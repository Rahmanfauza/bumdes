<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BUMDesGO</title>
    @stack('preload')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased font-sans bg-gray-50 text-gray-900 overflow-x-hidden">

    <!-- ====== HEADER ====== -->
    <header id="mainNav"
        class="fixed top-0 left-0 w-full z-50 flex items-center justify-between px-6 lg:px-12 py-5 transition-all duration-300">

        <!-- Logo -->
        <a href="{{ url('/') }}" class="flex items-center gap-3">
            <img src="{{ asset('Logo.png') }}" alt="Logo Bumdes Go" class="h-10 w-auto">
            <span class="text-xl font-bold text-white tracking-wide">BUMDes <span class="text-blue-300">GO</span></span>
        </a>

        <!-- Desktop Nav Links -->
        <nav class="hidden lg:flex items-center gap-2 text-white/90 text-sm font-medium">
            @php
            $navLinks = [
            ['url' => url('/'), 'label' => 'Beranda', 'active' => request()->is('/')],
            ['url' => url('/berita'), 'label' => 'Berita', 'active' => request()->is('berita') ||
            request()->is('berita/*')],
            ['url' => url('/katalog'), 'label' => 'Katalog', 'active' => request()->is('katalog') ||
            request()->is('katalog/*')],
            ['url' => url('/profil'), 'label' => 'Profil', 'active' => request()->is('profil') ||
            request()->is('profil/*')],
            ['url' => url('/kontak'), 'label' => 'Kontak', 'active' => request()->is('kontak')],
            ];
            @endphp
            @foreach($navLinks as $link)
            <a href="{{ $link['url'] }}" class="px-4 py-1.5 rounded-full transition-all duration-200
                          {{ $link['active']
                              ? 'bg-blue-500/30 text-blue-200 font-semibold'
                              : 'hover:bg-blue-500/20 text-white/80 hover:text-blue-200' }}">
                {{ $link['label'] }}
            </a>
            @endforeach
            <button id="loginBtn"
                class="ml-4 bg-white text-gray-900 px-6 py-2 rounded-full font-bold hover:bg-gray-100 transition focus:outline-none">
                Log in
            </button>
        </nav>

        <!-- Mobile Hamburger -->
        <div class="lg:hidden flex items-center">
            <button id="mobileMenuBtn" class="text-white focus:outline-none" aria-label="Toggle Menu">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </header>

    <!-- Mobile Nav Menu (hidden by default) -->
    <div id="mobileMenu"
        class="fixed top-0 left-0 w-full h-full z-40 bg-blue-900/95 backdrop-blur-md flex flex-col items-center justify-center gap-8 hidden">
        <button id="closeMobileMenu" class="absolute top-6 right-6 text-white focus:outline-none">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <a href="{{ url('/') }}"
            class="text-2xl font-semibold transition-all px-6 py-2 rounded-full
                  {{ request()->is('/') ? 'bg-white/20 text-white font-bold' : 'text-white/80 hover:text-white hover:bg-white/10' }}">
            Beranda
        </a>
        <a href="{{ url('/berita') }}"
            class="text-2xl font-semibold transition-all px-6 py-2 rounded-full
                  {{ request()->is('berita') || request()->is('berita/*') ? 'bg-white/20 text-white font-bold' : 'text-white/80 hover:text-white hover:bg-white/10' }}">
            Berita
        </a>
        <a href="{{ url('/katalog') }}"
            class="text-2xl font-semibold transition-all px-6 py-2 rounded-full
                  {{ request()->is('katalog') || request()->is('katalog/*') ? 'bg-white/20 text-white font-bold' : 'text-white/80 hover:text-white hover:bg-white/10' }}">
            Katalog
        </a>
        <a href="{{ url('/profil') }}"
            class="text-2xl font-semibold transition-all px-6 py-2 rounded-full
                  {{ request()->is('profil') || request()->is('profil/*') ? 'bg-white/20 text-white font-bold' : 'text-white/80 hover:text-white hover:bg-white/10' }}">
            Profil
        </a>
        <a href="{{ url('/kontak') }}"
            class="text-2xl font-semibold transition-all px-6 py-2 rounded-full
                  {{ request()->is('kontak') ? 'bg-white/20 text-white font-bold' : 'text-white/80 hover:text-white hover:bg-white/10' }}">
            Kontak
        </a>
        <button id="mobileLoginBtn"
            class="bg-white text-gray-900 px-8 py-3 rounded-full font-bold hover:bg-gray-100 transition focus:outline-none text-lg">
            Log in
        </button>
    </div>

    <!-- ====== PAGE CONTENT ====== -->
    @yield('content')

    <!-- ====== LOGIN MODAL ====== -->
    <div id="loginModal"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 hidden opacity-0 transition-opacity duration-300">
        <!-- Backdrop -->
        <div id="loginBackdrop" class="absolute inset-0 bg-black/60 backdrop-blur-sm cursor-pointer"></div>

        <!-- Modal Card -->
        <div id="loginFormContainer"
            class="relative z-10 w-full max-w-md bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl p-8 shadow-2xl transform scale-95 transition-transform duration-300">

            <!-- Close Button -->
            <button id="closeModalBtn"
                class="absolute top-4 right-4 text-white/60 hover:text-white transition focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <div class="mb-8 text-center pt-2">
                <h2 class="text-3xl font-bold text-white mb-2">Login</h2>
                <p class="text-blue-100">Silahkan masukkan data anda untuk login.</p>
            </div>

            <form action="{{ url('/login') }}" method="POST" class="space-y-6">
                @csrf
                <!-- Username -->
                <div>
                    <label for="username" class="block text-sm font-medium text-blue-50 mb-2">Username</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-blue-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="text" name="username" id="username"
                            class="block w-full pl-11 pr-4 py-3 border border-white/20 rounded-xl bg-white/10 text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 sm:text-sm transition duration-150 ease-in-out"
                            placeholder="Masukkan username anda" required>
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-blue-50 mb-2">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-blue-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="password" name="password" id="password"
                            class="block w-full pl-11 pr-4 py-3 border border-white/20 rounded-xl bg-white/10 text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 sm:text-sm transition duration-150 ease-in-out"
                            placeholder="Masukkan password anda" required>
                    </div>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember-me" type="checkbox"
                            class="h-4 w-4 text-blue-500 focus:ring-blue-400 border-white/30 rounded bg-white/10">
                        <label for="remember-me" class="ml-2 block text-sm text-blue-100 cursor-pointer">
                            Ingat saya
                        </label>
                    </div>
                    <div class="text-sm">
                        <a href="#" class="font-medium text-blue-300 hover:text-blue-100 transition duration-150">
                            Lupa password?
                        </a>
                    </div>
                </div>

                <!-- Submit -->
                <div>
                    <button type="submit"
                        class="w-full flex justify-center py-3 px-4 rounded-xl shadow-sm text-sm font-bold text-blue-900 bg-blue-100 hover:bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-300 focus:ring-offset-transparent transition duration-200 ease-in-out hover:-translate-y-0.5 transform">
                        Masuk
                    </button>
                </div>
            </form>

            <div class="mt-8 text-center">
                <p class="text-sm text-blue-100 border-t border-white/20 pt-6">
                    Belum punya akun?
                    <a href="#" class="font-medium text-white hover:text-blue-200 transition duration-150">Daftar</a>
                </p>
            </div>
        </div>
    </div>

    <!-- ====== FOOTER ====== -->
    <footer class="bg-gray-900 text-white pt-20 pb-10 relative z-20">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">

                <!-- Tentang BUMDes -->
                <div class="col-span-1 md:col-span-2 lg:col-span-1">
                    <div class="flex items-center gap-3 mb-6">
                        <img src="{{ asset('Logo.png') }}" alt="Logo Bumdes Go" class="h-10 w-auto">
                        <h2 class="text-xl font-bold tracking-wide">BUMDes <span class="text-blue-400">GO</span></h2>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed mb-6">
                        BUMDes Sinar Jaya Digital Solusi hadir untuk memajukan perekonomian Desa Sinulasi melalui
                        pemanfaatan teknologi digital berkelanjutan dan pemberdayaan masyarakat lokal.
                    </p>
                    <!-- Social Media -->
                    <div class="flex space-x-4">
                        <a href="#"
                            class="text-gray-400 hover:text-white transition-colors bg-white/5 p-2 rounded-full hover:bg-blue-600">
                            <span class="sr-only">Facebook</span>
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#"
                            class="text-gray-400 hover:text-white transition-colors bg-white/5 p-2 rounded-full hover:bg-pink-600">
                            <span class="sr-only">Instagram</span>
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#"
                            class="text-gray-400 hover:text-white transition-colors bg-white/5 p-2 rounded-full hover:bg-sky-500">
                            <span class="sr-only">Twitter / X</span>
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path
                                    d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Tautan Cepat -->
                <div>
                    <h3 class="text-white font-bold mb-6 uppercase tracking-wider text-sm">Tautan Cepat</h3>
                    <ul class="space-y-4">
                        <li><a href="{{ url('/') }}"
                                class="text-gray-400 hover:text-blue-400 transition-colors text-sm">Beranda</a></li>
                        <li><a href="{{ url('/berita') }}"
                                class="text-gray-400 hover:text-blue-400 transition-colors text-sm">Berita &amp;
                                Pengumuman</a></li>
                        <li><a href="{{ url('/katalog') }}"
                                class="text-gray-400 hover:text-blue-400 transition-colors text-sm">Katalog
                                Produk</a></li>
                        <li><a href="{{ url('/profil') }}"
                                class="text-gray-400 hover:text-blue-400 transition-colors text-sm">Profil
                                BUMDes</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-blue-400 transition-colors text-sm">Galeri
                                Kegiatan</a></li>
                    </ul>
                </div>

                <!-- Layanan -->
                <div>
                    <h3 class="text-white font-bold mb-6 uppercase tracking-wider text-sm">Layanan</h3>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-gray-400 hover:text-blue-400 transition-colors text-sm">Mitra
                                Desa</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-blue-400 transition-colors text-sm">Lapak
                                UMKM</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-blue-400 transition-colors text-sm">Penyewaan
                                Alat</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-blue-400 transition-colors text-sm">Simpan
                                Pinjam</a></li>
                    </ul>
                </div>

                <!-- Kontak -->
                <div>
                    <h3 class="text-white font-bold mb-6 uppercase tracking-wider text-sm">Hubungi Kami</h3>
                    <ul class="space-y-4 text-sm text-gray-400">
                        <li class="flex items-start gap-3">
                            <svg class="h-5 w-5 text-blue-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>Kantor Kepala Desa Sinulasi, Kec. Maju Bersama, Kab. Sinar Jaya, Kode Pos 12345</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="h-5 w-5 text-blue-500 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span>(021) 1234-5678</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="h-5 w-5 text-blue-500 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span>halo@bumdesgodigitalsolusi.id</span>
                        </li>
                    </ul>
                </div>

            </div>

            <!-- Footer Bottom Bar -->
            <div
                class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center text-sm text-gray-500 gap-4">
                <p>&copy; 2026 BUMDes Go Digital Solusi. Hak cipta dilindungi undang-undang.</p>
                <div class="flex space-x-6">
                    <a href="#" class="hover:text-blue-400 transition-colors">Syarat &amp; Ketentuan</a>
                    <a href="#" class="hover:text-blue-400 transition-colors">Kebijakan Privasi</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- ====== SCRIPTS ====== -->
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        // ----- Login Modal -----
        const loginBtn = document.getElementById('loginBtn');
        const mobileLoginBtn = document.getElementById('mobileLoginBtn');
        const loginModal = document.getElementById('loginModal');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const loginBackdrop = document.getElementById('loginBackdrop');
        const loginFormContainer = document.getElementById('loginFormContainer');

        const openModal = (e) => {
            if (e) e.preventDefault();
            loginModal.classList.remove('hidden');
            setTimeout(() => {
                loginModal.classList.remove('opacity-0');
                loginFormContainer.classList.remove('scale-95');
                loginFormContainer.classList.add('scale-100');
            }, 10);
        };

        const closeModal = () => {
            loginModal.classList.add('opacity-0');
            loginFormContainer.classList.remove('scale-100');
            loginFormContainer.classList.add('scale-95');
            setTimeout(() => loginModal.classList.add('hidden'), 300);
        };

        if (loginBtn) loginBtn.addEventListener('click', openModal);
        if (mobileLoginBtn) mobileLoginBtn.addEventListener('click', openModal);
        if (closeModalBtn) closeModalBtn.addEventListener('click', closeModal);
        if (loginBackdrop) loginBackdrop.addEventListener('click', closeModal);

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !loginModal.classList.contains('hidden')) closeModal();
        });

        // ----- Mobile Menu -----
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const closeMobileMenu = document.getElementById('closeMobileMenu');
        const mobileMenu = document.getElementById('mobileMenu');

        if (mobileMenuBtn) mobileMenuBtn.addEventListener('click', () => mobileMenu.classList.remove('hidden'));
        if (closeMobileMenu) closeMobileMenu.addEventListener('click', () => mobileMenu.classList.add(
            'hidden'));

        // Close mobile menu when a link is clicked
        mobileMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => mobileMenu.classList.add('hidden'));
        });

        // ----- Navbar Scroll Effect -----
        const mainNav = document.getElementById('mainNav');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                mainNav.classList.add('bg-blue-900/80', 'backdrop-blur-md', 'shadow-lg', 'py-3');
                mainNav.classList.remove('py-5');
            } else {
                mainNav.classList.remove('bg-blue-900/80', 'backdrop-blur-md', 'shadow-lg', 'py-3');
                mainNav.classList.add('py-5');
            }
        });
    });
    </script>

</body>

</html>