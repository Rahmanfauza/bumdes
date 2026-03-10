<?php

namespace App\Http\Controllers\Admin\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\UnitUsaha;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    private function buildQuery(int $tahun, string|int|null $bulan, string|int|null $minggu = null)
    {
        return Transaksi::with('unitUsaha')
            ->whereYear('tanggal_transaksi', $tahun)
            ->when($bulan, fn($q) => $q->whereMonth('tanggal_transaksi', $bulan))
            ->when($minggu, fn($q) => $q->whereRaw('CEIL(DAY(tanggal_transaksi) / 7) = ?', [$minggu]))
            ->orderBy('tanggal_transaksi', 'desc');
    }

    private function aggregateTotals($transaksis): array
    {
        $totalPemasukan = $transaksis->where('jenis_transaksi', 'Pemasukan')->sum('jumlah');
        $totalPengeluaran = $transaksis->where('jenis_transaksi', 'Pengeluaran')->sum('jumlah');
        return [$totalPemasukan, $totalPengeluaran, $totalPemasukan - $totalPengeluaran];
    }

    private function namaBulanLengkap(): array
    {
        return [
            '',
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];
    }

    // ─────────────────────────────────────────────────────────────────────
    public function index(Request $request)
    {
        $tahunDipilih = (int) $request->get('tahun', date('Y'));
        $bulanDipilih = $request->get('bulan', '');
        $mingguDipilih = $request->get('minggu', '');

        $transaksis = $this->buildQuery($tahunDipilih, $bulanDipilih, $mingguDipilih)->get();

        [$totalPemasukan, $totalPengeluaran, $saldo] = $this->aggregateTotals($transaksis);

        $namaBulan = [
            1 => 'Jan',
            2 => 'Feb',
            3 => 'Mar',
            4 => 'Apr',
            5 => 'Mei',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Ags',
            9 => 'Sep',
            10 => 'Okt',
            11 => 'Nov',
            12 => 'Des',
        ];

        $bulananRaw = Transaksi::selectRaw(
            'MONTH(tanggal_transaksi) as bulan, jenis_transaksi, SUM(jumlah) as total'
        )->whereYear('tanggal_transaksi', $tahunDipilih)
            ->groupBy('bulan', 'jenis_transaksi')->get();

        $pemasukanPerBulan = array_fill(1, 12, 0);
        $pengeluaranPerBulan = array_fill(1, 12, 0);
        foreach ($bulananRaw as $row) {
            if ($row->jenis_transaksi === 'Pemasukan') {
                $pemasukanPerBulan[$row->bulan] = (float) $row->total;
            } else {
                $pengeluaranPerBulan[$row->bulan] = (float) $row->total;
            }
        }

        $perUnitUsaha = Transaksi::selectRaw(
            'unit_usaha_id, jenis_transaksi, SUM(jumlah) as total'
        )->whereYear('tanggal_transaksi', $tahunDipilih)
            ->when($bulanDipilih, fn($q) => $q->whereMonth('tanggal_transaksi', $bulanDipilih))
            ->when($mingguDipilih, fn($q) => $q->whereRaw('CEIL(DAY(tanggal_transaksi) / 7) = ?', [$mingguDipilih]))
            ->groupBy('unit_usaha_id', 'jenis_transaksi')
            ->with('unitUsaha')->get()->groupBy('unit_usaha_id');

        $tahunTersedia = Transaksi::selectRaw('YEAR(tanggal_transaksi) as tahun')
            ->distinct()->orderBy('tahun', 'desc')->pluck('tahun');

        if ($tahunTersedia->isEmpty()) {
            $tahunTersedia = collect([date('Y')]);
        }

        return view('admin.laporan.laporan', compact(
            'transaksis',
            'totalPemasukan',
            'totalPengeluaran',
            'saldo',
            'pemasukanPerBulan',
            'pengeluaranPerBulan',
            'namaBulan',
            'perUnitUsaha',
            'tahunDipilih',
            'bulanDipilih',
            'mingguDipilih',
            'tahunTersedia'
        ));
    }

    // ─────────────────────────────────────────────────────────────────────
    // EXPORT CSV
    // ─────────────────────────────────────────────────────────────────────
    public function exportCsv(Request $request)
    {
        $tahunDipilih = (int) $request->get('tahun', date('Y'));
        $bulanDipilih = $request->get('bulan', '');
        $mingguDipilih = $request->get('minggu', '');

        $transaksis = $this->buildQuery($tahunDipilih, $bulanDipilih, $mingguDipilih)->get();
        [$totalPemasukan, $totalPengeluaran, $saldo] = $this->aggregateTotals($transaksis);

        $bulanNama = $this->namaBulanLengkap();
        $strBulan = $bulanDipilih ? ($bulanNama[$bulanDipilih] ?? '') . ' ' : '';
        $strMinggu = $mingguDipilih ? "Pekan $mingguDipilih, " : '';
        $periodLabel = $strMinggu . $strBulan . ($bulanDipilih ? '' : 'Tahun_') . $tahunDipilih;

        $filename = 'Laporan_BUMDes_' . str_replace(' ', '_', $periodLabel) . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $callback = function () use ($transaksis, $totalPemasukan, $totalPengeluaran, $saldo, $periodLabel) {
            $out = fopen('php://output', 'w');
            fprintf($out, chr(0xEF) . chr(0xBB) . chr(0xBF)); // BOM UTF-8 agar Excel bisa baca

            fputcsv($out, ['LAPORAN KEUANGAN BUMDES'], ';');
            fputcsv($out, ['Periode: ' . str_replace('_', ' ', $periodLabel)], ';');
            fputcsv($out, ['Dicetak: ' . now()->format('d/m/Y H:i')], ';');
            fputcsv($out, [''], ';');

            fputcsv($out, ['RINGKASAN'], ';');
            fputcsv($out, ['Total Pemasukan', number_format($totalPemasukan, 0, ',', '.')], ';');
            fputcsv($out, ['Total Pengeluaran', number_format($totalPengeluaran, 0, ',', '.')], ';');
            fputcsv($out, ['Saldo Bersih', number_format($saldo, 0, ',', '.')], ';');
            fputcsv($out, [''], ';');

            fputcsv($out, ['No', 'Tanggal', 'Unit Usaha', 'Jenis Transaksi', 'Jumlah', 'Keterangan'], ';');
            foreach ($transaksis as $i => $t) {
                fputcsv($out, [
                    $i + 1,
                    \Carbon\Carbon::parse($t->tanggal_transaksi)->format('d/m/Y'),
                    $t->unitUsaha->nama_usaha ?? '-',
                    $t->jenis_transaksi,
                    (float) $t->jumlah,
                    $t->keterangan ?? '-',
                ], ';');
            }

            fputcsv($out, [''], ';');
            fputcsv($out, ['', '', '', 'TOTAL PEMASUKAN', (float) $totalPemasukan, ''], ';');
            fputcsv($out, ['', '', '', 'TOTAL PENGELUARAN', (float) $totalPengeluaran, ''], ';');
            fputcsv($out, ['', '', '', 'SALDO BERSIH', (float) $saldo, ''], ';');

            fclose($out);
        };

        return response()->stream($callback, 200, $headers);
    }

    // ─────────────────────────────────────────────────────────────────────
    // EXPORT PDF
    // ─────────────────────────────────────────────────────────────────────
    public function exportPdf(Request $request)
    {
        $tahunDipilih = (int) $request->get('tahun', date('Y'));
        $bulanDipilih = $request->get('bulan', '');
        $mingguDipilih = $request->get('minggu', '');

        $transaksis = $this->buildQuery($tahunDipilih, $bulanDipilih, $mingguDipilih)->get();
        [$totalPemasukan, $totalPengeluaran, $saldo] = $this->aggregateTotals($transaksis);

        $perUnitUsaha = Transaksi::selectRaw(
            'unit_usaha_id, jenis_transaksi, SUM(jumlah) as total'
        )->whereYear('tanggal_transaksi', $tahunDipilih)
            ->when($bulanDipilih, fn($q) => $q->whereMonth('tanggal_transaksi', $bulanDipilih))
            ->when($mingguDipilih, fn($q) => $q->whereRaw('CEIL(DAY(tanggal_transaksi) / 7) = ?', [$mingguDipilih]))
            ->groupBy('unit_usaha_id', 'jenis_transaksi')
            ->with('unitUsaha')->get()->groupBy('unit_usaha_id');

        $bulanNama = $this->namaBulanLengkap();
        $strBulan = $bulanDipilih ? ($bulanNama[$bulanDipilih] ?? '') . ' ' : '';
        $strMinggu = $mingguDipilih ? "Pekan $mingguDipilih, " : '';
        $periodLabel = $strMinggu . $strBulan . ($bulanDipilih ? '' : 'Tahun ') . $tahunDipilih;

        $pdf = Pdf::loadView('admin.laporan.laporan-pdf', compact(
            'transaksis',
            'totalPemasukan',
            'totalPengeluaran',
            'saldo',
            'perUnitUsaha',
            'periodLabel'
        ))->setPaper('a4', 'portrait');

        return $pdf->download('Laporan_BUMDes_' . str_replace(' ', '_', $periodLabel) . '.pdf');
    }
}
