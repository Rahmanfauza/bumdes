@extends('layouts.admin')

@section('header_title', 'Administrasi Persuratan')

@section('content')
<div class="bg-white border border-[#D6D3D1] rounded-[12px] p-6 shadow-sm">
    <div class="flex items-center justify-between mb-4">
        <div>
            <h2 class="text-xl font-semibold text-[#1C1917]">Daftar Surat</h2>
            <p class="text-sm text-[#57534E]">Pengelolaan surat masuk dan keluar BUMDes.</p>
        </div>
        <a href="{{ route('admin.surat.create') }}" class="bg-[#C2410C] hover:bg-[#9A3412] text-white px-4 py-2 rounded-[8px] text-sm font-semibold transition-colors flex items-center gap-2 shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Buat Surat
        </a>
    </div>

    <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-[8px] flex items-start gap-3">
        <svg class="w-5 h-5 text-blue-600 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <div>
            <h4 class="text-sm font-bold text-blue-800 mb-1">Panduan Status Persetujuan (Approval)</h4>
            <ul class="text-sm text-blue-700 list-disc pl-4 space-y-1">
                <li><span class="font-semibold uppercase text-xs px-1.5 py-0.5 rounded bg-gray-200 text-gray-800">Draft</span> : Dokumen masih berupa rancangan, belum dikirim ke Direktur.</li>
                <li><span class="font-semibold uppercase text-xs px-1.5 py-0.5 rounded bg-blue-200 text-blue-800">Diajukan</span> : Dokumen telah dikirim ke panel Direktur dan sedang menunggu keputusan.</li>
                <li><span class="font-semibold uppercase text-xs px-1.5 py-0.5 rounded bg-green-200 text-green-800">Disetujui</span> / <span class="font-semibold uppercase text-xs px-1.5 py-0.5 rounded bg-red-200 text-red-800">Ditolak</span> : Keputusan final dari Direktur.</li>
            </ul>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-[#D6D3D1] bg-[#FAFAF9]">
                    <th class="py-3 px-4 text-xs font-semibold text-[#78716C] uppercase tracking-wider">No. Surat</th>
                    <th class="py-3 px-4 text-xs font-semibold text-[#78716C] uppercase tracking-wider">Jenis</th>
                    <th class="py-3 px-4 text-xs font-semibold text-[#78716C] uppercase tracking-wider">Perihal</th>
                    <th class="py-3 px-4 text-xs font-semibold text-[#78716C] uppercase tracking-wider">Pengirim / Penerima</th>
                    <th class="py-3 px-4 text-xs font-semibold text-[#78716C] uppercase tracking-wider">Status</th>
                    <th class="py-3 px-4 text-xs font-semibold text-[#78716C] uppercase tracking-wider text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#E7E5E4]">
                @forelse($surats as $item)
                <tr class="hover:bg-[#F5F5F4] transition-colors">
                    <td class="py-3 px-4 text-[14px] font-semibold text-[#1C1917]">{{ $item->nomor_surat }}</td>
                    <td class="py-3 px-4 text-[14px] text-[#57534E] capitalize">Surat {{ $item->jenis_surat }}</td>
                    <td class="py-3 px-4 text-[14px] text-[#57534E]">{{ $item->perihal }}</td>
                    <td class="py-3 px-4 text-[14px] text-[#57534E]">
                        @if($item->jenis_surat == 'masuk')
                            Dari: {{ $item->pengirim ?? '-' }}
                        @else
                            Kepada: {{ $item->penerima ?? '-' }}
                        @endif
                    </td>
                    <td class="py-3 px-4 text-[14px]">
                        @if($item->status == 'disetujui')
                            <span class="bg-green-100 text-green-700 px-2.5 py-1 rounded-full text-xs font-bold uppercase">Disetujui</span>
                        @elseif($item->status == 'ditolak')
                            <span class="bg-red-100 text-red-700 px-2.5 py-1 rounded-full text-xs font-bold uppercase">Ditolak</span>
                        @elseif($item->status == 'diajukan')
                            <span class="bg-blue-100 text-blue-700 px-2.5 py-1 rounded-full text-xs font-bold uppercase">Diajukan</span>
                        @else
                            <span class="bg-gray-100 text-gray-700 px-2.5 py-1 rounded-full text-xs font-bold uppercase">Draft</span>
                        @endif
                    </td>
                    <td class="py-3 px-4 text-[14px] text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.surat.edit', $item->id_surat) }}" class="text-[#D97706] hover:text-[#B45309] font-medium text-xs border border-[#D97706] hover:bg-[#FEF3C7] px-2 py-1 rounded transition-colors">Edit</a>
                            <form action="{{ route('admin.surat.destroy', $item->id_surat) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus surat ini?');" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-[#DC2626] hover:text-[#991B1B] font-medium text-xs border border-[#DC2626] hover:bg-[#FEE2E2] px-2 py-1 rounded transition-colors">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-6 text-center text-sm text-[#78716C]">Belum ada data surat.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
