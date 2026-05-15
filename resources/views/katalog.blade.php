@extends('layouts.app')

@section('content')

<!-- Top Layout Container -->
<div class="relative w-full pt-20 bg-white z-10">

    <!-- Hero Section Flat Split -->
    <div class="w-full flex flex-col lg:flex-row border-b-4 border-[#111827]">
        <!-- Left Side: Solid Blue Action Block -->
        <div class="w-full lg:w-1/2 bg-[#2563EB] relative overflow-hidden flex flex-col justify-center p-8 lg:p-16 min-h-[40vh] lg:h-[60vh]">
            <!-- Decorative Flat Shapes -->
            <div class="absolute -top-16 -left-16 w-64 h-64 border-8 border-white/20 pointer-events-none"></div>
            <div class="absolute bottom-10 right-10 w-24 h-24 bg-white/20 rounded-full pointer-events-none"></div>
            
            <div class="relative z-10 w-full max-w-xl">
                <div class="inline-block px-4 py-1.5 bg-[#F59E0B] rounded-md text-white font-black tracking-widest uppercase text-sm mb-6">
                    Inventaris Lokal
                </div>

                <h1 class="text-5xl md:text-6xl lg:text-7xl font-black text-white tracking-tighter leading-[0.95] mb-6 uppercase">
                    Katalog<br/><span class="text-[#111827]">Unggulan</span>
                </h1>

                <p class="text-xl font-bold text-white/90 leading-snug">
                    Distribusi produk otentik desa. Dari bumi ke tangan Anda tanpa perantara.
                </p>
            </div>
        </div>

        <!-- Right Side: Image Edge-to-Edge -->
        <div class="w-full lg:w-1/2 h-[40vh] lg:h-[60vh] bg-gray-200 border-b-4 lg:border-b-0 lg:border-l-4 border-[#111827]">
            <img class="w-full h-full object-cover object-center block" 
                 src="{{ asset('shallow-focus-shot-japanese-elderly-people-working-field.jpg') }}" 
                 alt="BUMDes Agriculture" fetchpriority="high" loading="eager" decoding="async">
        </div>
    </div>


    <!-- ====== CATALOG SECTION ====== -->
    <div class="w-full py-24 bg-white relative border-b-4 border-[#111827]">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">

            <!-- Category Filter (Flat) -->
            <div class="flex flex-wrap justify-center gap-4 mb-16">
                <button class="px-8 py-3 rounded-md bg-[#111827] text-white font-black uppercase tracking-widest text-sm border-4 border-[#111827] hover:bg-white hover:text-[#111827] transition-colors">Semua</button>
                <button class="px-8 py-3 rounded-md bg-white text-[#4B5563] font-black uppercase tracking-widest text-sm border-4 border-[#E5E7EB] hover:border-[#111827] hover:text-[#111827] transition-colors">Hasil Tani</button>
                <button class="px-8 py-3 rounded-md bg-white text-[#4B5563] font-black uppercase tracking-widest text-sm border-4 border-[#E5E7EB] hover:border-[#111827] hover:text-[#111827] transition-colors">Kerajinan</button>
                <button class="px-8 py-3 rounded-md bg-white text-[#4B5563] font-black uppercase tracking-widest text-sm border-4 border-[#E5E7EB] hover:border-[#111827] hover:text-[#111827] transition-colors">Kuliner</button>
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">

                <!-- Product Card 1 -->
                <div class="bg-[#F3F4F6] p-4 rounded-2xl flex flex-col group cursor-pointer hover:bg-[#E5E7EB] transition-colors border-4 border-transparent hover:border-[#2563EB]">
                    <div class="w-full aspect-[4/3] rounded-xl bg-gray-300 overflow-hidden relative mb-6 border-4 border-transparent group-hover:border-[#111827] transition-all">
                        <img src="https://images.unsplash.com/photo-1594282486552-05b4d80fbb9f?q=80&w=600&auto=format&fit=crop"
                            alt="Sayuran Organik" class="w-full h-full object-cover">
                        <div class="absolute top-3 right-3 bg-[#10B981] text-white px-3 py-1 font-bold text-xs uppercase tracking-wider rounded">Laris</div>
                    </div>
                    <div class="px-2 flex flex-col flex-grow">
                        <div class="text-xs text-[#2563EB] font-black mb-2 uppercase tracking-widest">Hasil Tani</div>
                        <h3 class="text-2xl font-black text-[#111827] uppercase tracking-tighter mb-2 leading-tight">Paket Sayuran Organik</h3>
                        <p class="text-[#4B5563] font-medium text-sm leading-relaxed mb-6 flex-grow">Sayuran murni tanpa unsur pestisida rekayasa.</p>
                        
                        <div class="w-full pt-4 border-t-4 border-white flex flex-col items-start gap-4">
                            <span class="text-3xl font-black text-[#111827] tracking-tighter">Rp35K</span>
                            <a href="#" class="w-full text-center py-3 rounded bg-white text-[#2563EB] font-black tracking-widest uppercase border-4 border-white group-hover:border-[#2563EB] transition-all">Beli</a>
                        </div>
                    </div>
                </div>

                <!-- Product Card 2 -->
                <div class="bg-[#F3F4F6] p-4 rounded-2xl flex flex-col group cursor-pointer hover:bg-[#E5E7EB] transition-colors border-4 border-transparent hover:border-[#2563EB]">
                    <div class="w-full aspect-[4/3] rounded-xl bg-gray-300 overflow-hidden relative mb-6 border-4 border-transparent group-hover:border-[#111827] transition-all">
                        <img src="https://images.unsplash.com/photo-1621370830740-4598d41fe041?q=80&w=600&auto=format&fit=crop"
                            alt="Madu Hutan Asli" class="w-full h-full object-cover">
                    </div>
                    <div class="px-2 flex flex-col flex-grow">
                        <div class="text-xs text-[#2563EB] font-black mb-2 uppercase tracking-widest">Hasil Tani</div>
                        <h3 class="text-2xl font-black text-[#111827] uppercase tracking-tighter mb-2 leading-tight">Madu Liar 500ml</h3>
                        <p class="text-[#4B5563] font-medium text-sm leading-relaxed mb-6 flex-grow">Ekstraksi lebah hutan murni untuk stabilitas fisik.</p>
                        
                        <div class="w-full pt-4 border-t-4 border-white flex flex-col items-start gap-4">
                            <span class="text-3xl font-black text-[#111827] tracking-tighter">Rp120K</span>
                            <a href="#" class="w-full text-center py-3 rounded bg-[#2563EB] text-white font-black tracking-widest uppercase border-4 border-transparent hover:bg-white hover:text-[#2563EB] hover:border-[#2563EB] transition-all">Beli Utama</a>
                        </div>
                    </div>
                </div>

                <!-- Product Card 3 -->
                <div class="bg-[#F3F4F6] p-4 rounded-2xl flex flex-col group cursor-pointer hover:bg-[#E5E7EB] transition-colors border-4 border-transparent hover:border-[#F59E0B]">
                     <div class="w-full aspect-[4/3] rounded-xl bg-gray-300 overflow-hidden relative mb-6 border-4 border-transparent group-hover:border-[#111827] transition-all">
                        <img src="https://images.unsplash.com/photo-1516054817101-9dcbe768ef60?q=80&w=600&auto=format&fit=crop"
                            alt="Kerajinan Bambu" class="w-full h-full object-cover">
                        <div class="absolute top-3 right-3 bg-[#2563EB] text-white px-3 py-1 font-bold text-xs uppercase tracking-wider rounded">Baru</div>
                    </div>
                    <div class="px-2 flex flex-col flex-grow">
                        <div class="text-xs text-[#F59E0B] font-black mb-2 uppercase tracking-widest">Kerajinan</div>
                        <h3 class="text-2xl font-black text-[#111827] uppercase tracking-tighter mb-2 leading-tight">Lampu Bambu</h3>
                        <p class="text-[#4B5563] font-medium text-sm leading-relaxed mb-6 flex-grow">Struktur dekorasi anyaman solid bambu.</p>
                        
                        <div class="w-full pt-4 border-t-4 border-white flex flex-col items-start gap-4">
                            <div class="flex gap-2 items-center">
                                <span class="text-xl font-bold text-gray-400 line-through tracking-tighter leading-none">Rp90K</span>
                                <span class="text-3xl font-black text-[#111827] tracking-tighter leading-none text-[#F59E0B]">Rp75K</span>
                            </div>
                            <a href="#" class="w-full text-center py-3 rounded bg-white text-[#F59E0B] font-black tracking-widest uppercase border-4 border-white group-hover:border-[#F59E0B] transition-all">Beli</a>
                        </div>
                    </div>
                </div>

                <!-- Product Card 4 -->
                 <div class="bg-[#F3F4F6] p-4 rounded-2xl flex flex-col group cursor-pointer hover:bg-[#E5E7EB] transition-colors border-4 border-transparent hover:border-[#111827]">
                    <div class="w-full aspect-[4/3] rounded-xl bg-gray-300 overflow-hidden relative mb-6 border-4 border-transparent group-hover:border-[#111827] transition-all">
                        <img src="https://images.unsplash.com/photo-1604328698692-f76ea9498e76?q=80&w=600&auto=format&fit=crop"
                            alt="Kopi Robusta" class="w-full h-full object-cover">
                    </div>
                    <div class="px-2 flex flex-col flex-grow">
                        <div class="text-xs text-[#111827] font-black mb-2 uppercase tracking-widest">Hasil Tani</div>
                        <h3 class="text-2xl font-black text-[#111827] uppercase tracking-tighter mb-2 leading-tight">Kopi Robusta 250g</h3>
                        <p class="text-[#4B5563] font-medium text-sm leading-relaxed mb-6 flex-grow">Ekstraksi bubuk gelap komoditas utama lereng utara.</p>
                        
                        <div class="w-full pt-4 border-t-4 border-white flex flex-col items-start gap-4">
                            <span class="text-3xl font-black text-[#111827] tracking-tighter">Rp45K</span>
                             <a href="#" class="w-full text-center py-3 rounded bg-[#111827] text-white font-black tracking-widest uppercase border-4 border-transparent hover:bg-white hover:text-[#111827] hover:border-[#111827] transition-all">Beli</a>
                        </div>
                    </div>
                </div>

                <!-- Product Card 5 -->
                 <div class="bg-[#F3F4F6] p-4 rounded-2xl flex flex-col group cursor-pointer hover:bg-[#E5E7EB] transition-colors border-4 border-transparent hover:border-[#2563EB]">
                    <div class="w-full aspect-[4/3] rounded-xl bg-gray-300 overflow-hidden relative mb-6 border-4 border-transparent group-hover:border-[#111827] transition-all">
                        <img src="https://images.unsplash.com/photo-1582285513953-b035a6435c2b?q=80&w=600&auto=format&fit=crop"
                            alt="Keripik Pisang" class="w-full h-full object-cover">
                    </div>
                    <div class="px-2 flex flex-col flex-grow">
                        <div class="text-xs text-[#2563EB] font-black mb-2 uppercase tracking-widest">Kuliner Lokal</div>
                        <h3 class="text-2xl font-black text-[#111827] uppercase tracking-tighter mb-2 leading-tight">Keripik Pisang 1Kg</h3>
                        <p class="text-[#4B5563] font-medium text-sm leading-relaxed mb-6 flex-grow">Cemilan olahan karbohidrat padat distribusi partai.</p>
                        
                        <div class="w-full pt-4 border-t-4 border-white flex flex-col items-start gap-4">
                            <span class="text-3xl font-black text-[#111827] tracking-tighter">Rp40K</span>
                            <a href="#" class="w-full text-center py-3 rounded bg-white text-[#2563EB] font-black tracking-widest uppercase border-4 border-white group-hover:border-[#2563EB] transition-all">Beli</a>
                        </div>
                    </div>
                </div>

                 <!-- Product Card 6 -->
                 <div class="bg-[#F3F4F6] p-4 rounded-2xl flex flex-col group cursor-pointer hover:bg-[#E5E7EB] transition-colors border-4 border-transparent hover:border-[#2563EB]">
                    <div class="w-full aspect-[4/3] rounded-xl bg-gray-300 overflow-hidden relative mb-6 border-4 border-transparent group-hover:border-[#111827] transition-all">
                        <img src="https://images.unsplash.com/photo-1628151015968-3cae74676104?q=80&w=600&auto=format&fit=crop"
                            alt="Beras Desa" class="w-full h-full object-cover">
                    </div>
                    <div class="px-2 flex flex-col flex-grow">
                        <div class="text-xs text-[#2563EB] font-black mb-2 uppercase tracking-widest">Hasil Tani</div>
                        <h3 class="text-2xl font-black text-[#111827] uppercase tracking-tighter mb-2 leading-tight">Beras Wangi 5Kg</h3>
                        <p class="text-[#4B5563] font-medium text-sm leading-relaxed mb-6 flex-grow">Logistik pokok utama panen kuartal murni.</p>
                        
                        <div class="w-full pt-4 border-t-4 border-white flex flex-col items-start gap-4">
                            <span class="text-3xl font-black text-[#111827] tracking-tighter">Rp85K</span>
                             <a href="#" class="w-full text-center py-3 rounded bg-white text-[#2563EB] font-black tracking-widest uppercase border-4 border-white group-hover:border-[#2563EB] transition-all">Beli</a>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Flat Pagination -->
            <div class="mt-20 flex justify-center">
                <nav class="flex items-center gap-3" aria-label="Pagination">
                    <button class="w-12 h-12 rounded flex items-center justify-center bg-white border-4 border-[#E5E7EB] text-[#4B5563] hover:border-[#111827] hover:text-[#111827] transition-all font-black">&lt;</button>
                    <button class="w-12 h-12 rounded flex items-center justify-center bg-[#2563EB] border-4 border-[#2563EB] text-white font-black hover:bg-[#111827] hover:border-[#111827] transition-all">1</button>
                    <button class="w-12 h-12 rounded flex items-center justify-center bg-white border-4 border-[#E5E7EB] text-[#111827] hover:border-[#111827] transition-all font-black">2</button>
                    <button class="w-12 h-12 rounded flex items-center justify-center bg-white border-4 border-[#E5E7EB] text-[#111827] hover:border-[#111827] transition-all font-black">3</button>
                    <span class="text-[#111827] font-black px-2">...</span>
                    <button class="w-12 h-12 rounded flex items-center justify-center bg-white border-4 border-[#E5E7EB] text-[#111827] hover:border-[#111827] transition-all font-black">&gt;</button>
                </nav>
            </div>
        </div>
    </div>

    <!-- Call to Action (Flat Block Variant) -->
    <div class="w-full bg-[#F59E0B] py-24 relative overflow-hidden z-0 border-b-4 border-black">
        <!-- Abstract Decoration -->
        <div class="absolute -top-1/2 left-1/4 w-96 h-96 bg-[#111827] rounded-full opacity-10 pointer-events-none"></div>
        <div class="absolute -bottom-1/4 right-1/4 w-72 h-72 border-8 border-black/10 rotate-45 pointer-events-none"></div>

        <div class="max-w-4xl mx-auto px-6 text-center relative z-10 flex flex-col items-center">
            <h2 class="text-5xl lg:text-7xl font-black text-[#111827] mb-6 tracking-tighter uppercase leading-none">
                Buka Posisi<br/><span class="text-white">Mitra Lapak</span>
            </h2>
            <div class="w-24 h-2 bg-white mb-8"></div>
            <p class="text-xl text-[#111827] font-bold mb-10 max-w-2xl mx-auto">
                Lakukan pengajuan integrasi logistik. Kami mengontrol distribusi, Anda menumbuhkan hasil pengerjaan.
            </p>
            <div class="flex flex-col sm:flex-row gap-6 justify-center w-full sm:w-auto">
                <button class="px-10 py-5 bg-[#111827] border-4 border-[#111827] text-white font-black uppercase tracking-widest rounded text-sm hover:scale-105 transition-transform">
                    DAFTAR SEKARANG
                </button>
                <button class="px-10 py-5 bg-transparent border-4 border-[#111827] text-[#111827] font-black uppercase tracking-widest rounded text-sm hover:scale-105 hover:bg-white transition-transform">
                    AKSES INFORMASI
                </button>
            </div>
        </div>
    </div>
</div>

@endsection