@extends('layouts.admin')

@section('header_title', 'Manajemen Stok')

@section('content')
<div class="space-y-6" x-data="{ isModalOpen: false, editData: {}, submitUrl: '' }"
    @open-edit.window="isModalOpen = true; editData = $event.detail; submitUrl = '{{ route('stok.update', ':id') }}'.replace(':id', editData.id)">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div class="inline-block px-[14px] py-[6px] bg-[#F5F5F4] text-[#57534E] font-semibold text-[14px] rounded-[9999px]">
            Data Manajemen Stok
        </div>
    </div>

    <div class="flex flex-col xl:flex-row gap-8 items-start">
        <!-- Sidebar Buttons (Kiri) -->
        <div class="w-full xl:w-1/4 shrink-0">
            @include('admin.input data.inputdata')
        </div>

        <!-- Content Area (Kanan) -->
        <div class="w-full xl:w-3/4 flex-1">
            {{-- Data Table --}}
            <div class="bg-[#FAFAF9] border border-[#D6D3D1] rounded-[12px] overflow-hidden hover:shadow-[0_4px_16px_rgba(28,25,23,0.06)] transition-shadow">
                
                <div class="px-6 py-5 border-b border-[#D6D3D1] flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <h3 class="text-2xl font-display font-bold text-[#1C1917] tracking-tight">Manajemen Stok</h3>
                        <p class="text-[#57534E] text-[14px] mt-1">Mengelola sisa stok dan nilai persediaan</p>
                    </div>
                    <button @click="isModalOpen = true; editData = {}; submitUrl = ''"
                        class="flex items-center justify-center gap-2 px-6 py-3 bg-[#C2410C] hover:bg-[#9A3412] text-white rounded-[8px] font-semibold text-[14px] transition-all shadow-sm hover:shadow-[0_4px_12px_rgba(194,65,12,0.25)]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Stok
                    </button>
                </div>

                <div class="overflow-x-auto min-h-[400px]">
                    <table class="w-full text-left font-semibold text-[#1C1917]">
                        <thead class="text-[12px] uppercase bg-[#F5F5F4] border-b border-[#D6D3D1] text-[#78716C]">
                            <tr>
                                <th scope="col" class="px-6 py-4 font-semibold tracking-wide">Nama Produk</th>
                                <th scope="col" class="px-6 py-4 font-semibold tracking-wide text-center w-32">Sisa Stok</th>
                                <th scope="col" class="px-6 py-4 font-semibold tracking-wide text-right">Nilai Persediaan</th>
                                <th scope="col" class="px-6 py-4 font-semibold tracking-wide text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($produkJasas as $index => $produk)
                                <tr class="border-b border-[#D6D3D1] last:border-0 hover:bg-[#F5F5F4] transition-colors">
                                    <td class="px-6 py-4 font-semibold text-[#C2410C] uppercase">{{ $produk->nama_produk }}</td>
                                    <td class="px-6 py-4 text-center">
                                        @php
                                            if($produk->stok_awal > 10) {
                                                $bgClass = 'bg-[#DCFCE7] text-[#16A34A]';
                                            } elseif($produk->stok_awal > 0) {
                                                $bgClass = 'bg-[#FEF3C7] text-[#D97706]';
                                            } else {
                                                $bgClass = 'bg-[#FEE2E2] text-[#DC2626]';
                                            }
                                        @endphp
                                        <span class="inline-block px-[10px] py-[4px] rounded-[9999px] text-[12px] font-bold {{ $bgClass }}">
                                            {{ $produk->stok_awal }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right font-semibold text-[#1C1917]">
                                        Rp {{ number_format($produk->nilai_persediaan, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end gap-2">
                                            {{-- Adjust --}}
                                            <button @click="$dispatch('open-edit', {{ json_encode($produk) }})"
                                                class="px-4 py-2 bg-transparent text-[#1C1917] border border-[#D6D3D1] rounded-[8px] hover:bg-[#F5F5F4] font-semibold text-[13px] transition-colors"
                                                title="Sesuaikan Stok">
                                                Update Stok
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center text-[#78716C] font-semibold">
                                        Belum ada data produk yang terdaftar.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- ========================================== --}}
    {{-- MODAL UPDATE/ADJUST STOK --}}
    {{-- ========================================== --}}
    <div x-show="isModalOpen" x-transition.opacity.duration.300ms
        class="fixed inset-0 z-[70] bg-[#1C1917]/80 backdrop-blur-sm flex items-center justify-center p-4 sm:p-0"
        style="display: none;">
        
        <div x-show="isModalOpen" @click.away="isModalOpen = false" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            class="relative bg-[#FAFAF9] border border-[#D6D3D1] shadow-[0_24px_48px_rgba(28,25,23,0.12)] w-full max-w-lg sm:mx-auto my-8 flex flex-col overflow-hidden rounded-[12px]">
            
            <div class="p-6 border-b border-[#D6D3D1] shrink-0 bg-[#FAFAF9] relative">
                <div class="flex items-center justify-between">
                    <h3 class="text-2xl font-display font-bold text-[#1C1917]" x-text="editData.id ? 'Sesuaikan Stok' : 'Tambah Stok Baru'">Sesuaikan Stok</h3>
                    <button @click="isModalOpen = false" type="button"
                        class="text-[#78716C] hover:text-[#1C1917] p-1 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                @if(session('success'))
                    <div class="mt-4 bg-[#16A34A]/10 border border-[#16A34A] text-[#16A34A] px-4 py-3 rounded-[8px] font-semibold text-[14px]" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if($errors->any())
                    <div class="mt-4 bg-[#DC2626]/10 border border-[#DC2626] text-[#DC2626] px-4 py-3 rounded-[8px] font-semibold text-[14px]" role="alert">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <div class="p-6 bg-[#FAFAF9] flex-1 overflow-y-auto">
                <form :action="submitUrl" method="POST" id="formAdjustStok">
                    @csrf
                    <!-- Paksa Method PUT krn form ini akan diarahkan ke update jika mode Edit. Namun Form HTML basic default POST,
                         jadi pakai blade if atau JS utk tambahkan field _method DELETE/PUT jika sesuai -->
                    <template x-if="editData.id">
                        <input type="hidden" name="_method" value="PUT">
                    </template>
                    
                    <div class="space-y-6">
                        <div>
                            <label class="block text-[14px] font-semibold text-[#1C1917] mb-2">Produk <span class="text-[#DC2626]">*</span></label>
                            
                            <template x-if="editData.id">
                                <div class="w-full px-4 py-3 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[8px] text-[#C2410C] font-semibold uppercase">
                                    <span x-text="editData.nama_produk"></span>
                                </div>
                            </template>

                            <template x-if="!editData.id">
                                <p class="text-[13px] text-[#57534E] mt-1 font-medium bg-[#F5F5F4] p-4 rounded-[8px] border border-[#D6D3D1]">Harap gunakan fasilitas Update Stok pada masing-masing baris produk. 'Tambah Baru' saat ini terintegrasi ke form Produk & Jasa. Silahkan kelola produk di sana terlebih dahulu.</p>
                            </template>
                        </div>

                        <template x-if="editData.id">
                            <div class="border border-[#D6D3D1] p-5 bg-[#F5F5F4] rounded-[8px] flex flex-col items-center justify-center">
                                <span class="text-[12px] font-semibold text-[#57534E] uppercase tracking-wide">Sisa Stok Saat Ini</span>
                                <span class="block text-4xl font-display font-bold text-[#16A34A] mt-2" x-text="editData.stok_awal"></span>
                            </div>
                        </template>

                        <template x-if="editData.id">
                            <div>
                                <label class="block text-[14px] font-semibold text-[#1C1917] mb-2">Perbarui Stok Ke <span class="text-[#DC2626]">*</span></label>
                                <input type="number" name="stok_awal" x-model="editData.stok_awal" min="0" placeholder="Masukkan angka"
                                    class="w-full px-4 py-4 text-center text-xl bg-[#F5F5F4] border border-[#D6D3D1] rounded-[8px] text-[#1C1917] font-bold focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15 transition-all" required>
                            </div>
                        </template>
                    </div>
                </form>
            </div>

            <div class="p-6 border-t border-[#D6D3D1] bg-[#FAFAF9] flex justify-end gap-3 shrink-0">
                <button @click="isModalOpen = false" type="button"
                    class="px-5 py-2.5 bg-transparent border border-[#D6D3D1] text-[#57534E] font-semibold rounded-[8px] hover:text-[#1C1917] hover:bg-[#F5F5F4] transition-colors">
                    Batal
                </button>
                
                <button x-show="editData.id" type="submit" form="formAdjustStok"
                    class="px-5 py-2.5 bg-[#C2410C] text-white font-semibold rounded-[8px] hover:bg-[#9A3412] transition-colors shadow-sm hover:shadow-md">
                    Simpan Stok
                </button>
                
                <!-- Tombol ini muncul kalau dia klik 'Tambah Baru' supaya kasih tau untuk edit lewat produk -->
                <a x-show="!editData.id" href="{{ route('produkjasa.index') }}"
                    class="px-5 py-2.5 border border-[#D6D3D1] bg-white text-[#1C1917] font-semibold rounded-[8px] hover:bg-[#F5F5F4] transition-colors">
                    Buka Master Produk
                </a>
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
