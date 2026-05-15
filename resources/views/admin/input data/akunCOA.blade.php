@extends('layouts.admin')

@section('header_title', 'Daftar Akun COA')

@section('content')
<div class="space-y-6" x-data="{ isModalOpen: false }">
    <!-- Header Page -->
    <div class="flex items-center justify-between">
        <div class="inline-block px-[14px] py-[6px] bg-[#F5F5F4] text-[#57534E] font-semibold text-[14px] rounded-[9999px]">
            Modul Akuntansi
        </div>
    </div>

    <!-- Flex Split Layout -->
    <div class="flex flex-col xl:flex-row gap-8 items-start">
        <!-- Sidebar Buttons (Kiri) -->
        <div class="w-full xl:w-1/4 shrink-0">
            @include('admin.input data.inputdata')
        </div>

        <!-- Content Area (Kanan) -->
        <div class="w-full xl:w-3/4 flex-1">
            <!-- Data Table Section -->
            <div class="bg-[#FAFAF9] border border-[#D6D3D1] rounded-[12px] overflow-hidden hover:shadow-[0_4px_16px_rgba(28,25,23,0.06)] transition-shadow">
                
                <!-- Table Header Area -->
                <div class="px-6 py-5 border-b border-[#D6D3D1] flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <h3 class="text-2xl font-display font-bold text-[#1C1917] tracking-tight">Daftar Akun (COA)</h3>
                    <button @click="isModalOpen = true"
                        class="flex items-center justify-center gap-2 px-6 py-3 bg-[#C2410C] hover:bg-[#9A3412] text-white rounded-[8px] font-semibold text-[14px] transition-all shadow-sm hover:shadow-[0_4px_12px_rgba(194,65,12,0.25)]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Akun
                    </button>
                </div>

                <div class="overflow-x-auto min-h-[400px]">
                    <table class="w-full text-left font-semibold text-[#1C1917]">
                        <thead class="text-[12px] uppercase bg-[#F5F5F4] border-b border-[#D6D3D1] text-[#78716C]">
                            <tr>
                                <th scope="col" class="px-6 py-4 font-semibold tracking-wide">Nomor Akun</th>
                                <th scope="col" class="px-6 py-4 font-semibold tracking-wide">Nama Akun</th>
                                <th scope="col" class="px-6 py-4 font-semibold tracking-wide">Kelompok</th>
                                <th scope="col" class="px-6 py-4 font-semibold tracking-wide">Saldo Nominal</th>
                                <th scope="col" class="px-6 py-4 font-semibold tracking-wide text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($akun_coas as $akun)
                                <tr class="border-b border-[#D6D3D1] last:border-0 hover:bg-[#F5F5F4] transition-colors">
                                    <td class="px-6 py-4 font-semibold text-[#1C1917]">{{ $akun->nomor_akun }}</td>
                                    <td class="px-6 py-4 font-semibold text-[#1C1917]">{{ $akun->nama_akun }}</td>
                                    <td class="px-6 py-4 text-[#57534E]">{{ $akun->kelompok }}</td>
                                    <td class="px-6 py-4 font-semibold text-[#1C1917]">Rp {{ number_format($akun->saldo_nominal, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end gap-2">
                                            <!-- Tombol Edit -->
                                            <button @click="$dispatch('open-edit', {{ json_encode($akun) }})"
                                                class="px-4 py-2 bg-transparent text-[#1C1917] border border-[#D6D3D1] rounded-[8px] hover:bg-[#F5F5F4] font-semibold text-[13px] transition-colors"
                                                title="Edit">
                                                Edit
                                            </button>
                                            <!-- Tombol Hapus -->
                                            <form action="{{ route('akun-coa.destroy', $akun->id) }}" method="POST"
                                                onsubmit="return confirm('Hapus COA ini dari sistem?');"
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
                                        Belum ada data akun COA.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Akun COA -->
    <div x-show="isModalOpen" x-transition.opacity.duration.300ms
        class="fixed inset-0 z-[70] bg-[#1C1917]/80 backdrop-blur-sm flex items-center justify-center p-4 sm:p-0"
        style="display: none;">
        
        <div x-show="isModalOpen" @click.away="isModalOpen = false" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            class="relative bg-[#FAFAF9] border border-[#D6D3D1] shadow-[0_24px_48px_rgba(28,25,23,0.12)] w-full max-w-lg sm:mx-auto rounded-[12px] overflow-hidden">
            
            <div class="p-6 border-b border-[#D6D3D1] bg-[#FAFAF9] flex items-center justify-between">
                <h3 class="text-2xl font-display font-bold text-[#1C1917]">Tambah COA</h3>
                <button @click="isModalOpen = false" type="button"
                    class="text-[#78716C] hover:text-[#1C1917] p-1 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="p-6 bg-[#FAFAF9] overflow-y-auto">
                <form action="{{ route('akun-coa.store') }}" method="POST" id="formTambahCoa">
                    @csrf
                    <div class="space-y-5">
                        <div>
                            <label class="block text-[14px] font-semibold text-[#1C1917] mb-2">Nomor Akun <span class="text-[#DC2626]">*</span></label>
                            <input type="text" name="nomor_akun" placeholder="1.1.1.1" required
                                class="w-full px-4 py-3 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[8px] text-[#1C1917] text-[16px] focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15 transition-all">
                        </div>
                        <div>
                            <label class="block text-[14px] font-semibold text-[#1C1917] mb-2">Nama Akun <span class="text-[#DC2626]">*</span></label>
                            <input type="text" name="nama_akun" placeholder="KAS TUNAI" required
                                class="w-full px-4 py-3 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[8px] text-[#1C1917] text-[16px] focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15 transition-all">
                        </div>
                        <div>
                            <label class="block text-[14px] font-semibold text-[#1C1917] mb-2">Kelompok <span class="text-[#DC2626]">*</span></label>
                            <select name="kelompok" required
                                class="w-full px-4 py-3 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[8px] text-[#1C1917] text-[16px] focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15 transition-all appearance-none">
                                <option value="Aset">Aset</option>
                                <option value="Kewajiban">Kewajiban</option>
                                <option value="Ekuitas">Ekuitas</option>
                                <option value="Pendapatan">Pendapatan</option>
                                <option value="Beban">Beban</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[14px] font-semibold text-[#1C1917] mb-2">Saldo Nominal Awal <span class="text-[#DC2626]">*</span></label>
                            <input type="text" name="saldo_nominal" placeholder="0" value="0" required
                                class="format-rupiah w-full px-4 py-3 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[8px] text-[#1C1917] text-[16px] focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15 transition-all">
                        </div>
                    </div>
                </form>
            </div>

            <div class="p-6 border-t border-[#D6D3D1] bg-[#FAFAF9] flex justify-end gap-3">
                <button @click="isModalOpen = false" type="button" class="px-5 py-2.5 bg-transparent border border-[#D6D3D1] text-[#57534E] font-semibold rounded-[8px] hover:text-[#1C1917] hover:bg-[#F5F5F4] transition-colors">Batal</button>
                <button type="submit" form="formTambahCoa" class="px-5 py-2.5 bg-[#C2410C] text-white font-semibold rounded-[8px] hover:bg-[#9A3412] transition-colors shadow-sm">Simpan COA</button>
            </div>
        </div>
    </div>

    <!-- Modal Edit Akun COA -->
    <div x-data="{ isEditModalOpen: false, editData: {}, submitUrl: '' }"
        @open-edit.window="isEditModalOpen = true; editData = $event.detail; submitUrl = '{{ route('akun-coa.update', ':id') }}'.replace(':id', editData.id)"
        x-show="isEditModalOpen" x-transition.opacity.duration.300ms
        class="fixed inset-0 z-[70] bg-[#1C1917]/80 backdrop-blur-sm flex items-center justify-center p-4 sm:p-0"
        style="display: none;">
        
        <div x-show="isEditModalOpen" @click.away="isEditModalOpen = false" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            class="relative bg-[#FAFAF9] border border-[#D6D3D1] shadow-[0_24px_48px_rgba(28,25,23,0.12)] w-full max-w-lg sm:mx-auto rounded-[12px] overflow-hidden">
            
            <div class="p-6 border-b border-[#D6D3D1] bg-[#FAFAF9] flex items-center justify-between">
                <h3 class="text-2xl font-display font-bold text-[#1C1917]">Edit COA</h3>
                <button @click="isEditModalOpen = false" type="button"
                    class="text-[#78716C] hover:text-[#1C1917] p-1 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="p-6 bg-[#FAFAF9] overflow-y-auto">
                <form :action="submitUrl" method="POST" id="formEditCoa">
                    @csrf
                    @method('PUT')
                    <div class="space-y-5">
                        <div>
                            <label class="block text-[14px] font-semibold text-[#1C1917] mb-2">Nomor Akun <span class="text-[#DC2626]">*</span></label>
                            <input type="text" name="nomor_akun" x-model="editData.nomor_akun" required
                                class="w-full px-4 py-3 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[8px] text-[#1C1917] text-[16px] focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15 transition-all">
                        </div>
                        <div>
                            <label class="block text-[14px] font-semibold text-[#1C1917] mb-2">Nama Akun <span class="text-[#DC2626]">*</span></label>
                            <input type="text" name="nama_akun" x-model="editData.nama_akun" required
                                class="w-full px-4 py-3 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[8px] text-[#1C1917] text-[16px] focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15 transition-all">
                        </div>
                        <div>
                            <label class="block text-[14px] font-semibold text-[#1C1917] mb-2">Kelompok <span class="text-[#DC2626]">*</span></label>
                            <select name="kelompok" x-model="editData.kelompok" required
                                class="w-full px-4 py-3 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[8px] text-[#1C1917] text-[16px] focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15 transition-all appearance-none">
                                <option value="Aset">Aset</option>
                                <option value="Kewajiban">Kewajiban</option>
                                <option value="Ekuitas">Ekuitas</option>
                                <option value="Pendapatan">Pendapatan</option>
                                <option value="Beban">Beban</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[14px] font-semibold text-[#1C1917] mb-2">Saldo Nominal <span class="text-[#DC2626]">*</span></label>
                            <input type="text" name="saldo_nominal" x-model="editData.saldo_nominal" required
                                class="format-rupiah w-full px-4 py-3 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[8px] text-[#1C1917] text-[16px] focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15 transition-all">
                        </div>
                    </div>
                </form>
            </div>

            <div class="p-6 border-t border-[#D6D3D1] bg-[#FAFAF9] flex justify-end gap-3">
                <button @click="isEditModalOpen = false" type="button" class="px-5 py-2.5 bg-transparent border border-[#D6D3D1] text-[#57534E] font-semibold rounded-[8px] hover:text-[#1C1917] hover:bg-[#F5F5F4] transition-colors">Batal</button>
                <button type="submit" form="formEditCoa" class="px-5 py-2.5 bg-[#C2410C] text-white font-semibold rounded-[8px] hover:bg-[#9A3412] transition-colors shadow-sm">Perbarui COA</button>
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
