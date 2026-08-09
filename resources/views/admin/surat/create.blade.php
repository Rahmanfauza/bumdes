@extends('layouts.admin')

@section('header_title', 'Buat Surat Baru')

@section('content')
<div class="max-w-2xl bg-white border border-[#D6D3D1] rounded-[12px] p-6 shadow-sm">
    <div class="mb-6">
        <h2 class="text-xl font-semibold text-[#1C1917]">Formulir Persuratan</h2>
        <p class="text-sm text-[#57534E]">Isi detail surat masuk atau surat keluar.</p>
    </div>

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-lg mb-6 text-sm">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.surat.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-[#1C1917] mb-1.5">Nomor Surat</label>
                <input type="text" name="nomor_surat" value="{{ old('nomor_surat') }}" placeholder="Contoh: 001/BUMDES/VIII/2026"
                    class="w-full px-4 py-2 border border-[#D6D3D1] rounded-[8px] focus:outline-none focus:border-[#C2410C] focus:ring-1 focus:ring-[#C2410C] transition-colors bg-[#FAFAF9] text-[#1C1917]" required>
            </div>
            <div>
                <label class="block text-sm font-semibold text-[#1C1917] mb-1.5">Jenis Surat</label>
                <select name="jenis_surat" class="w-full px-4 py-2 border border-[#D6D3D1] rounded-[8px] focus:outline-none focus:border-[#C2410C] focus:ring-1 focus:ring-[#C2410C] transition-colors bg-[#FAFAF9] text-[#1C1917]" required>
                    <option value="masuk" {{ old('jenis_surat') == 'masuk' ? 'selected' : '' }}>Surat Masuk</option>
                    <option value="keluar" {{ old('jenis_surat') == 'keluar' ? 'selected' : '' }}>Surat Keluar</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-[#1C1917] mb-1.5">Perihal / Judul Surat</label>
            <input type="text" name="perihal" value="{{ old('perihal') }}" placeholder="Contoh: Undangan Rapat Tahunan"
                class="w-full px-4 py-2 border border-[#D6D3D1] rounded-[8px] focus:outline-none focus:border-[#C2410C] focus:ring-1 focus:ring-[#C2410C] transition-colors bg-[#FAFAF9] text-[#1C1917]" required>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-[#1C1917] mb-1.5">Pengirim <span class="text-xs text-[#78716C] font-normal">(Opsional)</span></label>
                <input type="text" name="pengirim" value="{{ old('pengirim') }}" placeholder="Asal surat"
                    class="w-full px-4 py-2 border border-[#D6D3D1] rounded-[8px] focus:outline-none focus:border-[#C2410C] focus:ring-1 focus:ring-[#C2410C] transition-colors bg-[#FAFAF9] text-[#1C1917]">
            </div>
            <div>
                <label class="block text-sm font-semibold text-[#1C1917] mb-1.5">Penerima <span class="text-xs text-[#78716C] font-normal">(Opsional)</span></label>
                <input type="text" name="penerima" value="{{ old('penerima') }}" placeholder="Tujuan surat"
                    class="w-full px-4 py-2 border border-[#D6D3D1] rounded-[8px] focus:outline-none focus:border-[#C2410C] focus:ring-1 focus:ring-[#C2410C] transition-colors bg-[#FAFAF9] text-[#1C1917]">
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-[#1C1917] mb-1.5">Lampiran Dokumen <span class="text-xs text-[#78716C] font-normal">(Opsional, Max 10MB)</span></label>
            <input type="file" name="file_dokumen" accept=".pdf,.doc,.docx,.jpg,.png"
                class="w-full px-4 py-2 border border-[#D6D3D1] rounded-[8px] focus:outline-none focus:border-[#C2410C] transition-colors bg-[#FAFAF9] text-[#1C1917] file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#FFF7ED] file:text-[#C2410C] hover:file:bg-[#FFEDD5]">
        </div>

        <div>
            <label class="block text-sm font-semibold text-[#1C1917] mb-1.5">Status Persetujuan (Approval)</label>
            <p class="text-xs text-[#57534E] mb-2">Pilih <b>"Ajukan ke Direktur"</b> agar dokumen ini terkirim ke panel Direktur untuk disetujui. Pilih "Draft" jika dokumen masih belum selesai.</p>
            <select name="status" class="w-full px-4 py-2 border border-[#D6D3D1] rounded-[8px] focus:outline-none focus:border-[#C2410C] focus:ring-1 focus:ring-[#C2410C] transition-colors bg-[#FAFAF9] text-[#1C1917]" required>
                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft (Simpan Sementara)</option>
                <option value="diajukan" {{ old('status') == 'diajukan' ? 'selected' : '' }}>Ajukan ke Direktur (Kirim Permintaan Approval)</option>
                <option value="disetujui" {{ old('status') == 'disetujui' ? 'selected' : '' }} disabled>Disetujui (Approved) - Hanya Direktur</option>
                <option value="ditolak" {{ old('status') == 'ditolak' ? 'selected' : '' }} disabled>Ditolak (Rejected) - Hanya Direktur</option>
            </select>
        </div>

        <div class="pt-4 flex items-center justify-end gap-3 border-t border-[#D6D3D1]">
            <a href="{{ route('admin.surat.index') }}" class="text-[#57534E] hover:text-[#1C1917] font-semibold text-sm transition-colors">Batal</a>
            <button type="submit" class="bg-[#C2410C] hover:bg-[#9A3412] text-white px-5 py-2 rounded-[8px] text-sm font-bold tracking-wide transition-all shadow-sm">
                Simpan Surat
            </button>
        </div>
    </form>
</div>
@endsection
