@extends('layouts.app')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&display=swap');

    /* Flat Design Base Override */
    body {
        font-family: 'Outfit', sans-serif;
        background-color: #ffffff !important; 
        color: #111827; /* Gray 900 */
        margin: 0;
        padding: 0;
        background-image: none !important; /* Remove any previous body texture */
    }

    /* Core Flat Tokens */
    .flat-bg-primary { background-color: #2563EB; } /* blue-600 */
    .flat-bg-emerald { background-color: #10B981; } /* emerald-500 */
    .flat-bg-amber { background-color: #F59E0B; } /* amber-500 */
    .flat-bg-muted { background-color: #F3F4F6; } /* gray-100 */
    .flat-bg-dark { background-color: #1F2937; } /* gray-800 */
    
    .flat-text-dark { color: #111827; }
    .flat-text-light { color: #FFFFFF; }
    .flat-text-muted { color: #6B7280; } /* gray-500 */

    /* Flat Components */
    .flat-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 1rem 2rem;
        font-weight: 800;
        font-size: 1.125rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-radius: 0.375rem; /* rounded-md */
        transition: all 200ms ease;
        box-shadow: none !important;
    }

    .flat-btn-primary {
        background-color: #F59E0B; /* Amber */
        color: #ffffff;
    }
    .flat-btn-primary:hover {
        background-color: #D97706; /* amber-600 */
        transform: scale(1.05);
    }

    .flat-btn-outline {
        background-color: transparent;
        color: #ffffff;
        border: 4px solid #ffffff;
    }
    .flat-btn-outline:hover {
        background-color: #ffffff;
        color: #2563EB; /* match bg for inversion */
        transform: scale(1.05);
    }

    .flat-btn-dark {
        background-color: #1F2937;
        color: #ffffff;
    }
    .flat-btn-dark:hover {
        background-color: #111827;
        transform: scale(1.05);
    }

    .flat-card {
        background-color: #ffffff;
        border-radius: 0.5rem; /* rounded-lg */
        padding: 2rem;
        transition: transform 200ms ease;
        box-shadow: none !important;
        border: none !important;
    }
    .flat-card:hover {
        transform: scale(1.02);
    }

    /* Remove ANY trace of shadow globally in this page scope */
    * { box-shadow: none !important; }
</style>

<!-- Top Layout Container -->
<div class="relative w-full -mt-8 pt-8 bg-white z-10">

    <!-- HERO SECTION: 50/50 Split Poster -->
    <div class="w-full min-h-[90vh] flex flex-col lg:flex-row">
        <!-- Left Side: Solid Blue Action Block -->
        <div class="w-full lg:w-1/2 flat-bg-primary relative overflow-hidden flex items-center justify-center p-8 lg:p-16 min-h-[50vh] lg:min-h-full">
            <!-- Decorative Flat Shapes -->
            <div class="absolute -top-24 -left-24 w-80 h-80 rounded-full bg-white/10 pointer-events-none"></div>
            <div class="absolute -bottom-16 -right-16 w-64 h-64 bg-white/10 rotate-45 pointer-events-none"></div>
            <div class="absolute top-1/4 right-10 w-12 h-12 rounded-full border-4 border-white/20 pointer-events-none"></div>
            
            <div class="relative z-10 w-full max-w-xl">
                <!-- Eyebrow Tag -->
                <div class="inline-block px-4 py-1.5 flat-bg-amber rounded-md text-white font-black tracking-widest uppercase text-sm mb-6">
                    Sistem Tata Kelola
                </div>

                <h1 class="text-6xl md:text-7xl lg:text-[5.5rem] font-black flat-text-light tracking-tighter leading-[0.95] mb-6 drop-shadow-none">
                    BUMDes<br/>GO DIGITAL
                </h1>

                <p class="text-xl lg:text-2xl font-medium text-white/90 leading-snug mb-12 max-w-lg">
                    Revolusi akuntansi desa. Transparan, terpusat, dan dibangun untuk efisiensi instan.
                </p>

                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="#" class="flat-btn flat-btn-primary">Katalog Produk</a>
                    <a href="#" class="flat-btn flat-btn-outline">Info Grafik</a>
                </div>
            </div>
        </div>

        <!-- Right Side: The Requested Image (Edge to Edge, NO overlay) -->
        <div class="w-full lg:w-1/2 min-h-[40vh] lg:min-h-full bg-gray-200">
            <img class="w-full h-full object-cover object-center block" 
                 src="{{ asset('raiyan-zakaria-Y43aG83fYMA-unsplash.jpg') }}" 
                 alt="BUMDes Operations Image">
        </div>
    </div>


    <!-- STRUKTUR PENGURUS SECTION -->
    <div class="w-full py-24 flat-bg-muted">
        <div class="mx-auto max-w-7xl px-6 lg:px-12">
            
            <div class="mb-16">
                <h2 class="text-5xl md:text-7xl font-black flat-text-dark tracking-tighter uppercase leading-none mb-4">
                    Struktur<br/>Pengurus
                </h2>
                <div class="w-32 h-4 flat-bg-primary"></div> <!-- Bold geometric underline -->
                <p class="mt-6 text-xl flat-text-muted max-w-2xl font-medium">Tim pengelola inti dengan determinasi tingkat tinggi untuk kemajuan kolektif.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Direktur -->
                <div class="flat-card group cursor-pointer border-4 border-transparent hover:border-[#1F2937] transition-all bg-white relative">
                    <!-- Deco dot -->
                    <div class="absolute top-4 right-4 w-3 h-3 rounded-full bg-[#1F2937]"></div>
                    
                    <div class="w-full flex flex-col mb-8 mt-4">
                        <img class="w-24 h-24 rounded-full object-cover border-4 border-[#2563EB] mb-6"
                            src="https://ui-avatars.com/api/?name=Budi+Santoso&size=200&background=1F2937&color=fff&font-size=0.33"
                            alt="Budi Santoso">
                        <h3 class="text-3xl font-black flat-text-dark tracking-tighter mb-2">Budi Santoso</h3>
                        <div class="inline-block self-start px-3 py-1 bg-[#1F2937] text-white rounded font-bold text-xs tracking-widest uppercase mb-4">
                            Direktur
                        </div>
                    </div>
                    <p class="text-[#6B7280] font-medium leading-relaxed">Penyusun strategi makro operasional BUMDes.</p>
                </div>

                <!-- Sekretaris -->
                <div class="flat-card group cursor-pointer border-4 border-transparent hover:border-[#1F2937] transition-all bg-white relative">
                    <div class="absolute top-4 right-4 w-3 h-3 rounded-full bg-[#1F2937]"></div>
                    
                    <div class="w-full flex flex-col mb-8 mt-4">
                        <img class="w-24 h-24 rounded-full object-cover border-4 border-[#10B981] mb-6"
                            src="https://ui-avatars.com/api/?name=Siti+Aminah&size=200&background=1F2937&color=fff&font-size=0.33"
                            alt="Siti Aminah">
                        <h3 class="text-3xl font-black flat-text-dark tracking-tighter mb-2">Siti Aminah</h3>
                        <div class="inline-block self-start px-3 py-1 bg-[#1F2937] text-white rounded font-bold text-xs tracking-widest uppercase mb-4">
                            Sekretaris
                        </div>
                    </div>
                    <p class="text-[#6B7280] font-medium leading-relaxed">Pengelola sistematisasi arsip dan komunikasi intra-desa.</p>
                </div>

                <!-- Bendahara -->
                <div class="flat-card group cursor-pointer border-4 border-transparent hover:border-[#1F2937] transition-all bg-white relative">
                    <div class="absolute top-4 right-4 w-3 h-3 rounded-full bg-[#1F2937]"></div>
                    
                    <div class="w-full flex flex-col mb-8 mt-4">
                        <img class="w-24 h-24 rounded-full object-cover border-4 border-[#F59E0B] mb-6"
                            src="https://ui-avatars.com/api/?name=Ahmad+Fauzi&size=200&background=1F2937&color=fff&font-size=0.33"
                            alt="Ahmad Fauzi">
                        <h3 class="text-3xl font-black flat-text-dark tracking-tighter mb-2">Ahmad Fauzi</h3>
                        <div class="inline-block self-start px-3 py-1 bg-[#1F2937] text-white rounded font-bold text-xs tracking-widest uppercase mb-4">
                            Bendahara
                        </div>
                    </div>
                    <p class="text-[#6B7280] font-medium leading-relaxed">Auditor akuntansi lapangan dan stabilitas kas lokal.</p>
                </div>
            </div>
        </div>
    </div>


    <!-- GALERI KEGIATAN SECTION (Solid Emerald Color Block) -->
    <div class="w-full py-24 flat-bg-emerald relative overflow-hidden">
        <!-- Decoration -->
        <div class="absolute right-0 top-0 w-[40rem] h-[40rem] bg-[#059669]/20 rounded-full translate-x-1/3 -translate-y-1/3 pointer-events-none"></div>

        <div class="mx-auto max-w-7xl px-6 lg:px-12 relative z-10">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
                <div>
                    <h2 class="text-5xl md:text-7xl font-black flat-text-light tracking-tighter uppercase leading-none mb-4">
                        Arsip<br/>Digital
                    </h2>
                    <div class="w-32 h-4 flat-bg-dark"></div>
                </div>
                <p class="text-xl text-white font-semibold max-w-sm">
                    Kompilasi dokumentasi kemajuan desa secara riil.
                </p>
            </div>

            <!-- Hard grid, no gaps, flat block images -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Gallery Item 1 -->
                <div class="bg-white p-2 rounded-xl cursor-pointer group hover:scale-[1.02] hover:-translate-y-2 transition-all border-4 border-transparent hover:border-[#1F2937]">
                    <div class="w-full aspect-[4/3] overflow-hidden rounded-lg bg-gray-200">
                        <img src="https://picsum.photos/800/600?random=1" alt="Rapat Desa" class="w-full h-full object-cover">
                    </div>
                    <div class="pt-5 pb-3 px-3 flex justify-between items-center">
                        <h3 class="font-black text-[#111827] text-xl uppercase tracking-tighter">Rapat Desa</h3>
                        <span class="font-bold text-white bg-[#10B981] px-2 py-0.5 rounded text-sm">15.01</span>
                    </div>
                </div>

                <!-- Gallery Item 2 -->
                <div class="bg-white p-2 rounded-xl cursor-pointer group hover:scale-[1.02] hover:-translate-y-2 transition-all border-4 border-transparent hover:border-[#1F2937]">
                    <div class="w-full aspect-[4/3] overflow-hidden rounded-lg bg-gray-200">
                        <img src="https://picsum.photos/800/600?random=2" alt="Digitalisasi" class="w-full h-full object-cover">
                    </div>
                    <div class="pt-5 pb-3 px-3 flex justify-between items-center">
                        <h3 class="font-black text-[#111827] text-xl uppercase tracking-tighter">Penyuluhan</h3>
                        <span class="font-bold text-white bg-[#10B981] px-2 py-0.5 rounded text-sm">03.02</span>
                    </div>
                </div>

                <!-- Gallery Item 3 -->
                <div class="bg-white p-2 rounded-xl cursor-pointer group hover:scale-[1.02] hover:-translate-y-2 transition-all border-4 border-transparent hover:border-[#1F2937]">
                    <div class="w-full aspect-[4/3] overflow-hidden rounded-lg bg-gray-200">
                        <img src="https://picsum.photos/800/600?random=3" alt="Pasar Desa" class="w-full h-full object-cover">
                    </div>
                    <div class="pt-5 pb-3 px-3 flex justify-between items-center">
                        <h3 class="font-black text-[#111827] text-xl uppercase tracking-tighter">Bazar Lokal</h3>
                        <span class="font-bold text-white bg-[#10B981] px-2 py-0.5 rounded text-sm">22.02</span>
                    </div>
                </div>
            </div>
            
            <!-- Emerald Section Button -->
            <div class="mt-16 text-center">
                <a href="#" class="flat-btn border-4 border-white text-white hover:bg-white hover:text-[#10B981] bg-transparent">
                    Buka Arsip Lengkap
                </a>
            </div>
        </div>
    </div>


    <!-- KATALOG PRODUK SECTION -->
    <div class="w-full py-24 bg-white relative">
        <div class="mx-auto max-w-7xl px-6 lg:px-12">
            
            <div class="flex flex-col mb-16 items-start md:items-center md:text-center">
                <div class="inline-block px-4 py-1.5 bg-[#2563EB] rounded font-black tracking-widest uppercase text-sm mb-6 text-white">
                    Indeks Komoditas
                </div>
                <h2 class="text-5xl md:text-7xl font-black flat-text-dark tracking-tighter uppercase leading-none mb-6">
                    Katalog Utama
                </h2>
                <div class="w-32 h-4 flat-bg-amber"></div>
            </div>

            <!-- Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Produk 1 -->
                <div class="bg-[#F3F4F6] p-4 rounded-2xl flex flex-col group cursor-pointer hover:bg-[#E5E7EB] transition-colors border-4 border-transparent hover:border-[#2563EB]">
                    <!-- Image Area -->
                    <div class="w-full aspect-[4/3] rounded-xl bg-gray-300 overflow-hidden relative mb-6">
                        <img src="https://picsum.photos/400/300?random=11" alt="Bambu" class="w-full h-full object-cover">
                        <div class="absolute top-3 right-3 bg-[#2563EB] text-white px-3 py-1 font-bold text-xs uppercase tracking-wider rounded">Baru</div>
                    </div>
                    <div class="px-2 flex flex-col flex-grow">
                        <h3 class="text-2xl font-black flat-text-dark uppercase tracking-tighter mb-2 leading-tight">Kerajinan Bambu</h3>
                        <p class="text-[#6B7280] font-medium text-sm leading-relaxed mb-6 flex-grow">Struktur anyaman fungsional buatan lokalisasi desa.</p>
                        
                        <div class="w-full pt-4 border-t-2 border-gray-300 flex flex-col items-start gap-4">
                            <span class="text-3xl font-black text-[#111827] tracking-tighter">Rp45K</span>
                            <a href="#" class="w-full text-center flat-btn bg-[#2563EB] text-white border-2 border-transparent hover:bg-white hover:border-[#2563EB] hover:text-[#2563EB]">Akses Info</a>
                        </div>
                    </div>
                </div>

                <!-- Produk 2 -->
                <div class="bg-[#F3F4F6] p-4 rounded-2xl flex flex-col group cursor-pointer hover:bg-[#E5E7EB] transition-colors border-4 border-transparent hover:border-[#2563EB]">
                    <div class="w-full aspect-[4/3] rounded-xl bg-gray-300 overflow-hidden relative mb-6">
                        <img src="https://picsum.photos/400/300?random=12" alt="Kopi" class="w-full h-full object-cover">
                    </div>
                    <div class="px-2 flex flex-col flex-grow">
                        <h3 class="text-2xl font-black flat-text-dark uppercase tracking-tighter mb-2 leading-tight">Arabika Roast</h3>
                        <p class="text-[#6B7280] font-medium text-sm leading-relaxed mb-6 flex-grow">Ekstraksi biji kopi hitam dataran tinggi murni.</p>
                        
                        <div class="w-full pt-4 border-t-2 border-gray-300 flex flex-col items-start gap-4">
                            <span class="text-3xl font-black text-[#111827] tracking-tighter">Rp65K</span>
                            <a href="#" class="w-full text-center flat-btn bg-[#2563EB] text-white border-2 border-transparent hover:bg-white hover:border-[#2563EB] hover:text-[#2563EB]">Akses Info</a>
                        </div>
                    </div>
                </div>

                <!-- Produk 3 -->
                <div class="bg-[#F3F4F6] p-4 rounded-2xl flex flex-col group cursor-pointer hover:bg-[#E5E7EB] transition-colors border-4 border-transparent hover:border-[#F59E0B]">
                    <div class="w-full aspect-[4/3] rounded-xl bg-gray-300 overflow-hidden relative mb-6">
                        <img src="https://picsum.photos/400/300?random=13" alt="Madu" class="w-full h-full object-cover">
                        <div class="absolute top-3 right-3 bg-[#EF4444] text-white px-3 py-1 font-bold text-xs uppercase tracking-wider rounded">Laris</div>
                    </div>
                    <div class="px-2 flex flex-col flex-grow">
                        <h3 class="text-2xl font-black flat-text-dark uppercase tracking-tighter mb-2 leading-tight">Madu Hutan</h3>
                        <p class="text-[#6B7280] font-medium text-sm leading-relaxed mb-6 flex-grow">Komposit absolut pemanenan lebah flora lokal.</p>
                        
                        <div class="w-full pt-4 border-t-2 border-gray-300 flex flex-col items-start gap-4">
                            <span class="text-3xl font-black text-[#111827] tracking-tighter text-[#EF4444]">Rp85K</span>
                            <a href="#" class="w-full text-center flat-btn bg-[#F59E0B] text-white border-none hover:bg-[#D97706]">Beli Instan</a>
                        </div>
                    </div>
                </div>

                <!-- Produk 4 -->
                <div class="bg-[#F3F4F6] p-4 rounded-2xl flex flex-col group cursor-pointer hover:bg-[#E5E7EB] transition-colors border-4 border-transparent hover:border-[#2563EB]">
                    <div class="w-full aspect-[4/3] rounded-xl bg-gray-300 overflow-hidden relative mb-6">
                        <img src="https://picsum.photos/400/300?random=14" alt="Kripik" class="w-full h-full object-cover">
                    </div>
                    <div class="px-2 flex flex-col flex-grow">
                        <h3 class="text-2xl font-black flat-text-dark uppercase tracking-tighter mb-2 leading-tight">Kripik Singkong</h3>
                        <p class="text-[#6B7280] font-medium text-sm leading-relaxed mb-6 flex-grow">Distribusi renyah cemilan olahan panen lokal.</p>
                        
                        <div class="w-full pt-4 border-t-2 border-gray-300 flex flex-col items-start gap-4">
                            <span class="text-3xl font-black text-[#111827] tracking-tighter">Rp15K</span>
                            <a href="#" class="w-full text-center flat-btn bg-[#2563EB] text-white border-2 border-transparent hover:bg-white hover:border-[#2563EB] hover:text-[#2563EB]">Akses Info</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-16 flex justify-center">
                <a href="#" class="flat-btn flat-btn-dark px-12 py-5 text-lg border-4 border-[#1F2937]">Display Seluruh Entitas</a>
            </div>
        </div>
    </div>

</div>
@endsection