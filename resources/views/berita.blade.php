@extends('layouts.app')

@push('preload')
<link rel="preload" as="image" href="{{ asset('community-people-working-together-agriculture-grow-food.jpg') }}"
    fetchpriority="high">
@endpush

@section('content')
<!-- Top Layout Container -->
<div class="relative w-full pt-20 bg-white z-10">

    <!-- Hero Section Flat Split -->
    <div class="w-full flex flex-col lg:flex-row border-b-4 border-[#111827]">
        <!-- Right Side: The Requested Image (Edge to Edge, NO overlay) for Mobile top / Desktop right -->
        <div class="w-full lg:w-1/2 h-[40vh] lg:h-[60vh] bg-gray-200 order-1 lg:order-2 border-b-4 lg:border-b-0 lg:border-l-4 border-[#111827]">
            <img class="w-full h-full object-cover object-center block" 
                 src="{{ asset('community-people-working-together-agriculture-grow-food.jpg') }}" 
                 alt="Hero Berita BUMDes" fetchpriority="high" loading="eager" decoding="async">
        </div>
        
        <!-- Left Side: Solid Emerald Action Block -->
        <div class="w-full lg:w-1/2 bg-[#10B981] relative overflow-hidden flex flex-col justify-center p-8 lg:p-16 min-h-[40vh] lg:h-[60vh] order-2 lg:order-1">
            <!-- Decorative Flat Shapes -->
            <div class="absolute -top-16 -left-16 w-64 h-64 rounded-full bg-white/20 pointer-events-none"></div>
            <div class="absolute bottom-10 right-10 w-24 h-24 border-4 border-[#111827] pointer-events-none"></div>
            
            <div class="relative z-10 w-full max-w-xl">
                <!-- Eyebrow Tag -->
                <div class="inline-block px-4 py-1.5 bg-[#111827] rounded-md text-white font-black tracking-widest uppercase text-sm mb-6">
                    Pusat Informasi
                </div>

                <h1 class="text-5xl md:text-6xl lg:text-7xl font-black text-white tracking-tighter leading-[0.95] mb-6 uppercase">
                    Berita &<br/><span class="text-[#111827]">Kegiatan</span>
                </h1>

                <p class="text-xl font-bold text-[#111827] leading-snug">
                    Transparansi kegiatan dan informasi esensial dari ruang kendali BUMDes.
                </p>
            </div>
        </div>
    </div>


    <!-- Berita Content Section (Flat Cards) -->
    <div class="w-full py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            
            <div class="flex flex-col mb-16 text-left">
                <h2 class="text-5xl md:text-6xl font-black text-[#111827] tracking-tighter uppercase leading-none mb-6">
                    Indeks Arsip
                </h2>
                <div class="w-32 h-4 bg-[#F59E0B]"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 pt-8">

                <!-- Berita Card 1 -->
                <div class="bg-[#F3F4F6] p-4 rounded-2xl flex flex-col group cursor-pointer hover:bg-[#E5E7EB] transition-colors border-4 border-transparent hover:border-[#10B981]">
                    <div class="w-full aspect-[4/3] rounded-xl bg-gray-300 overflow-hidden relative mb-6 border-4 border-transparent group-hover:border-[#111827] transition-all">
                        <img src="https://picsum.photos/600/400?random=101" alt="Gotong Royong" class="w-full h-full object-cover">
                    </div>
                    <div class="px-2 flex flex-col flex-grow">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="text-xs font-black text-[#4B5563] uppercase tracking-widest bg-white px-2 py-1 rounded">04.11.2025</span>
                            <span class="bg-[#10B981] text-white text-xs px-2 py-1 rounded font-black uppercase tracking-widest">Berita</span>
                        </div>
                        <h2 class="text-2xl font-black text-[#111827] uppercase tracking-tighter mb-4 leading-tight">Gotong royong sosial masyarakat</h2>
                        <p class="text-[#4B5563] font-medium text-sm leading-relaxed mb-6 flex-grow">
                            Kami selaku pengurus BUMDes mengajak seluruh warga lintas sektor untuk optimalisasi program infrastruktur desa.
                        </p>
                        
                        <div class="w-full pt-4 border-t-4 border-white">
                            <a href="#" class="inline-block text-sm font-black text-[#10B981] hover:text-[#111827] uppercase tracking-widest transition-colors">BACA SELENGKAPNYA -></a>
                        </div>
                    </div>
                </div>

                <!-- Berita Card 2 -->
                <div class="bg-[#F3F4F6] p-4 rounded-2xl flex flex-col group cursor-pointer hover:bg-[#E5E7EB] transition-colors border-4 border-transparent hover:border-[#10B981]">
                    <div class="w-full aspect-[4/3] rounded-xl bg-gray-300 overflow-hidden relative mb-6 border-4 border-transparent group-hover:border-[#111827] transition-all">
                        <img src="https://picsum.photos/600/400?random=102" alt="Kopi" class="w-full h-full object-cover">
                    </div>
                    <div class="px-2 flex flex-col flex-grow">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="text-xs font-black text-[#4B5563] uppercase tracking-widest bg-white px-2 py-1 rounded">12.10.2025</span>
                            <span class="bg-[#2563EB] text-white text-xs px-2 py-1 rounded font-black uppercase tracking-widest">Kegiatan</span>
                        </div>
                        <h2 class="text-2xl font-black text-[#111827] uppercase tracking-tighter mb-4 leading-tight">Distribusi Kopi Arabika Utama</h2>
                         <p class="text-[#4B5563] font-medium text-sm leading-relaxed mb-6 flex-grow">
                            Produk kopi ekstraksi tertinggi hasil kebun lereng utara berhasil dimobilisasi menuju indeks komoditas.
                        </p>
                        
                        <div class="w-full pt-4 border-t-4 border-white">
                            <a href="#" class="inline-block text-sm font-black text-[#10B981] hover:text-[#111827] uppercase tracking-widest transition-colors">BACA SELENGKAPNYA -></a>
                        </div>
                    </div>
                </div>

                <!-- Berita Card 3 -->
                <div class="bg-[#F3F4F6] p-4 rounded-2xl flex flex-col group cursor-pointer hover:bg-[#E5E7EB] transition-colors border-4 border-transparent hover:border-[#F59E0B]">
                    <div class="w-full aspect-[4/3] rounded-xl bg-gray-300 overflow-hidden relative mb-6 border-4 border-transparent group-hover:border-[#111827] transition-all">
                        <img src="https://picsum.photos/600/400?random=103" alt="Rapat" class="w-full h-full object-cover">
                    </div>
                    <div class="px-2 flex flex-col flex-grow">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="text-xs font-black text-[#4B5563] uppercase tracking-widest bg-white px-2 py-1 rounded">20.09.2025</span>
                            <span class="bg-[#F59E0B] text-[#111827] text-xs px-2 py-1 rounded font-black uppercase tracking-widest">Edaran</span>
                        </div>
                        <h2 class="text-2xl font-black text-[#111827] uppercase tracking-tighter mb-4 leading-tight">Konklusi Rapat Laporan Tengah Tahun</h2>
                        <p class="text-[#4B5563] font-medium text-sm leading-relaxed mb-6 flex-grow">
                            Rapat penyesuaian rasio metrik bulanan berjalan tertib demi mengejar kuota pertumbuhan progresif desa.
                        </p>
                        
                        <div class="w-full pt-4 border-t-4 border-white">
                            <a href="#" class="inline-block text-sm font-black text-[#10B981] hover:text-[#111827] uppercase tracking-widest transition-colors">BACA SELENGKAPNYA -></a>
                        </div>
                    </div>
                </div>

            </div>

             <div class="mt-16 flex justify-center">
                <a href="#" class="inline-flex items-center justify-center px-12 py-5 font-black text-lg uppercase tracking-widest bg-[#111827] text-white border-4 border-[#111827] rounded-md hover:bg-white hover:text-[#111827] transition-all">
                    Tampilkan Indeks Terdahulu
                </a>
            </div>
        </div>
    </div>
</div>

@endsection