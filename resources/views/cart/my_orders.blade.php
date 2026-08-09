@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-100 py-10 sm:py-16">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <a href="{{ url('/katalog') }}" class="text-xs font-black uppercase text-[#2563EB] hover:underline flex items-center gap-1 mb-2">
                    ← Kembali Belanja di Katalog
                </a>
                <h1 class="text-3xl sm:text-4xl font-black text-[#111827] uppercase tracking-tight">
                    Riwayat <span class="text-[#2563EB]">Pesanan Saya</span>
                </h1>
                <p class="text-slate-600 font-bold text-sm">Daftar transaksi dan status pemesanan produk BUMDes Anda.</p>
            </div>
            <a href="{{ url('/katalog') }}" class="px-5 py-2.5 bg-[#2563EB] text-white border-4 border-[#111827] rounded-xl font-black uppercase text-xs tracking-wider hover:bg-[#111827] transition-all shadow-[4px_4px_0_0_#111827] hover:shadow-none hover:translate-x-0.5 hover:translate-y-0.5 self-start sm:self-auto">
                + Belanja Lagi
            </a>
        </div>

        @if($pesanans->isEmpty())
            <div class="bg-white border-4 border-[#111827] rounded-2xl p-12 text-center shadow-lg">
                <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4 border-4 border-[#111827]">
                    <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </div>
                <h2 class="text-2xl font-black text-[#111827] uppercase tracking-tight mb-2">Belum Ada Riwayat Pesanan</h2>
                <p class="text-slate-500 font-bold text-sm max-w-md mx-auto mb-6">Anda belum pernah melakukan pemesanan. Pilih produk dari katalog dan lakukan pembelian sekarang!</p>
                <a href="{{ url('/katalog') }}" class="inline-flex items-center gap-2 px-8 py-3.5 bg-[#2563EB] text-white border-4 border-[#111827] rounded-xl font-black uppercase text-sm tracking-wider hover:bg-[#111827] transition-all">
                    Buka Katalog Produk →
                </a>
            </div>
        @else
            <div class="space-y-4">
                @foreach($pesanans as $order)
                <div class="bg-white border-4 border-[#111827] rounded-2xl p-5 sm:p-6 shadow-sm hover:border-[#2563EB] transition-all flex flex-col md:flex-row items-start md:items-center justify-between gap-5">
                    <div class="space-y-2 flex-grow">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="font-black text-base text-[#111827] uppercase">
                                #ORD-{{ str_pad($order->id_transaksi, 5, '0', STR_PAD_LEFT) }}
                            </span>
                            <span class="text-xs font-bold text-slate-400">
                                • {{ $order->tanggal ? $order->tanggal->format('d M Y, H:i') : $order->created_at->format('d M Y, H:i') }} WIB
                            </span>

                            @if($order->status == 'menunggu_konfirmasi')
                                <span class="bg-[#F59E0B]/20 text-[#B45309] border-2 border-[#F59E0B] px-2.5 py-0.5 rounded-md text-[11px] font-black uppercase">
                                    Menunggu Konfirmasi
                                </span>
                            @elseif($order->status == 'diproses')
                                <span class="bg-blue-100 text-blue-800 border-2 border-blue-400 px-2.5 py-0.5 rounded-md text-[11px] font-black uppercase">
                                    Sedang Diproses
                                </span>
                            @elseif($order->status == 'selesai')
                                <span class="bg-emerald-100 text-emerald-800 border-2 border-emerald-500 px-2.5 py-0.5 rounded-md text-[11px] font-black uppercase">
                                    Selesai
                                </span>
                            @elseif($order->status == 'batal')
                                <span class="bg-red-100 text-red-800 border-2 border-red-400 px-2.5 py-0.5 rounded-md text-[11px] font-black uppercase">
                                    Dibatalkan
                                </span>
                            @else
                                <span class="bg-slate-100 text-slate-700 px-2.5 py-0.5 rounded-md text-[11px] font-black uppercase">
                                    {{ $order->status }}
                                </span>
                            @endif
                        </div>

                        <!-- Ordered items snippet -->
                        <div class="text-xs font-bold text-slate-600">
                            @foreach($order->detail as $item)
                                <span class="inline-block bg-slate-100 px-2 py-1 rounded border border-slate-200 mr-1 mb-1">
                                    {{ $item->produk->nama_produk ?? 'Produk' }} (x{{ $item->jumlah }})
                                </span>
                            @endforeach
                        </div>

                        <div class="text-xs font-bold text-slate-500">
                            Metode Bayar: <span class="font-black text-[#111827] uppercase">{{ $order->metode_bayar }}</span>
                        </div>
                    </div>

                    <!-- Total and View Button -->
                    <div class="flex items-center justify-between w-full md:w-auto md:flex-col md:items-end gap-3 pt-3 md:pt-0 border-t-2 md:border-t-0 border-slate-100 shrink-0">
                        <div class="text-left md:text-right">
                            <div class="text-[11px] font-bold text-slate-400 uppercase">Total Tagihan</div>
                            <div class="text-xl font-black text-[#2563EB]">
                                Rp {{ number_format($order->total, 0, ',', '.') }}
                            </div>
                        </div>
                        <a href="{{ route('cart.order.detail', $order->id_transaksi) }}" 
                           class="px-4 py-2 bg-white text-[#111827] border-4 border-[#111827] rounded-xl font-black uppercase text-xs tracking-wider hover:bg-[#111827] hover:text-white transition-all shadow-[2px_2px_0_0_#111827] hover:shadow-none hover:translate-x-0.5 hover:translate-y-0.5">
                            Lihat Invoice →
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        @endif

    </div>
</div>
@endsection
