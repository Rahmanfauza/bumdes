@extends('layouts.admin')

@section('header_title', 'Arsip Digital')

@section('content')
<div class="bg-white border border-[#D6D3D1] rounded-[12px] p-6 shadow-sm">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-xl font-semibold text-[#1C1917]">Penyimpanan Arsip Digital</h2>
            <p class="text-sm text-[#57534E]">Kelola dokumen dan file BUMDes secara aman.</p>
        </div>
        <button type="button" onclick="document.getElementById('uploadModal').classList.remove('hidden')" class="bg-[#C2410C] hover:bg-[#9A3412] text-white px-4 py-2 rounded-[8px] text-sm font-semibold transition-colors flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
            Unggah File
        </button>
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

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @forelse($arsips as $arsip)
        <div class="border border-[#D6D3D1] rounded-[12px] p-4 flex flex-col justify-between hover:border-[#C2410C] transition-colors group">
            <div>
                <div class="w-12 h-12 rounded-lg bg-[#FAFAF9] border border-[#E7E5E4] flex items-center justify-center mb-3 text-[#A8A29E] group-hover:text-[#C2410C]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                </div>
                <h3 class="font-semibold text-[#1C1917] text-sm truncate" title="{{ basename($arsip->nama_file) }}">
                    {{ basename($arsip->nama_file) }}
                </h3>
                <p class="text-xs text-[#78716C] mt-1">{{ \Carbon\Carbon::parse($arsip->upload_date)->format('d M Y, H:i') }}</p>
                <p class="text-xs text-[#57534E] mt-0.5 capitalize">{{ $arsip->kategori ?? 'Umum' }}</p>
            </div>
            
            <div class="mt-4 pt-3 border-t border-[#E7E5E4] flex items-center justify-between">
                <a href="{{ Storage::url($arsip->nama_file) }}" target="_blank" class="text-[#0284C7] hover:text-[#0369A1] font-semibold text-xs">Download</a>
                
                <form action="{{ route('admin.arsip.destroy', $arsip->id_arsip) }}" method="POST" onsubmit="return confirm('Hapus file ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-[#DC2626] hover:text-[#991B1B] font-semibold text-xs">Hapus</button>
                </form>
            </div>
        </div>
        @empty
        <div class="col-span-full py-10 text-center text-[#78716C]">
            <svg class="w-12 h-12 mx-auto mb-3 text-[#D6D3D1]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
            Belum ada arsip yang diunggah.
        </div>
        @endforelse
    </div>
</div>

<!-- Modal Upload -->
<div id="uploadModal" class="fixed inset-0 z-50 hidden bg-[#1C1917]/50 flex items-center justify-center backdrop-blur-sm p-4">
    <div class="bg-white rounded-[12px] w-full max-w-md p-6 shadow-xl relative">
        <button type="button" onclick="document.getElementById('uploadModal').classList.add('hidden')" class="absolute top-4 right-4 text-[#78716C] hover:text-[#1C1917]">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        
        <h3 class="text-lg font-semibold text-[#1C1917] mb-4">Unggah Arsip Digital</h3>
        
        <form action="{{ route('admin.arsip.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-[#1C1917] mb-1.5">File Dokumen</label>
                <input type="file" name="file" class="w-full text-sm text-[#57534E] file:mr-4 file:py-2 file:px-4 file:rounded-[6px] file:border-0 file:text-sm file:font-semibold file:bg-[#FAFAF9] file:text-[#C2410C] hover:file:bg-[#F5F5F4] cursor-pointer" required>
                <p class="text-xs text-[#78716C] mt-1">Maks 10MB (PDF, DOC, DOCX, JPG, PNG, ZIP)</p>
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-[#1C1917] mb-1.5">Kategori</label>
                <input type="text" name="kategori" placeholder="Contoh: Laporan Tahunan" class="w-full px-4 py-2 border border-[#D6D3D1] rounded-[8px] focus:outline-none focus:border-[#C2410C] text-[#1C1917] bg-[#FAFAF9]">
            </div>

            <div class="pt-4 flex justify-end gap-3">
                <button type="button" onclick="document.getElementById('uploadModal').classList.add('hidden')" class="px-4 py-2 text-sm font-semibold text-[#57534E] hover:text-[#1C1917]">Batal</button>
                <button type="submit" class="bg-[#C2410C] hover:bg-[#9A3412] text-white px-5 py-2 rounded-[8px] text-sm font-bold">Mulai Unggah</button>
            </div>
        </form>
    </div>
</div>
@endsection
