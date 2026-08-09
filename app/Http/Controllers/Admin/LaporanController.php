<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PemasukanKas;
use App\Models\PengeluaranKas;
use App\Models\TransaksiPenjualan;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));

        // Pemasukan Kas (Excluding auto-generated sales to avoid double counting in the view breakdown)
        $pemasukan = PemasukanKas::whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->whereNull('id_transaksi')
            ->get();
            
        // Pengeluaran Kas
        $pengeluaran = PengeluaranKas::whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->get();

        // Penjualan (Transkasi)
        $penjualan = TransaksiPenjualan::whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->where('status', 'selesai')
            ->get();

        $totalPemasukan = $pemasukan->sum('nominal');
        $totalPengeluaran = $pengeluaran->sum('nominal');
        $totalPenjualan = $penjualan->sum('total');
        
        $labaKotor = $totalPenjualan + $totalPemasukan;
        $labaBersih = $labaKotor - $totalPengeluaran;

        // TREN HARIAN (Chart Data)
        $daysInMonth = Carbon::createFromDate($tahun, $bulan)->daysInMonth;
        $labelsHarian = [];
        $dataPemasukanHarian = [];
        $dataPengeluaranHarian = [];

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $labelsHarian[] = $day;
            
            // Pemasukan hari ini (termasuk penjualan, jadi gabungkan manual kas + transaksi online)
            $pemasukanKasHariIni = $pemasukan->filter(function($item) use ($tahun, $bulan, $day) {
                return Carbon::parse($item->tanggal)->format('Y-m-d') === sprintf('%04d-%02d-%02d', $tahun, $bulan, $day);
            })->sum('nominal');

            $penjualanHariIni = $penjualan->filter(function($item) use ($tahun, $bulan, $day) {
                return Carbon::parse($item->tanggal)->format('Y-m-d') === sprintf('%04d-%02d-%02d', $tahun, $bulan, $day);
            })->sum('total');

            $dataPemasukanHarian[] = $pemasukanKasHariIni + $penjualanHariIni;

            // Pengeluaran hari ini
            $pengeluaranHariIni = $pengeluaran->filter(function($item) use ($tahun, $bulan, $day) {
                return Carbon::parse($item->tanggal)->format('Y-m-d') === sprintf('%04d-%02d-%02d', $tahun, $bulan, $day);
            })->sum('nominal');
            $dataPengeluaranHarian[] = $pengeluaranHariIni;
        }

        // TOP PRODUK TERLARIS
        $topProduk = \App\Models\DetailTransaksi::select('id_produk', \DB::raw('SUM(jumlah) as total_terjual'), \DB::raw('SUM(subtotal) as total_pendapatan'))
            ->whereHas('transaksi', function($q) use ($bulan, $tahun) {
                $q->whereMonth('tanggal', $bulan)
                  ->whereYear('tanggal', $tahun)
                  ->where('status', 'selesai');
            })
            ->with('produk')
            ->groupBy('id_produk')
            ->orderByDesc('total_terjual')
            ->limit(5)
            ->get();

        return view('admin.laporan.index', compact(
            'bulan', 'tahun', 'pemasukan', 'pengeluaran', 'penjualan',
            'totalPemasukan', 'totalPengeluaran', 'totalPenjualan', 'labaKotor', 'labaBersih',
            'labelsHarian', 'dataPemasukanHarian', 'dataPengeluaranHarian', 'topProduk'
        ));
    }
}
