@extends('layouts.app')

@section('content')

<!-- Top Layout Container -->
<div class="relative w-full pt-16 sm:pt-20 bg-white z-10">

    <!-- Hero Section Flat Split -->
    <div class="w-full flex flex-col lg:flex-row border-b-4 border-[#111827]">
        <!-- Right Side: Full Hero Image -->
         <div class="w-full lg:w-1/2 h-[30vh] sm:h-[40vh] lg:h-[60vh] bg-gray-200 order-1 lg:order-2 border-b-4 lg:border-b-0 lg:border-l-4 border-[#111827]">
            <img class="w-full h-full object-cover object-center block hover:scale-105 transition-transform duration-700" 
                 src="{{ asset('green-landscape-with-mountain.jpg') }}" 
                 alt="Kontak BUMDes" fetchpriority="high" loading="eager" decoding="async">
        </div>

        <!-- Left Side: Solid Dark Block -->
        <div class="w-full lg:w-1/2 bg-[#2563EB] relative overflow-hidden flex flex-col justify-center p-6 sm:p-8 lg:p-16 min-h-[40vh] lg:h-[60vh] order-2 lg:order-1">
            <!-- Decorative Shapes -->
            <div class="absolute -bottom-16 -left-16 w-32 sm:w-64 h-32 sm:h-64 border-4 sm:border-8 border-white/20 pointer-events-none"></div>
            <div class="absolute top-10 right-10 w-16 sm:w-32 h-16 sm:h-32 bg-white/20 rounded-full pointer-events-none hidden sm:block"></div>
            
            <div class="relative z-10 w-full max-w-xl">
                 <div class="inline-block px-3 sm:px-4 py-1 sm:py-1.5 bg-[#111827] rounded-md text-white font-black tracking-widest uppercase text-xs sm:text-sm mb-4 sm:mb-6">
                    Pusat Komando
                </div>

                <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-black text-white tracking-tighter leading-[0.95] mb-4 sm:mb-6 uppercase">
                    Hubungi<br/><span class="text-[#111827]">Kami</span>
                </h1>

                <p class="text-base sm:text-lg lg:text-xl font-bold text-white/90 leading-snug">
                    Jalur komunikasi langsung untuk kolaborasi silang sektor.
                </p>
            </div>
        </div>
    </div>

    <!-- ====== CONTACT SECTION ====== -->
    <div class="w-full py-12 sm:py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 sm:gap-12 items-stretch">

                <!-- Informasi Kontak (Flat Variant) -->
                <div class="bg-[#F3F4F6] p-6 sm:p-8 md:p-12 border-4 border-[#111827] rounded flex flex-col justify-center relative overflow-hidden group">
                    <div class="absolute -right-12 -top-12 w-32 md:w-48 h-32 md:h-48 bg-[#E5E7EB] rounded-full pointer-events-none"></div>

                    <h2 class="text-3xl sm:text-4xl md:text-5xl font-black text-[#111827] mb-6 sm:mb-8 uppercase tracking-tighter leading-none relative z-10 break-words">
                        Kontak<br>Posisi Keamanan
                    </h2>
                    <div class="w-16 sm:w-24 h-3 sm:h-4 bg-[#F59E0B] mb-8 sm:mb-12 relative z-10"></div>

                    <div class="space-y-8 sm:space-y-10 relative z-10">
                        <!-- Alamat -->
                        <div class="flex flex-col sm:flex-row items-start gap-4 sm:gap-5">
                            <div class="w-12 h-12 sm:w-16 sm:h-16 bg-[#111827] text-white border-4 border-[#111827] flex items-center justify-center flex-shrink-0 transition-colors shadow-[4px_4px_0_0_#F59E0B] sm:shadow-[8px_8px_0_0_#F59E0B]">
                                <svg class="w-6 h-6 sm:w-8 sm:h-8 font-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="3" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="3" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div class="mt-1">
                                <h3 class="text-lg sm:text-xl font-black text-[#111827] mb-1 sm:mb-2 uppercase tracking-widest break-words">Markas Pusat</h3>
                                <p class="text-[#4B5563] font-bold leading-relaxed text-xs sm:text-sm">
                                    Balai Desa Sinulasi Utama<br>
                                    Distrik Integrasi, Teritori Timur<br>
                                    Kode Sektor A1-9092
                                </p>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="flex flex-col sm:flex-row items-start gap-4 sm:gap-5">
                            <div class="w-12 h-12 sm:w-16 sm:h-16 bg-[#111827] text-white border-4 border-[#111827] flex items-center justify-center flex-shrink-0 shadow-[4px_4px_0_0_#10B981] sm:shadow-[8px_8px_0_0_#10B981]">
                                <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="3" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="mt-1 w-full overflow-hidden">
                                <h3 class="text-lg sm:text-xl font-black text-[#111827] mb-1 sm:mb-2 uppercase tracking-widest break-words">Surat Digital</h3>
                                <p class="text-[#4B5563] font-bold text-xs sm:text-sm flex flex-col gap-1 w-full">
                                    <a href="mailto:halo@bumdesgodigitalsolusi.id" class="hover:text-[#2563EB] hover:bg-white inline-block px-1 transition-colors break-all">halo@bumdesgodigitalsolusi.id</a>
                                    <a href="mailto:support@bumdesgodigitalsolusi.id" class="hover:text-[#10B981] hover:bg-white inline-block px-1 transition-colors break-all">support@bumdesgodigitalsolusi.id</a>
                                </p>
                            </div>
                        </div>

                        <!-- Telepon -->
                        <div class="flex flex-col sm:flex-row items-start gap-4 sm:gap-5">
                            <div class="w-12 h-12 sm:w-16 sm:h-16 bg-[#111827] text-white border-4 border-[#111827] flex items-center justify-center flex-shrink-0 shadow-[4px_4px_0_0_#2563EB] sm:shadow-[8px_8px_0_0_#2563EB]">
                                <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="3" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <div class="mt-1">
                                <h3 class="text-lg sm:text-xl font-black text-[#111827] mb-1 sm:mb-2 uppercase tracking-widest break-words">Transmisi Suara</h3>
                                <p class="text-[#4B5563] font-bold text-xs sm:text-sm flex flex-col gap-1">
                                    <a href="tel:+622112345678" class="hover:text-[#2563EB] hover:bg-white inline-block px-1 transition-colors break-all">Telp: (021) 1234-5678</a>
                                    <a href="https://wa.me/6281234567890" target="_blank" class="hover:text-[#10B981] hover:bg-white inline-block px-1 transition-colors cursor-pointer break-all">WA: +62 812-3456-7890</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Google Map (Flat Frame) -->
                <div class="bg-[#111827] border-4 border-[#111827] rounded overflow-hidden h-[300px] sm:h-full min-h-[300px] sm:min-h-[450px] flex flex-col p-1.5 sm:p-2">
                    <div class="w-full flex-grow h-full bg-gray-200 border-4 border-[#111827] relative">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1m3!1m2!1s0x2e69f3e945e34b9d%3A0x5371bf0fdad786a9!2sJakarta%2C%20Daerah%20Khusus%20Ibukota%20Jakarta!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid"
                            class="absolute inset-0 w-full h-full border-0 filter grayscale contrast-125" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                        <!-- Flat Target overlay pointer -->
                        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 pointer-events-none">
                            <div class="w-12 h-12 sm:w-16 sm:h-16 border-4 border-[#F59E0B] rounded-full flex items-center justify-center bg-white/50 backdrop-blur-sm">
                                <div class="w-3 h-3 sm:w-4 sm:h-4 bg-[#F59E0B] rounded-full"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection