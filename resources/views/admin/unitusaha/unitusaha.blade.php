@extends('layouts.admin')

@section('header_title', 'Master Data Unit Usaha')

@section('content')
<div class="space-y-6" x-data="{ isModalOpen: false }">
    <!-- Header Page -->
    <div class="flex items-center justify-between">
        <div class="inline-block px-[14px] py-[6px] bg-[#F5F5F4] text-[#57534E] font-semibold text-[14px] rounded-[9999px]">
            Modul Operasional
        </div>
    </div>

    <!-- Modul Internal Navigation -->
    <div class="flex flex-wrap gap-3 mt-4">
        <a href="{{ route('unit-usaha') }}" class="{{ request()->routeIs('unit-usaha') ? 'bg-[#C2410C] text-white shadow-[0_4px_12px_rgba(194,65,12,0.25)]' : 'bg-white text-[#57534E] border border-[#D6D3D1] hover:bg-[#F5F5F4] hover:text-[#1C1917]' }} px-6 py-2.5 font-semibold text-[14px] rounded-[8px] transition-all">
            Master Data Unit Usaha
        </a>
        <a href="{{ route('pos.index') }}" class="{{ request()->routeIs('pos.index') ? 'bg-[#C2410C] text-white shadow-[0_4px_12px_rgba(194,65,12,0.25)]' : 'bg-white text-[#57534E] border border-[#D6D3D1] hover:bg-[#F5F5F4] hover:text-[#1C1917]' }} px-6 py-2.5 font-semibold text-[14px] rounded-[8px] transition-all">
            Kasir POS
        </a>
        <a href="{{ route('simpan-pinjam.index') }}" class="{{ request()->routeIs('simpan-pinjam.index') ? 'bg-[#C2410C] text-white shadow-[0_4px_12px_rgba(194,65,12,0.25)]' : 'bg-white text-[#57534E] border border-[#D6D3D1] hover:bg-[#F5F5F4] hover:text-[#1C1917]' }} px-6 py-2.5 font-semibold text-[14px] rounded-[8px] transition-all">
            Simpan Pinjam Koperasi
        </a>
    </div>

    <!-- Data Table Section -->
    <div class="bg-[#FAFAF9] border border-[#D6D3D1] rounded-[12px] overflow-hidden shadow-sm hover:shadow-[0_4px_16px_rgba(28,25,23,0.06)] transition-shadow mt-6">
        
        <!-- Table Header Area -->
        <div class="bg-[#FAFAF9] px-6 py-5 border-b border-[#D6D3D1] flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h3 class="text-2xl font-display font-bold text-[#1C1917] tracking-tight">Daftar Unit Usaha</h3>
                <p class="text-[#57534E] text-[14px] mt-1">Kelola entitas operasional BUMDes</p>
            </div>
            <button @click="isModalOpen = true"
                class="flex items-center justify-center gap-2 px-6 py-3 bg-[#C2410C] hover:bg-[#9A3412] text-white rounded-[8px] font-semibold text-[14px] transition-all shadow-sm hover:shadow-[0_4px_12px_rgba(194,65,12,0.25)]">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Unit
            </button>
        </div>

        <div class="overflow-x-auto min-h-[400px]">
            <table class="w-full text-left font-semibold text-[#1C1917]">
                <thead class="text-[12px] uppercase bg-[#F5F5F4] border-b border-[#D6D3D1] text-[#78716C]">
                    <tr>
                        <th scope="col" class="px-6 py-4 font-semibold tracking-wide w-16 text-center">No.</th>
                        <th scope="col" class="px-6 py-4 font-semibold tracking-wide w-64">Nama Usaha</th>
                        <th scope="col" class="px-6 py-4 font-semibold tracking-wide">Deskripsi</th>
                        <th scope="col" class="px-6 py-4 font-semibold tracking-wide w-40 text-center">Status</th>
                        <th scope="col" class="px-6 py-4 font-semibold tracking-wide w-32 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($unit_usahas as $index => $unit)
                        <tr class="border-b border-[#D6D3D1] last:border-0 hover:bg-[#F5F5F4] transition-colors">
                            <td class="px-6 py-4 text-center text-[#1C1917]">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 font-semibold text-[#C2410C] uppercase">{{ $unit->nama_usaha }}</td>
                            <td class="px-6 py-4 text-[#57534E]">{{ $unit->deskripsi_usaha ?: '-' }}</td>
                            <td class="px-6 py-4 text-center">
                                @php
                                    $statusConfig = [
                                        'Aktif' => 'bg-[#DCFCE7] text-[#16A34A]',
                                        'Tidak Aktif' => 'bg-[#FEE2E2] text-[#DC2626]',
                                        'Dalam Pengembangan' => 'bg-[#FEF3C7] text-[#D97706]',
                                    ];
                                    $badgeClass = $statusConfig[$unit->status_usaha] ?? 'bg-[#F5F5F4] text-[#57534E]';
                                @endphp
                                <span class="inline-block px-[10px] py-[4px] rounded-[9999px] text-[12px] font-bold uppercase {{ $badgeClass }}">
                                    {{ $unit->status_usaha }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <!-- Tombol Edit -->
                                    <button @click="$dispatch('open-edit', {{ json_encode($unit) }})"
                                        class="px-4 py-2 bg-transparent text-[#1C1917] border border-[#D6D3D1] rounded-[8px] hover:bg-[#E7E5E4] font-semibold text-[13px] transition-colors"
                                        title="Edit">
                                        Edit
                                    </button>
                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('unit-usaha.destroy', $unit->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus Unit Usaha ini secara permanen?');"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-4 py-2 bg-[#DC2626] text-white border border-transparent rounded-[8px] hover:bg-[#B91C1C] font-semibold text-[13px] transition-colors"
                                            title="Hapus">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-[#78716C] font-semibold">
                                Belum ada data unit usaha terdaftar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah Unit Usaha -->
    <div x-show="isModalOpen" x-transition.opacity.duration.300ms
        class="fixed inset-0 z-[70] bg-[#1C1917]/80 backdrop-blur-sm flex items-center justify-center p-4 sm:p-0"
        style="display: none;">
        
        <div x-show="isModalOpen" @click.away="isModalOpen = false" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            class="relative bg-[#FAFAF9] border border-[#D6D3D1] shadow-[0_24px_48px_rgba(28,25,23,0.12)] w-full max-w-2xl sm:mx-auto my-8 max-h-[90vh] flex flex-col overflow-hidden rounded-[12px]">
            
            <!-- Modal Header -->
            <div class="p-6 border-b border-[#D6D3D1] shrink-0 bg-[#FAFAF9] relative">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-display font-bold text-[#1C1917]">Tambah Unit Usaha</h3>
                        <p class="text-[#57534E] text-[14px] mt-1">Registrasi entitas usaha BUMDes baru</p>
                    </div>
                    <button @click="isModalOpen = false" type="button"
                        class="text-[#78716C] hover:text-[#1C1917] p-1 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                @if(session('success'))
                    <div class="mt-4 bg-[#DCFCE7] border border-[#16A34A]/20 text-[#16A34A] px-4 py-3 rounded-[8px] font-semibold text-[14px]" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if($errors->any())
                    <div class="mt-4 bg-[#FEE2E2] border border-[#DC2626]/20 text-[#DC2626] px-4 py-3 rounded-[8px] font-semibold text-[14px]" role="alert">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <!-- Modal Body (Form) -->
            <div class="p-6 overflow-y-auto flex-1 bg-[#FAFAF9]">
                <form action="{{ route('unit-usaha.store') }}" method="POST" id="formTambahUnitUsaha">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-[14px] font-semibold text-[#1C1917] mb-2">Nama Usaha <span class="text-[#DC2626]">*</span></label>
                            <input type="text" name="nama_usaha" placeholder="CTH: PAMSIMAS, PENYEWAAN TRATAG"
                                class="w-full px-4 py-3 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[8px] text-[#1C1917] text-[16px] placeholder-[#A8A29E] focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15 transition-all uppercase" required>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-[14px] font-semibold text-[#1C1917] mb-2">Status Usaha <span class="text-[#DC2626]">*</span></label>
                            <select name="status_usaha"
                                class="w-full px-4 py-3 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[8px] text-[#1C1917] text-[16px] focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15 transition-all uppercase appearance-none" required>
                                <option value="Aktif">AKTIF</option>
                                <option value="Tidak Aktif">TIDAK AKTIF</option>
                                <option value="Dalam Pengembangan">DALAM PENGEMBANGAN</option>
                            </select>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-[14px] font-semibold text-[#1C1917] mb-2">Deskripsi Usaha</label>
                            <textarea name="deskripsi_usaha" rows="4" placeholder="DETAIL LAYANAN, PRODUK, ATAU FUNGSI UNIT USAHA INI..."
                                class="w-full px-4 py-3 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[8px] text-[#1C1917] text-[16px] placeholder-[#A8A29E] focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15 transition-all uppercase"></textarea>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="p-6 border-t border-[#D6D3D1] shrink-0 bg-[#FAFAF9] flex justify-end gap-3">
                <button @click="isModalOpen = false" type="button"
                    class="px-5 py-2.5 bg-transparent border border-[#D6D3D1] text-[#57534E] font-semibold rounded-[8px] hover:text-[#1C1917] hover:bg-[#F5F5F4] transition-colors">
                    Batal
                </button>
                <button type="submit" form="formTambahUnitUsaha"
                    class="px-5 py-2.5 bg-[#C2410C] text-white font-semibold rounded-[8px] hover:bg-[#9A3412] transition-colors shadow-sm">
                    Simpan Data
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Edit Unit Usaha -->
    <div x-data="{ isEditModalOpen: false, editData: {}, submitUrl: '' }"
        @open-edit.window="isEditModalOpen = true; editData = $event.detail; submitUrl = '{{ route('unit-usaha.update', ':id') }}'.replace(':id', editData.id)"
        x-show="isEditModalOpen" x-transition.opacity.duration.300ms
        class="fixed inset-0 z-[70] bg-[#1C1917]/80 backdrop-blur-sm flex items-center justify-center p-4 sm:p-0"
        style="display: none;">
        
        <div x-show="isEditModalOpen" @click.away="isEditModalOpen = false" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            class="relative bg-[#FAFAF9] border border-[#D6D3D1] shadow-[0_24px_48px_rgba(28,25,23,0.12)] w-full max-w-2xl sm:mx-auto my-8 max-h-[90vh] flex flex-col overflow-hidden rounded-[12px]">
            
            <div class="p-6 border-b border-[#D6D3D1] shrink-0 bg-[#FAFAF9] relative">
                <div class="flex items-center justify-between">
                    <h3 class="text-2xl font-display font-bold text-[#1C1917]">Edit Unit Usaha</h3>
                    <button @click="isEditModalOpen = false" type="button"
                        class="text-[#78716C] hover:text-[#1C1917] p-1 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="p-6 bg-[#FAFAF9] flex-1 overflow-y-auto">
                <form :action="submitUrl" method="POST" id="formEditUnitUsaha">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-[14px] font-semibold text-[#1C1917] mb-2">Nama Usaha <span class="text-[#DC2626]">*</span></label>
                            <input type="text" name="nama_usaha" x-model="editData.nama_usaha"
                                class="w-full px-4 py-3 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[8px] text-[#1C1917] text-[16px] focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15 transition-all uppercase" required>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-[14px] font-semibold text-[#1C1917] mb-2">Status Usaha <span class="text-[#DC2626]">*</span></label>
                            <select name="status_usaha" x-model="editData.status_usaha"
                                class="w-full px-4 py-3 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[8px] text-[#1C1917] text-[16px] focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15 transition-all uppercase appearance-none" required>
                                <option value="Aktif">AKTIF</option>
                                <option value="Tidak Aktif">TIDAK AKTIF</option>
                                <option value="Dalam Pengembangan">DALAM PENGEMBANGAN</option>
                            </select>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-[14px] font-semibold text-[#1C1917] mb-2">Deskripsi Usaha</label>
                            <textarea name="deskripsi_usaha" rows="4" x-model="editData.deskripsi_usaha"
                                class="w-full px-4 py-3 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[8px] text-[#1C1917] text-[16px] focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15 transition-all uppercase"></textarea>
                        </div>
                    </div>
                </form>
            </div>

            <div class="p-6 border-t border-[#D6D3D1] shrink-0 bg-[#FAFAF9] flex justify-end gap-3">
                <button @click="isEditModalOpen = false" type="button"
                    class="px-5 py-2.5 bg-transparent border border-[#D6D3D1] text-[#57534E] font-semibold rounded-[8px] hover:text-[#1C1917] hover:bg-[#F5F5F4] transition-colors">
                    Batal
                </button>
                <button type="submit" form="formEditUnitUsaha"
                    class="px-5 py-2.5 bg-[#C2410C] text-white font-semibold rounded-[8px] hover:bg-[#9A3412] transition-colors shadow-sm">
                    Perbarui Data
                </button>
            </div>
        </div>
    </div>
</div>

@if(session('success') || $errors->any())
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('modalData', () => ({
                isModalOpen: true
            }));
        });
    </script>
@endif
@endsection