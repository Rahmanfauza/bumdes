@extends('layouts.app')

@section('content')
<!-- Hero Background Wrapper -->
<div class="relative w-full min-h-screen bg-cover bg-center"
    style="background-image: url('{{ asset('raiyan-zakaria-Y43aG83fYMA-unsplash.jpg') }}');">
    <!-- Dark Overlay -->
    <div class="absolute inset-0 bg-black/70"></div>

    <!-- Main Content Container with Split Layout -->
    <div class="relative z-10 w-full min-h-screen flex items-center justify-center p-6 lg:px-12 lg:pt-24 pb-12">
        <!-- Split Grid Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-8 w-full max-w-7xl items-center mt-16 lg:mt-0">

            <!-- Hero Section (Left) -->
            <div class="text-left w-full max-w-2xl px-4 lg:px-0">
                <h1
                    class="text-4xl md:text-5xl lg:text-5xl font-extrabold text-white leading-[1.1] mb-4 tracking-tight">
                    BUMDes <span class="text-blue-300">GO</span><br />DIGITAL SOLUSI
                </h1>

                <h3 class="text-xl md:text-2xl text-white/90 font-medium mb-6">
                    Desa Sinulasi
                </h3>

                <p class="text-base md:text-lg text-white/80 mb-10 max-w-md leading-relaxed">
                    Aplikasi akuntansi cerdas dan transparan untuk tata kelola BUMDes yang lebih modern dan
                    akuntabel.
                </p>

                <div class="flex flex-col sm:flex-row items-start lg:items-center gap-4">
                    <a href="#"
                        class="w-full sm:w-auto text-center px-8 py-3.5 bg-white text-[#111827] font-bold rounded-lg shadow-lg hover:bg-gray-100 transition-all focus:ring-4 focus:ring-white/50 text-sm">
                        Lihat Katalog Produk
                    </a>
                    <a href="#"
                        class="w-full sm:w-auto text-center px-8 py-3.5 bg-white/10 text-white font-semibold rounded-lg shadow-lg border border-transparent hover:bg-blue-300 transition-all focus:ring-4 focus:ring-[#2A2359]/50 text-sm">
                        Lihat Profil Kami
                    </a>
                </div>
            </div>

            <!-- Empty Column for Grid Balance -->
            <div class="hidden lg:block"></div>
        </div>
    </div>
</div> <!-- Close Hero Wrapper -->

<!-- Struktur pengurus -->
<div class="w-full py-24 sm:py-32 bg-blue-300 relative z-20 shadow-xl rounded-t-[3rem] -mt-8">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">Struktur Pengurus</h2>
            <p class="mt-4 text-lg leading-8 text-white">Tim pengelola BUMDes Go Digital Solusi yang
                berpengalaman dan berdedikasi tinggi demi kemajuan desa.</p>
        </div>
        <ul role="list"
            class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-12 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-3">
            <!-- Direktur -->
            <li
                class="text-center bg-white/20 backdrop-blur-md rounded-3xl p-8 border border-white/40 shadow-xl hover:bg-white/30 transform hover:-translate-y-2 hover:scale-105 hover:shadow-2xl transition-all duration-300 cursor-pointer group">
                <img class="mx-auto h-32 w-32 rounded-full object-cover shadow-md border-4 border-white group-hover:border-blue-200 transition-colors duration-300"
                    src="https://ui-avatars.com/api/?name=Budi+Santoso&size=200&background=1e3a8a&color=fff"
                    alt="Budi Santoso">
                <h3
                    class="mt-6 text-xl font-bold leading-7 tracking-tight text-gray-900 group-hover:text-blue-900 transition-colors duration-300">
                    Budi Santoso</h3>
                <p class="text-sm leading-6 text-blue-800 font-semibold mt-1">Direktur BUMDes</p>
            </li>
            <!-- Sekretaris -->
            <li
                class="text-center bg-white/20 backdrop-blur-md rounded-3xl p-8 border border-white/40 shadow-xl hover:bg-white/30 transform hover:-translate-y-2 hover:scale-105 hover:shadow-2xl transition-all duration-300 cursor-pointer group">
                <img class="mx-auto h-32 w-32 rounded-full object-cover shadow-md border-4 border-white group-hover:border-blue-200 transition-colors duration-300"
                    src="https://ui-avatars.com/api/?name=Siti+Aminah&size=200&background=1e3a8a&color=fff"
                    alt="Siti Aminah">
                <h3
                    class="mt-6 text-xl font-bold leading-7 tracking-tight text-gray-900 group-hover:text-blue-900 transition-colors duration-300">
                    Siti Aminah</h3>
                <p class="text-sm leading-6 text-blue-800 font-semibold mt-1">Sekretaris</p>
            </li>
            <!-- Bendahara -->
            <li
                class="text-center bg-white/20 backdrop-blur-md rounded-3xl p-8 border border-white/40 shadow-xl hover:bg-white/30 transform hover:-translate-y-2 hover:scale-105 hover:shadow-2xl transition-all duration-300 cursor-pointer group">
                <img class="mx-auto h-32 w-32 rounded-full object-cover shadow-md border-4 border-white group-hover:border-blue-200 transition-colors duration-300"
                    src="https://ui-avatars.com/api/?name=Ahmad+Fauzi&size=200&background=1e3a8a&color=fff"
                    alt="Ahmad Fauzi">
                <h3
                    class="mt-6 text-xl font-bold leading-7 tracking-tight text-gray-900 group-hover:text-blue-900 transition-colors duration-300">
                    Ahmad Fauzi</h3>
                <p class="text-sm leading-6 text-blue-800 font-semibold mt-1">Bendahara</p>
            </li>
        </ul>
    </div>
