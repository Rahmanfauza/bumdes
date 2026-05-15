@extends('layouts.admin')

@section('header_title', 'Master Saldo Awal')

@section('content')
<div class="space-y-6" x-data="{ isModalOpen: false }">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="inline-block px-[14px] py-[6px] bg-[#F5F5F4] text-[#57534E] font-semibold text-[14px] rounded-[9999px]">
            Data Saldo Awal BUMDes
        </div>
        <div class="inline-flex items-center px-5 py-2.5 bg-[#DCFCE7] text-[#16A34A] border border-[#16A34A]/20 rounded-[9999px] font-bold text-[14px] shadow-sm">
            Total Kas: Rp {{ number_format($total_saldo, 0, ',', '.') }}
        </div>
    </div>

    <!-- Layout Container (Sidebar + Content) -->
    <div class="flex flex-col xl:flex-row gap-8 items-start mt-4">
        
        <!-- Sidebar Buttons (Kiri) -->
        <div class="w-full xl:w-1/4 shrink-0">
            @include('admin.input data.inputdata')
        </div>

        <!-- Content Area (Kanan) -->
        <div class="w-full xl:w-3/4 flex-1">
            <!-- Data Table -->
            <div class="bg-[#FAFAF9] border border-[#D6D3D1] rounded-[12px] shadow-sm overflow-hidden hover:shadow-[0_4px_16px_rgba(28,25,23,0.06)] transition-shadow">
                <div class="px-6 py-5 border-b border-[#D6D3D1] flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <h3 class="text-2xl font-display font-bold text-[#1C1917]">Riwayat Saldo Awal</h3>
                        <p class="text-[#57534E] text-[14px] mt-1">Daftar transaksi penyertaan dan input kas awal</p>
                    </div>
                    <button @click="isModalOpen = true"
                        class="flex items-center justify-center gap-2 px-6 py-3 bg-[#C2410C] hover:bg-[#9A3412] text-white rounded-[8px] font-semibold text-[14px] transition-all shadow-sm hover:shadow-[0_4px_12px_rgba(194,65,12,0.25)]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Saldo Awal
                    </button>
                </div>
                <div class="overflow-x-auto min-h-[400px]">
                    <table class="w-full text-left font-semibold text-[#1C1917]">
                        <thead class="bg-[#F5F5F4] border-b border-[#D6D3D1] text-[12px] uppercase text-[#78716C]">
                            <tr>
                                <th class="px-6 py-4 font-semibold tracking-wide">Tanggal</th>
                                <th class="px-6 py-4 font-semibold tracking-wide">Sumber Dana</th>
                                <th class="px-6 py-4 font-semibold tracking-wide text-right">Jumlah</th>
                                <th class="px-6 py-4 font-semibold tracking-wide">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($saldo_awals as $saldo)
                            <tr class="border-b border-[#D6D3D1] last:border-0 hover:bg-[#F5F5F4] transition-colors">
                                <td class="px-6 py-4 font-semibold text-[#1C1917]">{{ \Carbon\Carbon::parse($saldo->tanggal)->format('d M Y') }}</td>
                                <td class="px-6 py-4 text-[#57534E]">{{ $saldo->sumber_dana }}</td>
                                <td class="px-6 py-4 text-right font-semibold text-[#16A34A]">Rp {{ number_format($saldo->jumlah, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-[#57534E] text-[14px]">{{ $saldo->keterangan ?? '-' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-[#78716C] font-semibold">
                                    Belum ada data saldo awal yang dimasukkan.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Saldo Awal -->
    <div x-show="isModalOpen" x-transition.opacity.duration.300ms
        class="fixed inset-0 z-[70] bg-[#1C1917]/80 backdrop-blur-sm flex items-center justify-center p-4 sm:p-0"
        style="display: none;">
        
        <div x-show="isModalOpen" @click.away="isModalOpen = false" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            class="relative bg-[#FAFAF9] border border-[#D6D3D1] shadow-[0_24px_48px_rgba(28,25,23,0.12)] w-full max-w-lg sm:mx-auto my-8 flex flex-col overflow-hidden rounded-[12px]">
            
            <div class="p-6 border-b border-[#D6D3D1] shrink-0 bg-[#FAFAF9] relative">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-display font-bold text-[#1C1917]">Tambah Saldo Awal</h3>
                        <p class="text-[#57534E] text-[14px] mt-1">Input penyertaan modal atau kas awal</p>
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

            <div class="p-6 bg-[#FAFAF9] flex-1 overflow-y-auto">
                <form action="{{ route('saldo-awal.store') }}" method="POST" id="formTambahSaldo" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-[14px] font-semibold text-[#1C1917] mb-2">Tanggal <span class="text-[#DC2626]">*</span></label>
                        <input type="date" name="tanggal" required class="w-full px-4 py-3 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[8px] text-[#1C1917] text-[16px] focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15 transition-all">
                    </div>
                    <div>
                        <label class="block text-[14px] font-semibold text-[#1C1917] mb-2">Sumber Dana <span class="text-[#DC2626]">*</span></label>
                        <input type="text" name="sumber_dana" required placeholder="Contoh: Penyertaan Modal Desa" class="w-full px-4 py-3 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[8px] text-[#1C1917] text-[16px] placeholder-[#A8A29E] focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15 transition-all">
                    </div>
                    <div>
                        <label class="block text-[14px] font-semibold text-[#1C1917] mb-2">Jumlah Kas (Rp) <span class="text-[#DC2626]">*</span></label>
                        <div class="relative">
                            <span class="absolute left-4 top-3 text-[#57534E] font-semibold">Rp</span>
                            <input type="text" name="jumlah" required class="format-rupiah w-full pl-12 pr-4 py-3 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[8px] text-[#1C1917] font-semibold focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15 transition-all">
                        </div>
                    </div>
                    <div>
                        <label class="block text-[14px] font-semibold text-[#1C1917] mb-2">Keterangan</label>
                        <input type="text" name="keterangan" placeholder="Catatan tambahan..." class="w-full px-4 py-3 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[8px] text-[#1C1917] text-[16px] placeholder-[#A8A29E] focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15 transition-all">
                    </div>
                </form>
            </div>

            <div class="p-6 border-t border-[#D6D3D1] bg-[#FAFAF9] flex justify-end gap-3 shrink-0">
                <button @click="isModalOpen = false" type="button"
                    class="px-5 py-2.5 bg-transparent border border-[#D6D3D1] text-[#57534E] font-semibold rounded-[8px] hover:text-[#1C1917] hover:bg-[#F5F5F4] transition-colors">
                    Batal
                </button>
                <button type="submit" form="formTambahSaldo"
                    class="px-5 py-2.5 bg-[#C2410C] text-white font-semibold rounded-[8px] hover:bg-[#9A3412] transition-colors shadow-sm">
                    Simpan Data
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
