@extends('layouts.app')

@section('content')

<!-- Hero Background Wrapper -->
<div class="relative w-full h-[55vh] overflow-hidden bg-gray-900">
    <!-- Hero Image — fetchpriority tinggi agar tidak ada delay -->
    <img src="{{ asset('shallow-focus-shot-japanese-elderly-people-working-field.jpg') }}" alt="BUMDes Agriculture"
        fetchpriority="high" loading="eager" decoding="async"
        class="absolute inset-0 w-full h-full object-cover object-center">
    <!-- Dark Overlay -->
    <div class="absolute inset-0 bg-black/60"></div>

    <!-- Hero Content -->
    <div class="relative z-10 w-full h-full flex flex-col items-center justify-center text-center px-4 pt-20">
        <h1 class="text-4xl md:text-5xl lg:text-5xl font-extrabold text-white mb-4 tracking-tight">
            Katalog <span class="text-transparent bg-clip-text bg-blue-300">Produk Unggulan</span>
        </h1>
        <p class="text-lg md:text-xl text-white/90 max-w-2xl mt-2 font-light">
            Jelajahi berbagai produk lokal berkualitas dari Desa Sinulasi. Dari hasil bumi segar hingga kerajinan tangan
            otentik, setiap pembelian Anda mendukung kesejahteraan masyarakat desa.
        </p>
    </div>
</div> <!-- Close Hero Wrapper -->

