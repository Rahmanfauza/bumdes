<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - BUMDesGO</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Source+Sans+3:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Source Sans 3', sans-serif !important; }
        .font-display { font-family: 'Playfair Display', serif !important; letter-spacing: -0.02em; }
        .font-code { font-family: 'Fira Code', monospace !important; }
        /* Scrollbar adjustment */
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #FAFAF9; }
        ::-webkit-scrollbar-thumb { background: #D6D3D1; border-radius: 9999px; }
        ::-webkit-scrollbar-thumb:hover { background: #78716C; }
    </style>
</head>

<body class="antialiased bg-[#FAFAF9] text-[#1C1917] overflow-hidden" x-data="{ sidebarOpen: true }">
    <!-- Load Alpine.js for simple state management -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <div class="flex h-screen w-full">
        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'w-64' : 'w-20'"
            class="bg-[#FAFAF9] text-[#1C1917] flex flex-col transition-all duration-300 z-20 overflow-hidden relative border-r border-[#D6D3D1]">
            
            <!-- Logo Sidebar -->
            <div class="h-[4.5rem] flex items-center justify-center border-b border-[#D6D3D1] shrink-0 px-4 group bg-[#FAFAF9]">
                <div class="flex items-center gap-3 whitespace-nowrap overflow-hidden">
                    <!-- Ikon/Logo singkatan -->
                    <div
                        class="w-8 h-8 bg-[#C2410C] text-white rounded-[8px] flex items-center justify-center font-display text-xl shrink-0 transition-colors">
                        B
                    </div>
                    <!-- Teks Logo -->
                    <span x-show="sidebarOpen" x-transition.opacity class="text-2xl font-display font-bold text-[#1C1917]">
                        BUMDes<span class="text-[#C2410C]">GO</span>
                    </span>
                </div>
            </div>

            <!-- Navigation Links -->
            <div class="flex-1 overflow-y-auto py-6 space-y-1">

                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-3 px-4 py-2.5 {{ request()->routeIs('dashboard') ? 'bg-[#F5F5F4] text-[#C2410C] border-l-[3px] border-[#C2410C]' : 'border-l-[3px] border-transparent text-[#57534E] hover:bg-[#F5F5F4] hover:text-[#1C1917]' }} font-semibold transition-colors group"
                    title="Dashboard">
                    <svg class="w-5 h-5 shrink-0 {{ request()->routeIs('dashboard') ? 'text-[#C2410C]' : 'text-[#78716C] group-hover:text-[#1C1917]' }}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                        </path>
                    </svg>
                    <span x-show="sidebarOpen" x-transition.opacity class="whitespace-nowrap text-[15px]">Dashboard</span>
                </a>

                <a href="{{ route('input-data.anggota') }}"
                    class="flex items-center gap-3 px-4 py-2.5 {{ request()->is('admin/input-data*') ? 'bg-[#F5F5F4] text-[#C2410C] border-l-[3px] border-[#C2410C]' : 'border-l-[3px] border-transparent text-[#57534E] hover:bg-[#F5F5F4] hover:text-[#1C1917]' }} font-semibold transition-colors group"
                    title="Input Data">
                    <svg class="w-5 h-5 shrink-0 {{ request()->is('admin/input-data*') ? 'text-[#C2410C]' : 'text-[#78716C] group-hover:text-[#1C1917]' }}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                        </path>
                    </svg>
                    <span x-show="sidebarOpen" x-transition.opacity class="whitespace-nowrap text-[15px]">Input Data</span>
                </a>

                <a href="{{ route('unit-usaha') }}"
                    class="flex items-center gap-3 px-4 py-2.5 {{ request()->routeIs('unit-usaha*') ? 'bg-[#F5F5F4] text-[#C2410C] border-l-[3px] border-[#C2410C]' : 'border-l-[3px] border-transparent text-[#57534E] hover:bg-[#F5F5F4] hover:text-[#1C1917]' }} font-semibold transition-colors group"
                    title="Unit Usaha">
                    <svg class="w-5 h-5 shrink-0 {{ request()->routeIs('unit-usaha*') ? 'text-[#C2410C]' : 'text-[#78716C] group-hover:text-[#1C1917]' }}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                        </path>
                    </svg>
                    <span x-show="sidebarOpen" x-transition.opacity class="whitespace-nowrap text-[15px]">Unit Usaha</span>
                </a>

                <a href="{{ route('transaksi.index') }}"
                    class="flex items-center gap-3 px-4 py-2.5 {{ request()->routeIs('transaksi.*') ? 'bg-[#F5F5F4] text-[#C2410C] border-l-[3px] border-[#C2410C]' : 'border-l-[3px] border-transparent text-[#57534E] hover:bg-[#F5F5F4] hover:text-[#1C1917]' }} font-semibold transition-colors group"
                    title="Transaksi">
                    <svg class="w-5 h-5 shrink-0 {{ request()->routeIs('transaksi.*') ? 'text-[#C2410C]' : 'text-[#78716C] group-hover:text-[#1C1917]' }}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                        </path>
                    </svg>
                    <span x-show="sidebarOpen" x-transition.opacity class="whitespace-nowrap text-[15px]">Transaksi</span>
                </a>

                <a href="{{ route('laporan.index') }}"
                    class="flex items-center gap-3 px-4 py-2.5 {{ request()->routeIs('laporan.*') ? 'bg-[#F5F5F4] text-[#C2410C] border-l-[3px] border-[#C2410C]' : 'border-l-[3px] border-transparent text-[#57534E] hover:bg-[#F5F5F4] hover:text-[#1C1917]' }} font-semibold transition-colors group"
                    title="Laporan">
                    <svg class="w-5 h-5 shrink-0 {{ request()->routeIs('laporan.*') ? 'text-[#C2410C]' : 'text-[#78716C] group-hover:text-[#1C1917]' }}"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                        </path>
                    </svg>
                    <span x-show="sidebarOpen" x-transition.opacity class="whitespace-nowrap text-[15px]">Laporan</span>
                </a>
                
                <!-- Dropdown Kelola Konten -->
                <div x-data="{ open: {{ request()->routeIs('admin.anggota') ? 'true' : 'false' }} }" class="relative">
                    <button @click="if(sidebarOpen) open = !open"
                        :class="open && sidebarOpen ? 'bg-[#F5F5F4] text-[#1C1917]' : 'text-[#57534E] hover:bg-[#F5F5F4] hover:text-[#1C1917]'"
                        class="w-full flex items-center justify-between px-4 py-2.5 border-l-[3px] border-transparent font-semibold transition-colors group"
                        title="Kelola Konten">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 shrink-0"
                                :class="open && sidebarOpen ? 'text-[#1C1917]' : 'text-[#78716C] group-hover:text-[#1C1917]'" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                </path>
                            </svg>
                            <span x-show="sidebarOpen" x-transition.opacity class="whitespace-nowrap text-[15px]">Kelola Konten</span>
                        </div>
                        <svg x-show="sidebarOpen" :class="open ? 'rotate-180' : ''"
                            class="w-4 h-4 text-[#78716C] transition-transform duration-200" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>

                    <!-- Submenu -->
                    <div x-show="open && sidebarOpen" x-transition x-collapse class="pl-12 pr-4 pt-1 pb-2 space-y-1 bg-[#FAFAF9]">
                        <a href="{{ route('admin.anggota') }}"
                            class="block py-2 text-[14px] px-3 rounded-[8px] transition-colors {{ request()->routeIs('admin.anggota') ? 'bg-[#F5F5F4] text-[#C2410C] font-semibold' : 'text-[#57534E] hover:bg-[#F5F5F4] hover:text-[#1C1917] font-semibold' }}"
                            title="Pengurus">Pengurus</a>
                        <a href="#"
                            class="block py-2 text-[14px] px-3 rounded-[8px] text-[#57534E] hover:bg-[#F5F5F4] hover:text-[#1C1917] font-semibold transition-colors"
                            title="Berita">Berita</a>
                        <a href="#"
                           class="block py-2 text-[14px] px-3 rounded-[8px] text-[#57534E] hover:bg-[#F5F5F4] hover:text-[#1C1917] font-semibold transition-colors"
                            title="Produk">Produk</a>
                    </div>
                </div>
            </div>

            <!-- Profile / Logout Area Sidebar (Bottom) -->
            <div class="p-4 border-t border-[#D6D3D1] shrink-0">
                <form action="{{ url('/logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="flex items-center justify-center gap-2 w-full py-2.5 rounded-[8px] font-semibold text-white bg-[#DC2626] hover:bg-[#B91C1C] transition-all"
                        title="Logout">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                        <span x-show="sidebarOpen" x-transition.opacity
                            class="whitespace-nowrap pr-2">Keluar</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col h-full overflow-hidden relative bg-[#FAFAF9]">
            <!-- Top Header -->
            <header
                class="h-[4.5rem] bg-[#FAFAF9]/90 backdrop-blur-sm border-b border-[#D6D3D1] flex items-center justify-between px-6 shrink-0 relative z-10 transition-all">
                <!-- Left Title & Toggle -->
                <div class="flex items-center gap-6">
                    <!-- Toggle Sidebar Button -->
                    <button @click="sidebarOpen = !sidebarOpen"
                        class="p-2 border border-transparent hover:border-[#D6D3D1] rounded-[8px] text-[#57534E] hover:text-[#1C1917] hover:bg-[#F5F5F4] transition-colors focus:outline-none">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <!-- Menu Icon (Hamburger) -->
                            <path x-show="!sidebarOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                            <!-- Arrow Left Icon (Tutup) -->
                            <path x-show="sidebarOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    <!-- Title -->
                    <h1 class="text-3xl font-display font-bold text-[#1C1917] hidden sm:block tracking-tight">@yield('header_title', 'Dashboard')</h1>
                </div>

                <!-- Right Header Tools -->
                <div class="flex items-center gap-4">
                    <div
                        class="flex items-center gap-3 bg-[#F5F5F4] py-1.5 px-3 rounded-[8px] border border-[#D6D3D1] cursor-pointer hover:border-[#C2410C] transition-colors">
                        <span class="text-[14px] font-semibold hidden sm:block text-[#1C1917]">
                            {{ Session::get('username', 'ADMIN') }}
                        </span>
                        <div
                            class="w-8 h-8 rounded-[9999px] bg-white border border-[#D6D3D1] flex items-center justify-center text-[#1C1917] font-semibold uppercase text-sm shrink-0">
                            {{ substr(Session::get('username', 'A'), 0, 1) }}
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-6 md:p-8 relative">
                <div class="relative z-10 w-full max-w-[1200px] mx-auto">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- Script Auto Format Rupiah Global -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function formatNumber(numStr) {
                if (!numStr) return '';
                let cleanStr = numStr.toString().replace(/[^0-9]/g, '');
                if (!cleanStr) return '';
                return parseInt(cleanStr, 10).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            document.body.addEventListener('input', function(e) {
                if (e.target && e.target.classList.contains('format-rupiah')) {
                    let cursorPosition = e.target.selectionStart;
                    let originalLength = e.target.value.length;
                    
                    let formatted = formatNumber(e.target.value);
                    e.target.value = formatted;
                    
                    let newLength = e.target.value.length;
                    cursorPosition = cursorPosition + (newLength - originalLength);
                    
                    try {
                        e.target.setSelectionRange(cursorPosition, cursorPosition);
                    } catch (err) {}
                }
            });

            document.body.addEventListener('submit', function(e) {
                if (e.target && e.target.tagName === 'FORM') {
                    let inputs = e.target.querySelectorAll('.format-rupiah');
                    inputs.forEach(input => {
                        input.value = input.value.replace(/\./g, '');
                    });
                }
            });
        });
    </script>
</body>

</html>