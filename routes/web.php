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

// Auth Routes (Dummy Array)
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

// Protected Dashboard Route
Route::group(['prefix' => 'admin'], function () {
    Route::get('/dashboard', function () {
        // Cek session login sederhana
        if (!\Illuminate\Support\Facades\Session::has('logged_in')) {
            return redirect('/')->withErrors(['error' => 'Silakan login terlebih dahulu.']);
        }

        $jumlahAnggota = \App\Models\Anggota::count();
        $jumlahUnitUsaha = \App\Models\UnitUsaha::count();
        $totalTransaksi = \App\Models\Transaksi::count();

        return view('admin.dashboard', compact('jumlahAnggota', 'jumlahUnitUsaha', 'totalTransaksi'));
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

    // Unit Usaha Routes
    Route::get('/input-data/unit-usaha', [\App\Http\Controllers\Admin\InputData\UnitUsahaController::class, 'index'])->name('unit-usaha');
    Route::post('/input-data/unit-usaha', [\App\Http\Controllers\Admin\InputData\UnitUsahaController::class, 'store'])->name('unit-usaha.store');
    Route::put('/input-data/unit-usaha/{id}', [\App\Http\Controllers\Admin\InputData\UnitUsahaController::class, 'update'])->name('unit-usaha.update');
    Route::delete('/input-data/unit-usaha/{id}', [\App\Http\Controllers\Admin\InputData\UnitUsahaController::class, 'destroy'])->name('unit-usaha.destroy');

    // Transaksi Routes
    Route::get('/transaksi', [\App\Http\Controllers\Admin\Transaksi\TransaksiController::class, 'index'])->name('transaksi.index');
    Route::post('/transaksi', [\App\Http\Controllers\Admin\Transaksi\TransaksiController::class, 'store'])->name('transaksi.store');
    Route::put('/transaksi/{id}', [\App\Http\Controllers\Admin\Transaksi\TransaksiController::class, 'update'])->name('transaksi.update');
    Route::delete('/transaksi/{id}', [\App\Http\Controllers\Admin\Transaksi\TransaksiController::class, 'destroy'])->name('transaksi.destroy');

    // Laporan Route
    Route::get('/laporan', [\App\Http\Controllers\Admin\Laporan\LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/export-csv', [\App\Http\Controllers\Admin\Laporan\LaporanController::class, 'exportCsv'])->name('laporan.export.csv');
    Route::get('/laporan/export-pdf', [\App\Http\Controllers\Admin\Laporan\LaporanController::class, 'exportPdf'])->name('laporan.export.pdf');
});
