@extends('layouts.admin')

@section('header_title', 'Buku Kas (Pemasukan & Pengeluaran)')

@section('content')
<!-- Ringkasan Saldo -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <div class="bg-white border border-[#D6D3D1] rounded-[12px] p-5 shadow-sm flex items-center justify-between">
        <div>
            <p class="text-sm font-semibold text-[#78716C] mb-1">Total Pemasukan</p>
            <h3 class="text-2xl font-bold text-[#16A34A]">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</h3>
        </div>
        <div class="w-12 h-12 bg-green-50 rounded-full flex items-center justify-center text-[#16A34A]">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m0-16l-4 4m4-4l4 4"></path></svg>
        </div>
    </div>
    
    <div class="bg-white border border-[#D6D3D1] rounded-[12px] p-5 shadow-sm flex items-center justify-between">
        <div>
            <p class="text-sm font-semibold text-[#78716C] mb-1">Total Pengeluaran</p>
            <h3 class="text-2xl font-bold text-[#DC2626]">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</h3>
        </div>
        <div class="w-12 h-12 bg-red-50 rounded-full flex items-center justify-center text-[#DC2626]">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20V4m0 16l4-4m-4 4l-4-4"></path></svg>
        </div>
    </div>
    
    <div class="bg-[#C2410C] rounded-[12px] p-5 shadow-sm flex items-center justify-between text-white">
        <div>
            <p class="text-sm font-medium opacity-80 mb-1">Saldo Akhir</p>
            <h3 class="text-2xl font-bold">Rp {{ number_format($saldo, 0, ',', '.') }}</h3>
        </div>
        <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6 text-sm">
        {{ session('success') }}
    </div>
