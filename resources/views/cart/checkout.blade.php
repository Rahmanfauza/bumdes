@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-100 py-10 sm:py-16">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Breadcrumbs -->
        <div class="mb-8">
            <a href="{{ route('cart.index') }}" class="text-xs font-black uppercase text-[#2563EB] hover:underline flex items-center gap-1 mb-2">
                ← Kembali ke Keranjang Belanja
            </a>
            <h1 class="text-3xl sm:text-4xl font-black text-[#111827] uppercase tracking-tight">
                Konfirmasi <span class="text-[#2563EB]">Checkout</span>
            </h1>
            <p class="text-slate-600 font-bold text-sm">Lengkapi data pengiriman dan pilih metode pembayaran pesanan Anda.</p>
        </div>

        @if($errors->any())
            <div class="mb-6 p-4 bg-red-50 border-4 border-[#EF4444] rounded-xl flex items-center gap-3 text-red-900 font-bold text-sm">
                <svg class="w-6 h-6 text-[#EF4444] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <form action="{{ route('cart.checkout.process') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left: Shipping & Payment Details -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- Recipient & Shipping Information -->
                    <div class="bg-white border-4 border-[#111827] rounded-2xl p-6 shadow-sm">
                        <div class="flex items-center gap-3 mb-5 pb-3 border-b-4 border-[#111827]">
                            <div class="w-8 h-8 rounded-lg bg-[#2563EB] text-white flex items-center justify-center font-black text-sm">1</div>
                            <h2 class="text-lg font-black text-[#111827] uppercase tracking-tight">Informasi Pengiriman</h2>
                        </div>

                        <div class="space-y-4">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-black text-[#111827] uppercase tracking-widest mb-1.5">Nama Penerima <span class="text-red-500">*</span></label>
                                    <input type="text" name="nama_penerima" value="{{ old('nama_penerima', $pelanggan->nama) }}" 
                                           class="w-full px-3.5 py-3 border-4 border-[#111827] rounded-xl bg-slate-50 font-bold text-sm text-[#111827] focus:bg-white focus:outline-none focus:border-[#2563EB] transition-colors" required>
                                </div>
                                <div>
                                    <label class="block text-xs font-black text-[#111827] uppercase tracking-widest mb-1.5">Nomor WhatsApp / HP <span class="text-red-500">*</span></label>
                                    <input type="tel" name="no_hp" value="{{ old('no_hp', $pelanggan->no_hp) }}" 
                                           class="w-full px-3.5 py-3 border-4 border-[#111827] rounded-xl bg-slate-50 font-bold text-sm text-[#111827] focus:bg-white focus:outline-none focus:border-[#2563EB] transition-colors" placeholder="081234567890" required>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-black text-[#111827] uppercase tracking-widest mb-1.5">Alamat Pengiriman Lengkap <span class="text-red-500">*</span></label>
                                <textarea name="alamat_pengiriman" rows="3" 
                                          class="w-full px-3.5 py-3 border-4 border-[#111827] rounded-xl bg-slate-50 font-bold text-sm text-[#111827] focus:bg-white focus:outline-none focus:border-[#2563EB] transition-colors" 
                                          placeholder="Tuliskan nama jalan, RT/RW, Dusun, Desa, patokan lokasi..." required>{{ old('alamat_pengiriman', $pelanggan->alamat) }}</textarea>
                            </div>

                            <div>
                                <label class="block text-xs font-black text-[#111827] uppercase tracking-widest mb-1.5">Catatan untuk Penjual / BUMDes (Opsional)</label>
                                <input type="text" name="catatan" value="{{ old('catatan') }}" 
                                       class="w-full px-3.5 py-2.5 border-4 border-[#111827] rounded-xl bg-slate-50 font-bold text-xs text-[#111827] focus:bg-white focus:outline-none focus:border-[#2563EB] transition-colors" 
                                       placeholder="Contoh: Tolong kirim sebelum sore / kemas rapat">
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method Selection -->
                    <div class="bg-white border-4 border-[#111827] rounded-2xl p-6 shadow-sm">
                        <div class="flex items-center gap-3 mb-5 pb-3 border-b-4 border-[#111827]">
                            <div class="w-8 h-8 rounded-lg bg-[#F59E0B] text-[#111827] flex items-center justify-center font-black text-sm">2</div>
                            <h2 class="text-lg font-black text-[#111827] uppercase tracking-tight">Metode Pembayaran</h2>
                        </div>

                        <div class="space-y-3">
                            <label class="flex items-start gap-4 p-4 border-4 border-[#111827] rounded-xl cursor-pointer hover:bg-slate-50 transition-colors has-[:checked]:bg-blue-50 has-[:checked]:border-[#2563EB]">
                                <input type="radio" name="metode_bayar" value="COD / Bayar di Tempat" class="mt-1 w-5 h-5 text-[#2563EB]" checked>
                                <div>
                                    <div class="font-black text-sm text-[#111827] uppercase">COD / Bayar di Tempat (Tunai)</div>
                                    <div class="text-xs font-bold text-slate-500 mt-0.5">Bayar langsung saat produk diantar kurir desa ke lokasi Anda.</div>
                                </div>
                            </label>

                            <label class="flex items-start gap-4 p-4 border-4 border-[#111827] rounded-xl cursor-pointer hover:bg-slate-50 transition-colors has-[:checked]:bg-blue-50 has-[:checked]:border-[#2563EB]">
                                <input type="radio" name="metode_bayar" value="Transfer Bank (BCA / Mandiri / BRI)" class="mt-1 w-5 h-5 text-[#2563EB]">
                                <div>
                                    <div class="font-black text-sm text-[#111827] uppercase">Transfer Bank Resmi BUMDes</div>
                                    <div class="text-xs font-bold text-slate-500 mt-0.5">Transfer rekening bank (BCA, Mandiri, atau BRI) BUMDes Sinar Jaya.</div>
                                </div>
                            </label>

                            <label class="flex items-start gap-4 p-4 border-4 border-[#111827] rounded-xl cursor-pointer hover:bg-slate-50 transition-colors has-[:checked]:bg-blue-50 has-[:checked]:border-[#2563EB]">
                                <input type="radio" name="metode_bayar" value="QRIS BUMDes" class="mt-1 w-5 h-5 text-[#2563EB]">
                                <div>
                                    <div class="font-black text-sm text-[#111827] uppercase">QRIS Nasional BUMDes</div>
                                    <div class="text-xs font-bold text-slate-500 mt-0.5">Scan cepat via GoPay, OVO, Dana, ShopeePay, atau Mobile Banking.</div>
                                </div>
                            </label>
                        </div>
                    </div>

                </div>

                <!-- Right: Ordered Items & Final Action -->
                <div class="lg:col-span-1">
                    <div class="bg-white border-4 border-[#111827] rounded-2xl p-6 shadow-xl sticky top-28">
                        <h2 class="text-lg font-black text-[#111827] uppercase tracking-tight mb-4 pb-3 border-b-4 border-[#111827]">
                            Pesanan Anda ({{ $details->sum('jumlah') }})
                        </h2>

                        <!-- Items Mini List -->
                        <div class="space-y-3 max-h-60 overflow-y-auto pr-1 mb-6 divide-y-2 divide-slate-100">
                            @foreach($details as $item)
                            <div class="pt-3 first:pt-0 flex items-center justify-between gap-3 text-xs">
                                <div>
                                    <div class="font-black text-[#111827] uppercase line-clamp-1">{{ $item->produk->nama_produk }}</div>
                                    <div class="text-slate-500 font-bold">{{ $item->jumlah }} x Rp {{ number_format($item->harga, 0, ',', '.') }}</div>
                                </div>
                                <div class="font-black text-[#2563EB] shrink-0">
                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- Price Breakdown -->
                        <div class="space-y-2 pt-4 border-t-4 border-[#111827] mb-6">
                            <div class="flex justify-between text-xs font-bold text-slate-600">
                                <span>Subtotal Produk</span>
                                <span>Rp {{ number_format($totalBelanja, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-xs font-bold text-slate-600">
                                <span>Ongkos Kirim Desa</span>
                                <span class="text-emerald-600 font-black">Gratis</span>
                            </div>
                            <div class="pt-3 border-t-2 border-slate-200 flex justify-between items-baseline">
                                <span class="text-sm font-black text-[#111827] uppercase">Total Bayar</span>
                                <span class="text-2xl font-black text-[#2563EB] tracking-tight">
                                    Rp {{ number_format($totalBelanja, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>

                        <!-- Submit Order Button -->
                        <button type="submit" class="w-full py-4 px-4 bg-[#10B981] text-white border-4 border-[#111827] rounded-xl font-black uppercase text-sm tracking-wider flex items-center justify-center gap-2 hover:bg-[#111827] transition-all shadow-[4px_4px_0_0_#111827] hover:shadow-none hover:translate-x-0.5 hover:translate-y-0.5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            <span>Buat Pesanan Sekarang</span>
                        </button>

                        <p class="text-[11px] font-bold text-slate-400 text-center mt-3">
                            Pesanan akan segera diteruskan ke Admin pengelola transaksi BUMDes.
                        </p>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
@endsection
