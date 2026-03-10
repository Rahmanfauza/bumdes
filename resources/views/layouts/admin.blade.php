<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - BUMDesGO</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased font-sans bg-gray-100 text-gray-900 overflow-hidden" x-data="{ sidebarOpen: true }">
    <!-- Load Alpine.js for simple state management -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <div class="flex h-screen w-full">
        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'w-64' : 'w-20'" class="bg-blue-900 text-white flex flex-col transition-all duration-300 z-20 shadow-xl overflow-hidden relative">
            <!-- Logo Sidebar -->
            <div class="h-16 flex items-center justify-center border-b border-blue-800 shrink-0 px-4">
                <div class="flex items-center gap-2 whitespace-nowrap">
                    <!-- Ikon/Logo singkatan (selalu tampil) -->
                    <div class="w-8 h-8 bg-white text-blue-900 rounded-lg flex items-center justify-center font-bold text-lg shrink-0 shadow-sm">
                        B
                    </div>
                    <!-- Teks Logo (Tampil jika sidebar buka) -->
                    <span x-show="sidebarOpen" x-transition.opacity class="text-xl font-bold tracking-wide">
                        BUMDes <span class="text-blue-400">GO</span>
                    </span>
                </div>
            </div>

            <!-- Navigation Links -->
            <div class="flex-1 overflow-y-auto py-6 px-3 space-y-2">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl {{ request()->routeIs('dashboard') ? 'bg-blue-800 text-white shadow-sm' : 'text-blue-100 hover:bg-blue-800/50 hover:text-white group' }} font-medium transition" title="Dashboard">
                    <svg class="w-6 h-6 shrink-0 {{ request()->routeIs('dashboard') ? 'text-blue-300' : 'group-hover:text-blue-200' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    <span x-show="sidebarOpen" x-transition.opacity class="whitespace-nowrap">Dashboard</span>
                </a>

                <a href="{{ route('admin.anggota') }}" class="flex items-center gap-3 px-3 py-3 rounded-xl {{ request()->routeIs('admin.anggota') ? 'bg-blue-800 text-white shadow-sm' : 'text-blue-100 hover:bg-blue-800/50 hover:text-white group' }} font-medium transition" title="Data Anggota">
                    <svg class="w-6 h-6 shrink-0 {{ request()->routeIs('admin.anggota') ? 'text-blue-300' : 'group-hover:text-blue-200' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <span x-show="sidebarOpen" x-transition.opacity class="whitespace-nowrap">Data Anggota</span>
                </a>
                
                <!-- Dropdown Kelola Konten -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="if(sidebarOpen) open = !open" :class="open && sidebarOpen ? 'bg-blue-800/80 text-white' : 'text-blue-100 hover:bg-blue-800/50 hover:text-white'" class="w-full flex items-center justify-between px-3 py-3 rounded-xl font-medium transition group" title="Kelola Konten">
                        <div class="flex items-center gap-3">
                            <svg class="w-6 h-6 shrink-0 group-hover:text-blue-200" :class="open && sidebarOpen ? 'text-blue-300' : 'text-blue-300'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            <span x-show="sidebarOpen" x-transition.opacity class="whitespace-nowrap">Kelola Konten</span>
                        </div>
                        <svg x-show="sidebarOpen" :class="open ? 'rotate-180' : ''" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    
                    <!-- Submenu -->
                    <div x-show="open && sidebarOpen" x-transition x-collapse class="pl-11 pr-3 pt-1 pb-2 space-y-1">
                        <a href="#" class="block py-2 text-sm text-blue-200 hover:text-white hover:translate-x-1 transition-transform" title="Berita">Berita</a>
                        <a href="#" class="block py-2 text-sm text-blue-200 hover:text-white hover:translate-x-1 transition-transform" title="Produk">Produk</a>
                    </div>
                </div>

                <a href="#" class="flex items-center gap-3 px-3 py-3 rounded-xl text-blue-100 hover:bg-blue-800/50 hover:text-white transition-colors group" title="Unit Usaha">
                    <svg class="w-6 h-6 shrink-0 text-blue-300 group-hover:text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    <span x-show="sidebarOpen" x-transition.opacity class="whitespace-nowrap">Unit Usaha</span>
                </a>

                <a href="#" class="flex items-center gap-3 px-3 py-3 rounded-xl text-blue-100 hover:bg-blue-800/50 hover:text-white transition-colors group" title="Transaksi">
                    <svg class="w-6 h-6 shrink-0 text-blue-300 group-hover:text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    <span x-show="sidebarOpen" x-transition.opacity class="whitespace-nowrap">Transaksi</span>
                </a>

                <a href="#" class="flex items-center gap-3 px-3 py-3 rounded-xl text-blue-100 hover:bg-blue-800/50 hover:text-white transition-colors group" title="Laporan">
                    <svg class="w-6 h-6 shrink-0 text-blue-300 group-hover:text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    <span x-show="sidebarOpen" x-transition.opacity class="whitespace-nowrap">Laporan</span>
                </a>
            </div>

            <!-- Profile / Logout Area Sidebar (Bottom) -->
            <div class="p-3 border-t border-blue-800 shrink-0">
                <form action="{{ url('/logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center justify-center gap-3 w-full py-3 rounded-xl text-red-100 bg-red-600/20 hover:bg-red-600 hover:text-white transition-colors shadow-sm border border-red-500/30 overflow-hidden" title="Logout">
                        <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        <span x-show="sidebarOpen" x-transition.opacity class="font-bold whitespace-nowrap pr-2">Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col h-full overflow-hidden relative bg-gray-50">
            <!-- Top Header -->
            <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-6 shrink-0 relative z-10 shadow-[0_4px_20px_-15px_rgba(0,0,0,0.1)] transition-all">
                <!-- Left Title & Toggle -->
                <div class="flex items-center gap-4">
                    <!-- Toggle Sidebar Button -->
                    <button @click="sidebarOpen = !sidebarOpen" class="p-2 rounded-lg text-gray-500 hover:bg-gray-100 hover:text-blue-600 transition focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <!-- Menu Icon (Hamburger) -->
                            <path x-show="!sidebarOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            <!-- Arrow Left Icon (Tutup) -->
                            <path x-show="sidebarOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    <!-- Title -->
                    <h1 class="text-xl font-bold text-gray-800 hidden sm:block">@yield('header_title', 'Dashboard')</h1>
                </div>

                <!-- Right Header Tools -->
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-3 bg-gray-50 py-1.5 px-3 rounded-full border border-gray-100 shadow-sm cursor-pointer hover:bg-gray-100 transition">
                        <span class="text-sm font-semibold text-gray-700 hidden sm:block">Halo, {{ Session::get('username') }}</span>
                        <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold uppercase text-sm shadow-inner overflow-hidden shrink-0">
                            {{ substr(Session::get('username', 'A'), 0, 1) }}
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-6 md:p-8 relative">
                <!-- Background Decoration -->
                <div class="absolute inset-0 z-0 pointer-events-none overflow-hidden">
                    <div class="absolute -top-40 -right-40 w-96 h-96 bg-blue-100 rounded-full opacity-50 blur-3xl"></div>
                    <div class="absolute top-40 -left-20 w-72 h-72 bg-indigo-100 rounded-full opacity-40 blur-3xl"></div>
                </div>
                
                <div class="relative z-10 w-full max-w-7xl mx-auto">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
</body>
</html>