<!-- ====== CATALOG SECTION ====== -->
<section
    class="w-full min-h-screen py-16 mt-[-2.5rem] relative overflow-hidden bg-gray-50 z-20 rounded-t-[3rem] shadow-[0_-15px_40px_-15px_rgba(0,0,0,0.3)]">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">

        <!-- Category Filter (Static) -->
        <div class="flex flex-wrap justify-center gap-3 mb-12">
            <button
                class="px-6 py-2 rounded-full bg-blue-600 text-white font-medium shadow-md hover:bg-blue-700 transition">Semua
                Produk</button>
            <button
                class="px-6 py-2 rounded-full bg-white text-gray-600 border border-gray-200 font-medium hover:bg-gray-50 hover:text-blue-600 transition shadow-sm">Hasil
                Tani</button>
            <button
                class="px-6 py-2 rounded-full bg-white text-gray-600 border border-gray-200 font-medium hover:bg-gray-50 hover:text-blue-600 transition shadow-sm">Kerajinan</button>
            <button
                class="px-6 py-2 rounded-full bg-white text-gray-600 border border-gray-200 font-medium hover:bg-gray-50 hover:text-blue-600 transition shadow-sm">Kuliner
                Lokal</button>
        </div>

        <!-- Product Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">

            <!-- Product Card 1 -->
            <div
                class="group bg-white rounded-2xl shadow-sm hover:shadow-xl border border-gray-100 overflow-hidden text-left transition-all duration-300 hover:-translate-y-2 flex flex-col h-full">
                <div class="relative h-60 w-full overflow-hidden bg-gray-100">
                    <img src="https://images.unsplash.com/photo-1594282486552-05b4d80fbb9f?q=80&w=600&auto=format&fit=crop"
                        alt="Sayuran Organik"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div
                        class="absolute top-3 left-3 bg-emerald-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-sm z-10">
                        Terlaris</div>
                    <!-- Action Overlay -->
                    <div
                        class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-3 z-20 backdrop-blur-[2px]">
                        <button
                            class="bg-white text-blue-600 p-3 rounded-full hover:bg-blue-50 transition transform hover:scale-110"
                            title="Lihat Detail">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="p-6 flex-grow flex flex-col">
                    <div class="text-xs text-gray-500 mb-2 uppercase tracking-wide font-semibold">Hasil Tani</div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">Paket Sayuran Organik Segar Khusus
                    </h3>
                    <p class="text-sm text-gray-600 mb-4 line-clamp-2 flex-grow">Sayuran segar langsung dari petani
                        lokal, bebas pestisida kimia dan perawatan penuh kasih sayang.</p>
                    <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-100">
                        <span class="text-xl font-extrabold text-blue-600">Rp 35.000</span>
                        <button
                            class="flex items-center gap-2 text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg transition-colors">
                            Beli
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product Card 2 -->
            <div
                class="group bg-white rounded-2xl shadow-sm hover:shadow-xl border border-gray-100 overflow-hidden text-left transition-all duration-300 hover:-translate-y-2 flex flex-col h-full">
                <div class="relative h-60 w-full overflow-hidden bg-gray-100">
                    <img src="https://images.unsplash.com/photo-1621370830740-4598d41fe041?q=80&w=600&auto=format&fit=crop"
                        alt="Madu Hutan Asli"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <!-- Action Overlay -->
                    <div
                        class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-3 z-20 backdrop-blur-[2px]">
                        <button
                            class="bg-white text-blue-600 p-3 rounded-full hover:bg-blue-50 transition transform hover:scale-110"
                            title="Lihat Detail">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="p-6 flex-grow flex flex-col">
                    <div class="text-xs text-gray-500 mb-2 uppercase tracking-wide font-semibold">Hasil Tani</div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">Madu Hutan Asli Liar 500ml</h3>
                    <p class="text-sm text-gray-600 mb-4 line-clamp-2 flex-grow">Madu murni dari lebah liar hutan
                        sekitar desa. Kaya manfaat untuk stamina tubuh.</p>
                    <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-100">
                        <span class="text-xl font-extrabold text-blue-600">Rp 120.000</span>
                        <button
                            class="flex items-center gap-2 text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg transition-colors">
                            Beli
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product Card 3 -->
            <div
                class="group bg-white rounded-2xl shadow-sm hover:shadow-xl border border-gray-100 overflow-hidden text-left transition-all duration-300 hover:-translate-y-2 flex flex-col h-full">
                <div class="relative h-60 w-full overflow-hidden bg-gray-100">
                    <img src="https://images.unsplash.com/photo-1516054817101-9dcbe768ef60?q=80&w=600&auto=format&fit=crop"
                        alt="Kerajinan Bambu"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div
                        class="absolute top-3 left-3 bg-blue-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-sm z-10">
                        Baru</div>
                    <!-- Action Overlay -->
                    <div
                        class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-3 z-20 backdrop-blur-[2px]">
                        <button
                            class="bg-white text-blue-600 p-3 rounded-full hover:bg-blue-50 transition transform hover:scale-110"
                            title="Lihat Detail">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="p-6 flex-grow flex flex-col">
                    <div class="text-xs text-gray-500 mb-2 uppercase tracking-wide font-semibold">Kerajinan</div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">Lampu Gantung Anyaman Bambu</h3>
                    <p class="text-sm text-gray-600 mb-4 line-clamp-2 flex-grow">Hiasan lampu gantung estetik dari
                        anyaman bambu pilihan karya pengerajin lokal.</p>
                    <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-100">
                        <div>
                            <span class="text-sm text-gray-400 line-through block leading-none mb-1">Rp 90.000</span>
                            <span class="text-xl font-extrabold text-blue-600 leading-none">Rp 75.000</span>
                        </div>
                        <button
                            class="flex items-center gap-2 text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg transition-colors">
                            Beli
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product Card 4 -->
            <div
                class="group bg-white rounded-2xl shadow-sm hover:shadow-xl border border-gray-100 overflow-hidden text-left transition-all duration-300 hover:-translate-y-2 flex flex-col h-full">
                <div class="relative h-60 w-full overflow-hidden bg-gray-100">
                    <img src="https://images.unsplash.com/photo-1604328698692-f76ea9498e76?q=80&w=600&auto=format&fit=crop"
                        alt="Kopi Robusta"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <!-- Action Overlay -->
                    <div
                        class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-3 z-20 backdrop-blur-[2px]">
                        <button
                            class="bg-white text-blue-600 p-3 rounded-full hover:bg-blue-50 transition transform hover:scale-110"
                            title="Lihat Detail">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="p-6 flex-grow flex flex-col">
                    <div class="text-xs text-gray-500 mb-2 uppercase tracking-wide font-semibold">Hasil Tani</div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">Kopi Robusta Sinulasi 250g</h3>
                    <p class="text-sm text-gray-600 mb-4 line-clamp-2 flex-grow">Biji Kopi Robusta murni yang diroasting
                        dengan tingkat kematangan medium to dark.</p>
                    <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-100">
                        <span class="text-xl font-extrabold text-blue-600">Rp 45.000</span>
                        <button
                            class="flex items-center gap-2 text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg transition-colors">
                            Beli
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product Card 5 -->
            <div
                class="group bg-white rounded-2xl shadow-sm hover:shadow-xl border border-gray-100 overflow-hidden text-left transition-all duration-300 hover:-translate-y-2 flex flex-col h-full">
                <div class="relative h-60 w-full overflow-hidden bg-gray-100">
                    <img src="https://images.unsplash.com/photo-1582285513953-b035a6435c2b?q=80&w=600&auto=format&fit=crop"
                        alt="Keripik Pisang"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <!-- Action Overlay -->
                    <div
                        class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-3 z-20 backdrop-blur-[2px]">
                        <button
                            class="bg-white text-blue-600 p-3 rounded-full hover:bg-blue-50 transition transform hover:scale-110"
                            title="Lihat Detail">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="p-6 flex-grow flex flex-col">
                    <div class="text-xs text-gray-500 mb-2 uppercase tracking-wide font-semibold">Kuliner Lokal</div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">Keripik Pisang Khas Desa 1Kg</h3>
                    <p class="text-sm text-gray-600 mb-4 line-clamp-2 flex-grow">Renyah, manis alami tanpa pengawet
                        kemasan hemat bungkus besar.</p>
                    <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-100">
                        <span class="text-xl font-extrabold text-blue-600">Rp 40.000</span>
                        <button
                            class="flex items-center gap-2 text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg transition-colors">
                            Beli
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product Card 6 -->
            <div
                class="group bg-white rounded-2xl shadow-sm hover:shadow-xl border border-gray-100 overflow-hidden text-left transition-all duration-300 hover:-translate-y-2 flex flex-col h-full">
                <div class="relative h-60 w-full overflow-hidden bg-gray-100">
                    <img src="https://images.unsplash.com/photo-1628151015968-3cae74676104?q=80&w=600&auto=format&fit=crop"
                        alt="Beras Desa"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <!-- Action Overlay -->
                    <div
                        class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-3 z-20 backdrop-blur-[2px]">
                        <button
                            class="bg-white text-blue-600 p-3 rounded-full hover:bg-blue-50 transition transform hover:scale-110"
                            title="Lihat Detail">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="p-6 flex-grow flex flex-col">
                    <div class="text-xs text-gray-500 mb-2 uppercase tracking-wide font-semibold">Hasil Tani</div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">Beras Ciarum Wangi Premium 5Kg</h3>
                    <p class="text-sm text-gray-600 mb-4 line-clamp-2 flex-grow">Pulut, putih, dan beraroma pandan wangi
                        asli padi lokal.</p>
                    <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-100">
                        <span class="text-xl font-extrabold text-blue-600">Rp 85.000</span>
                        <button
                            class="flex items-center gap-2 text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg transition-colors">
                            Beli
                        </button>
                    </div>
                </div>
            </div>

        </div>

        <!-- Pagination Placeholder -->
        <div class="mt-16 flex justify-center">
            <nav class="flex items-center gap-2" aria-label="Pagination">
                <button
                    class="w-10 h-10 rounded-full flex items-center justify-center bg-white border border-gray-200 text-gray-500 hover:bg-gray-50 hover:text-blue-600 transition shadow-sm disabled:opacity-50 disabled:cursor-not-allowed">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                        </path>
                    </svg>
                </button>
                <button
                    class="w-10 h-10 rounded-full flex items-center justify-center bg-blue-600 border border-blue-600 text-white font-medium shadow-sm transition">1</button>
                <button
                    class="w-10 h-10 rounded-full flex items-center justify-center bg-white border border-gray-200 text-gray-700 hover:bg-blue-50 font-medium hover:text-blue-600 hover:border-blue-200 transition shadow-sm">2</button>
                <button
                    class="w-10 h-10 rounded-full flex items-center justify-center bg-white border border-gray-200 text-gray-700 hover:bg-blue-50 font-medium hover:text-blue-600 hover:border-blue-200 transition shadow-sm">3</button>
                <span class="text-gray-400 font-medium px-2">...</span>
                <button
                    class="w-10 h-10 rounded-full flex items-center justify-center bg-white border border-gray-200 text-gray-500 hover:bg-gray-50 hover:text-blue-600 transition shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </nav>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-20 bg-blue-600 text-white relative z-10 overflow-hidden">
    <!-- Decorative elements -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0">
        <div
            class="absolute -top-24 -left-24 w-64 h-64 rounded-full bg-blue-500/50 mix-blend-multiply filter blur-2xl opacity-70 animate-blob">
        </div>
        <div
            class="absolute top-1/2 -right-24 w-72 h-72 rounded-full bg-cyan-400/50 mix-blend-multiply filter blur-2xl opacity-70 animate-blob animation-delay-2000">
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-6 text-center relative z-10">
        <h2 class="text-3xl lg:text-5xl font-bold mb-6 tracking-tight">Ingin Menjadi Mitra Penjual Kami?</h2>
        <p class="text-xl text-blue-100 mb-10 max-w-2xl mx-auto">Kami mengundang UMKM dan pengerajin lokal di Sinar Jaya
            untuk bergabung dengan BUMDes Go dan memasarkan produknya secara lebih luas.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <button
                class="px-8 py-4 bg-white text-blue-700 font-bold rounded-full hover:bg-blue-50 hover:scale-105 transition-all shadow-xl shadow-blue-800/20 active:scale-95">Daftar
                Sekarang</button>
            <button
                class="px-8 py-4 bg-blue-700 border border-blue-500 text-white font-bold rounded-full hover:bg-blue-800 transition-all shadow-md">Pelajari
                Lebih Lanjut</button>
        </div>
    </div>
</section>

@endsection