@endif
@if($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-lg mb-6 text-sm">
        <ul class="list-disc pl-5">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Pemasukan -->
    <div class="bg-white border border-[#D6D3D1] rounded-[12px] p-6 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-[#1C1917]">Pemasukan Kas</h2>
            <button onclick="document.getElementById('modalPemasukan').classList.remove('hidden')" class="text-sm font-semibold text-[#C2410C] hover:text-[#9A3412]">+ Tambah</button>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-[#D6D3D1] bg-[#FAFAF9]">
                        <th class="py-2 px-3 text-xs font-semibold text-[#78716C] uppercase">Tanggal</th>
                        <th class="py-2 px-3 text-xs font-semibold text-[#78716C] uppercase">Keterangan</th>
                        <th class="py-2 px-3 text-xs font-semibold text-[#78716C] uppercase text-right">Nominal</th>
                        <th class="py-2 px-3 text-xs font-semibold text-[#78716C] uppercase text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#E7E5E4]">
                    @forelse($pemasukan as $p)
                    <tr class="hover:bg-[#F5F5F4]">
                        <td class="py-2 px-3 text-[13px] text-[#57534E]">{{ \Carbon\Carbon::parse($p->tanggal)->format('d M Y') }}</td>
                        <td class="py-2 px-3 text-[13px] text-[#1C1917]">
                            {{ $p->keterangan }}
                            @if($p->id_transaksi)
                                <span class="inline-block ml-2 px-2 py-0.5 bg-[#FDE68A] text-[#92400E] text-[10px] font-bold rounded">Otomatis (Sistem)</span>
                            @endif
                        </td>
                        <td class="py-2 px-3 text-[13px] font-bold text-[#16A34A] text-right">+ Rp {{ number_format($p->nominal, 0, ',', '.') }}</td>
                        <td class="py-2 px-3 text-center">
                            @if(!$p->id_transaksi)
                            <form action="{{ route('admin.kas.pemasukan.destroy', $p->id_pemasukan) }}" method="POST" onsubmit="return confirm('Hapus data ini?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-[#DC2626] hover:text-[#991B1B] text-xs font-semibold">Hapus</button>
                            </form>
                            @else
                            <span class="text-[#A8A29E] text-xs" title="Kas dari penjualan tidak bisa dihapus manual">-</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-4 text-center text-sm text-[#78716C]">Belum ada data pemasukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pengeluaran -->
    <div class="bg-white border border-[#D6D3D1] rounded-[12px] p-6 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-[#1C1917]">Pengeluaran Kas</h2>
            <button onclick="document.getElementById('modalPengeluaran').classList.remove('hidden')" class="text-sm font-semibold text-[#C2410C] hover:text-[#9A3412]">+ Tambah</button>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-[#D6D3D1] bg-[#FAFAF9]">
                        <th class="py-2 px-3 text-xs font-semibold text-[#78716C] uppercase">Tanggal</th>
                        <th class="py-2 px-3 text-xs font-semibold text-[#78716C] uppercase">Keterangan</th>
                        <th class="py-2 px-3 text-xs font-semibold text-[#78716C] uppercase text-right">Nominal</th>
                        <th class="py-2 px-3 text-xs font-semibold text-[#78716C] uppercase text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#E7E5E4]">
                    @forelse($pengeluaran as $p)
                    <tr class="hover:bg-[#F5F5F4]">
                        <td class="py-2 px-3 text-[13px] text-[#57534E]">{{ \Carbon\Carbon::parse($p->tanggal)->format('d M Y') }}</td>
                        <td class="py-2 px-3 text-[13px] text-[#1C1917]">{{ $p->keterangan }}</td>
                        <td class="py-2 px-3 text-[13px] font-bold text-[#DC2626] text-right">- Rp {{ number_format($p->nominal, 0, ',', '.') }}</td>
                        <td class="py-2 px-3 text-center">
                            <form action="{{ route('admin.kas.pengeluaran.destroy', $p->id_pengeluaran) }}" method="POST" onsubmit="return confirm('Hapus data ini?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-[#DC2626] hover:text-[#991B1B] text-xs font-semibold">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-4 text-center text-sm text-[#78716C]">Belum ada data pengeluaran.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Pemasukan -->
<div id="modalPemasukan" class="fixed inset-0 z-50 hidden bg-[#1C1917]/50 flex items-center justify-center backdrop-blur-sm p-4">
    <div class="bg-white rounded-[12px] w-full max-w-md p-6 shadow-xl relative">
        <h3 class="text-lg font-bold text-[#16A34A] mb-4">Catat Pemasukan Kas</h3>
        <form action="{{ route('admin.kas.pemasukan.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-[#1C1917] mb-1">Tanggal</label>
                <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" class="w-full px-4 py-2 border rounded-[8px]" required>
            </div>
            <div>
                <label class="block text-sm font-semibold text-[#1C1917] mb-1">Nominal (Rp)</label>
                <input type="number" name="nominal" class="w-full px-4 py-2 border rounded-[8px]" required min="1">
            </div>
            <div>
                <label class="block text-sm font-semibold text-[#1C1917] mb-1">Keterangan</label>
                <input type="text" name="keterangan" class="w-full px-4 py-2 border rounded-[8px]" required placeholder="Contoh: Pendapatan layanan air">
            </div>
            <div class="pt-4 flex justify-end gap-3">
                <button type="button" onclick="document.getElementById('modalPemasukan').classList.add('hidden')" class="px-4 py-2 text-sm font-semibold">Batal</button>
                <button type="submit" class="bg-[#16A34A] text-white px-5 py-2 rounded-[8px] text-sm font-bold">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Pengeluaran -->
<div id="modalPengeluaran" class="fixed inset-0 z-50 hidden bg-[#1C1917]/50 flex items-center justify-center backdrop-blur-sm p-4">
    <div class="bg-white rounded-[12px] w-full max-w-md p-6 shadow-xl relative">
        <h3 class="text-lg font-bold text-[#DC2626] mb-4">Catat Pengeluaran Kas</h3>
        <form action="{{ route('admin.kas.pengeluaran.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-[#1C1917] mb-1">Tanggal</label>
                <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" class="w-full px-4 py-2 border rounded-[8px]" required>
            </div>
            <div>
                <label class="block text-sm font-semibold text-[#1C1917] mb-1">Nominal (Rp)</label>
                <input type="number" name="nominal" class="w-full px-4 py-2 border rounded-[8px]" required min="1">
            </div>
            <div>
                <label class="block text-sm font-semibold text-[#1C1917] mb-1">Keterangan</label>
                <input type="text" name="keterangan" class="w-full px-4 py-2 border rounded-[8px]" required placeholder="Contoh: Pembelian alat tulis">
            </div>
            <div class="pt-4 flex justify-end gap-3">
                <button type="button" onclick="document.getElementById('modalPengeluaran').classList.add('hidden')" class="px-4 py-2 text-sm font-semibold">Batal</button>
                <button type="submit" class="bg-[#DC2626] text-white px-5 py-2 rounded-[8px] text-sm font-bold">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
