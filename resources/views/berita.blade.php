@extends('layouts.app')

@push('preload')
<link rel="preload" as="image" href="{{ asset('community-people-working-together-agriculture-grow-food.jpg') }}"
    fetchpriority="high">
@endpush

@section('content')
<!-- Hero Background Wrapper -->
<div class="relative w-full h-[55vh] overflow-hidden bg-gray-900">
    <!-- Hero Image — fetchpriority tinggi agar tidak ada delay -->
    <img src="{{ asset('community-people-working-together-agriculture-grow-food.jpg') }}" alt="Hero Berita BUMDes"
        fetchpriority="high" loading="eager" decoding="async"
        class="absolute inset-0 w-full h-full object-cover object-center">
    <!-- Dark Overlay -->
    <div class="absolute inset-0 bg-black/60"></div>

    <!-- Hero Content -->
    <div class="relative z-10 w-full h-full flex flex-col items-center justify-center text-center px-4 pt-20">
        <h1 class="text-4xl md:text-5xl lg:text-5xl font-extrabold text-white mb-4 tracking-tight">
            Berita & <span class="text-transparent bg-clip-text bg-blue-300">Kegiatan</span>
        </h1>
        <p class="text-lg md:text-xl text-white/90 max-w-2xl mt-2 font-light">
            Transparansi kegiatan dan informasi terbaru dari BUMDes Go DIGITAL SOLUSI.
        </p>
    </div>
</div> <!-- Close Hero Wrapper -->

<!-- Berita Content Section -->
<div
    class="w-full min-h-screen py-16 mt-[-2.5rem] relative overflow-hidden bg-white z-20 rounded-t-[3rem] shadow-[0_-15px_40px_-15px_rgba(0,0,0,0.3)]">
    <!-- Ambient blur blobs -->
    <div
        class="pointer-events-none absolute -top-24 -left-24 w-[500px] h-[500px] bg-blue-200 rounded-full opacity-40 blur-3xl">
    </div>
    <div
        class="pointer-events-none absolute -bottom-24 -right-24 w-[500px] h-[500px] bg-sky-300 rounded-full opacity-30 blur-3xl">
    </div>
    <div
        class="pointer-events-none absolute top-1/2 left-1/3 w-[600px] h-[400px] bg-indigo-200 rounded-full opacity-20 blur-3xl">
    </div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 pt-8">

            <!-- Berita Card 1 -->
            <div
                class="bg-blue-300/80 backdrop-blur-sm rounded-xl overflow-hidden shadow-lg border border-blue-200 flex flex-col transition hover:shadow-2xl hover:-translate-y-1 group cursor-pointer">
                <div class="overflow-hidden h-48">
                    <img src="https://picsum.photos/600/400?random=101" alt="Gotong Royong"
                        class="w-full h-full object-cover transform group-hover:scale-105 transition duration-500">
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="text-xs font-medium text-blue-900/70">4 November 2025</span>
                        <span class="bg-white/40 text-blue-900 text-xs px-3 py-1 rounded-full font-medium">Berita</span>
                    </div>
                    <h2
                        class="text-xl font-bold text-blue-950 mb-3 leading-snug group-hover:text-white transition-colors">
                        Gotong royong bersama masyarakat</h2>
                    <p class="text-blue-900/75 text-sm leading-relaxed mb-4 flex-grow">
                        Kami selaku pengurus BUMDes mengajak seluruh warga untuk bersama-sama bergotong royong
                        melanjutkan program-program yang tertunda serta membersihkan lingkungan sekitar fasilitas desa.
                    </p>
                </div>
            </div>

            <!-- Dummy Berita Card 2 -->
            <div
                class="bg-blue-300/80 backdrop-blur-sm rounded-xl overflow-hidden shadow-lg border border-blue-200 flex flex-col transition hover:shadow-2xl hover:-translate-y-1 group cursor-pointer">
                <div class="overflow-hidden h-48">
                    <img src="https://picsum.photos/600/400?random=102" alt="Berita 2"
                        class="w-full h-full object-cover transform group-hover:scale-105 transition duration-500">
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="text-xs font-medium text-blue-900/70">12 Oktober 2025</span>
                        <span
                            class="bg-white/40 text-blue-900 text-xs px-3 py-1 rounded-full font-medium">Kegiatan</span>
                    </div>
                    <h2
                        class="text-xl font-bold text-blue-950 mb-3 leading-snug group-hover:text-white transition-colors">
                        Peluncuran Kopi Arabika Terbaru</h2>
                    <p class="text-blue-900/75 text-sm leading-relaxed mb-4 flex-grow">
                        Produk kopi terbaru hasil panen dari perkebunan warga kini sudah tersedia di katalog BUMDes dan
                        didistribusikan ke pasar lokal.
                    </p>
                </div>
            </div>

            <!-- Dummy Berita Card 3 -->
            <div
                class="bg-blue-300/80 backdrop-blur-sm rounded-xl overflow-hidden shadow-lg border border-blue-200 flex flex-col transition hover:shadow-2xl hover:-translate-y-1 group cursor-pointer">
                <div class="overflow-hidden h-48">
                    <img src="https://picsum.photos/600/400?random=103" alt="Berita 3"
                        class="w-full h-full object-cover transform group-hover:scale-105 transition duration-500">
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="text-xs font-medium text-blue-900/70">20 September 2025</span>
                        <span
                            class="bg-white/40 text-blue-900 text-xs px-3 py-1 rounded-full font-medium">Pengumuman</span>
                    </div>
                    <h2
                        class="text-xl font-bold text-blue-950 mb-3 leading-snug group-hover:text-white transition-colors">
                        Rapat Evaluasi Triwulan 3</h2>
                    <p class="text-blue-900/75 text-sm leading-relaxed mb-4 flex-grow">
                        Rapat evaluasi berjalan tertib bersama seluruh stakeholder untuk memastikan program akhir tahun
                        berjalan mulus dan sesuai anggaran.
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection