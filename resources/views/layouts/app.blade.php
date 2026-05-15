<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BUMDesGO</title>
    @stack('preload')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif !important; }
        * { box-shadow: none !important; }
        /* Scrollbar adjustment for a cleaner look horizontally */
        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-track { background: #F3F4F6; }
        ::-webkit-scrollbar-thumb { background: #111827; }
    </style>
</head>

<body class="antialiased bg-white text-[#111827] overflow-x-hidden">

    <!-- ====== HEADER ====== -->
    <header id="mainNav"
        class="fixed top-0 left-0 w-full z-50 flex items-center justify-between px-4 sm:px-6 lg:px-12 py-3 sm:py-5 bg-white border-b-4 border-[#111827] transition-all duration-200">

        <!-- Logo -->
        <a href="{{ url('/') }}" class="flex items-center gap-2 sm:gap-3 group">
            <div class="bg-[#111827] text-white px-2 py-1 sm:p-2 rounded-md font-black text-lg sm:text-xl tracking-tighter group-hover:scale-105 transition-transform border-4 border-[#111827] group-hover:bg-white group-hover:text-[#111827]">
                B<span class="text-[#F59E0B]">.</span>GO
            </div>
            <!-- Hide "BUMDes GO" completely on very small mobile, show on sm+ -->
            <span class="text-lg sm:text-xl font-black text-[#111827] tracking-tighter hidden sm:block">BUMDes <span class="text-[#2563EB]">GO</span></span>
        </a>

        <!-- Desktop Nav Links -->
        <nav class="hidden lg:flex items-center gap-1 xl:gap-2 text-sm font-bold uppercase tracking-widest">
            @php
            $navLinks = [
                ['url' => url('/'), 'label' => 'Beranda', 'active' => request()->is('/')],
                ['url' => url('/berita'), 'label' => 'Berita', 'active' => request()->is('berita') || request()->is('berita/*')],
                ['url' => url('/katalog'), 'label' => 'Katalog', 'active' => request()->is('katalog') || request()->is('katalog/*')],
                ['url' => url('/profil'), 'label' => 'Profil', 'active' => request()->is('profil') || request()->is('profil/*')],
                ['url' => url('/kontak'), 'label' => 'Kontak', 'active' => request()->is('kontak')],
            ];
            @endphp
            @foreach($navLinks as $link)
            <a href="{{ $link['url'] }}" class="px-3 xl:px-4 py-2 rounded-md transition-all duration-200 border-4
                          {{ $link['active']
                              ? 'bg-[#111827] text-white border-[#111827]'
                              : 'border-transparent text-[#4B5563] hover:border-[#111827] hover:text-[#111827]' }}">
                {{ $link['label'] }}
            </a>
            @endforeach
            <button id="loginBtn"
                class="ml-2 xl:ml-4 bg-[#F59E0B] text-[#111827] border-4 border-[#111827] px-4 xl:px-6 py-2 rounded-md font-black hover:bg-[#111827] hover:text-[#F59E0B] transition-colors focus:outline-none focus:ring-4 focus:ring-[#F59E0B]/50">
                LOG IN
            </button>
        </nav>

        <!-- Mobile Hamburger -->
        <div class="lg:hidden flex items-center">
            <button id="mobileMenuBtn" class="text-white focus:outline-none bg-[#111827] border-4 border-[#111827] p-1.5 sm:p-2 rounded-md hover:bg-white hover:text-[#111827] transition-colors" aria-label="Toggle Menu">
                <svg class="w-6 h-6 sm:w-7 sm:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="3" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </header>

    <!-- Mobile Nav Menu (hidden by default) -->
    <div id="mobileMenu" class="fixed inset-0 z-[60] bg-[#2563EB] hidden overflow-y-auto">
        <div class="min-h-screen py-10 px-4 flex flex-col items-center justify-center gap-4 sm:gap-6 relative">
            <button id="closeMobileMenu" class="absolute top-4 sm:top-6 right-4 sm:right-6 text-white focus:outline-none bg-[#111827] border-4 border-[#111827] p-1.5 sm:p-2 rounded-md hover:bg-white hover:text-[#111827] transition-colors">
                <svg class="w-7 h-7 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="3" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <a href="{{ url('/') }}"
                class="block w-full max-w-sm text-center text-xl sm:text-2xl font-black uppercase tracking-widest transition-all px-4 sm:px-8 py-3 sm:py-4 rounded-md border-4
                    {{ request()->is('/') ? 'bg-white text-[#2563EB] border-white' : 'border-transparent text-white hover:border-white' }}">
                Beranda
            </a>
            <a href="{{ url('/berita') }}"
                class="block w-full max-w-sm text-center text-xl sm:text-2xl font-black uppercase tracking-widest transition-all px-4 sm:px-8 py-3 sm:py-4 rounded-md border-4
                    {{ request()->is('berita') || request()->is('berita/*') ? 'bg-white text-[#2563EB] border-white' : 'border-transparent text-white hover:border-white' }}">
                Berita
            </a>
            <a href="{{ url('/katalog') }}"
                class="block w-full max-w-sm text-center text-xl sm:text-2xl font-black uppercase tracking-widest transition-all px-4 sm:px-8 py-3 sm:py-4 rounded-md border-4
                    {{ request()->is('katalog') || request()->is('katalog/*') ? 'bg-white text-[#2563EB] border-white' : 'border-transparent text-white hover:border-white' }}">
                Katalog
            </a>
            <a href="{{ url('/profil') }}"
                class="block w-full max-w-sm text-center text-xl sm:text-2xl font-black uppercase tracking-widest transition-all px-4 sm:px-8 py-3 sm:py-4 rounded-md border-4
                    {{ request()->is('profil') || request()->is('profil/*') ? 'bg-white text-[#2563EB] border-white' : 'border-transparent text-white hover:border-white' }}">
                Profil
            </a>
            <a href="{{ url('/kontak') }}"
                class="block w-full max-w-sm text-center text-xl sm:text-2xl font-black uppercase tracking-widest transition-all px-4 sm:px-8 py-3 sm:py-4 rounded-md border-4
                    {{ request()->is('kontak') ? 'bg-white text-[#2563EB] border-white' : 'border-transparent text-white hover:border-white' }}">
                Kontak
            </a>
            <button id="mobileLoginBtn"
                class="w-full max-w-sm bg-[#F59E0B] text-[#111827] px-4 sm:px-10 py-4 sm:py-5 rounded-md font-black uppercase tracking-widest border-4 border-[#111827] hover:bg-[#111827] hover:text-[#F59E0B] transition-colors focus:outline-none text-xl sm:text-2xl mt-4">
                Log in Sistem
            </button>
        </div>
    </div>

    <!-- ====== PAGE CONTENT ====== -->
    <main class="w-full flex-grow pt-[4.5rem]">
        @yield('content')
    </main>

    <!-- ====== LOGIN MODAL ====== -->
    <div id="loginModal"
        class="fixed inset-0 z-[70] flex items-center justify-center p-4 hidden opacity-0 transition-opacity duration-200">
        <div id="loginBackdrop" class="absolute inset-0 bg-[#111827]/90 cursor-pointer"></div>

        <!-- Responsive Modal Card Flat -->
        <div id="loginFormContainer"
            class="relative z-10 w-full max-w-[95%] sm:max-w-md bg-white border-4 border-[#111827] rounded-xl p-6 sm:p-8 transform scale-95 transition-transform duration-200 overflow-y-auto max-h-[90vh]">

            <button id="closeModalBtn"
                class="absolute top-3 sm:top-4 right-3 sm:right-4 text-[#111827] hover:bg-[#F3F4F6] p-1 border-4 border-transparent hover:border-[#111827] rounded-md transition focus:outline-none">
                <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="3" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <div class="mb-6 sm:mb-8 text-center pt-2 sm:pt-4">
                <h2 class="text-3xl sm:text-4xl font-black text-[#111827] uppercase tracking-tighter mb-2">Login</h2>
                <div class="w-16 h-2 bg-[#2563EB] mx-auto mb-4"></div>
                <p class="text-[#4B5563] font-bold text-sm sm:text-base">Akses area manajerial.</p>
            </div>

            <form action="{{ url('/login') }}" method="POST" class="space-y-4 sm:space-y-6">
                @csrf
                <div>
                    <label for="username" class="block text-xs sm:text-sm font-bold text-[#111827] uppercase tracking-widest mb-1 sm:mb-2">Username</label>
                    <input type="text" name="username" id="username"
                        class="block w-full px-3 sm:px-4 py-3 sm:py-4 border-4 border-[#111827] rounded-md bg-[#F3F4F6] text-[#111827] font-bold placeholder-[#9CA3AF] focus:outline-none focus:bg-white focus:border-[#2563EB] transition-colors"
                        placeholder="USERNAME" required>
                </div>

                <div>
                    <label for="password" class="block text-xs sm:text-sm font-bold text-[#111827] uppercase tracking-widest mb-1 sm:mb-2">Password</label>
                    <input type="password" name="password" id="password"
                        class="block w-full px-3 sm:px-4 py-3 sm:py-4 border-4 border-[#111827] rounded-md bg-[#F3F4F6] text-[#111827] font-bold placeholder-[#9CA3AF] focus:outline-none focus:bg-white focus:border-[#2563EB] transition-colors"
                        placeholder="PASSWORD" required>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <input id="remember-me" name="remember-me" type="checkbox"
                            class="h-5 w-5 border-4 border-[#111827] rounded-sm bg-white cursor-pointer appearance-none checked:bg-[#2563EB]">
                        <label for="remember-me" class="block text-sm font-bold text-[#111827] cursor-pointer">
                            Ingat Saya
                        </label>
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="w-full flex justify-center py-4 px-4 rounded-md text-sm sm:text-base font-black uppercase tracking-widest text-[#111827] bg-[#F59E0B] border-4 border-[#111827] hover:bg-[#111827] hover:text-[#F59E0B] transition-colors shadow-[4px_4px_0_0_#111827] hover:shadow-none hover:translate-x-1 hover:translate-y-1">
                        MASUK SISTEM
                    </button>
                </div>
            </form>

            <div class="mt-6 sm:mt-8 text-center border-t-4 border-[#111827] pt-4 sm:pt-6">
                <button type="button" id="openRegisterFromLoginBtn" class="font-bold text-[#2563EB] hover:text-[#111827] transition-colors uppercase tracking-widest text-sm">Ganti ke Pendaftaran</button>
            </div>
        </div>
    </div>

    <!-- ====== REGISTER MODAL ====== -->
    <div id="registerModal"
        class="fixed inset-0 z-[70] flex items-center justify-center p-4 hidden opacity-0 transition-opacity duration-200">
        <div id="registerBackdrop" class="absolute inset-0 bg-[#111827]/90 cursor-pointer"></div>

        <!-- Responsive Modal Card Flat -->
        <div id="registerFormContainer"
             class="relative z-10 w-full max-w-[95%] sm:max-w-md bg-white border-4 border-[#111827] rounded-xl p-6 sm:p-8 transform scale-95 transition-transform duration-200 overflow-y-auto max-h-[90vh]">

            <button id="closeRegisterModalBtn"
                 class="absolute top-3 sm:top-4 right-3 sm:right-4 text-[#111827] hover:bg-[#F3F4F6] p-1 border-4 border-transparent hover:border-[#111827] rounded-md transition focus:outline-none">
                <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="3" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <div class="mb-6 sm:mb-8 text-center pt-2 sm:pt-4">
                <h2 class="text-3xl sm:text-4xl font-black text-[#111827] uppercase tracking-tighter mb-2">Daftar</h2>
                 <div class="w-16 h-2 bg-[#10B981] mx-auto mb-4"></div>
                <p class="text-[#4B5563] font-bold text-sm sm:text-base">Registrasi akses awal.</p>
            </div>

            <form action="{{ url('/register') }}" method="POST" class="space-y-4 sm:space-y-5">
                @csrf
                <div>
                    <label for="reg_name" class="block text-xs sm:text-sm font-bold text-[#111827] uppercase tracking-widest mb-1">Username</label>
                    <input type="text" name="name" id="reg_name"
                           class="block w-full px-3 sm:px-4 py-3 sm:py-4 border-4 border-[#111827] rounded-md bg-[#F3F4F6] text-[#111827] font-bold placeholder-[#9CA3AF] focus:outline-none focus:bg-white focus:border-[#10B981] transition-colors"
                        placeholder="USERNAME BARU" required>
                </div>

                <div>
                    <label for="reg_email" class="block text-xs sm:text-sm font-bold text-[#111827] uppercase tracking-widest mb-1">Email</label>
                    <input type="email" name="email" id="reg_email"
                           class="block w-full px-3 sm:px-4 py-3 sm:py-4 border-4 border-[#111827] rounded-md bg-[#F3F4F6] text-[#111827] font-bold placeholder-[#9CA3AF] focus:outline-none focus:bg-white focus:border-[#10B981] transition-colors"
                        placeholder="ALAMAT EMAIL" required>
                </div>

                <div>
                    <label for="reg_password" class="block text-xs sm:text-sm font-bold text-[#111827] uppercase tracking-widest mb-1">Password</label>
                     <input type="password" name="password" id="reg_password"
                            class="block w-full px-3 sm:px-4 py-3 sm:py-4 border-4 border-[#111827] rounded-md bg-[#F3F4F6] text-[#111827] font-bold placeholder-[#9CA3AF] focus:outline-none focus:bg-white focus:border-[#10B981] transition-colors"
                        placeholder="PASSWORD BARU" required>
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="w-full flex justify-center py-4 px-4 rounded-md text-sm sm:text-base font-black uppercase tracking-widest text-[#111827] bg-[#10B981] border-4 border-[#111827] hover:bg-[#111827] hover:text-[#10B981] transition-colors shadow-[4px_4px_0_0_#111827] hover:shadow-none hover:translate-x-1 hover:translate-y-1">
                        BUAT AKUN
                    </button>
                </div>
            </form>

            <div class="mt-6 sm:mt-8 text-center border-t-4 border-[#111827] pt-4 sm:pt-6">
                 <button type="button" id="openLoginFromRegisterBtn" class="font-bold text-[#10B981] hover:text-[#111827] transition-colors uppercase tracking-widest text-sm">Kembali ke Login</button>
            </div>
        </div>
    </div>

    <!-- ====== FOOTER ====== -->
    <footer class="bg-[#111827] text-white pt-20 sm:pt-24 pb-8 sm:pb-12 border-t-8 border-[#F59E0B] relative z-20 overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 sm:w-96 sm:h-96 border-8 border-white/10 rounded-full translate-x-1/3 -translate-y-1/3 pointer-events-none"></div>

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-12 relative z-10">
            <div class="grid grid-cols-1 gap-12 sm:grid-cols-2 lg:grid-cols-4 sm:gap-10 lg:gap-12 mb-12 sm:mb-16">

                <!-- Tentang BUMDes -->
                <div class="col-span-1 sm:col-span-2 lg:col-span-1">
                    <div class="flex items-center gap-3 mb-6">
                         <div class="bg-white text-[#111827] px-2 py-1 rounded-md font-black tracking-tighter text-lg border-2 border-white">
                            B<span class="text-[#F59E0B]">.</span>GO
                        </div>
                        <h2 class="text-xl sm:text-2xl font-black tracking-tighter uppercase">BUMDes <span class="text-[#2563EB]">GO</span></h2>
                    </div>
                    <p class="text-gray-300 font-bold leading-relaxed mb-6 text-sm sm:text-base">
                        Sinar Jaya Digital Solusi. Pemanfaatan teknologi bergaris keras untuk menopang mesin ekonomi struktural independen desa.
                    </p>
                </div>

                <!-- Tautan Cepat -->
                <div>
                    <h3 class="bg-white text-[#111827] font-black mb-6 uppercase tracking-widest text-sm inline-block px-3 py-1.5 rounded border-2 border-white">Tautan Pusat</h3>
                    <ul class="space-y-3 sm:space-y-4">
                        <li><a href="{{ url('/') }}" class="text-gray-300 font-bold hover:text-white hover:bg-[#2563EB] inline-block px-2 py-1 -ml-2 transition-colors rounded">Beranda</a></li>
                        <li><a href="{{ url('/berita') }}" class="text-gray-300 font-bold hover:text-white hover:bg-[#2563EB] inline-block px-2 py-1 -ml-2 transition-colors rounded">Berita Daerah</a></li>
                        <li><a href="{{ url('/katalog') }}" class="text-gray-300 font-bold hover:text-white hover:bg-[#2563EB] inline-block px-2 py-1 -ml-2 transition-colors rounded">Inventaris Katalog</a></li>
                        <li><a href="{{ url('/profil') }}" class="text-gray-300 font-bold hover:text-white hover:bg-[#2563EB] inline-block px-2 py-1 -ml-2 transition-colors rounded">Profil Entitas</a></li>
                    </ul>
                </div>

                <!-- Layanan -->
                <div>
                    <h3 class="bg-white text-[#111827] font-black mb-6 uppercase tracking-widest text-sm inline-block px-3 py-1.5 rounded border-2 border-white">Sektor Usaha</h3>
                    <ul class="space-y-3 sm:space-y-4">
                        <li><a href="#" class="text-gray-300 font-bold hover:text-[#111827] hover:bg-[#10B981] inline-block px-2 py-1 -ml-2 transition-colors rounded">Manufaktur Mitra</a></li>
                        <li><a href="#" class="text-gray-300 font-bold hover:text-[#111827] hover:bg-[#10B981] inline-block px-2 py-1 -ml-2 transition-colors rounded">Akomodasi UMKM</a></li>
                        <li><a href="#" class="text-gray-300 font-bold hover:text-[#111827] hover:bg-[#10B981] inline-block px-2 py-1 -ml-2 transition-colors rounded">Pengadaan Alat</a></li>
                        <li><a href="#" class="text-gray-300 font-bold hover:text-[#111827] hover:bg-[#10B981] inline-block px-2 py-1 -ml-2 transition-colors rounded">Sirkuit Modal</a></li>
                    </ul>
                </div>

                <!-- Kontak -->
                <div>
                    <h3 class="bg-white text-[#111827] font-black mb-6 uppercase tracking-widest text-sm inline-block px-3 py-1.5 rounded border-2 border-white">Pangkalan</h3>
                    <ul class="space-y-4 text-gray-300 font-bold text-sm sm:text-base">
                        <li class="flex items-start gap-4">
                            <div class="bg-[#F59E0B] w-3 h-3 border border-[#F59E0B] mt-1.5 flex-shrink-0"></div>
                            <span>Pusat Tata Kelola. Gedung A1 Sinar Jaya.</span>
                        </li>
                        <li class="flex items-start gap-4">
                            <div class="bg-[#10B981] w-3 h-3 border border-[#10B981] mt-1.5 flex-shrink-0"></div>
                            <span>(021) 1234-5678</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Footer Bottom Bar -->
            <div class="border-t-4 border-gray-700 pt-6 sm:pt-8 flex flex-col md:flex-row justify-between items-center text-xs sm:text-sm font-black text-gray-400 gap-4">
                <p class="text-center md:text-left">&copy; 2026 BUMDES GO. SISTEM DILINDUNGI TATA KELOLA.</p>
                <div class="flex space-x-6">
                    <a href="#" class="hover:text-white transition-colors uppercase tracking-widest">Syarat</a>
                    <a href="#" class="hover:text-white transition-colors uppercase tracking-widest">Privasi</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- ====== SCRIPTS ====== -->
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        // ----- Login & Register Modals -----
        const loginBtn = document.getElementById('loginBtn');
        const mobileLoginBtn = document.getElementById('mobileLoginBtn');
        const loginModal = document.getElementById('loginModal');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const loginBackdrop = document.getElementById('loginBackdrop');
        const loginFormContainer = document.getElementById('loginFormContainer');

        const registerModal = document.getElementById('registerModal');
        const closeRegisterModalBtn = document.getElementById('closeRegisterModalBtn');
        const registerBackdrop = document.getElementById('registerBackdrop');
        const registerFormContainer = document.getElementById('registerFormContainer');
        
        const openRegisterFromLoginBtn = document.getElementById('openRegisterFromLoginBtn');
        const openLoginFromRegisterBtn = document.getElementById('openLoginFromRegisterBtn');

        const openLoginModal = (e) => {
            if (e) e.preventDefault();
            closeRegisterModal();
            loginModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden'; 
            setTimeout(() => {
                loginModal.classList.remove('opacity-0');
                loginFormContainer.classList.remove('scale-95');
                loginFormContainer.classList.add('scale-100');
            }, 10);
        };

        const closeLoginModal = () => {
            loginModal.classList.add('opacity-0');
            loginFormContainer.classList.remove('scale-100');
            loginFormContainer.classList.add('scale-95');
            document.body.style.overflow = '';
            setTimeout(() => loginModal.classList.add('hidden'), 200);
        };

        const openRegisterModal = (e) => {
            if (e) e.preventDefault();
            closeLoginModal();
            registerModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            setTimeout(() => {
                registerModal.classList.remove('opacity-0');
                registerFormContainer.classList.remove('scale-95');
                registerFormContainer.classList.add('scale-100');
            }, 10);
        };

        const closeRegisterModal = () => {
            registerModal.classList.add('opacity-0');
            registerFormContainer.classList.remove('scale-100');
            registerFormContainer.classList.add('scale-95');
            document.body.style.overflow = '';
            setTimeout(() => registerModal.classList.add('hidden'), 200);
        };

        if (loginBtn) loginBtn.addEventListener('click', openLoginModal);
        if (mobileLoginBtn) mobileLoginBtn.addEventListener('click', openLoginModal);
        
        [closeModalBtn, loginBackdrop].forEach(el => el && el.addEventListener('click', closeLoginModal));
        [closeRegisterModalBtn, registerBackdrop].forEach(el => el && el.addEventListener('click', closeRegisterModal));

        if (openRegisterFromLoginBtn) openRegisterFromLoginBtn.addEventListener('click', openRegisterModal);
        if (openLoginFromRegisterBtn) openLoginFromRegisterBtn.addEventListener('click', openLoginModal);

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                if (!loginModal.classList.contains('hidden')) closeLoginModal();
                if (!registerModal.classList.contains('hidden')) closeRegisterModal();
            }
        });

        // ----- Mobile Menu Management -----
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const closeMobileMenu = document.getElementById('closeMobileMenu');
        const mobileMenu = document.getElementById('mobileMenu');

        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            });
        }
        if (closeMobileMenu) {
            closeMobileMenu.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
                document.body.style.overflow = '';
            });
        }

        mobileMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
                document.body.style.overflow = '';
            });
        });

        // ----- Flat Navbar Scroll Behavior -----
        const mainNav = document.getElementById('mainNav');
        let lastScrollY = window.scrollY;

        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                // When scrolled down, minimize padding slightly to save screen estate
                mainNav.classList.remove('py-3', 'sm:py-5');
                mainNav.classList.add('py-2', 'sm:py-3');
            } else {
                mainNav.classList.add('py-3', 'sm:py-5');
                mainNav.classList.remove('py-2', 'sm:py-3');
            }
            lastScrollY = window.scrollY;
        });
    });
    </script>
</body>
</html>