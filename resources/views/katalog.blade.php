@extends('layouts.app')

@section('content')

<!-- Top Layout Container -->
<div class="relative w-full pt-20 bg-white z-10">

    <!-- Hero Section Flat Split -->
    <div class="w-full flex flex-col lg:flex-row border-b-4 border-[#111827]">
        <!-- Left Side: Solid Blue Action Block -->
        <div class="w-full lg:w-1/2 bg-[#2563EB] relative overflow-hidden flex flex-col justify-center p-8 lg:p-16 min-h-[40vh] lg:h-[60vh]">
            <!-- Decorative Flat Shapes -->
            <div class="absolute -top-16 -left-16 w-64 h-64 border-8 border-white/20 pointer-events-none"></div>
            <div class="absolute bottom-10 right-10 w-24 h-24 bg-white/20 rounded-full pointer-events-none"></div>
            
            <div class="relative z-10 w-full max-w-xl">
                <div class="inline-block px-4 py-1.5 bg-[#F59E0B] rounded-md text-white font-black tracking-widest uppercase text-sm mb-6 shadow-sm">
                    Inventaris & Komoditas Lokal
                </div>

                <h1 class="text-5xl md:text-6xl lg:text-7xl font-black text-white tracking-tighter leading-[0.95] mb-6 uppercase">
                    Katalog<br/><span class="text-[#111827]">Produk Desa</span>
                </h1>

                <p class="text-lg sm:text-xl font-bold text-white/90 leading-snug">
                    Distribusi produk otentik desa. Dari hasil bumi dan tangan pengrajin lokal langsung ke tangan Anda.
                </p>
            </div>
        </div>

        <!-- Right Side: Image Edge-to-Edge -->
        <div class="w-full lg:w-1/2 h-[40vh] lg:h-[60vh] bg-gray-200 border-b-4 lg:border-b-0 lg:border-l-4 border-[#111827]">
            <img class="w-full h-full object-cover object-center block" 
                 src="{{ asset('shallow-focus-shot-japanese-elderly-people-working-field.jpg') }}" 
                 alt="BUMDes Agriculture" fetchpriority="high" loading="eager" decoding="async">
        </div>
    </div>


    <!-- ====== CATALOG SECTION ====== -->
    <div class="w-full py-16 sm:py-24 bg-white relative border-b-4 border-[#111827]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12">

            @if(session('success'))
            <div class="mb-8 p-4 bg-emerald-50 border-4 border-[#10B981] rounded-xl flex items-center justify-between text-emerald-900 font-bold text-sm">
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6 text-[#10B981] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>{{ session('success') }}</span>
                </div>
                <a href="{{ route('cart.index') }}" class="px-4 py-1.5 bg-[#10B981] text-white rounded font-black text-xs uppercase hover:bg-black transition-colors shrink-0">
                    Buka Keranjang →
                </a>
            </div>
            @endif

            @if($errors->has('error'))
            <div class="mb-8 p-4 bg-red-50 border-4 border-[#EF4444] rounded-xl flex items-center gap-3 text-red-900 font-bold text-sm">
                <svg class="w-6 h-6 text-[#EF4444] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>{{ $errors->first('error') }}</span>
            </div>
            @endif

            <!-- Search & Filter Bar -->
            <div class="mb-12 flex flex-col md:flex-row items-center justify-between gap-6">
                <!-- Search Form -->
                <form action="{{ url('/katalog') }}" method="GET" class="w-full md:w-96 flex items-center">
                    @if($kategoriId && $kategoriId != 'all')
                        <input type="hidden" name="kategori" value="{{ $kategoriId }}">
                    @endif
                    <div class="relative w-full">
                        <input type="text" name="q" value="{{ $search ?? '' }}" 
                            placeholder="Cari komoditas produk..." 
                            class="w-full pl-11 pr-24 py-3 bg-slate-50 border-4 border-[#111827] rounded-md font-bold text-sm text-[#111827] placeholder-slate-400 focus:outline-none focus:bg-white transition-all">
                        <svg class="w-5 h-5 text-slate-500 absolute left-3.5 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <button type="submit" class="absolute right-1.5 top-1/2 -translate-y-1/2 bg-[#111827] text-white text-xs font-black uppercase px-4 py-2 rounded">
                            Cari
                        </button>
                    </div>
                </form>

                <!-- Total Count Display -->
                <div class="text-sm font-bold text-slate-600 self-start md:self-auto flex items-center gap-2">
                    <span>Menampilkan:</span>
                    <span class="bg-[#111827] text-white px-3 py-1 rounded font-mono font-bold">{{ $produks->count() }} Produk</span>
                </div>
            </div>

            <!-- Category Filter Buttons (Flat & Dynamic) -->
            <div class="flex flex-wrap justify-start sm:justify-center gap-3 mb-16">
                <a href="{{ url('/katalog' . ($search ? '?q=' . urlencode($search) : '')) }}" 
                   class="px-6 py-2.5 rounded-md font-black uppercase tracking-wider text-xs sm:text-sm border-4 transition-all duration-150 {{ !$kategoriId || $kategoriId == 'all' ? 'bg-[#111827] text-white border-[#111827] shadow-sm' : 'bg-white text-[#4B5563] border-[#E5E7EB] hover:border-[#111827] hover:text-[#111827]' }}">
                    Semua Komoditas
                </a>
                @foreach($kategoris as $kat)
                <a href="{{ url('/katalog?kategori=' . $kat->id_kategori . ($search ? '&q=' . urlencode($search) : '')) }}" 
                   class="px-6 py-2.5 rounded-md font-black uppercase tracking-wider text-xs sm:text-sm border-4 transition-all duration-150 {{ $kategoriId == $kat->id_kategori ? 'bg-[#2563EB] text-white border-[#2563EB] shadow-sm' : 'bg-white text-[#4B5563] border-[#E5E7EB] hover:border-[#111827] hover:text-[#111827]' }}">
                    {{ $kat->nama_kategori }} ({{ $kat->produk_count }})
                </a>
                @endforeach
            </div>

            <!-- Product Grid (Dynamic from Database) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @forelse($produks as $item)
                <div class="bg-[#F3F4F6] p-4 rounded-2xl flex flex-col group hover:bg-[#E5E7EB] transition-all border-4 border-transparent hover:border-[#2563EB] shadow-sm">
                    <!-- Image Card -->
                    <div class="w-full aspect-[4/3] rounded-xl bg-gray-300 overflow-hidden relative mb-5 border-4 border-transparent group-hover:border-[#111827] transition-all">
                        <img src="{{ $item->gambar_url }}" alt="{{ $item->nama_produk }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        
                        @if($item->stok > 0)
                            <div class="absolute top-3 right-3 bg-[#10B981] text-white px-2.5 py-1 font-black text-[11px] uppercase tracking-wider rounded shadow-sm">
                                Stok: {{ $item->stok }} {{ $item->satuan }}
                            </div>
                        @else
                            <div class="absolute top-3 right-3 bg-[#EF4444] text-white px-2.5 py-1 font-black text-[11px] uppercase tracking-wider rounded shadow-sm">
                                Habis
                            </div>
                        @endif

                        @if($item->kategori)
                            <div class="absolute bottom-3 left-3 bg-[#111827]/85 text-white px-2.5 py-1 font-black text-[10px] uppercase tracking-wider rounded">
                                {{ $item->kategori->nama_kategori }}
                            </div>
                        @endif
                    </div>

                    <!-- Content Card -->
                    <div class="px-2 flex flex-col flex-grow">
                        <div class="text-[11px] text-[#2563EB] font-black mb-1 uppercase tracking-widest">
                            {{ $item->kategori->nama_kategori ?? 'Umum' }}
                        </div>
                        <h3 class="text-xl font-black text-[#111827] uppercase tracking-tight mb-2 leading-tight group-hover:text-[#2563EB] transition-colors line-clamp-1">
                            {{ $item->nama_produk }}
                        </h3>
                        <p class="text-[#4B5563] font-medium text-xs leading-relaxed mb-4 flex-grow line-clamp-2">
                            {{ $item->deskripsi ?: 'Produk unggulan berkualitas hasil kemitraan BUMDes dan masyarakat desa.' }}
                        </p>
                        
                        <!-- Price & Order Action -->
                        <div class="w-full pt-4 border-t-4 border-white flex flex-col gap-3 mt-auto">
                            <div class="flex items-baseline justify-between">
                                <span class="text-2xl font-black text-[#111827] tracking-tighter">
                                    Rp {{ number_format($item->harga, 0, ',', '.') }}
                                </span>
                                <span class="text-xs text-slate-500 font-bold">/ {{ $item->satuan }}</span>
                            </div>

                            @if($item->stok > 0)
                                <div class="grid grid-cols-2 gap-2">
                                    <form action="{{ route('cart.add') }}" method="POST" class="w-full">
                                        @csrf
                                        <input type="hidden" name="id_produk" value="{{ $item->id_produk }}">
                                        <input type="hidden" name="jumlah" value="1">
                                        <button type="submit" class="w-full py-2.5 px-2 rounded bg-white text-[#2563EB] font-black tracking-wider uppercase text-[11px] border-4 border-white hover:border-[#2563EB] hover:bg-[#2563EB] hover:text-white transition-all flex items-center justify-center gap-1 shadow-sm" title="Tambahkan ke Keranjang">
                                            <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                            <span>+Keranjang</span>
                                        </button>
                                    </form>
                                    <form action="{{ route('cart.add') }}" method="POST" class="w-full">
                                        @csrf
                                        <input type="hidden" name="id_produk" value="{{ $item->id_produk }}">
                                        <input type="hidden" name="jumlah" value="1">
                                        <input type="hidden" name="direct_checkout" value="1">
                                        <button type="submit" class="w-full py-2.5 px-2 rounded bg-[#F59E0B] text-[#111827] font-black tracking-wider uppercase text-[11px] border-4 border-[#111827] hover:bg-[#111827] hover:text-[#F59E0B] transition-all flex items-center justify-center gap-1 shadow-sm">
                                            <span>Beli</span>
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                        </button>
                                    </form>
                                </div>
                            @else
                                <button disabled class="w-full py-2.5 rounded bg-gray-200 text-gray-400 font-black uppercase text-xs tracking-wider cursor-not-allowed border-2 border-gray-300">
                                    Stok Habis
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-1 sm:col-span-2 lg:col-span-3 xl:col-span-4 py-16 text-center bg-[#F3F4F6] rounded-2xl border-4 border-dashed border-[#CBD5E1]">
                    <svg class="w-14 h-14 text-slate-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    <h3 class="text-xl font-black text-[#111827] uppercase tracking-tight">Tidak Ada Produk Ditemukan</h3>
                    <p class="text-slate-500 text-sm mt-1 max-w-md mx-auto">
                        @if($search)
                            Tidak ada produk yang cocok dengan kata kunci "{{ $search }}". Silakan coba kata kunci lain.
                        @else
                            Belum ada produk untuk kategori yang dipilih saat ini.
                        @endif
                    </p>
                    <a href="{{ url('/katalog') }}" class="mt-4 inline-block px-6 py-2 rounded bg-[#111827] text-white font-black uppercase text-xs">
                        Lihat Semua Komoditas
                    </a>
                </div>
                @endforelse
            </div>

        </div>
    </div>

    <!-- Call to Action (Flat Block Variant) -->
    <div class="w-full bg-[#F59E0B] py-20 relative overflow-hidden z-0 border-b-4 border-black">
        <!-- Abstract Decoration -->
        <div class="absolute -top-1/2 left-1/4 w-96 h-96 bg-[#111827] rounded-full opacity-10 pointer-events-none"></div>
        <div class="absolute -bottom-1/4 right-1/4 w-72 h-72 border-8 border-black/10 rotate-45 pointer-events-none"></div>

        <div class="max-w-4xl mx-auto px-6 text-center relative z-10 flex flex-col items-center">
            <h2 class="text-4xl lg:text-6xl font-black text-[#111827] mb-4 tracking-tighter uppercase leading-none">
                Buka Kemitraan<br/><span class="text-white">Lapak Komoditas</span>
            </h2>
            <div class="w-20 h-2 bg-white mb-6"></div>
            <p class="text-lg text-[#111827] font-bold mb-8 max-w-2xl mx-auto">
                Punya komoditas atau hasil kerajinan desa? Integrasikan produk Anda ke sistem BUMDesGO untuk pemasaran yang lebih luas.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center w-full sm:w-auto">
                <a href="{{ url('/kontak') }}" class="px-8 py-4 bg-[#111827] border-4 border-[#111827] text-white font-black uppercase tracking-wider rounded text-sm hover:scale-105 transition-transform">
                    Hubungi Pengurus BUMDes
                </a>
                <a href="{{ url('/') }}" class="px-8 py-4 bg-transparent border-4 border-[#111827] text-[#111827] font-black uppercase tracking-wider rounded text-sm hover:scale-105 hover:bg-white transition-transform">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>

@endsection