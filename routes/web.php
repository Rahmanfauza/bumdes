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
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/anggota', function () {
        // Cek session login sederhana
        if (!\Illuminate\Support\Facades\Session::has('logged_in')) {
            return redirect('/')->withErrors(['error' => 'Silakan login terlebih dahulu.']);
        }
        return view('admin.anggota');
    })->name('admin.anggota');
});
