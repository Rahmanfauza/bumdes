@extends('layouts.admin')

@section('header_title', 'Approval Dokumen')

@section('content')
<div class="mb-6">
    <h2 class="text-xl font-semibold text-[#1C1917]">Persetujuan Dokumen & Surat</h2>
    <p class="text-sm text-[#57534E]">Tinjau dan berikan persetujuan untuk surat/dokumen yang diajukan oleh Sekretaris.</p>
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

<!-- Dokumen Menunggu Persetujuan -->
<div class="bg-white border border-[#D6D3D1] rounded-[12px] p-6 shadow-sm mb-6">
    <h3 class="text-lg font-bold text-[#C2410C] mb-4 flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        Menunggu Persetujuan
    </h3>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-[#D6D3D1] bg-[#FFF7ED]">
                    <th class="py-3 px-4 text-xs font-semibold text-[#78716C] uppercase">Tgl Diajukan</th>
                    <th class="py-3 px-4 text-xs font-semibold text-[#78716C] uppercase">No. Surat</th>
                    <th class="py-3 px-4 text-xs font-semibold text-[#78716C] uppercase">Perihal</th>
                    <th class="py-3 px-4 text-xs font-semibold text-[#78716C] uppercase">Status</th>
                    <th class="py-3 px-4 text-xs font-semibold text-[#78716C] uppercase text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#E7E5E4]">
                @forelse($suratMenunggu as $s)
                <tr class="hover:bg-[#F5F5F4] transition-colors">
                    <td class="py-3 px-4 text-[14px] text-[#57534E]">{{ $s->updated_at->format('d M Y, H:i') }}</td>
                    <td class="py-3 px-4 text-[14px] font-semibold text-[#1C1917]">{{ $s->nomor_surat }}</td>
                    <td class="py-3 px-4 text-[14px] text-[#57534E]">{{ $s->perihal }}</td>
                    <td class="py-3 px-4 text-[14px]">
                        <span class="bg-blue-100 text-blue-700 px-2.5 py-1 rounded-full text-xs font-bold uppercase mb-2 inline-block">Diajukan</span>
                        @if($s->arsip)
                            <br>
                            <a href="{{ Storage::url($s->arsip->nama_file) }}" target="_blank" class="inline-flex items-center gap-1 text-xs font-semibold text-blue-600 hover:text-blue-800 hover:underline">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                                Lihat Dokumen
                            </a>
                        @endif
                    </td>
                    <td class="py-3 px-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <!-- Approve -->
                            <form action="{{ route('admin.approval.update', $s->id_surat) }}" method="POST" onsubmit="return confirm('Setujui dokumen ini?');">
                                @csrf @method('PUT')
                                <input type="hidden" name="status" value="disetujui">
                                <button type="submit" class="bg-[#16A34A] hover:bg-[#15803D] text-white font-medium text-xs px-3 py-1.5 rounded transition-colors flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Setujui
                                </button>
                            </form>
                            <!-- Reject -->
                            <form action="{{ route('admin.approval.update', $s->id_surat) }}" method="POST" onsubmit="return confirm('Tolak dokumen ini?');">
                                @csrf @method('PUT')
                                <input type="hidden" name="status" value="ditolak">
                                <button type="submit" class="bg-[#DC2626] hover:bg-[#B91C1C] text-white font-medium text-xs px-3 py-1.5 rounded transition-colors flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg> Tolak
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-8 text-center text-sm text-[#78716C]">
                        <svg class="w-12 h-12 mx-auto text-[#D6D3D1] mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Tidak ada dokumen yang menunggu persetujuan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Riwayat Persetujuan -->
<div class="bg-white border border-[#D6D3D1] rounded-[12px] p-6 shadow-sm">
    <h3 class="text-lg font-bold text-[#1C1917] mb-4">Riwayat Approval</h3>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse opacity-80">
            <thead>
                <tr class="border-b border-[#D6D3D1] bg-[#FAFAF9]">
                    <th class="py-2 px-3 text-xs font-semibold text-[#78716C] uppercase">Tgl Proses</th>
                    <th class="py-2 px-3 text-xs font-semibold text-[#78716C] uppercase">No. Surat</th>
                    <th class="py-2 px-3 text-xs font-semibold text-[#78716C] uppercase">Perihal</th>
                    <th class="py-2 px-3 text-xs font-semibold text-[#78716C] uppercase text-right">Keputusan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#E7E5E4]">
                @forelse($suratSelesai as $s)
                <tr class="hover:bg-[#F5F5F4] transition-colors">
                    <td class="py-2 px-3 text-[13px] text-[#57534E]">{{ $s->updated_at->format('d M Y, H:i') }}</td>
                    <td class="py-2 px-3 text-[13px] font-semibold text-[#1C1917]">{{ $s->nomor_surat }}</td>
                    <td class="py-2 px-3 text-[13px] text-[#57534E]">{{ $s->perihal }}</td>
                    <td class="py-2 px-3 text-[13px] text-right">
                        @if($s->status == 'disetujui')
                            <span class="text-green-700 font-bold uppercase text-xs"><svg class="w-3.5 h-3.5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Disetujui</span>
                        @else
                            <span class="text-red-700 font-bold uppercase text-xs"><svg class="w-3.5 h-3.5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg> Ditolak</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="py-4 text-center text-sm text-[#78716C]">Belum ada riwayat persetujuan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
