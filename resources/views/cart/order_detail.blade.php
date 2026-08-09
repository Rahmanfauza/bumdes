@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-100 py-10 sm:py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Top Navigation -->
        <div class="mb-6 flex items-center justify-between">
            <a href="{{ route('cart.orders') }}" class="text-xs font-black uppercase text-[#2563EB] hover:underline flex items-center gap-1">
                ← Lihat Semua Riwayat Pesanan
            </a>
            <a href="{{ url('/katalog') }}" class="text-xs font-black uppercase text-slate-500 hover:text-[#111827]">
                Belanja Lagi →
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border-4 border-[#10B981] rounded-xl flex items-center gap-3 text-emerald-900 font-bold text-sm">
                <svg class="w-6 h-6 text-[#10B981] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <div>
                    <div class="font-black">Berhasil!</div>
                    <div>{{ session('success') }}</div>
                </div>
            </div>
        @endif

        <!-- Order Card / Invoice Container -->
        <div class="bg-white border-4 border-[#111827] rounded-2xl shadow-xl overflow-hidden">

            <!-- Invoice Header -->
            <div class="bg-[#111827] text-white p-6 sm:p-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <span class="text-xs font-black uppercase tracking-widest text-[#F59E0B] bg-white/10 px-2.5 py-1 rounded">
                        Invoice Pemesanan BUMDes
                    </span>
                    <h1 class="text-2xl sm:text-3xl font-black uppercase tracking-tight mt-2">
                        Pesanan #ORD-{{ str_pad($pesanan->id_transaksi, 5, '0', STR_PAD_LEFT) }}
                    </h1>
                    <div class="text-xs font-bold text-slate-400 mt-1">
                        Waktu Pemesanan: {{ $pesanan->tanggal ? $pesanan->tanggal->format('d F Y, H:i') : $pesanan->created_at->format('d F Y, H:i') }} WIB
                    </div>
                </div>

                <!-- Status Badge -->
                <div>
                    @if($pesanan->status == 'menunggu_konfirmasi')
                        <div class="inline-flex items-center gap-2 bg-[#F59E0B] text-[#111827] px-4 py-2 rounded-xl font-black text-xs uppercase tracking-wider border-2 border-white shadow-sm">
                            <span class="w-2.5 h-2.5 rounded-full bg-[#111827] animate-pulse"></span>
                            Menunggu Konfirmasi Admin
                        </div>
                    @elseif($pesanan->status == 'diproses')
                        <div class="inline-flex items-center gap-2 bg-[#2563EB] text-white px-4 py-2 rounded-xl font-black text-xs uppercase tracking-wider border-2 border-white shadow-sm">
                            <span class="w-2.5 h-2.5 rounded-full bg-white animate-pulse"></span>
                            Sedang Diproses
                        </div>
                    @elseif($pesanan->status == 'selesai')
                        <div class="inline-flex items-center gap-2 bg-[#10B981] text-white px-4 py-2 rounded-xl font-black text-xs uppercase tracking-wider border-2 border-white shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            Pesanan Selesai / Terkonfirmasi
                        </div>
                    @elseif($pesanan->status == 'batal')
                        <div class="inline-flex items-center gap-2 bg-[#EF4444] text-white px-4 py-2 rounded-xl font-black text-xs uppercase tracking-wider border-2 border-white shadow-sm">
                            ✕ Dibatalkan
                        </div>
                    @else
                        <div class="inline-flex items-center gap-2 bg-slate-200 text-slate-800 px-4 py-2 rounded-xl font-black text-xs uppercase tracking-wider border-2 border-slate-300">
                            {{ $pesanan->status }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Invoice Content -->
            <div class="p-6 sm:p-8 space-y-8">

                <!-- Items Ordered Table -->
                <div>
                    <h2 class="text-base font-black text-[#111827] uppercase tracking-tight mb-4 pb-2 border-b-4 border-[#111827]">
                        Rincian Komoditas Produk
                    </h2>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead>
                                <tr class="border-b-2 border-slate-200 text-xs font-black uppercase tracking-wider text-slate-500">
                                    <th class="py-3">Produk</th>
                                    <th class="py-3 text-center">Harga</th>
                                    <th class="py-3 text-center">Jumlah</th>
                                    <th class="py-3 text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y-2 divide-slate-100 font-bold text-slate-700">
                                @foreach($pesanan->detail as $item)
                                <tr>
                                    <td class="py-4">
                                        <div class="flex items-center gap-3">
                                            @if($item->produk)
                                                <img src="{{ $item->produk->gambar_url }}" alt="{{ $item->produk->nama_produk }}" class="w-12 h-12 rounded-lg object-cover border-2 border-[#111827] shrink-0">
                                                <div>
                                                    <div class="font-black text-[#111827] uppercase">{{ $item->produk->nama_produk }}</div>
                                                    <div class="text-xs text-slate-400">{{ $item->produk->kategori->nama_kategori ?? 'Umum' }}</div>
                                                </div>
                                            @else
                                                <div class="font-black text-[#111827]">Produk #{{ $item->id_produk }}</div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="py-4 text-center">
                                        Rp {{ number_format($item->harga, 0, ',', '.') }}
                                    </td>
                                    <td class="py-4 text-center font-black text-[#111827]">
                                        {{ $item->jumlah }} {{ $item->produk->satuan ?? 'unit' }}
                                    </td>
                                    <td class="py-4 text-right font-black text-[#2563EB]">
                                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="border-t-4 border-[#111827]">
                                    <td colspan="3" class="py-4 text-right font-black text-sm uppercase text-[#111827]">Total Pembayaran:</td>
                                    <td class="py-4 text-right font-black text-xl text-[#2563EB]">
                                        Rp {{ number_format($pesanan->total, 0, ',', '.') }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <!-- Info Columns: Shipping & Payment -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-4 border-t-2 border-slate-100">
                    <!-- Shipping Info -->
                    <div class="bg-slate-50 p-5 rounded-xl border-2 border-[#111827]">
                        <h3 class="text-xs font-black uppercase tracking-wider text-slate-500 mb-2">Tujuan Pengiriman:</h3>
                        <div class="text-sm font-bold text-[#111827] leading-relaxed">
                            {{ $pesanan->alamat_pengiriman ?: ($pesanan->pelanggan->alamat ?? 'Diambil di Kantor BUMDes') }}
                        </div>
                        @if($pesanan->catatan)
                            <div class="mt-3 pt-3 border-t border-slate-200 text-xs font-bold text-slate-600">
                                <span class="font-black text-[#111827]">Catatan:</span> {{ $pesanan->catatan }}
                            </div>
                        @endif
                    </div>

                    <!-- Payment Info -->
                    <div class="bg-slate-50 p-5 rounded-xl border-2 border-[#111827]">
                        <h3 class="text-xs font-black uppercase tracking-wider text-slate-500 mb-2">Metode Pembayaran:</h3>
                        <div class="text-base font-black text-[#111827] uppercase">
                            {{ $pesanan->metode_bayar }}
                        </div>
                        <div class="text-xs font-bold text-slate-500 mt-2">
                            @if(str_contains(strtolower($pesanan->metode_bayar), 'cod'))
                                Siapkan uang pas saat kurir BUMDes mengantarkan pesanan ke alamat Anda.
                            @elseif(str_contains(strtolower($pesanan->metode_bayar), 'transfer'))
                                Transfer ke Rekening BRI: <strong>0123-01-000456-50-8</strong> (a.n. BUMDes Sinar Jaya).
                            @else
                                Scan QRIS BUMDes yang tersedia di konfirmasi pesanan atau hubungi pengelola.
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Actions / Help Contact -->
                <div class="pt-4 border-t-4 border-[#111827] flex flex-col sm:flex-row items-center justify-between gap-4">
                    @php
                        $waPesanan = rawurlencode("Halo Pengelola BUMDesGO, saya ingin menanyakan status pesanan #ORD-" . str_pad($pesanan->id_transaksi, 5, '0', STR_PAD_LEFT) . " atas nama " . ($pesanan->pelanggan->nama ?? 'Pelanggan') . " senilai Rp " . number_format($pesanan->total, 0, ',', '.') . ".");
                    @endphp
                    <a href="https://wa.me/6281234567890?text={{ $waPesanan }}" target="_blank" rel="noopener noreferrer" 
                       class="w-full sm:w-auto px-6 py-3 bg-[#10B981] text-white border-4 border-[#111827] rounded-xl font-black uppercase text-xs tracking-wider flex items-center justify-center gap-2 hover:bg-[#111827] transition-all shadow-[4px_4px_0_0_#111827] hover:shadow-none hover:translate-x-0.5 hover:translate-y-0.5">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                        <span>Konfirmasi via WhatsApp</span>
                    </a>

                    <div class="flex items-center gap-3">
                        <button onclick="window.print()" class="px-5 py-3 bg-white text-[#111827] border-4 border-[#111827] rounded-xl font-black uppercase text-xs tracking-wider hover:bg-slate-100 transition-colors">
                            Cetak Invoice
                        </button>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>
@endsection
