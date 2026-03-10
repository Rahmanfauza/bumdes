@extends('layouts.admin')

@section('header_title', 'Dashboard')

@section('content')
<!-- Welcome Banner -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 mb-8 overflow-hidden relative">
    <div class="absolute inset-y-0 right-0 w-1/3 bg-gradient-to-l from-blue-50/80 to-transparent pointer-events-none">
    </div>
    <div class="relative z-10">
        <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Selamat Datang di Dashboard!</h2>
        <p class="text-gray-500 max-w-2xl text-base leading-relaxed">Anda berhasil login menggunakan data dummy array.
            Di sini Anda bisa mengelola seluruh konten website BUMDes Go DIGITAL SOLUSI secara mudah.</p>
    </div>
</div>

<!-- Quick Stats -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div
        class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col items-center justify-center text-center transition hover:shadow-lg hover:border-blue-200 group">
        <div
            class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                </path>
            </svg>
        </div>
        <h3 class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-1">Total Produk</h3>
        <p class="text-4xl font-black text-gray-800">24</p>
    </div>

    <div
        class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col items-center justify-center text-center transition hover:shadow-lg hover:border-emerald-200 group">
        <div
            class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-emerald-500 group-hover:text-white transition-colors duration-300">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                </path>
            </svg>
        </div>
        <h3 class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-1">Berita Aktif</h3>
        <p class="text-4xl font-black text-gray-800">12</p>
    </div>

    <div
        class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col items-center justify-center text-center transition hover:shadow-lg hover:border-purple-200 group">
        <div
            class="w-14 h-14 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center mb-4 group-hover:bg-purple-500 group-hover:text-white transition-colors duration-300">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                </path>
            </svg>
        </div>
        <h3 class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-1">Total Kunjungan</h3>
        <p class="text-4xl font-black text-gray-800">8,405</p>
    </div>
</div>
@endsection