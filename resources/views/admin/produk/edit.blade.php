@extends('layouts.admin')

@section('header_title', 'Edit Produk')

@section('content')
<div class="max-w-3xl bg-white border border-[#D6D3D1] rounded-[12px] p-6 sm:p-8 shadow-sm">
    <div class="mb-6 pb-4 border-b border-[#E7E5E4]">
        <h2 class="text-xl font-bold text-[#1C1917]">Ubah Informasi Produk</h2>
        <p class="text-sm text-[#57534E]">Perbarui informasi barang, harga, stok, atau foto produk BUMDes.</p>
    </div>

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-lg mb-6 text-sm">
            <ul class="list-disc pl-5 space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.produk.update', $produk->id_produk) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Nama Produk & Kategori -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="nama_produk" class="block text-xs font-bold text-[#1C1917] uppercase tracking-wider mb-1.5">
                    Nama Produk / Barang <span class="text-red-500">*</span>
                </label>
                <input type="text" name="nama_produk" id="nama_produk" value="{{ old('nama_produk', $produk->nama_produk) }}"
                    class="w-full px-4 py-2.5 border border-[#D6D3D1] rounded-[8px] focus:outline-none focus:border-[#C2410C] focus:ring-1 focus:ring-[#C2410C] transition-colors bg-[#FAFAF9] text-[#1C1917] text-sm" required>
            </div>

            <div>
                <label for="id_kategori" class="block text-xs font-bold text-[#1C1917] uppercase tracking-wider mb-1.5">
                    Kategori <span class="text-red-500">*</span>
                </label>
                <select name="id_kategori" id="id_kategori"
                    class="w-full px-4 py-2.5 border border-[#D6D3D1] rounded-[8px] focus:outline-none focus:border-[#C2410C] focus:ring-1 focus:ring-[#C2410C] transition-colors bg-[#FAFAF9] text-[#1C1917] text-sm" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategoris as $kat)
                        <option value="{{ $kat->id_kategori }}" {{ old('id_kategori', $produk->id_kategori) == $kat->id_kategori ? 'selected' : '' }}>
                            {{ $kat->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Harga, Stok, Satuan, Status -->
        <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
            <div class="sm:col-span-1">
                <label for="harga" class="block text-xs font-bold text-[#1C1917] uppercase tracking-wider mb-1.5">
                    Harga (Rp) <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <span class="absolute left-3 top-2.5 text-sm font-bold text-[#78716C]">Rp</span>
                    <input type="text" name="harga" id="harga" value="{{ old('harga', number_format($produk->harga, 0, ',', '.')) }}" placeholder="50.000"
                        class="rupiah-input format-rupiah w-full pl-10 pr-3 py-2.5 border border-[#D6D3D1] rounded-[8px] focus:outline-none focus:border-[#C2410C] focus:ring-1 focus:ring-[#C2410C] transition-colors bg-[#FAFAF9] text-[#1C1917] text-sm font-semibold" required>
                </div>
            </div>

            <div class="sm:col-span-1">
                <label for="stok" class="block text-xs font-bold text-[#1C1917] uppercase tracking-wider mb-1.5">
                    Stok <span class="text-red-500">*</span>
                </label>
                <input type="number" name="stok" id="stok" value="{{ old('stok', $produk->stok) }}" min="0"
                    class="w-full px-4 py-2.5 border border-[#D6D3D1] rounded-[8px] focus:outline-none focus:border-[#C2410C] focus:ring-1 focus:ring-[#C2410C] transition-colors bg-[#FAFAF9] text-[#1C1917] text-sm" required>
            </div>

            <div class="sm:col-span-1">
                <label for="satuan" class="block text-xs font-bold text-[#1C1917] uppercase tracking-wider mb-1.5">
                    Satuan <span class="text-red-500">*</span>
                </label>
                <input type="text" name="satuan" id="satuan" value="{{ old('satuan', $produk->satuan) }}" placeholder="pcs, kg, liter"
                    class="w-full px-4 py-2.5 border border-[#D6D3D1] rounded-[8px] focus:outline-none focus:border-[#C2410C] focus:ring-1 focus:ring-[#C2410C] transition-colors bg-[#FAFAF9] text-[#1C1917] text-sm" required>
            </div>

            <div class="sm:col-span-1">
                <label for="status" class="block text-xs font-bold text-[#1C1917] uppercase tracking-wider mb-1.5">
                    Status <span class="text-red-500">*</span>
                </label>
                <select name="status" id="status"
                    class="w-full px-4 py-2.5 border border-[#D6D3D1] rounded-[8px] focus:outline-none focus:border-[#C2410C] focus:ring-1 focus:ring-[#C2410C] transition-colors bg-[#FAFAF9] text-[#1C1917] text-sm" required>
                    <option value="aktif" {{ old('status', $produk->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ old('status', $produk->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>
        </div>

        <!-- Deskripsi Produk -->
        <div>
            <label for="deskripsi" class="block text-xs font-bold text-[#1C1917] uppercase tracking-wider mb-1.5">
                Deskripsi Produk (Opsional)
            </label>
            <textarea name="deskripsi" id="deskripsi" rows="3"
                class="w-full px-4 py-2.5 border border-[#D6D3D1] rounded-[8px] focus:outline-none focus:border-[#C2410C] focus:ring-1 focus:ring-[#C2410C] transition-colors bg-[#FAFAF9] text-[#1C1917] text-sm">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
        </div>

        <!-- Upload & Ganti Foto Produk -->
        <div>
            <label class="block text-xs font-bold text-[#1C1917] uppercase tracking-wider mb-1.5">
                Foto Produk <span class="text-slate-400 font-normal normal-case">(Biarkan kosong jika tidak ingin mengubah foto)</span>
            </label>
            <div class="mt-1 flex flex-col sm:flex-row items-center gap-5 p-4 border-2 border-dashed border-[#D6D3D1] rounded-xl bg-[#FAFAF9]">
                <!-- Current / Preview Image Area -->
                <div class="w-32 h-32 rounded-lg bg-slate-200 border border-slate-300 overflow-hidden flex items-center justify-center shrink-0 relative group">
                    @if($produk->gambar && \Illuminate\Support\Facades\Storage::disk('public')->exists($produk->gambar))
                        <img id="imagePreview" src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}" class="w-full h-full object-cover">
                        <div id="previewPlaceholder" class="hidden flex flex-col items-center justify-center text-slate-400 p-2 text-center">
                            <svg class="w-8 h-8 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="text-[11px] font-medium leading-tight">Belum Ada Foto</span>
                        </div>
                    @else
                        <img id="imagePreview" src="" alt="Preview Gambar" class="w-full h-full object-cover hidden">
                        <div id="previewPlaceholder" class="flex flex-col items-center justify-center text-slate-400 p-2 text-center">
                            <svg class="w-8 h-8 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="text-[11px] font-medium leading-tight">Belum Ada Foto</span>
                        </div>
                    @endif
                </div>

                <!-- Input File -->
                <div class="flex-1 text-center sm:text-left">
                    <input type="file" name="gambar" id="gambarInput" accept="image/*" class="block w-full text-xs text-slate-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-md file:border-0
                        file:text-xs file:font-bold
                        file:bg-[#C2410C] file:text-white
                        hover:file:bg-[#9A3412] file:cursor-pointer transition-colors">
                    <p class="text-xs text-slate-500 mt-2">Pilih file baru untuk mengganti foto produk yang sudah ada.</p>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="pt-5 flex items-center justify-end gap-3 border-t border-[#D6D3D1]">
            <a href="{{ route('admin.produk.index') }}" class="text-[#57534E] hover:text-[#1C1917] font-semibold text-sm transition-colors px-4 py-2">
                Batal
            </a>
            <button type="submit" class="bg-[#C2410C] hover:bg-[#9A3412] text-white px-6 py-2.5 rounded-[8px] text-sm font-bold tracking-wide transition-all shadow-md flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>

<script>
    document.getElementById('gambarInput').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('imagePreview');
        const placeholder = document.getElementById('previewPlaceholder');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                if (placeholder) placeholder.classList.add('hidden');
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
