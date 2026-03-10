@extends('layouts.app')

@section('content')

<!-- Hero Background Wrapper -->
<div class="relative w-full h-[55vh] overflow-hidden bg-gray-900">
    <img src="{{ asset('green-landscape-with-mountain.jpg') }}" alt="Kontak BUMDes" fetchpriority="high" loading="eager"
        decoding="async" class="absolute inset-0 w-full h-full object-cover object-center">
    <div class="absolute inset-0 bg-blue-900/60 mix-blend-multiply"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-transparent to-transparent opacity-80"></div>

    <!-- Hero Content -->
    <div class="relative z-10 w-full h-full flex flex-col items-center justify-center text-center px-4 pt-20">
        <h1 class="text-4xl md:text-5xl lg:text-5xl font-extrabold text-white mb-4 tracking-tight">
            Hubungi <span class="text-transparent bg-clip-text bg-blue-300">Kami</span>
        </h1>
        <p class="text-lg md:text-xl text-white/90 max-w-2xl mt-2 font-light">
            Kami siap mendengar dari Anda. Mari berkolaborasi dan bangun potensi bersama.
        </p>
    </div>
</div>

<!-- ====== CONTACT SECTION ====== -->
<section
    class="w-full py-20 mt-[-2.5rem] relative bg-gray-50 z-20 rounded-t-[3rem] shadow-[0_-15px_40px_-15px_rgba(0,0,0,0.3)]">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-stretch">

            <!-- Informasi Kontak -->
            <div class="bg-white p-8 md:p-10 rounded-3xl shadow-sm border border-gray-100 flex flex-col justify-center">
                <h2
                    class="text-3xl font-bold text-gray-900 mb-8 border-b-2 border-blue-500 pb-2 inline-block self-start">
                    Informasi Kontak</h2>

                <div class="space-y-8">
                    <!-- Alamat -->
                    <div class="flex items-start gap-5 group">
                        <div
                            class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300 shadow-sm">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-1">Alamat Kantor</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Kantor Kepala Desa Sinulasi<br>
                                Kec. Maju Bersama, Kab. Sinar Jaya<br>
                                Kode Pos 12345
                            </p>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="flex items-start gap-5 group">
                        <div
                            class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300 shadow-sm">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-1">Email</h3>
                            <p class="text-gray-600">
                                <a href="mailto:halo@bumdesgodigitalsolusi.id"
                                    class="hover:text-blue-600 transition-colors">halo@bumdesgodigitalsolusi.id</a><br>
                                <a href="mailto:support@bumdesgodigitalsolusi.id"
                                    class="hover:text-blue-600 transition-colors">support@bumdesgodigitalsolusi.id</a>
                            </p>
                        </div>
                    </div>

                    <!-- Telepon -->
                    <div class="flex items-start gap-5 group">
                        <div
                            class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300 shadow-sm">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-1">Telepon / WhatsApp</h3>
                            <p class="text-gray-600">
                                <a href="tel:+622112345678" class="hover:text-blue-600 transition-colors">(021)
                                    1234-5678</a><br>
                                <a href="https://wa.me/6281234567890" target="_blank"
                                    class="hover:text-blue-600 transition-colors cursor-pointer">+62 812-3456-7890
                                    (WA)</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Google Map -->
            <div
                class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden h-full min-h-[450px] flex flex-col relative group">
                <!-- Overlay loading optional indicator -->
                <div class="w-full flex-grow h-full bg-gray-200">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1m3!1m2!1s0x2e69f3e945e34b9d%3A0x5371bf0fdad786a9!2sJakarta%2C%20Daerah%20Khusus%20Ibukota%20Jakarta!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid"
                        class="absolute inset-0 w-full h-full border-0" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection