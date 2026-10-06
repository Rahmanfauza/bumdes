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

                @php $role = Session::get('admin_role', 0); @endphp

                <!-- MENU UNTUK ADMIN (Role 1) -->
                @if($role == 1)
                    <!-- Dropdown Kelola Produk & Jasa -->
                    <div x-data="{ open: {{ request()->is('admin/produk*') ? 'true' : 'false' }} }" class="relative">
                        <button @click="if(sidebarOpen) open = !open"
                            :class="open && sidebarOpen ? 'bg-[#F5F5F4] text-[#1C1917]' : 'text-[#57534E] hover:bg-[#F5F5F4] hover:text-[#1C1917]'"
                            class="w-full flex items-center justify-between px-4 py-2.5 border-l-[3px] border-transparent font-semibold transition-colors group"
                            title="Produk & Jasa">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 shrink-0" :class="open && sidebarOpen ? 'text-[#1C1917]' : 'text-[#78716C] group-hover:text-[#1C1917]'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                <span x-show="sidebarOpen" x-transition.opacity class="whitespace-nowrap text-[15px]">Produk & Jasa</span>
                            </div>
                            <svg x-show="sidebarOpen" :class="open ? 'rotate-180' : ''" class="w-4 h-4 text-[#78716C] transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open && sidebarOpen" x-transition x-collapse class="pl-12 pr-4 pt-1 pb-2 space-y-1 bg-[#FAFAF9]">
                            <a href="{{ route('admin.produk.index') }}" class="block py-2 text-[14px] px-3 rounded-[8px] {{ request()->routeIs('admin.produk.*') ? 'bg-[#F5F5F4] text-[#C2410C]' : 'text-[#57534E] hover:bg-[#F5F5F4] hover:text-[#1C1917]' }} font-semibold transition-colors" title="Daftar Produk">Daftar Produk</a>
                            <a href="{{ route('admin.kategori.index') }}" class="block py-2 text-[14px] px-3 rounded-[8px] {{ request()->routeIs('admin.kategori.*') ? 'bg-[#F5F5F4] text-[#C2410C]' : 'text-[#57534E] hover:bg-[#F5F5F4] hover:text-[#1C1917]' }} font-semibold transition-colors" title="Kategori Produk">Kategori Produk</a>
                        </div>
                    </div>

                    <!-- Pencatatan Transaksi Penjualan -->
                    <a href="{{ route('admin.transaksi.index') }}"
                        class="flex items-center gap-3 px-4 py-2.5 {{ request()->routeIs('admin.transaksi.*') ? 'bg-[#F5F5F4] text-[#C2410C] border-l-[3px] border-[#C2410C]' : 'border-l-[3px] border-transparent text-[#57534E] hover:bg-[#F5F5F4] hover:text-[#1C1917]' }} font-semibold transition-colors group"
                        title="Transaksi Penjualan">
                        <svg class="w-5 h-5 shrink-0 {{ request()->routeIs('admin.transaksi.*') ? 'text-[#C2410C]' : 'text-[#78716C] group-hover:text-[#1C1917]' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span x-show="sidebarOpen" x-transition.opacity class="whitespace-nowrap text-[15px]">Transaksi Penjualan</span>
                    </a>
                @endif

                <!-- MENU UNTUK SEKRETARIS (Role 2) -->
                @if($role == 2)
                    <!-- Persuratan -->
                    <a href="{{ route('admin.surat.index') }}"
                        class="flex items-center gap-3 px-4 py-2.5 {{ request()->routeIs('admin.surat.*') ? 'bg-[#F5F5F4] text-[#C2410C] border-l-[3px] border-[#C2410C]' : 'border-l-[3px] border-transparent text-[#57534E] hover:bg-[#F5F5F4] hover:text-[#1C1917]' }} font-semibold transition-colors group"
                        title="Administrasi Persuratan">
                        <svg class="w-5 h-5 shrink-0 {{ request()->routeIs('admin.surat.*') ? 'text-[#C2410C]' : 'text-[#78716C] group-hover:text-[#1C1917]' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <span x-show="sidebarOpen" x-transition.opacity class="whitespace-nowrap text-[15px]">Persuratan</span>
                    </a>

                    <!-- Arsip Digital -->
                    <a href="{{ route('admin.arsip.index') }}"
                        class="flex items-center gap-3 px-4 py-2.5 {{ request()->routeIs('admin.arsip.*') ? 'bg-[#F5F5F4] text-[#C2410C] border-l-[3px] border-[#C2410C]' : 'border-l-[3px] border-transparent text-[#57534E] hover:bg-[#F5F5F4] hover:text-[#1C1917]' }} font-semibold transition-colors group"
                        title="Arsip Digital">
                        <svg class="w-5 h-5 shrink-0 {{ request()->routeIs('admin.arsip.*') ? 'text-[#C2410C]' : 'text-[#78716C] group-hover:text-[#1C1917]' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                        </svg>
                        <span x-show="sidebarOpen" x-transition.opacity class="whitespace-nowrap text-[15px]">Arsip Digital</span>
                    </a>
                @endif

                <!-- MENU UNTUK BENDAHARA (Role 3) -->
                @if($role == 3)
                    <!-- Buku Kas (Pemasukan & Pengeluaran) -->
                    <a href="{{ route('admin.kas.index') }}"
                        class="flex items-center gap-3 px-4 py-2.5 {{ request()->routeIs('admin.kas.*') ? 'bg-[#F5F5F4] text-[#C2410C] border-l-[3px] border-[#C2410C]' : 'border-l-[3px] border-transparent text-[#57534E] hover:bg-[#F5F5F4] hover:text-[#1C1917]' }} font-semibold transition-colors group"
                        title="Buku Kas BUMDes">
                        <svg class="w-5 h-5 shrink-0 {{ request()->routeIs('admin.kas.*') ? 'text-[#C2410C]' : 'text-[#78716C] group-hover:text-[#1C1917]' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span x-show="sidebarOpen" x-transition.opacity class="whitespace-nowrap text-[15px]">Buku Kas</span>
                    </a>

                    <!-- Laporan Keuangan -->
                    <a href="{{ route('admin.laporan.index') }}"
                        class="flex items-center gap-3 px-4 py-2.5 {{ request()->routeIs('admin.laporan.*') ? 'bg-[#F5F5F4] text-[#C2410C] border-l-[3px] border-[#C2410C]' : 'border-l-[3px] border-transparent text-[#57534E] hover:bg-[#F5F5F4] hover:text-[#1C1917]' }} font-semibold transition-colors group"
                        title="Laporan Keuangan">
                        <svg class="w-5 h-5 shrink-0 {{ request()->routeIs('admin.laporan.*') ? 'text-[#C2410C]' : 'text-[#78716C] group-hover:text-[#1C1917]' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span x-show="sidebarOpen" x-transition.opacity class="whitespace-nowrap text-[15px]">Laporan Keuangan</span>
                    </a>
                @endif

                <!-- MENU UNTUK DIREKTUR (Role 4) -->
                @if($role == 4)
                    <!-- Approval Dokumen -->
                    <a href="{{ route('admin.approval.index') }}"
                        class="flex items-center gap-3 px-4 py-2.5 {{ request()->routeIs('admin.approval.*') ? 'bg-[#F5F5F4] text-[#C2410C] border-l-[3px] border-[#C2410C]' : 'border-l-[3px] border-transparent text-[#57534E] hover:bg-[#F5F5F4] hover:text-[#1C1917]' }} font-semibold transition-colors group"
                        title="Approval Dokumen & Laporan">
                        <svg class="w-5 h-5 shrink-0 {{ request()->routeIs('admin.approval.*') ? 'text-[#C2410C]' : 'text-[#78716C] group-hover:text-[#1C1917]' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span x-show="sidebarOpen" x-transition.opacity class="whitespace-nowrap text-[15px]">Approval Dokumen</span>
                    </a>

                    <!-- Manajemen Akun -->
                    <a href="{{ route('admin.akun.index') }}"
                        class="flex items-center gap-3 px-4 py-2.5 {{ request()->routeIs('admin.akun.*') ? 'bg-[#F5F5F4] text-[#C2410C] border-l-[3px] border-[#C2410C]' : 'border-l-[3px] border-transparent text-[#57534E] hover:bg-[#F5F5F4] hover:text-[#1C1917]' }} font-semibold transition-colors group"
                        title="Manajemen Akun Pengurus">
                        <svg class="w-5 h-5 shrink-0 {{ request()->routeIs('admin.akun.*') ? 'text-[#C2410C]' : 'text-[#78716C] group-hover:text-[#1C1917]' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <span x-show="sidebarOpen" x-transition.opacity class="whitespace-nowrap text-[15px]">Manajemen Akun</span>
                    </a>
                @endif
            </div>

            <!-- Profile / Logout Area Sidebar (Bottom) -->
            <div class="p-4 border-t border-[#D6D3D1] shrink-0">
                <form action="{{ route('admin.logout') }}" method="POST">
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
                            {{ Session::get('admin_username', 'ADMIN') }}
                        </span>
                        <div
                            class="w-8 h-8 rounded-[9999px] bg-white border border-[#D6D3D1] flex items-center justify-center text-[#1C1917] font-semibold uppercase text-sm shrink-0">
                            {{ substr(Session::get('admin_username', 'A'), 0, 1) }}
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-6 md:p-8 relative">
                <div class="relative z-10 w-full max-w-[1200px] mx-auto">
                    @if(session('error') || $errors->has('error'))
                        <div class="mb-5 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-lg shadow-xs flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span class="text-red-800 text-sm font-semibold">{{ session('error') ?: $errors->first('error') }}</span>
                            </div>
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="mb-5 p-4 bg-green-50 border-l-4 border-green-500 rounded-r-lg shadow-xs flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-green-800 text-sm font-semibold">{{ session('success') }}</span>
                            </div>
                        </div>
                    @endif
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
                if (e.target && (e.target.classList.contains('format-rupiah') || e.target.classList.contains('rupiah-input'))) {
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
                    let inputs = e.target.querySelectorAll('.format-rupiah, .rupiah-input');
                    inputs.forEach(input => {
                        input.value = input.value.replace(/\./g, '');
                    });
                }
            });

            // Format nilai awal saat load
            document.querySelectorAll('.format-rupiah, .rupiah-input').forEach(function(input) {
                if (input.value) {
                    input.value = formatNumber(input.value);
                }
            });
        });
    </script>
</body>

</html>