</div>

<!-- Galeri Kegiatan -->
<div class="w-full py-24 sm:py-32 relative z-20 overflow-hidden bg-[#f0f4ff]">
    <!-- Ambient blur blobs -->
    <div
        class="pointer-events-none absolute -top-24 -left-24 w-[500px] h-[500px] bg-blue-300 rounded-full opacity-30 blur-3xl">
    </div>
    <div
        class="pointer-events-none absolute -bottom-24 -right-24 w-[500px] h-[500px] bg-indigo-400 rounded-full opacity-25 blur-3xl">
    </div>
    <div
        class="pointer-events-none absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[400px] bg-sky-200 rounded-full opacity-20 blur-3xl">
    </div>
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center mb-16">
            <h2 class="text-3xl font-bold tracking-tight text-blue-300 sm:text-4xl">Galeri Kegiatan</h2>
            <p class="mt-4 text-lg leading-8 text-gray-600">Dokumentasi berbagai aktivitas dan program unggulan dari
                BUMDes Go Digital Solusi di Desa Sinulasi.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Item 1 -->
            <div
                class="group relative overflow-hidden rounded-3xl shadow-md hover:shadow-2xl transition-all duration-300 cursor-pointer">
                <img src="https://picsum.photos/800/600?random=1" alt="Kegiatan 1"
                    class="w-full h-72 object-cover transform group-hover:scale-110 transition-transform duration-700 ease-in-out">
                <div
                    class="absolute inset-0 bg-gradient-to-t from-gray-900/90 via-gray-900/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                </div>
                <div
                    class="absolute bottom-0 left-0 p-8 translate-y-4 group-hover:translate-y-0 opacity-0 group-hover:opacity-100 transition-all duration-300">
                    <h3 class="text-2xl font-bold text-white mb-2">Rapat Desa</h3>
                    <p class="text-sm text-blue-200">Kegiatan koordinasi bulanan pengurus</p>
                    <p class="flex items-center gap-1.5 text-xs text-white/60 mt-2">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        15 Januari 2026
                    </p>
                </div>
            </div>

            <!-- Item 2 -->
            <div
                class="group relative overflow-hidden rounded-3xl shadow-md hover:shadow-2xl transition-all duration-300 cursor-pointer">
                <img src="https://picsum.photos/800/600?random=2" alt="Kegiatan 2"
                    class="w-full h-72 object-cover transform group-hover:scale-110 transition-transform duration-700 ease-in-out">
                <div
                    class="absolute inset-0 bg-gradient-to-t from-gray-900/90 via-gray-900/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                </div>
                <div
                    class="absolute bottom-0 left-0 p-8 translate-y-4 group-hover:translate-y-0 opacity-0 group-hover:opacity-100 transition-all duration-300">
                    <h3 class="text-2xl font-bold text-white mb-2">Pelatihan Digital</h3>
                    <p class="text-sm text-blue-200">Pemberdayaan UMKM berbasis digital</p>
                    <p class="flex items-center gap-1.5 text-xs text-white/60 mt-2">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        3 Februari 2026
                    </p>
                </div>
            </div>

            <!-- Item 3 -->
            <div
                class="group relative overflow-hidden rounded-3xl shadow-md hover:shadow-2xl transition-all duration-300 cursor-pointer">
                <img src="https://picsum.photos/800/600?random=3" alt="Kegiatan 3"
                    class="w-full h-72 object-cover transform group-hover:scale-110 transition-transform duration-700 ease-in-out">
                <div
                    class="absolute inset-0 bg-gradient-to-t from-gray-900/90 via-gray-900/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                </div>
                <div
                    class="absolute bottom-0 left-0 p-8 translate-y-4 group-hover:translate-y-0 opacity-0 group-hover:opacity-100 transition-all duration-300">
                    <h3 class="text-2xl font-bold text-white mb-2">Pasar Desa</h3>
                    <p class="text-sm text-blue-200">Gelar lapak UMKM lokal & hasil bumi</p>
                    <p class="flex items-center gap-1.5 text-xs text-white/60 mt-2">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        22 Februari 2026
                    </p>
                </div>
            </div>

            <!-- Item 4 -->
            <div
                class="group relative overflow-hidden rounded-3xl shadow-md hover:shadow-2xl transition-all duration-300 cursor-pointer">
                <img src="https://picsum.photos/800/600?random=4" alt="Kegiatan 4"
                    class="w-full h-72 object-cover transform group-hover:scale-110 transition-transform duration-700 ease-in-out">
                <div
                    class="absolute inset-0 bg-gradient-to-t from-gray-900/90 via-gray-900/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                </div>
                <div
                    class="absolute bottom-0 left-0 p-8 translate-y-4 group-hover:translate-y-0 opacity-0 group-hover:opacity-100 transition-all duration-300">
                    <h3 class="text-2xl font-bold text-white mb-2">Kerja Bakti</h3>
                    <p class="text-sm text-blue-200">Gotong royong pembangunan desa</p>
                    <p class="flex items-center gap-1.5 text-xs text-white/60 mt-2">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        1 Maret 2026
                    </p>
                </div>
            </div>

            <!-- Item 5 -->
            <div
                class="group relative overflow-hidden rounded-3xl shadow-md hover:shadow-2xl transition-all duration-300 cursor-pointer">
                <img src="https://picsum.photos/800/600?random=5" alt="Kegiatan 5"
                    class="w-full h-72 object-cover transform group-hover:scale-110 transition-transform duration-700 ease-in-out">
                <div
                    class="absolute inset-0 bg-gradient-to-t from-gray-900/90 via-gray-900/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                </div>
                <div
                    class="absolute bottom-0 left-0 p-8 translate-y-4 group-hover:translate-y-0 opacity-0 group-hover:opacity-100 transition-all duration-300">
                    <h3 class="text-2xl font-bold text-white mb-2">Pertanian Cerdas</h3>
                    <p class="text-sm text-blue-200">Program budidaya hidroponik BUMDes</p>
                    <p class="flex items-center gap-1.5 text-xs text-white/60 mt-2">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        10 Maret 2026
                    </p>
                </div>
            </div>

            <!-- Item 6 -->
            <div
                class="group relative overflow-hidden rounded-3xl shadow-md hover:shadow-2xl transition-all duration-300 cursor-pointer">
                <img src="https://picsum.photos/800/600?random=6" alt="Kegiatan 6"
                    class="w-full h-72 object-cover transform group-hover:scale-110 transition-transform duration-700 ease-in-out">
                <div
                    class="absolute inset-0 bg-gradient-to-t from-gray-900/90 via-gray-900/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                </div>
                <div
                    class="absolute bottom-0 left-0 p-8 translate-y-4 group-hover:translate-y-0 opacity-0 group-hover:opacity-100 transition-all duration-300">
                    <h3 class="text-2xl font-bold text-white mb-2">Sosialisasi</h3>
                    <p class="text-sm text-blue-200">Pengenalan program BUMDes ke warga</p>
                    <p class="flex items-center gap-1.5 text-xs text-white/60 mt-2">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        20 Maret 2026
                    </p>
                </div>
            </div>
        </div>

        <div class="mt-14 mb-16 text-center">
            <a href="#"
                class="inline-flex justify-center items-center px-8 py-3.5 text-blue-700 bg-blue-50 border border-blue-100 hover:bg-blue-600 hover:text-white font-bold rounded-full transition-all duration-300 shadow-sm hover:shadow-lg">
                Lihat Semua Kegiatan
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </a>
        </div>
    </div>

    {{-- ===== Katalog Produk (dalam div yang sama) ===== --}}
    <div class="mx-auto max-w-7xl px-6 lg:px-8 pt-0 pb-24 sm:pb-32">
        <div class="mx-auto max-w-2xl text-center mb-16">
            <h2 class="text-3xl font-bold tracking-tight text-blue-300 sm:text-4xl">Katalog Produk Unggulan</h2>
            <p class="mt-4 text-lg leading-8 text-gray-600">Berbagai produk lokal berkualitas hasil karya masyarakat
                Desa Sinulasi yang dikelola oleh BUMDes.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Produk 1 -->
            <div
                class="bg-gray-50 rounded-3xl p-6 border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 group cursor-pointer flex flex-col">
                <div class="relative w-full h-48 mb-6 overflow-hidden rounded-2xl">
                    <img src="https://picsum.photos/400/300?random=11" alt="Produk 1"
                        class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-3 right-3 bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-full">
                        Baru</div>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors">
                    Kerajinan Bambu</h3>
                <p class="text-sm text-gray-600 mb-4 flex-grow">Kerajinan anyaman bambu asli buatan warga desa
                    dengan desain modern.</p>
                <div class="flex items-center justify-between mt-auto">
                    <span class="text-lg font-bold text-blue-800">Rp 45.000</span>
                    <button
                        class="bg-blue-100 text-blue-700 hover:bg-blue-600 hover:text-white px-4 py-2 rounded-xl text-sm font-semibold transition-colors duration-300">Detail</button>
                </div>
            </div>

            <!-- Produk 2 -->
            <div
                class="bg-gray-50 rounded-3xl p-6 border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 group cursor-pointer flex flex-col">
                <div class="relative w-full h-48 mb-6 overflow-hidden rounded-2xl">
                    <img src="https://picsum.photos/400/300?random=12" alt="Produk 2"
                        class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors">Kopi
                    Arabika Desa</h3>
                <p class="text-sm text-gray-600 mb-4 flex-grow">Biji kopi pilihan yang dipetik dan di-roasting
                    langsung dari perkebunan dataran tinggi.</p>
                <div class="flex items-center justify-between mt-auto">
                    <span class="text-lg font-bold text-blue-800">Rp 65.000</span>
                    <button
                        class="bg-blue-100 text-blue-700 hover:bg-blue-600 hover:text-white px-4 py-2 rounded-xl text-sm font-semibold transition-colors duration-300">Detail</button>
                </div>
            </div>

            <!-- Produk 3 -->
            <div
                class="bg-gray-50 rounded-3xl p-6 border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 group cursor-pointer flex flex-col">
                <div class="relative w-full h-48 mb-6 overflow-hidden rounded-2xl">
                    <img src="https://picsum.photos/400/300?random=13" alt="Produk 3"
                        class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-3 right-3 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full">
                        Terlaris</div>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors">Madu
                    Hutan Asli</h3>
                <p class="text-sm text-gray-600 mb-4 flex-grow">Madu murni alami tanpa campuran hasil panen kelompok
                    tani hutan lokal.</p>
                <div class="flex items-center justify-between mt-auto">
                    <span class="text-lg font-bold text-blue-800">Rp 85.000</span>
                    <button
                        class="bg-blue-100 text-blue-700 hover:bg-blue-600 hover:text-white px-4 py-2 rounded-xl text-sm font-semibold transition-colors duration-300">Detail</button>
                </div>
            </div>

            <!-- Produk 4 -->
            <div
                class="bg-gray-50 rounded-3xl p-6 border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 group cursor-pointer flex flex-col">
                <div class="relative w-full h-48 mb-6 overflow-hidden rounded-2xl">
                    <img src="https://picsum.photos/400/300?random=14" alt="Produk 4"
                        class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors">Kripik
                    Singkong</h3>
                <p class="text-sm text-gray-600 mb-4 flex-grow">Camilan super renyah khas desa dengan berbagai
                    varian rasa rempah tradisional.</p>
                <div class="flex items-center justify-between mt-auto">
                    <span class="text-lg font-bold text-blue-800">Rp 15.000</span>
                    <button
                        class="bg-blue-100 text-blue-700 hover:bg-blue-600 hover:text-white px-4 py-2 rounded-xl text-sm font-semibold transition-colors duration-300">Detail</button>
                </div>
            </div>
        </div>

        <div class="mt-14 text-center">
            <a href="#"
                class="inline-flex justify-center items-center px-8 py-3.5 text-blue-700 bg-blue-50 border border-blue-100 hover:bg-blue-600 hover:text-white font-bold rounded-full transition-all duration-300 shadow-sm hover:shadow-lg">
                Lihat Semua Produk
                <svg class="w-5 h-5 ml-2 transition-transform duration-300 transform group-hover:translate-x-1"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3">
                    </path>
                </svg>
            </a>
        </div>
    </div>
</div>

@endsection