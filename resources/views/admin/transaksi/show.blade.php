@extends('layouts.admin')

@section('header_title', 'Detail Transaksi Penjualan')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl text-sm font-medium flex items-center gap-2">
            <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(session('info'))
        <div class="bg-blue-50 border border-blue-200 text-blue-800 px-4 py-3 rounded-xl text-sm font-medium">
            {{ session('info') }}
        </div>
    @endif

    <!-- Admin Status Control Bar (Print hidden) -->
    <div class="bg-white border border-[#D6D3D1] rounded-[16px] p-5 shadow-sm flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 print:hidden">
        <div class="flex items-center gap-3">
            <span class="text-xs font-bold text-[#78716C] uppercase tracking-wider">Ubah Status Pesanan:</span>
            @if($transaksi->status == 'menunggu_konfirmasi')
                <span class="px-2.5 py-1 rounded-full text-xs font-black bg-amber-100 text-amber-900 border border-amber-300">
                    Menunggu Konfirmasi
                </span>
            @elseif($transaksi->status == 'diproses')
                <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-sky-100 text-sky-900 border border-sky-300">
                    Sedang Diproses
                </span>
            @elseif($transaksi->status == 'selesai')
                <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-900 border border-emerald-300">
                    ✓ Selesai
                </span>
            @elseif($transaksi->status == 'batal')
                <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-red-100 text-red-900 border border-red-300">
                    ✕ Dibatalkan
                </span>
            @endif
        </div>

        <form action="{{ route('admin.transaksi.update-status', $transaksi->id_transaksi) }}" method="POST" class="flex items-center gap-2">
            @csrf
            @method('PUT')
            <select name="status" class="bg-stone-50 border border-[#D6D3D1] rounded-lg px-3 py-1.5 text-xs font-bold text-[#1C1917] focus:outline-none focus:border-[#C2410C]">
                <option value="menunggu_konfirmasi" {{ $transaksi->status == 'menunggu_konfirmasi' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                <option value="diproses" {{ $transaksi->status == 'diproses' ? 'selected' : '' }}>Sedang Diproses</option>
                <option value="selesai" {{ $transaksi->status == 'selesai' ? 'selected' : '' }}>Selesai / Terkonfirmasi</option>
                <option value="batal" {{ $transaksi->status == 'batal' ? 'selected' : '' }}>Batalkan Pesanan</option>
            </select>
            <button type="submit" class="bg-[#1C1917] hover:bg-[#44403C] text-white px-3.5 py-1.5 rounded-lg text-xs font-bold transition-colors">
                Perbarui Status
            </button>
        </form>
    </div>

    <!-- Main Invoice Card -->
    <div class="bg-white border border-[#D6D3D1] rounded-[16px] p-8 shadow-sm">
        
        <!-- Invoice Header -->
        <div class="flex justify-between items-start border-b border-[#D6D3D1] pb-6 mb-6">
            <div>
                <h2 class="text-3xl font-bold text-[#1C1917] font-display">BUMDes<span class="text-[#C2410C]">GO</span></h2>
                <p class="text-sm text-[#78716C] mt-1">Invoice Resmi Transaksi Penjualan</p>
            </div>
            <div class="text-right">
                <h3 class="text-xl font-bold text-[#1C1917]">#ORD-{{ str_pad($transaksi->id_transaksi, 5, '0', STR_PAD_LEFT) }}</h3>
                <p class="text-sm text-[#57534E] mt-1">{{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d F Y, H:i') }} WIB</p>
                <div class="mt-2">
                    <span class="inline-block px-2.5 py-0.5 rounded text-xs font-black uppercase
                        {{ $transaksi->status == 'selesai' ? 'bg-emerald-100 text-emerald-800' : ($transaksi->status == 'batal' ? 'bg-red-100 text-red-800' : 'bg-amber-100 text-amber-800') }}">
                        Status: {{ $transaksi->status }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Customer & Order Info Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 text-sm bg-stone-50 p-5 rounded-xl border border-stone-200">
            <!-- Customer Side -->
            <div>
                <span class="block font-bold text-[#78716C] uppercase tracking-wide text-xs mb-1.5">Informasi Pembeli / Pelanggan</span>
                @if($transaksi->pelanggan)
                    <p class="font-bold text-[#1C1917] text-base">{{ $transaksi->pelanggan->nama }}</p>
                    <p class="text-[#57534E] text-xs mt-0.5">Email: {{ $transaksi->pelanggan->email ?: '-' }}</p>
                    <p class="text-[#57534E] text-xs">WhatsApp/Telp: {{ $transaksi->pelanggan->no_hp ?: '-' }}</p>
                    @if($transaksi->alamat_pengiriman)
                        <div class="mt-2 pt-2 border-t border-stone-200">
                            <span class="font-bold text-[#78716C] text-xs">Alamat Pengiriman:</span>
                            <p class="text-[#1C1917] text-xs font-medium mt-0.5">{{ $transaksi->alamat_pengiriman }}</p>
                        </div>
                    @endif
                @else
                    <p class="font-semibold text-[#1C1917] text-base">Pelanggan Kasir POS Langsung</p>
                    <p class="text-[#78716C] text-xs mt-1">Transaksi langsung di kantor BUMDes.</p>
                @endif

                @if($transaksi->catatan)
                    <div class="mt-2 pt-2 border-t border-stone-200">
                        <span class="font-bold text-[#78716C] text-xs">Catatan Pembeli:</span>
                        <p class="text-[#1C1917] text-xs italic">{{ $transaksi->catatan }}</p>
                    </div>
                @endif
            </div>

            <!-- Transaction Side -->
            <div class="md:text-right">
                <span class="block font-bold text-[#78716C] uppercase tracking-wide text-xs mb-1.5">Rincian Pembayaran</span>
                <p class="font-bold text-[#1C1917] text-base uppercase">{{ $transaksi->metode_bayar }}</p>
                <p class="text-[#57534E] text-xs mt-1">
                    <span class="font-semibold text-[#78716C]">Petugas / Kasir:</span>
                    {{ $transaksi->user->nama ?? 'Admin BUMDes' }}
                </p>
            </div>
        </div>

        <!-- Items Table -->
        <table class="w-full text-left mb-8">
            <thead>
                <tr class="border-y border-[#D6D3D1] bg-[#FAFAF9]">
                    <th class="py-3 px-4 text-xs font-bold text-[#78716C] uppercase tracking-wider">Produk</th>
                    <th class="py-3 px-4 text-xs font-bold text-[#78716C] uppercase tracking-wider text-center">Jumlah</th>
                    <th class="py-3 px-4 text-xs font-bold text-[#78716C] uppercase tracking-wider text-right">Harga Satuan</th>
                    <th class="py-3 px-4 text-xs font-bold text-[#78716C] uppercase tracking-wider text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#E7E5E4]">
                @foreach($transaksi->detail as $dt)
                <tr>
                    <td class="py-4 px-4">
                        <p class="font-semibold text-[#1C1917] text-sm">{{ $dt->produk->nama_produk ?? 'Produk Komoditas' }}</p>
                        <p class="text-xs text-[#78716C]">{{ $dt->produk->kategori->nama_kategori ?? 'Umum' }}</p>
                    </td>
                    <td class="py-4 px-4 text-center text-[#1C1917] text-sm font-bold">
                        {{ $dt->jumlah }} {{ $dt->produk->satuan ?? 'unit' }}
                    </td>
                    <td class="py-4 px-4 text-right text-[#57534E] text-sm">
                        Rp {{ number_format($dt->harga, 0, ',', '.') }}
                    </td>
                    <td class="py-4 px-4 text-right font-bold text-[#1C1917] text-sm">
                        Rp {{ number_format($dt->subtotal, 0, ',', '.') }}
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="border-t-2 border-[#1C1917]">
                    <td colspan="3" class="py-4 px-4 text-right font-bold text-[#1C1917] text-base uppercase">
                        Total Tagihan
                    </td>
                    <td class="py-4 px-4 text-right font-bold text-[#C2410C] text-xl">
                        Rp {{ number_format($transaksi->total, 0, ',', '.') }}
                    </td>
                </tr>
            </tfoot>
        </table>

        <!-- Actions -->
        <div class="flex justify-between items-center pt-4 border-t border-[#E7E5E4] print:hidden">
            <a href="{{ route('admin.transaksi.index') }}" class="text-[#57534E] hover:text-[#1C1917] font-semibold text-sm transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Daftar Transaksi
            </a>
            <button onclick="window.print()" class="bg-[#1C1917] hover:bg-[#44403C] text-white px-5 py-2.5 rounded-[10px] text-sm font-semibold transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                Cetak Invoice
            </button>
        </div>
    </div>
</div>

<style>
    @media print {
        body { background: white !important; }
        aside, header, .print\:hidden { display: none !important; }
        main { padding: 0 !important; margin: 0 !important; overflow: visible !important; }
        .max-w-4xl { max-width: 100% !important; border: none !important; box-shadow: none !important; }
    }
</style>
@endsection
