@extends('layouts.app')

@section('content')

<!-- Top Layout Container -->
<div class="relative w-full pt-16 sm:pt-20 bg-white z-10">

    <!-- Hero Section Flat Split -->
    <div class="w-full flex flex-col lg:flex-row border-b-4 border-[#111827]">
        <!-- Right Side: Full Hero Image -->
        <div class="w-full lg:w-1/2 h-[30vh] sm:h-[40vh] lg:h-[60vh] bg-gray-200 order-1 lg:order-2 border-b-4 lg:border-b-0 lg:border-l-4 border-[#111827]">
            <img class="w-full h-full object-cover object-center block" 
                 src="{{ asset('green-landscape-with-mountain.jpg') }}" 
                 alt="BUMDes Profil" fetchpriority="high" loading="eager" decoding="async">
        </div>
        
        <!-- Left Side: Solid Dark Block -->
        <div class="w-full lg:w-1/2 bg-[#111827] relative overflow-hidden flex flex-col justify-center p-6 sm:p-8 lg:p-16 min-h-[40vh] lg:h-[60vh] order-2 lg:order-1">
            <!-- Decorative Shapes -->
            <div class="absolute -bottom-16 -left-16 w-32 sm:w-64 h-32 sm:h-64 border-4 sm:border-8 border-white/10 rounded-full pointer-events-none"></div>
            <div class="absolute top-10 right-10 w-16 sm:w-32 h-16 sm:h-32 bg-white/5 pointer-events-none hidden sm:block"></div>
            
            <div class="relative z-10 w-full max-w-xl">
                 <div class="inline-block px-3 sm:px-4 py-1 sm:py-1.5 bg-white rounded-md text-[#111827] font-black tracking-widest uppercase text-xs sm:text-sm mb-4 sm:mb-6">
                    Entitas Mandiri
                </div>

                <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-black text-white tracking-tighter leading-[0.95] mb-4 sm:mb-6 uppercase">
                    Profil<br/><span class="text-[#F59E0B]">BUMDes Go</span>
                </h1>

                <p class="text-base sm:text-lg lg:text-xl font-bold text-gray-300 leading-snug">
                    Mengenal lebih dekat perjalanan, cita-cita, dan arah gerak roda ekonomi kerakyatan.
                </p>
            </div>
        </div>
    </div>

    <!-- ====== PROFIL CONTENT SECTION ====== -->
    <div class="w-full py-12 sm:py-24 bg-white relative">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-12">

            <!-- Sejarah Section (Flat Style) -->
            <div class="mb-16 sm:mb-24 flex flex-col lg:flex-row gap-8 sm:gap-12 items-start">
                <div class="lg:w-1/3 flex-shrink-0">
                    <h2 class="text-4xl sm:text-5xl md:text-6xl font-black text-[#111827] uppercase tracking-tighter mb-4 leading-none inline-block border-b-8 border-[#2563EB] pb-2">
                        Sejarah
                    </h2>
                </div>
                <div class="lg:w-2/3">
                    <div class="text-[#4B5563] text-base sm:text-lg font-medium leading-relaxed space-y-4 sm:space-y-6">
                        <p class="p-4 sm:p-6 bg-[#F3F4F6] border-l-4 sm:border-l-8 border-[#2563EB] rounded-r-md">
                            <span class="font-black text-[#111827] uppercase tracking-widest text-xs sm:text-sm block mb-2">Fase Inisiasi</span>
                            BUMDes (Badan Usaha Milik Desa) didirikan dengan manifestasi gotong royong dan tekad baja untuk mewujudkan kemandirian basis material masyarakat desa. Berawal dari potensi lokus desa yang melimpah namun tidak terserap sempurna, agregat tokoh dan instansi aparat merintis arsitektur BUMDes.
                        </p>
                        <p class="p-4 sm:p-6 bg-white border-4 border-[#111827] rounded-md">
                             <span class="font-black text-[#111827] uppercase tracking-widest text-xs sm:text-sm block mb-2">Fase Transformasi</span>
                            Organisasi terus berkembang menguasai pilar sektor nyata. Ekspansi menuju digitalisasi platform "BUMDes Go" merupakan langkah definitif kami melepaskan borgol isolasi geografis, menghubungkan elemen produksi sekunder (UMKM) ke bursa komoditas terbuka.
                        </p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8">
                <!-- Visi Section (Flat Style) -->
                <div class="bg-white p-6 sm:p-8 rounded-xl border-4 border-[#111827] relative overflow-hidden group hover:bg-[#111827] transition-colors duration-300">
                    <!-- Icon Block -->
                    <div class="w-12 h-12 sm:w-16 sm:h-16 bg-[#F59E0B] border-4 border-[#111827] rounded mb-4 sm:mb-6 flex items-center justify-center text-[#111827] group-hover:bg-white transition-colors duration-300">
                         <svg class="w-6 h-6 sm:w-8 sm:h-8 font-black" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="3" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="3" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </div>
                    
                    <h3 class="text-3xl sm:text-4xl font-black text-[#111827] uppercase tracking-tighter mb-4 group-hover:text-white transition-colors">Visi</h3>
                    <div class="w-10 sm:w-12 h-1.5 sm:h-2 bg-[#F59E0B] mb-4 sm:mb-6"></div>
                    <p class="text-[#4B5563] font-bold leading-relaxed text-base sm:text-lg group-hover:text-gray-300 transition-colors">
                        Menjadi blok mesin utama penggerak agregat desa yang merdeka secara kapital, revolusioner, dan mengamankan titik kesejahteraan simetris sesuai tata nilai identitas lokalitas.
                    </p>
                </div>

                <!-- Misi Section (Flat Style) -->
                <div class="bg-white p-6 sm:p-8 rounded-xl border-4 border-[#111827] relative overflow-hidden group hover:bg-[#111827] transition-colors duration-300">
                    <div class="w-12 h-12 sm:w-16 sm:h-16 bg-[#10B981] border-4 border-[#111827] rounded mb-4 sm:mb-6 flex items-center justify-center text-[#111827] group-hover:bg-white transition-colors duration-300">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 font-black" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="3" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    
                    <h3 class="text-3xl sm:text-4xl font-black text-[#111827] uppercase tracking-tighter mb-4 group-hover:text-white transition-colors">Misi</h3>
                    <div class="w-10 sm:w-12 h-1.5 sm:h-2 bg-[#10B981] mb-4 sm:mb-6"></div>
                    <ul class="text-[#4B5563] space-y-3 sm:space-y-4 font-bold leading-relaxed text-base sm:text-lg group-hover:text-gray-300 transition-colors">
                        <li class="flex items-start gap-2 sm:gap-3">
                            <div class="w-2.5 h-2.5 sm:w-3 sm:h-3 bg-[#111827] mt-1.5 sm:mt-2 flex-shrink-0 group-hover:bg-[#10B981] transition-colors"></div>
                            <span>Membangun pangkalan tata niaga yang berakar dari demografi alam liar desa.</span>
                        </li>
                        <li class="flex items-start gap-2 sm:gap-3">
                            <div class="w-2.5 h-2.5 sm:w-3 sm:h-3 bg-[#111827] mt-1.5 sm:mt-2 flex-shrink-0 group-hover:bg-[#10B981] transition-colors"></div>
                            <span>Memberdayakan kluster UMKM melalui sistem platform jaringan yang serba terotomatisasi.</span>
                        </li>
                        <li class="flex items-start gap-2 sm:gap-3">
                            <div class="w-2.5 h-2.5 sm:w-3 sm:h-3 bg-[#111827] mt-1.5 sm:mt-2 flex-shrink-0 group-hover:bg-[#10B981] transition-colors"></div>
                            <span>Ekspansi wilayah padat karya demi melibas total kurva angka ketiadaan kerja.</span>
                        </li>
                        <li class="flex items-start gap-2 sm:gap-3">
                            <div class="w-2.5 h-2.5 sm:w-3 sm:h-3 bg-[#111827] mt-1.5 sm:mt-2 flex-shrink-0 group-hover:bg-[#10B981] transition-colors"></div>
                            <span>Eskalasi Pendapatan Asli Desa (PADes) radikal untuk menopang sirkuit fasilitas warganegara.</span>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection