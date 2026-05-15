<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/berita', function () {
    return view('berita');
});

Route::get('/katalog', function () {
    return view('katalog');
});

Route::get('/profil', function () {
    return view('profil');
});

Route::get('/kontak', function () {
    return view('kontak');
});

// Auth Routes
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);
Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

// Protected Dashboard Route
Route::group(['prefix' => 'admin'], function () {
    Route::get('/dashboard', function () {
        // Cek session login sederhana
        if (!\Illuminate\Support\Facades\Session::has('logged_in')) {
            return redirect('/')->withErrors(['error' => 'Silakan login terlebih dahulu.']);
        }

        $jumlahAnggota   = \App\Models\Anggota::count();
        $jumlahUnitUsaha = \App\Models\UnitUsaha::count();
        $totalTransaksi  = \App\Models\Transaksi::count();

        // Nilai total aktiva dari stok produk
        $allProduk   = \App\Models\ProdukJasa::get();
        $totalAktiva = $allProduk->sum(fn($p) => $p->stok_awal * $p->harga_jual);

        // Modal = total pemasukan - total pengeluaran (seluruh waktu)
        $totalPemasukan   = \App\Models\Transaksi::where('jenis_transaksi', 'Pemasukan')->sum('jumlah');
        $totalPengeluaran = \App\Models\Transaksi::where('jenis_transaksi', 'Pengeluaran')->sum('jumlah');
        $modalBumdes      = $totalPemasukan - $totalPengeluaran;

        // Laba/Rugi hari ini
        $today            = now()->toDateString();
        $pemasukanHariIni = \App\Models\Transaksi::where('jenis_transaksi', 'Pemasukan')->whereDate('tanggal_transaksi', $today)->sum('jumlah');
        $pengeluaranHariIni = \App\Models\Transaksi::where('jenis_transaksi', 'Pengeluaran')->whereDate('tanggal_transaksi', $today)->sum('jumlah');
        $labaRugiHariIni  = $pemasukanHariIni - $pengeluaranHariIni;

        // Transaksi hari ini
        $transaksiHariIni = \App\Models\Transaksi::whereDate('tanggal_transaksi', $today)->count();

        // Chart data bulanan (12 bulan tahun ini)
        $tahunIni = now()->year;
        $bulananRaw = \App\Models\Transaksi::selectRaw('MONTH(tanggal_transaksi) as bulan, jenis_transaksi, SUM(jumlah) as total')
            ->whereYear('tanggal_transaksi', $tahunIni)
            ->groupBy('bulan', 'jenis_transaksi')->get();
        $pemasukanPerBulan   = array_fill(1, 12, 0);
        $pengeluaranPerBulan = array_fill(1, 12, 0);
        foreach ($bulananRaw as $row) {
            if ($row->jenis_transaksi === 'Pemasukan') $pemasukanPerBulan[$row->bulan] = (float) $row->total;
            else $pengeluaranPerBulan[$row->bulan] = (float) $row->total;
        }

        return view('admin.dashboard', compact(
            'jumlahAnggota', 'jumlahUnitUsaha', 'totalTransaksi',
            'totalAktiva', 'modalBumdes', 'labaRugiHariIni',
            'transaksiHariIni', 'pemasukanPerBulan', 'pengeluaranPerBulan'
        ));
    })->name('dashboard');

    Route::get('/anggota', function () {
        // Cek session login sederhana
        if (!\Illuminate\Support\Facades\Session::has('logged_in')) {
            return redirect('/')->withErrors(['error' => 'Silakan login terlebih dahulu.']);
        }
        return view('admin.anggota');
    })->name('admin.anggota');

    Route::get('/input-data/anggota', function () {
        // Cek session login sederhana
        if (!\Illuminate\Support\Facades\Session::has('logged_in')) {
            return redirect('/')->withErrors(['error' => 'Silakan login terlebih dahulu.']);
        }
        $anggotas = \App\Models\Anggota::latest()->get();
        return view('admin.input data.anggota', compact('anggotas'));
    })->name('input-data.anggota');

    Route::post('/input-data/anggota', [\App\Http\Controllers\Admin\InputData\AnggotaController::class, 'store'])->name('anggota.store');
    Route::get('/input-data/anggota/{id}/edit', [\App\Http\Controllers\Admin\InputData\AnggotaController::class, 'edit'])->name('anggota.edit');
    Route::put('/input-data/anggota/{id}', [\App\Http\Controllers\Admin\InputData\AnggotaController::class, 'update'])->name('anggota.update');
    Route::delete('/input-data/anggota/{id}', [\App\Http\Controllers\Admin\InputData\AnggotaController::class, 'destroy'])->name('anggota.destroy');

    // Pelanggan Routes
    Route::get('/input-data/pelanggan', [\App\Http\Controllers\Admin\InputData\PelangganController::class, 'index'])->name('pelanggan.index');
    Route::post('/input-data/pelanggan', [\App\Http\Controllers\Admin\InputData\PelangganController::class, 'store'])->name('pelanggan.store');
    Route::put('/input-data/pelanggan/{id}', [\App\Http\Controllers\Admin\InputData\PelangganController::class, 'update'])->name('pelanggan.update');
    Route::delete('/input-data/pelanggan/{id}', [\App\Http\Controllers\Admin\InputData\PelangganController::class, 'destroy'])->name('pelanggan.destroy');

    // Produk & Jasa Routes
    Route::get('/input-data/produkjasa', [\App\Http\Controllers\Admin\InputData\ProdukJasaController::class, 'index'])->name('produkjasa.index');
    Route::post('/input-data/produkjasa', [\App\Http\Controllers\Admin\InputData\ProdukJasaController::class, 'store'])->name('produkjasa.store');
    Route::put('/input-data/produkjasa/{id}', [\App\Http\Controllers\Admin\InputData\ProdukJasaController::class, 'update'])->name('produkjasa.update');
    Route::delete('/input-data/produkjasa/{id}', [\App\Http\Controllers\Admin\InputData\ProdukJasaController::class, 'destroy'])->name('produkjasa.destroy');

    // Manajemen Stok Routes
    Route::get('/input-data/stok', [\App\Http\Controllers\Admin\InputData\StokController::class, 'index'])->name('stok.index');
    Route::put('/input-data/stok/{id}', [\App\Http\Controllers\Admin\InputData\StokController::class, 'update'])->name('stok.update');

    // Input Jurnal Routes
    Route::get('/input-data/jurnal', [\App\Http\Controllers\Admin\InputData\JurnalController::class, 'index'])->name('jurnal.index');
    Route::delete('/input-data/jurnal/{id}', [\App\Http\Controllers\Admin\InputData\JurnalController::class, 'destroy'])->name('jurnal.destroy');


    // Saldo Awal Routes
    Route::get('/input-data/saldo-awal', [\App\Http\Controllers\Admin\InputData\SaldoAwalController::class, 'index'])->name('saldo-awal.index');
    Route::post('/input-data/saldo-awal', [\App\Http\Controllers\Admin\InputData\SaldoAwalController::class, 'store'])->name('saldo-awal.store');

    // Akun COA Routes
    Route::get('/input-data/akun-coa', [\App\Http\Controllers\Admin\InputData\AkunCoaController::class, 'index'])->name('akun-coa.index');
    Route::post('/input-data/akun-coa', [\App\Http\Controllers\Admin\InputData\AkunCoaController::class, 'store'])->name('akun-coa.store');
    Route::put('/input-data/akun-coa/{id}', [\App\Http\Controllers\Admin\InputData\AkunCoaController::class, 'update'])->name('akun-coa.update');
    Route::delete('/input-data/akun-coa/{id}', [\App\Http\Controllers\Admin\InputData\AkunCoaController::class, 'destroy'])->name('akun-coa.destroy');

    // Unit Usaha Routes
    Route::get('/unit-usaha', [\App\Http\Controllers\Admin\UnitUsaha\UnitUsahaController::class, 'index'])->name('unit-usaha');
    Route::post('/unit-usaha', [\App\Http\Controllers\Admin\UnitUsaha\UnitUsahaController::class, 'store'])->name('unit-usaha.store');
    Route::put('/unit-usaha/{id}', [\App\Http\Controllers\Admin\UnitUsaha\UnitUsahaController::class, 'update'])->name('unit-usaha.update');
    Route::delete('/unit-usaha/{id}', [\App\Http\Controllers\Admin\UnitUsaha\UnitUsahaController::class, 'destroy'])->name('unit-usaha.destroy');

    // POS Routes
    Route::get('/unit-usaha/pos', [\App\Http\Controllers\Admin\UnitUsaha\PosController::class, 'index'])->name('pos.index');
    Route::post('/unit-usaha/pos/checkout', [\App\Http\Controllers\Admin\UnitUsaha\PosController::class, 'checkout'])->name('pos.checkout');

    // Simpan Pinjam Routes
    Route::get('/unit-usaha/simpan-pinjam', [\App\Http\Controllers\Admin\UnitUsaha\SimpanPinjamController::class, 'index'])->name('simpan-pinjam.index');
    Route::post('/unit-usaha/simpan-pinjam/simpanan', [\App\Http\Controllers\Admin\UnitUsaha\SimpanPinjamController::class, 'storeSimpanan'])->name('simpan-pinjam.simpanan.store');
    Route::post('/unit-usaha/simpan-pinjam/pinjaman', [\App\Http\Controllers\Admin\UnitUsaha\SimpanPinjamController::class, 'storePinjaman'])->name('simpan-pinjam.pinjaman.store');

    // Transaksi Routes
    Route::get('/transaksi', [\App\Http\Controllers\Admin\Transaksi\TransaksiController::class, 'index'])->name('transaksi.index');
    Route::post('/transaksi', [\App\Http\Controllers\Admin\Transaksi\TransaksiController::class, 'store'])->name('transaksi.store');
    Route::put('/transaksi/{id}', [\App\Http\Controllers\Admin\Transaksi\TransaksiController::class, 'update'])->name('transaksi.update');
    Route::delete('/transaksi/{id}', [\App\Http\Controllers\Admin\Transaksi\TransaksiController::class, 'destroy'])->name('transaksi.destroy');

    // Laporan Route
    Route::get('/laporan', [\App\Http\Controllers\Admin\Laporan\LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/export-csv', [\App\Http\Controllers\Admin\Laporan\LaporanController::class, 'exportCsv'])->name('laporan.export.csv');
    Route::get('/laporan/export-pdf', [\App\Http\Controllers\Admin\Laporan\LaporanController::class, 'exportPdf'])->name('laporan.export.pdf');

    // Laporan Stok Routes
    Route::get('/laporan/stok', [\App\Http\Controllers\Admin\Laporan\LaporanController::class, 'stok'])->name('laporan.stok');
    Route::get('/laporan/stok/export-csv', [\App\Http\Controllers\Admin\Laporan\LaporanController::class, 'exportStokCsv'])->name('laporan.stok.export.csv');
    Route::get('/laporan/stok/export-pdf', [\App\Http\Controllers\Admin\Laporan\LaporanController::class, 'exportStokPdf'])->name('laporan.stok.export.pdf');
});
