@extends('layouts.admin')

@section('header_title', 'Kelola Produk & Jasa')

@section('content')
<div class="bg-white border border-[#D6D3D1] rounded-[12px] p-6 shadow-sm">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <h2 class="text-xl font-semibold text-[#1C1917]">Daftar Produk BUMDes</h2>
            <p class="text-sm text-[#57534E]">Manajemen inventaris barang, komoditas lokal, dan jasa BUMDes.</p>
        </div>
        <a href="{{ route('admin.produk.create') }}" class="bg-[#C2410C] hover:bg-[#9A3412] text-white px-4 py-2.5 rounded-[8px] text-sm font-semibold transition-colors flex items-center gap-2 self-start sm:self-auto shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Produk Baru
        </a>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-lg mb-6 text-sm flex items-center gap-2">
            <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="overflow-x-auto border border-[#E7E5E4] rounded-lg">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-[#D6D3D1] bg-[#FAFAF9]">
                    <th class="py-3.5 px-4 text-xs font-bold text-[#78716C] uppercase tracking-wider">No</th>
                    <th class="py-3.5 px-4 text-xs font-bold text-[#78716C] uppercase tracking-wider">Foto Produk</th>
                    <th class="py-3.5 px-4 text-xs font-bold text-[#78716C] uppercase tracking-wider">Nama Produk</th>
                    <th class="py-3.5 px-4 text-xs font-bold text-[#78716C] uppercase tracking-wider">Kategori</th>
                    <th class="py-3.5 px-4 text-xs font-bold text-[#78716C] uppercase tracking-wider">Harga</th>
                    <th class="py-3.5 px-4 text-xs font-bold text-[#78716C] uppercase tracking-wider">Stok</th>
                    <th class="py-3.5 px-4 text-xs font-bold text-[#78716C] uppercase tracking-wider">Status</th>
                    <th class="py-3.5 px-4 text-xs font-bold text-[#78716C] uppercase tracking-wider text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#E7E5E4]">
                @forelse($produks as $idx => $item)
                <tr class="hover:bg-[#F5F5F4] transition-colors">
                    <td class="py-3.5 px-4 text-sm text-[#57534E]">{{ $idx + 1 }}</td>
                    <td class="py-3.5 px-4">
                        <div class="w-14 h-14 rounded-lg bg-slate-100 overflow-hidden border border-slate-200 shrink-0">
                            @if($item->gambar && \Illuminate\Support\Facades\Storage::disk('public')->exists($item->gambar))
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_produk }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center bg-slate-100 text-slate-400 text-[10px]">
                                    <svg class="w-5 h-5 mb-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>No Img</span>
                                </div>
                            @endif
                        </div>
                    </td>
                    <td class="py-3.5 px-4">
                        <div class="font-bold text-[#1C1917] text-sm">{{ $item->nama_produk }}</div>
                        @if($item->deskripsi)
                            <p class="text-xs text-[#78716C] line-clamp-1 max-w-xs">{{ $item->deskripsi }}</p>
                        @endif
                    </td>
                    <td class="py-3.5 px-4 text-sm text-[#57534E]">
                        <span class="inline-flex px-2 py-0.5 rounded-md bg-slate-100 text-slate-700 text-xs font-semibold">
                            {{ $item->kategori->nama_kategori ?? '-' }}
                        </span>
                    </td>
                    <td class="py-3.5 px-4 text-sm font-semibold text-[#1C1917]">
                        Rp {{ number_format($item->harga, 0, ',', '.') }}
                    </td>
                    <td class="py-3.5 px-4 text-sm text-[#57534E]">
                        <span class="font-semibold text-[#1C1917]">{{ $item->stok }}</span> {{ $item->satuan }}
                    </td>
                    <td class="py-3.5 px-4 text-sm">
                        @if($item->status == 'aktif')
                            <span class="bg-emerald-100 text-emerald-800 px-2.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider inline-flex items-center gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>
                                Aktif
                            </span>
                        @else
                            <span class="bg-rose-100 text-rose-800 px-2.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider inline-flex items-center gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-rose-600"></span>
                                Nonaktif
                            </span>
                        @endif
                    </td>
                    <td class="py-3.5 px-4 text-sm text-right whitespace-nowrap">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.produk.edit', $item->id_produk) }}" class="text-[#D97706] hover:text-[#B45309] font-semibold text-xs border border-[#D97706]/40 hover:bg-[#FEF3C7] px-2.5 py-1 rounded transition-colors flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                Edit
                            </a>
                            <form action="{{ route('admin.produk.destroy', $item->id_produk) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-[#DC2626] hover:text-[#991B1B] font-semibold text-xs border border-[#DC2626]/40 hover:bg-[#FEE2E2] px-2.5 py-1 rounded transition-colors flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="py-10 text-center text-sm text-[#78716C]">
                        <div class="flex flex-col items-center justify-center">
                            <svg class="w-12 h-12 text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                            <p class="font-medium text-slate-600">Belum ada produk yang ditambahkan.</p>
                            <a href="{{ route('admin.produk.create') }}" class="mt-2 text-xs font-bold text-[#C2410C] hover:underline">Tambah Produk Pertama →</a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
