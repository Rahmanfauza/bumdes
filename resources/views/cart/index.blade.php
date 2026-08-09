@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-100 py-10 sm:py-16">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Breadcrumb / Header -->
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <a href="{{ url('/katalog') }}" class="text-xs font-black uppercase text-[#2563EB] hover:underline flex items-center gap-1 mb-2">
                    ← Kembali Belanja di Katalog
                </a>
                <h1 class="text-3xl sm:text-4xl font-black text-[#111827] uppercase tracking-tight">
                    Keranjang <span class="text-[#2563EB]">Belanja</span>
                </h1>
                <p class="text-slate-600 font-bold text-sm">Rincian produk komoditas desa yang siap Anda pesan.</p>
            </div>
            <div class="flex items-center gap-2 bg-white px-4 py-2 rounded-xl border-4 border-[#111827] shadow-sm">
                <span class="text-xs font-black uppercase text-slate-500">Total Item:</span>
                <span class="text-base font-black text-[#111827]">{{ $details->sum('jumlah') }} Barang</span>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border-4 border-[#10B981] rounded-xl flex items-center gap-3 text-emerald-900 font-bold text-sm">
                <svg class="w-6 h-6 text-[#10B981] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 p-4 bg-red-50 border-4 border-[#EF4444] rounded-xl flex items-center gap-3 text-red-900 font-bold text-sm">
                <svg class="w-6 h-6 text-[#EF4444] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        @if($details->isEmpty())
            <div class="bg-white border-4 border-[#111827] rounded-2xl p-12 text-center shadow-lg">
                <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4 border-4 border-[#111827]">
                    <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <h2 class="text-2xl font-black text-[#111827] uppercase tracking-tight mb-2">Keranjang Belanja Masih Kosong</h2>
                <p class="text-slate-500 font-bold text-sm max-w-md mx-auto mb-6">Jelajahi produk berkualitas kami dan dukung ekonomi warga desa sekarang.</p>
                <a href="{{ url('/katalog') }}" class="inline-flex items-center gap-2 px-8 py-3.5 bg-[#2563EB] text-white border-4 border-[#111827] rounded-xl font-black uppercase text-sm tracking-wider hover:bg-[#111827] transition-all shadow-[4px_4px_0_0_#111827] hover:shadow-none hover:translate-x-0.5 hover:translate-y-0.5">
                    Mulai Belanja Produk →
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Cart Items List -->
                <div class="lg:col-span-2 space-y-4">
                    @foreach($details as $item)
                    <div class="bg-white border-4 border-[#111827] rounded-2xl p-4 sm:p-5 flex flex-col sm:flex-row items-center gap-5 shadow-sm hover:border-[#2563EB] transition-colors">
                        <!-- Product Thumbnail -->
                        <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-xl bg-slate-200 overflow-hidden shrink-0 border-2 border-[#111827]">
                            <img src="{{ $item->produk->gambar_url }}" alt="{{ $item->produk->nama_produk }}" class="w-full h-full object-cover">
                        </div>

                        <!-- Product Info -->
                        <div class="flex-grow text-center sm:text-left">
                            <span class="text-[10px] font-black uppercase tracking-wider text-[#2563EB] bg-[#2563EB]/10 px-2 py-0.5 rounded">
                                {{ $item->produk->kategori->nama_kategori ?? 'Komoditas' }}
                            </span>
                            <h3 class="text-lg font-black text-[#111827] uppercase tracking-tight mt-1 leading-snug">
                                {{ $item->produk->nama_produk }}
                            </h3>
                            <div class="text-sm font-bold text-slate-500 mt-0.5">
                                Rp {{ number_format($item->harga, 0, ',', '.') }} / {{ $item->produk->satuan }}
                            </div>
                            <div class="text-xs font-bold text-slate-400 mt-1">
                                Stok tersedia: {{ $item->produk->stok }} {{ $item->produk->satuan }}
                            </div>
                        </div>

                        <!-- Quantity Modifier & Subtotal -->
                        <div class="flex sm:flex-col items-center sm:items-end justify-between w-full sm:w-auto gap-3 pt-3 sm:pt-0 border-t-2 sm:border-t-0 border-slate-100">
                            <!-- Quantity Form -->
                            <form action="{{ route('cart.update', $item->id_detail) }}" method="POST" class="flex items-center border-2 border-[#111827] rounded-lg overflow-hidden bg-slate-50">
                                @csrf
                                @method('PUT')
                                <input type="number" name="jumlah" value="{{ $item->jumlah }}" min="1" max="{{ $item->produk->stok }}" 
                                       class="w-16 px-2 py-1.5 font-black text-center text-sm bg-transparent focus:outline-none" 
                                       onchange="this.form.submit()">
                                <button type="submit" class="px-2 py-1.5 bg-[#111827] text-white text-xs font-bold hover:bg-[#2563EB] transition-colors" title="Simpan Jumlah">
                                    ✓
                                </button>
                            </form>

                            <div class="text-right">
                                <div class="text-xs font-bold text-slate-400">Subtotal:</div>
                                <div class="text-lg font-black text-[#2563EB] tracking-tight">
                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                </div>
                            </div>

                            <!-- Delete Item -->
                            <form action="{{ route('cart.destroy', $item->id_detail) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Hapus produk ini dari keranjang?')" class="text-xs font-bold text-red-500 hover:text-red-700 hover:underline flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Order Summary Card -->
                <div class="lg:col-span-1">
                    <div class="bg-white border-4 border-[#111827] rounded-2xl p-6 shadow-xl sticky top-28">
                        <h2 class="text-xl font-black text-[#111827] uppercase tracking-tight mb-4 pb-3 border-b-4 border-[#111827]">
                            Ringkasan Belanja
                        </h2>

                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between text-sm font-bold text-slate-600">
                                <span>Total Item</span>
                                <span>{{ $details->sum('jumlah') }} Unit</span>
                            </div>
                            <div class="flex justify-between text-sm font-bold text-slate-600">
                                <span>Biaya Penanganan</span>
                                <span class="text-emerald-600 font-black">Gratis</span>
                            </div>
                            <div class="pt-3 border-t-2 border-slate-100 flex justify-between items-baseline">
                                <span class="text-base font-black text-[#111827] uppercase">Total Tagihan</span>
                                <span class="text-2xl font-black text-[#2563EB] tracking-tight">
                                    Rp {{ number_format($totalBelanja, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>

                        <a href="{{ route('cart.checkout') }}" class="w-full py-4 px-4 bg-[#F59E0B] text-[#111827] border-4 border-[#111827] rounded-xl font-black uppercase text-sm tracking-wider flex items-center justify-center gap-2 hover:bg-[#111827] hover:text-[#F59E0B] transition-all shadow-[4px_4px_0_0_#111827] hover:shadow-none hover:translate-x-0.5 hover:translate-y-0.5">
                            <span>Lanjut ke Checkout</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>

                        <div class="mt-4 text-center">
                            <a href="{{ url('/katalog') }}" class="text-xs font-bold text-slate-500 hover:text-[#2563EB] transition-colors">
                                + Tambah Produk Lain
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>
@endsection
