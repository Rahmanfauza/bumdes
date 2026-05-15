<!-- Sidebar Menu Input Data -->
<div class="flex flex-col gap-3 w-full">

    <!-- Daftar Akun (COA) -->
    <a href="{{ route('akun-coa.index') }}"
        class="{{ request()->routeIs('akun-coa.*') ? 'bg-[#C2410C] text-white shadow-[0_4px_12px_rgba(194,65,12,0.25)] ring-2 ring-[#C2410C]/20' : 'bg-[#FAFAF9] text-[#57534E] border border-[#D6D3D1] hover:bg-[#F5F5F4] hover:text-[#1C1917]' }} px-5 py-4 rounded-[10px] font-semibold text-[15px] transition-all flex items-center justify-between group">
        Daftar Akun (COA)
        <svg class="w-5 h-5 opacity-0 group-hover:opacity-100 transition-opacity {{ request()->routeIs('akun-coa.*') ? 'opacity-100 text-white' : 'text-[#A8A29E]' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </a>

    <!-- Master Pelanggan -->
    <a href="{{ route('pelanggan.index') }}"
        class="{{ request()->routeIs('pelanggan.*') ? 'bg-[#C2410C] text-white shadow-[0_4px_12px_rgba(194,65,12,0.25)] ring-2 ring-[#C2410C]/20' : 'bg-[#FAFAF9] text-[#57534E] border border-[#D6D3D1] hover:bg-[#F5F5F4] hover:text-[#1C1917]' }} px-5 py-4 rounded-[10px] font-semibold text-[15px] transition-all flex items-center justify-between group">
        Master Pelanggan
        <svg class="w-5 h-5 opacity-0 group-hover:opacity-100 transition-opacity {{ request()->routeIs('pelanggan.*') ? 'opacity-100 text-white' : 'text-[#A8A29E]' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </a>

    <!-- Master Anggota -->
    <a href="{{ route('input-data.anggota') }}"
        class="{{ request()->routeIs('input-data.anggota') ? 'bg-[#C2410C] text-white shadow-[0_4px_12px_rgba(194,65,12,0.25)] ring-2 ring-[#C2410C]/20' : 'bg-[#FAFAF9] text-[#57534E] border border-[#D6D3D1] hover:bg-[#F5F5F4] hover:text-[#1C1917]' }} px-5 py-4 rounded-[10px] font-semibold text-[15px] transition-all flex items-center justify-between group">
        Master Anggota
        <svg class="w-5 h-5 opacity-0 group-hover:opacity-100 transition-opacity {{ request()->routeIs('input-data.anggota') ? 'opacity-100 text-white' : 'text-[#A8A29E]' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </a>

    <!-- Master Produk/Jasa -->
    <a href="{{ route('produkjasa.index') }}"
        class="{{ request()->routeIs('produkjasa.*') ? 'bg-[#C2410C] text-white shadow-[0_4px_12px_rgba(194,65,12,0.25)] ring-2 ring-[#C2410C]/20' : 'bg-[#FAFAF9] text-[#57534E] border border-[#D6D3D1] hover:bg-[#F5F5F4] hover:text-[#1C1917]' }} px-5 py-4 rounded-[10px] font-semibold text-[15px] transition-all flex items-center justify-between group">
        Master Produk / Jasa
        <svg class="w-5 h-5 opacity-0 group-hover:opacity-100 transition-opacity {{ request()->routeIs('produkjasa.*') ? 'opacity-100 text-white' : 'text-[#A8A29E]' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </a>

    <!-- Manajemen Stok -->
    <a href="{{ route('stok.index') }}"
        class="{{ request()->routeIs('stok.*') ? 'bg-[#C2410C] text-white shadow-[0_4px_12px_rgba(194,65,12,0.25)] ring-2 ring-[#C2410C]/20' : 'bg-[#FAFAF9] text-[#57534E] border border-[#D6D3D1] hover:bg-[#F5F5F4] hover:text-[#1C1917]' }} px-5 py-4 rounded-[10px] font-semibold text-[15px] transition-all flex items-center justify-between group">
        Manajemen Stok
        <svg class="w-5 h-5 opacity-0 group-hover:opacity-100 transition-opacity {{ request()->routeIs('stok.*') ? 'opacity-100 text-white' : 'text-[#A8A29E]' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </a>

    <!-- Input Saldo Awal -->
    <a href="{{ route('saldo-awal.index') }}"
        class="{{ request()->routeIs('saldo-awal.*') ? 'bg-[#C2410C] text-white shadow-[0_4px_12px_rgba(194,65,12,0.25)] ring-2 ring-[#C2410C]/20' : 'bg-[#FAFAF9] text-[#57534E] border border-[#D6D3D1] hover:bg-[#F5F5F4] hover:text-[#1C1917]' }} px-5 py-4 rounded-[10px] font-semibold text-[15px] transition-all flex items-center justify-between group">
        Input Saldo Awal
        <svg class="w-5 h-5 opacity-0 group-hover:opacity-100 transition-opacity {{ request()->routeIs('saldo-awal.*') ? 'opacity-100 text-white' : 'text-[#A8A29E]' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </a>

    <!-- Input Jurnal -->
    <a href="{{ route('jurnal.index') }}"
        class="{{ request()->routeIs('jurnal.*') ? 'bg-[#C2410C] text-white shadow-[0_4px_12px_rgba(194,65,12,0.25)] ring-2 ring-[#C2410C]/20' : 'bg-[#FAFAF9] text-[#57534E] border border-[#D6D3D1] hover:bg-[#F5F5F4] hover:text-[#1C1917]' }} px-5 py-4 rounded-[10px] font-semibold text-[15px] transition-all flex items-center justify-between group">
        Input Jurnal
        <svg class="w-5 h-5 opacity-0 group-hover:opacity-100 transition-opacity {{ request()->routeIs('jurnal.*') ? 'opacity-100 text-white' : 'text-[#A8A29E]' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </a>

    <!-- Struktur Organisasi -->
    <a href="#"
        class="bg-[#FAFAF9] text-[#57534E] border border-[#D6D3D1] hover:bg-[#F5F5F4] hover:text-[#1C1917] px-5 py-4 rounded-[10px] font-semibold text-[15px] transition-all flex items-center justify-between group">
        Struktur Organisasi
        <svg class="w-5 h-5 text-[#A8A29E] opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </a>

</div>