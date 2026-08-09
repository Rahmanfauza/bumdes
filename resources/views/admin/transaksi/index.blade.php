@extends('layouts.admin')

@section('header_title', 'Pengelolaan Transaksi Penjualan')

@section('content')
<div class="space-y-6">

    <!-- Header Section -->
    <div class="bg-white border border-[#D6D3D1] rounded-[16px] p-6 shadow-sm flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-[#1C1917] font-display">Pengelolaan Transaksi & Pesanan</h2>
            <p class="text-sm text-[#57534E] mt-1">Kelola pesanan masuk dari pembeli (User / Pelanggan) dan transaksi kasir langsung.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.transaksi.create') }}" class="bg-[#C2410C] hover:bg-[#9A3412] text-white px-4 py-2.5 rounded-[10px] text-sm font-semibold transition-all shadow-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                <span>Catat Transaksi POS (Kasir)</span>
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl text-sm font-medium flex items-center gap-2">
            <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl text-sm font-medium flex items-center gap-2">
            <svg class="w-5 h-5 text-red-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <span>{{ $errors->first() }}</span>
        </div>
    @endif

    <!-- Status Tabs / Filter Navigation -->
    <div class="flex flex-wrap gap-2">
        <a href="{{ route('admin.transaksi.index', ['status' => 'all']) }}" 
           class="px-4 py-2 rounded-lg text-xs font-bold transition-all flex items-center gap-2 {{ !$statusFilter || $statusFilter == 'all' ? 'bg-[#1C1917] text-white shadow-sm' : 'bg-white border border-[#D6D3D1] text-[#57534E] hover:bg-[#F5F5F4]' }}">
            <span>Semua Transaksi</span>
            <span class="px-1.5 py-0.2 rounded-full text-[10px] {{ !$statusFilter || $statusFilter == 'all' ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-700' }}">{{ $countSemua }}</span>
        </a>

        <a href="{{ route('admin.transaksi.index', ['status' => 'menunggu_konfirmasi']) }}" 
           class="px-4 py-2 rounded-lg text-xs font-bold transition-all flex items-center gap-2 {{ $statusFilter == 'menunggu_konfirmasi' ? 'bg-[#F59E0B] text-[#1C1917] shadow-sm' : 'bg-white border border-[#D6D3D1] text-[#57534E] hover:bg-[#F5F5F4]' }}">
            <span class="w-2 h-2 rounded-full bg-amber-500 {{ $countMenunggu > 0 ? 'animate-ping' : '' }}"></span>
            <span>Menunggu Konfirmasi</span>
            <span class="px-1.5 py-0.2 rounded-full text-[10px] {{ $statusFilter == 'menunggu_konfirmasi' ? 'bg-white text-[#1C1917] font-black' : 'bg-amber-100 text-amber-900 font-black' }}">{{ $countMenunggu }}</span>
        </a>

        <a href="{{ route('admin.transaksi.index', ['status' => 'diproses']) }}" 
           class="px-4 py-2 rounded-lg text-xs font-bold transition-all flex items-center gap-2 {{ $statusFilter == 'diproses' ? 'bg-[#0284C7] text-white shadow-sm' : 'bg-white border border-[#D6D3D1] text-[#57534E] hover:bg-[#F5F5F4]' }}">
            <span>Sedang Diproses</span>
            <span class="px-1.5 py-0.2 rounded-full text-[10px] {{ $statusFilter == 'diproses' ? 'bg-white/20 text-white' : 'bg-sky-100 text-sky-800' }}">{{ $countDiproses }}</span>
        </a>

        <a href="{{ route('admin.transaksi.index', ['status' => 'selesai']) }}" 
           class="px-4 py-2 rounded-lg text-xs font-bold transition-all flex items-center gap-2 {{ $statusFilter == 'selesai' ? 'bg-[#10B981] text-white shadow-sm' : 'bg-white border border-[#D6D3D1] text-[#57534E] hover:bg-[#F5F5F4]' }}">
            <span>Selesai</span>
            <span class="px-1.5 py-0.2 rounded-full text-[10px] {{ $statusFilter == 'selesai' ? 'bg-white/20 text-white' : 'bg-emerald-100 text-emerald-800' }}">{{ $countSelesai }}</span>
        </a>

        <a href="{{ route('admin.transaksi.index', ['status' => 'batal']) }}" 
           class="px-4 py-2 rounded-lg text-xs font-bold transition-all flex items-center gap-2 {{ $statusFilter == 'batal' ? 'bg-[#EF4444] text-white shadow-sm' : 'bg-white border border-[#D6D3D1] text-[#57534E] hover:bg-[#F5F5F4]' }}">
            <span>Dibatalkan</span>
            <span class="px-1.5 py-0.2 rounded-full text-[10px] {{ $statusFilter == 'batal' ? 'bg-white/20 text-white' : 'bg-red-100 text-red-800' }}">{{ $countBatal }}</span>
        </a>
    </div>

    <!-- Table Container -->
    <div class="bg-white border border-[#D6D3D1] rounded-[16px] shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-[#D6D3D1] bg-[#FAFAF9]">
                        <th class="py-3.5 px-4 text-xs font-bold text-[#78716C] uppercase tracking-wider">ID & Waktu</th>
                        <th class="py-3.5 px-4 text-xs font-bold text-[#78716C] uppercase tracking-wider">Sumber / Pembeli</th>
                        <th class="py-3.5 px-4 text-xs font-bold text-[#78716C] uppercase tracking-wider">Rincian Komoditas</th>
                        <th class="py-3.5 px-4 text-xs font-bold text-[#78716C] uppercase tracking-wider">Total & Metode</th>
                        <th class="py-3.5 px-4 text-xs font-bold text-[#78716C] uppercase tracking-wider text-center">Status</th>
                        <th class="py-3.5 px-4 text-xs font-bold text-[#78716C] uppercase tracking-wider text-right">Kelola / Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#E7E5E4] text-sm">
                    @forelse($transaksis as $trx)
                    <tr class="hover:bg-[#F5F5F4]/80 transition-colors {{ $trx->status == 'menunggu_konfirmasi' ? 'bg-amber-50/40' : '' }}">
                        <!-- ID & Date -->
                        <td class="py-4 px-4 align-top">
                            <div class="font-bold text-[#1C1917]">
                                #ORD-{{ str_pad($trx->id_transaksi, 5, '0', STR_PAD_LEFT) }}
                            </div>
                            <div class="text-xs text-[#78716C] mt-0.5">
                                {{ \Carbon\Carbon::parse($trx->tanggal)->format('d M Y, H:i') }}
                            </div>
                        </td>

                        <!-- Customer / Source -->
                        <td class="py-4 px-4 align-top">
                            @if($trx->pelanggan)
                                <div class="flex items-center gap-1.5 font-bold text-[#1C1917]">
                                    <span class="bg-blue-100 text-blue-800 text-[10px] font-black px-1.5 py-0.5 rounded">User Online</span>
                                    <span>{{ $trx->pelanggan->nama }}</span>
                                </div>
                                <div class="text-xs text-[#57534E] mt-0.5">
                                    📞 {{ $trx->pelanggan->no_hp ?: '-' }}
                                </div>
                                @if($trx->alamat_pengiriman)
                                    <div class="text-[11px] text-[#78716C] mt-1 max-w-xs line-clamp-1" title="{{ $trx->alamat_pengiriman }}">
                                        📍 {{ $trx->alamat_pengiriman }}
                                    </div>
                                @endif
                            @else
                                <div class="flex items-center gap-1.5 font-bold text-[#57534E]">
                                    <span class="bg-stone-100 text-stone-700 text-[10px] font-bold px-1.5 py-0.5 rounded">POS Offline</span>
                                    <span>Pelanggan Kasir</span>
                                </div>
                                <div class="text-xs text-[#78716C] mt-0.5">
                                    Kasir: {{ $trx->user->nama ?? 'Admin' }}
                                </div>
                            @endif
                        </td>

                        <!-- Items ordered -->
                        <td class="py-4 px-4 align-top">
                            <div class="space-y-1">
                                @foreach($trx->detail as $item)
                                    <div class="text-xs text-[#1C1917] font-medium flex items-center gap-1">
                                        <span class="font-bold text-[#C2410C]">• {{ $item->jumlah }}x</span>
                                        <span>{{ $item->produk->nama_produk ?? 'Produk' }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </td>

                        <!-- Total & Payment -->
                        <td class="py-4 px-4 align-top">
                            <div class="font-bold text-[#1C1917] text-base">
                                Rp {{ number_format($trx->total, 0, ',', '.') }}
                            </div>
                            <div class="text-xs text-[#57534E] capitalize font-medium mt-0.5">
                                {{ $trx->metode_bayar }}
                            </div>
                        </td>

                        <!-- Status Badge -->
                        <td class="py-4 px-4 align-top text-center">
                            @if($trx->status == 'menunggu_konfirmasi')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-black bg-amber-100 text-amber-900 border border-amber-300 animate-pulse">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span>
                                    Menunggu
                                </span>
                            @elseif($trx->status == 'diproses')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-sky-100 text-sky-900 border border-sky-300">
                                    Diproses
                                </span>
                            @elseif($trx->status == 'selesai')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-900 border border-emerald-300">
                                    ✓ Selesai
                                </span>
                            @elseif($trx->status == 'batal')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-red-100 text-red-900 border border-red-300">
                                    ✕ Dibatalkan
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-stone-100 text-stone-800">
                                    {{ $trx->status }}
                                </span>
                            @endif
                        </td>

                        <!-- Action Buttons -->
                        <td class="py-4 px-4 align-top text-right">
                            <div class="flex items-center justify-end gap-1.5 flex-wrap">
                                <!-- Status Update Forms -->
                                @if($trx->status == 'menunggu_konfirmasi')
                                    <form action="{{ route('admin.transaksi.update-status', $trx->id_transaksi) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="selesai">
                                        <button type="submit" onclick="return confirm('Konfirmasi dan selesaikan pesanan #ORD-{{ $trx->id_transaksi }}?')" 
                                                class="px-2.5 py-1 bg-emerald-600 hover:bg-emerald-700 text-white rounded text-xs font-bold transition-colors shadow-xs" title="Konfirmasi & Selesaikan">
                                            ✓ Konfirmasi
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.transaksi.update-status', $trx->id_transaksi) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="batal">
                                        <button type="submit" onclick="return confirm('Tolak / batalkan pesanan #ORD-{{ $trx->id_transaksi }}? Stok produk akan dikembalikan.')" 
                                                class="px-2 py-1 bg-red-100 hover:bg-red-200 text-red-700 rounded text-xs font-bold transition-colors" title="Tolak Pesanan">
                                            ✕ Tolak
                                        </button>
                                    </form>
                                @elseif($trx->status == 'diproses')
                                    <form action="{{ route('admin.transaksi.update-status', $trx->id_transaksi) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="selesai">
                                        <button type="submit" class="px-2.5 py-1 bg-emerald-600 hover:bg-emerald-700 text-white rounded text-xs font-bold transition-colors">
                                            ✓ Selesaikan
                                        </button>
                                    </form>
                                @endif

                                <a href="{{ route('admin.transaksi.show', $trx->id_transaksi) }}" 
                                   class="text-[#0284C7] hover:text-[#0369A1] font-semibold text-xs border border-[#0284C7] hover:bg-[#E0F2FE] px-2.5 py-1 rounded transition-colors">
                                    Detail
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-12 text-center text-sm text-[#78716C]">
                            <svg class="w-10 h-10 mx-auto text-stone-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                            Tidak ada data transaksi yang sesuai filter.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
