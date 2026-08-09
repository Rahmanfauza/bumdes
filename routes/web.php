<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $produks = \App\Models\Produk::with('kategori')
        ->where('status', 'aktif')
        ->latest('id_produk')
        ->take(8)
        ->get();
    return view('welcome', compact('produks'));
});

Route::get('/berita', function () {
    return view('berita');
});

Route::get('/katalog', function (\Illuminate\Http\Request $request) {
    $kategoriId = $request->query('kategori');
    $search = $request->query('q');

    $query = \App\Models\Produk::with('kategori')->where('status', 'aktif');

    if ($kategoriId && $kategoriId != 'all') {
        $query->where('id_kategori', $kategoriId);
    }

    if ($search) {
        $query->where(function($q) use ($search) {
            $q->where('nama_produk', 'like', "%{$search}%")
              ->orWhere('deskripsi', 'like', "%{$search}%");
        });
    }

    $produks = $query->latest('id_produk')->get();
    $kategoris = \App\Models\KategoriProduk::withCount(['produk' => function($q) {
        $q->where('status', 'aktif');
    }])->get();

    return view('katalog', compact('produks', 'kategoris', 'kategoriId', 'search'));
});

Route::get('/profil', function () {
    return view('profil');
});

Route::get('/kontak', function () {
    return view('kontak');
});

// Auth Routes
// Auth Routes untuk Admin/Manajerial (Terpisah dari User)
Route::get('/admin/login', [\App\Http\Controllers\AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [\App\Http\Controllers\AdminAuthController::class, 'login']);
Route::post('/admin/logout', [\App\Http\Controllers\AdminAuthController::class, 'logout'])->name('admin.logout');

// Auth Routes untuk User (Pelanggan)
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register'])->name('register');
Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

// Customer Shopping Cart, Checkout & Orders Routes
Route::post('/cart/add', [\App\Http\Controllers\KeranjangController::class, 'addToCart'])->name('cart.add');
Route::get('/keranjang', [\App\Http\Controllers\KeranjangController::class, 'index'])->name('cart.index');
Route::put('/cart/{id}', [\App\Http\Controllers\KeranjangController::class, 'update'])->name('cart.update');
Route::delete('/cart/{id}', [\App\Http\Controllers\KeranjangController::class, 'destroy'])->name('cart.destroy');
Route::get('/checkout', [\App\Http\Controllers\KeranjangController::class, 'checkoutView'])->name('cart.checkout');
Route::post('/checkout', [\App\Http\Controllers\KeranjangController::class, 'processCheckout'])->name('cart.checkout.process');
Route::get('/pesanan', [\App\Http\Controllers\KeranjangController::class, 'myOrders'])->name('cart.orders');
Route::get('/pesanan/{id}', [\App\Http\Controllers\KeranjangController::class, 'showOrder'])->name('cart.order.detail');

// Protected Dashboard Route
Route::group(['prefix' => 'admin'], function () {
    Route::get('/dashboard', function () {
        // Cek session login admin
        if (!\Illuminate\Support\Facades\Session::has('admin_logged_in')) {
            return redirect('/admin/login')->withErrors(['error' => 'Silakan login terlebih dahulu.']);
        }

        $jumlahPelanggan = \App\Models\Pelanggan::count();
        $jumlahProduk = \App\Models\Produk::count();
        $totalTransaksi = \App\Models\TransaksiPenjualan::count();

        // Nilai total aset dari stok produk
        $allProduk = \App\Models\Produk::get();
        $totalAktiva = $allProduk->sum(fn($p) => $p->stok * $p->harga);

        // Kas BUMDes = total pemasukan - total pengeluaran
        $totalPemasukan = \App\Models\PemasukanKas::sum('nominal');
        $totalPengeluaran = \App\Models\PengeluaranKas::sum('nominal');
        $kasBumdes = $totalPemasukan - $totalPengeluaran;

        // Laba/Rugi hari ini (penjualan hari ini)
        $today = now()->toDateString();
        $labaRugiHariIni = \App\Models\TransaksiPenjualan::whereDate('tanggal', $today)->sum('total');

        // Transaksi hari ini
        $transaksiHariIni = \App\Models\TransaksiPenjualan::whereDate('tanggal', $today)->count();

        // Chart data bulanan (12 bulan tahun ini)
        // Dummy data for now as we don't have complex charts setup for the new tables yet
        $pemasukanPerBulan = array_fill(1, 12, 0);
        $pengeluaranPerBulan = array_fill(1, 12, 0);

        return view('admin.dashboard', compact(
            'jumlahPelanggan', 'jumlahProduk', 'totalTransaksi',
            'totalAktiva', 'kasBumdes', 'labaRugiHariIni',
            'transaksiHariIni', 'pemasukanPerBulan', 'pengeluaranPerBulan'
        ));
    })->name('dashboard');

    // Admin Routes
    Route::resource('produk', \App\Http\Controllers\Admin\ProdukController::class, ['as' => 'admin']);
    Route::resource('kategori', \App\Http\Controllers\Admin\KategoriProdukController::class, ['as' => 'admin'])->except(['create', 'show', 'edit']);
    Route::resource('transaksi', \App\Http\Controllers\Admin\TransaksiPenjualanController::class, ['as' => 'admin']);
    Route::put('transaksi/{id}/status', [\App\Http\Controllers\Admin\TransaksiPenjualanController::class, 'updateStatus'])->name('admin.transaksi.update-status');
    Route::resource('surat', \App\Http\Controllers\Admin\SuratController::class, ['as' => 'admin']);
    Route::resource('arsip', \App\Http\Controllers\Admin\ArsipDigitalController::class, ['as' => 'admin'])->except(['create', 'edit', 'update']);
    
    // Kas
    Route::get('kas', [\App\Http\Controllers\Admin\KasController::class, 'index'])->name('admin.kas.index');
    Route::post('kas/pemasukan', [\App\Http\Controllers\Admin\KasController::class, 'storePemasukan'])->name('admin.kas.pemasukan.store');
    Route::post('kas/pengeluaran', [\App\Http\Controllers\Admin\KasController::class, 'storePengeluaran'])->name('admin.kas.pengeluaran.store');
    Route::delete('kas/pemasukan/{id}', [\App\Http\Controllers\Admin\KasController::class, 'destroyPemasukan'])->name('admin.kas.pemasukan.destroy');
    Route::delete('kas/pengeluaran/{id}', [\App\Http\Controllers\Admin\KasController::class, 'destroyPengeluaran'])->name('admin.kas.pengeluaran.destroy');
    
    // Laporan Keuangan
    Route::get('laporan', [\App\Http\Controllers\Admin\LaporanController::class, 'index'])->name('admin.laporan.index');

    // Approval Dokumen (Direktur)
    Route::get('approval', [\App\Http\Controllers\Admin\ApprovalDokumenController::class, 'index'])->name('admin.approval.index');
    Route::put('approval/{id}', [\App\Http\Controllers\Admin\ApprovalDokumenController::class, 'update'])->name('admin.approval.update');

    // Manajemen Akun (Direktur)
    Route::resource('akun', \App\Http\Controllers\Admin\AkunController::class, ['as' => 'admin']);

});
