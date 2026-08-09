@extends('layouts.admin')

@section('header_title', 'Kategori Produk')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h2 class="text-xl font-semibold text-[#1C1917]">Kelola Kategori Produk</h2>
        <p class="text-sm text-[#57534E]">Tambahkan, ubah, atau hapus kategori produk.</p>
    </div>
    <button onclick="document.getElementById('modalTambah').classList.remove('hidden')" class="bg-[#1C1917] hover:bg-[#44403C] text-white px-4 py-2 rounded-[8px] text-sm font-semibold flex items-center gap-2 transition-colors shadow-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Tambah Kategori
    </button>
</div>

@if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-[8px] mb-6 text-sm flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        {{ session('success') }}
    </div>
@endif
@if($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-[8px] mb-6 text-sm flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
        <ul class="list-disc pl-4">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="bg-white border border-[#D6D3D1] rounded-[12px] shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-[#FAFAF9] border-b border-[#D6D3D1]">
                    <th class="py-3 px-4 text-[13px] font-semibold text-[#78716C] uppercase w-16 text-center">No</th>
                    <th class="py-3 px-4 text-[13px] font-semibold text-[#78716C] uppercase">Nama Kategori</th>
                    <th class="py-3 px-4 text-[13px] font-semibold text-[#78716C] uppercase text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#E7E5E4]">
                @forelse($kategori as $index => $kat)
                <tr class="hover:bg-[#F5F5F4] transition-colors">
                    <td class="py-3 px-4 text-[14px] text-[#57534E] text-center">{{ $index + 1 }}</td>
                    <td class="py-3 px-4 text-[14px] text-[#1C1917] font-semibold">{{ $kat->nama_kategori }}</td>
                    <td class="py-3 px-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <!-- Edit Button -->
                            <button onclick="openEditModal({{ $kat->id_kategori }}, '{{ $kat->nama_kategori }}')" class="text-[#0284C7] hover:text-[#0369A1] font-semibold text-[13px] flex items-center gap-1 bg-blue-50 px-2 py-1 rounded">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                Edit
                            </button>
                            <!-- Delete Button -->
                            <form action="{{ route('admin.kategori.destroy', $kat->id_kategori) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?');" class="inline-block">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-[#DC2626] hover:text-[#B91C1C] font-semibold text-[13px] flex items-center gap-1 bg-red-50 px-2 py-1 rounded">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="py-8 text-center text-[14px] text-[#78716C]">Belum ada data kategori produk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah -->
<div id="modalTambah" class="fixed inset-0 z-50 hidden bg-[#1C1917]/50 flex items-center justify-center backdrop-blur-sm p-4">
    <div class="bg-white rounded-[12px] w-full max-w-md p-6 shadow-xl">
        <h3 class="text-lg font-bold text-[#1C1917] mb-4">Tambah Kategori</h3>
        <form action="{{ route('admin.kategori.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-[13px] font-semibold text-[#57534E] mb-1">Nama Kategori</label>
                <input type="text" name="nama_kategori" class="w-full px-4 py-2 border border-[#D6D3D1] rounded-[8px] focus:outline-none focus:border-[#1C1917]" required placeholder="Contoh: Sembako">
            </div>
            <div class="flex justify-end gap-3 mt-6">
                <button type="button" onclick="document.getElementById('modalTambah').classList.add('hidden')" class="px-4 py-2 text-sm font-semibold text-[#57534E] hover:text-[#1C1917] hover:bg-[#F5F5F4] rounded-[8px]">Batal</button>
                <button type="submit" class="bg-[#1C1917] hover:bg-[#44403C] text-white px-5 py-2 rounded-[8px] text-sm font-semibold">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit -->
<div id="modalEdit" class="fixed inset-0 z-50 hidden bg-[#1C1917]/50 flex items-center justify-center backdrop-blur-sm p-4">
    <div class="bg-white rounded-[12px] w-full max-w-md p-6 shadow-xl">
        <h3 class="text-lg font-bold text-[#1C1917] mb-4">Edit Kategori</h3>
        <form id="formEdit" method="POST">
            @csrf @method('PUT')
            <div class="mb-4">
                <label class="block text-[13px] font-semibold text-[#57534E] mb-1">Nama Kategori</label>
                <input type="text" id="edit_nama_kategori" name="nama_kategori" class="w-full px-4 py-2 border border-[#D6D3D1] rounded-[8px] focus:outline-none focus:border-[#1C1917]" required>
            </div>
            <div class="flex justify-end gap-3 mt-6">
                <button type="button" onclick="document.getElementById('modalEdit').classList.add('hidden')" class="px-4 py-2 text-sm font-semibold text-[#57534E] hover:text-[#1C1917] hover:bg-[#F5F5F4] rounded-[8px]">Batal</button>
                <button type="submit" class="bg-[#1C1917] hover:bg-[#44403C] text-white px-5 py-2 rounded-[8px] text-sm font-semibold">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditModal(id, nama) {
        document.getElementById('edit_nama_kategori').value = nama;
        document.getElementById('formEdit').action = `/admin/kategori/${id}`;
        document.getElementById('modalEdit').classList.remove('hidden');
    }
</script>
@endsection
