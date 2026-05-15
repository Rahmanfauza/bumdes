<?php

namespace App\Http\Controllers\Admin\UnitUsaha;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use Illuminate\Http\Request;

class SimpanPinjamController extends Controller
{
    private function calculateLimitPinjaman()
    {
        $totalSaldoAwal = \App\Models\SaldoAwal::sum('jumlah');
        $totalPemasukan = \App\Models\Transaksi::where('jenis_transaksi', 'Pemasukan')->sum('jumlah');
        $totalPengeluaran = \App\Models\Transaksi::where('jenis_transaksi', 'Pengeluaran')->sum('jumlah');
        $totalSimpanan = \App\Models\Simpanan::sum('jumlah');
        $totalPinjamanDiberikan = \App\Models\Pinjaman::sum('jumlah_pinjaman');

        return $totalSaldoAwal + $totalPemasukan - $totalPengeluaran + $totalSimpanan - $totalPinjamanDiberikan;
    }

    public function index()
    {
        $anggotas = Anggota::all();
        $simpanans = \App\Models\Simpanan::with('anggota')->orderBy('tanggal', 'desc')->get();
        $pinjamans = \App\Models\Pinjaman::with('anggota')->orderBy('tanggal_pencairan', 'desc')->get();
        $limitPinjaman = $this->calculateLimitPinjaman();

        return view('admin.unitusaha.simpan-pinjam', compact('anggotas', 'simpanans', 'pinjamans', 'limitPinjaman'));
    }

    public function storeSimpanan(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'anggota_id' => 'required|exists:anggotas,id',
            'jenis' => 'required|string',
            'jumlah' => 'required|numeric',
            'keterangan' => 'nullable|string',
        ]);

        \App\Models\Simpanan::create($request->all());

        return redirect()->back()->with('success', 'Data simpanan berhasil ditambahkan!');
    }

    public function storePinjaman(Request $request)
    {
        $request->validate([
            'anggota_id' => 'required|exists:anggotas,id',
            'jumlah_pinjaman' => 'required|numeric',
            'tanggal_pencairan' => 'required|date',
            'bunga' => 'required|numeric',
            'jangka_waktu' => 'required|integer',
            'akun_pencairan' => 'required|string',
        ]);

        $limit = $this->calculateLimitPinjaman();
        if ($request->jumlah_pinjaman > $limit) {
            return redirect()->back()->withErrors(['error' => 'Jumlah pinjaman melebihi limit dana yang tersedia! Limit: Rp ' . number_format($limit, 0, ',', '.')]);
        }

        $data = $request->all();
        $data['sisa_pokok'] = $request->jumlah_pinjaman;
        $data['status'] = 'Aktif';

        \App\Models\Pinjaman::create($data);

        return redirect()->back()->with('success', 'Pengajuan pinjaman berhasil dan sedang diproses!');
    }
}
