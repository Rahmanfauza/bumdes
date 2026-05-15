@extends('layouts.admin')

@section('header_title', 'Manajemen Transaksi')

@section('content')
<div class="space-y-6" x-data="{ isModalOpen: false }">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div class="inline-block px-[14px] py-[6px] bg-[#F5F5F4] text-[#57534E] font-semibold text-[14px] rounded-[9999px]">
            Jurnal Umum & Transaksi Usaha
        </div>
    </div>

    {{-- Summary Cards (Flat Design) --}}
    @php
        $totalPemasukan  = $transaksis->where('jenis_transaksi', 'Pemasukan')->sum('jumlah');
        $totalPengeluaran = $transaksis->where('jenis_transaksi', 'Pengeluaran')->sum('jumlah');
        $saldo           = $totalPemasukan - $totalPengeluaran;
    @endphp
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        {{-- Pemasukan --}}
        <div class="bg-[#FAFAF9] border border-[#D6D3D1] rounded-[12px] p-6 shadow-sm hover:shadow-md transition-shadow flex items-center gap-5">
            <div class="w-14 h-14 rounded-full bg-[#DCFCE7] flex items-center justify-center shrink-0">
                <svg class="w-7 h-7 text-[#16A34A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                </svg>
            </div>
            <div>
                <p class="text-[13px] text-[#78716C] font-semibold uppercase tracking-wide">Pemasukan</p>
                <p class="text-2xl font-display font-bold text-[#1C1917] mt-1">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</p>
            </div>
        </div>
        {{-- Pengeluaran --}}
        <div class="bg-[#FAFAF9] border border-[#D6D3D1] rounded-[12px] p-6 shadow-sm hover:shadow-md transition-shadow flex items-center gap-5">
            <div class="w-14 h-14 rounded-full bg-[#FEE2E2] flex items-center justify-center shrink-0">
                <svg class="w-7 h-7 text-[#DC2626]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                </svg>
            </div>
            <div>
                <p class="text-[13px] text-[#78716C] font-semibold uppercase tracking-wide">Pengeluaran</p>
                <p class="text-2xl font-display font-bold text-[#1C1917] mt-1">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</p>
            </div>
        </div>
        {{-- Saldo --}}
        <div class="bg-[#FAFAF9] border border-[#D6D3D1] rounded-[12px] p-6 shadow-sm hover:shadow-md transition-shadow flex items-center gap-5">
            <div class="w-14 h-14 rounded-full bg-[#FEF3C7] flex items-center justify-center shrink-0">
                <svg class="w-7 h-7 text-[#D97706]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="text-[13px] text-[#78716C] font-semibold uppercase tracking-wide">Saldo Bersih</p>
                <p class="text-2xl font-display font-bold text-[#1C1917] mt-1">Rp {{ number_format($saldo, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>

    {{-- Success Notification --}}
    @if (session('success'))
        <div class="flex items-center gap-3 bg-[#DCFCE7] border border-[#16A34A]/20 text-[#16A34A] px-4 py-3 rounded-[8px] font-semibold text-[14px]" role="alert">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    {{-- Data Table --}}
    <div class="bg-[#FAFAF9] border border-[#D6D3D1] rounded-[12px] shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-[#D6D3D1] flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h3 class="text-2xl font-display font-bold text-[#1C1917]">Daftar Transaksi</h3>
                <p class="text-[14px] text-[#57534E] mt-1">Kelola arus kas keluar masuk operasional</p>
            </div>
            <button @click="isModalOpen = true"
                class="flex items-center justify-center gap-2 px-6 py-2.5 bg-[#C2410C] hover:bg-[#9A3412] text-white rounded-[8px] font-semibold text-[14px] transition-all shadow-sm hover:shadow-[0_4px_12px_rgba(194,65,12,0.25)]">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Transaksi
            </button>
        </div>

        <div class="overflow-x-auto min-h-[400px]">
            <table class="w-full text-left font-semibold text-[#1C1917]">
                <thead class="text-[12px] uppercase bg-[#F5F5F4] border-b border-[#D6D3D1] text-[#78716C]">
                    <tr>
                        <th scope="col" class="px-6 py-4 font-semibold tracking-wide w-12 text-center">No.</th>
                        <th scope="col" class="px-6 py-4 font-semibold tracking-wide whitespace-nowrap">Tanggal</th>
                        <th scope="col" class="px-6 py-4 font-semibold tracking-wide">Unit Usaha</th>
                        <th scope="col" class="px-6 py-4 font-semibold tracking-wide w-36 text-center">Jenis</th>
                        <th scope="col" class="px-6 py-4 font-semibold tracking-wide text-right">Jumlah (Rp)</th>
                        <th scope="col" class="px-6 py-4 font-semibold tracking-wide">Keterangan</th>
                        <th scope="col" class="px-6 py-4 font-semibold tracking-wide text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksis as $index => $transaksi)
                        <tr class="border-b border-[#D6D3D1] hover:bg-[#F5F5F4] transition-colors last:border-0">
                            <td class="px-6 py-4 text-center text-[#57534E]">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-[#57534E]">
                                {{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->translatedFormat('d M Y') }}
                            </td>
                            <td class="px-6 py-4 font-semibold uppercase text-[#C2410C]">
                                {{ $transaksi->unitUsaha->nama_usaha ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if ($transaksi->jenis_transaksi === 'Pemasukan')
                                    <span class="inline-block px-[10px] py-[4px] rounded-[9999px] text-[11px] font-bold uppercase tracking-wide bg-[#DCFCE7] text-[#16A34A]">
                                        Pemasukan
                                    </span>
                                @else
                                    <span class="inline-block px-[10px] py-[4px] rounded-[9999px] text-[11px] font-bold uppercase tracking-wide bg-[#FEE2E2] text-[#DC2626]">
                                        Pengeluaran
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right font-bold whitespace-nowrap
                                {{ $transaksi->jenis_transaksi === 'Pemasukan' ? 'text-[#16A34A]' : 'text-[#DC2626]' }}">
                                {{ number_format($transaksi->jumlah, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-[#57534E] max-w-xs truncate">
                                {{ $transaksi->keterangan ?: '-' }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-2">
                                    {{-- Edit --}}
                                    <button @click="$dispatch('open-edit-transaksi', {{ json_encode($transaksi) }})"
                                        class="px-4 py-2 bg-transparent border border-[#D6D3D1] text-[#1C1917] rounded-[8px] hover:bg-[#E7E5E4] font-semibold text-[13px] transition-colors"
                                        title="Edit">
                                        Edit
                                    </button>
                                    {{-- Hapus --}}
                                    <form action="{{ route('transaksi.destroy', $transaksi->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus transaksi ini?');"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-4 py-2 bg-[#DC2626] text-white rounded-[8px] hover:bg-[#B91C1C] font-semibold text-[13px] transition-colors"
                                            title="Hapus">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-[#78716C] font-semibold bg-[#FAFAF9]">
                                Belum ada data transaksi tercatat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- MODAL TAMBAH TRANSAKSI --}}
    {{-- ============================================================ --}}
    <div x-show="isModalOpen" x-transition.opacity.duration.300ms
        class="fixed inset-0 z-[70] bg-[#1C1917]/80 backdrop-blur-sm flex items-center justify-center p-4 sm:p-0"
        style="display: none;">
        <div x-show="isModalOpen" @click.away="isModalOpen = false"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            class="relative bg-[#FAFAF9] border border-[#D6D3D1] shadow-[0_24px_48px_rgba(28,25,23,0.12)] w-full max-w-2xl sm:mx-auto my-8 max-h-[90vh] flex flex-col overflow-hidden rounded-[12px]">

            {{-- Modal Header --}}
            <div class="p-6 border-b border-[#D6D3D1] shrink-0 bg-[#FAFAF9] relative">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-display font-bold text-[#1C1917]">Tambah Transaksi</h3>
                        <p class="text-[14px] text-[#57534E] mt-1">Catat pemasukan atau pengeluaran baru</p>
                    </div>
                    <button @click="isModalOpen = false" type="button"
                        class="text-[#78716C] hover:text-[#1C1917] p-1 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                @if ($errors->any())
                    <div class="mt-4 bg-[#FEE2E2] border border-[#DC2626]/20 text-[#DC2626] px-4 py-3 rounded-[8px] font-semibold text-[14px]" role="alert">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            {{-- Modal Body --}}
            <div class="p-6 overflow-y-auto flex-1 bg-[#FAFAF9]">
                <form action="{{ route('transaksi.store') }}" method="POST" id="formTambahTransaksi">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Unit Usaha --}}
                        <div class="md:col-span-2">
                            <label class="block text-[13px] font-semibold text-[#1C1917] uppercase tracking-wide mb-2">Unit Usaha <span class="text-[#DC2626]">*</span></label>
                            <select id="unit_usaha_id" name="unit_usaha_id"
                                class="w-full px-4 py-3 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[8px] text-[#1C1917] focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15 transition-all appearance-none uppercase" required>
                                <option value="">-- Pilih Unit Usaha --</option>
                                @foreach ($unit_usahas as $unit)
                                    <option value="{{ $unit->id }}" {{ old('unit_usaha_id') == $unit->id ? 'selected' : '' }}>
                                        {{ $unit->nama_usaha }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Tanggal --}}
                        <div>
                            <label class="block text-[13px] font-semibold text-[#1C1917] uppercase tracking-wide mb-2">Tanggal <span class="text-[#DC2626]">*</span></label>
                            <input type="date" id="tanggal_transaksi" name="tanggal_transaksi"
                                value="{{ old('tanggal_transaksi', date('Y-m-d')) }}"
                                class="w-full px-4 py-3 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[8px] text-[#1C1917] focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15 transition-all" required>
                        </div>

                        {{-- Jenis Transaksi --}}
                        <div>
                            <label class="block text-[13px] font-semibold text-[#1C1917] uppercase tracking-wide mb-2">Jenis Transaksi <span class="text-[#DC2626]">*</span></label>
                            <select id="jenis_transaksi" name="jenis_transaksi"
                                class="w-full px-4 py-3 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[8px] text-[#1C1917] focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15 transition-all appearance-none uppercase" required>
                                <option value="Pemasukan" {{ old('jenis_transaksi') === 'Pemasukan' ? 'selected' : '' }}>PEMASUKAN</option>
                                <option value="Pengeluaran" {{ old('jenis_transaksi') === 'Pengeluaran' ? 'selected' : '' }}>PENGELUARAN</option>
                            </select>
                        </div>

                        {{-- Jumlah --}}
                        <div class="md:col-span-2">
                            <label class="block text-[13px] font-semibold text-[#1C1917] uppercase tracking-wide mb-2">Jumlah (Rp) <span class="text-[#DC2626]">*</span></label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-[#57534E] font-semibold pointer-events-none">Rp</span>
                                <input type="text" id="jumlah_display"
                                    value="{{ old('jumlah') ? number_format(old('jumlah'), 0, ',', '.') : '' }}"
                                    placeholder="0"
                                    autocomplete="off"
                                    data-currency-input
                                    data-target="jumlah_hidden_tambah"
                                    class="w-full pl-12 pr-4 py-3 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[8px] text-[#1C1917] font-semibold focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15 transition-all" required>
                                <input type="hidden" id="jumlah_hidden_tambah" name="jumlah" value="{{ old('jumlah') }}">
                            </div>
                        </div>

                        {{-- Keterangan --}}
                        <div class="md:col-span-2">
                            <label class="block text-[13px] font-semibold text-[#1C1917] uppercase tracking-wide mb-2">Keterangan</label>
                            <textarea id="keterangan" name="keterangan" rows="3"
                                placeholder="Deskripsi singkat transaksi..."
                                class="w-full px-4 py-3 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[8px] text-[#1C1917] placeholder-[#A8A29E] focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15 transition-all">{{ old('keterangan') }}</textarea>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Modal Footer --}}
            <div class="p-6 border-t border-[#D6D3D1] shrink-0 bg-[#FAFAF9] flex justify-end gap-3">
                <button @click="isModalOpen = false" type="button"
                    class="px-5 py-2.5 bg-transparent border border-[#D6D3D1] text-[#57534E] font-semibold rounded-[8px] hover:text-[#1C1917] hover:bg-[#F5F5F4] transition-colors">
                    Batal
                </button>
                <button type="submit" form="formTambahTransaksi"
                    class="px-6 py-2.5 bg-[#C2410C] text-white font-semibold rounded-[8px] hover:bg-[#9A3412] shadow-sm transition-all flex items-center gap-2">
                    Simpan Transaksi
                </button>
            </div>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- MODAL EDIT TRANSAKSI --}}
    {{-- ============================================================ --}}
    <div x-data="{ isEditModalOpen: false, editData: {}, submitUrl: '' }"
        @open-edit-transaksi.window="
            isEditModalOpen = true;
            editData = $event.detail;
            submitUrl = '{{ route('transaksi.update', ':id') }}'.replace(':id', editData.id)
        "
        x-show="isEditModalOpen" x-transition.opacity.duration.300ms
        class="fixed inset-0 z-[70] bg-[#1C1917]/80 backdrop-blur-sm flex items-center justify-center p-4 sm:p-0"
        style="display: none;">

        <div x-show="isEditModalOpen" @click.away="isEditModalOpen = false"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            class="relative bg-[#FAFAF9] border border-[#D6D3D1] shadow-[0_24px_48px_rgba(28,25,23,0.12)] w-full max-w-2xl sm:mx-auto my-8 max-h-[90vh] flex flex-col overflow-hidden rounded-[12px]">

            {{-- Modal Header --}}
            <div class="p-6 border-b border-[#D6D3D1] shrink-0 bg-[#FAFAF9] relative">
                <div class="flex items-center justify-between">
                    <h3 class="text-2xl font-display font-bold text-[#1C1917]">Edit Transaksi</h3>
                    <button @click="isEditModalOpen = false" type="button"
                        class="text-[#78716C] hover:text-[#1C1917] p-1 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Modal Body --}}
            <div class="p-6 overflow-y-auto flex-1 bg-[#FAFAF9]">
                <form :action="submitUrl" method="POST" id="formEditTransaksi">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Unit Usaha --}}
                        <div class="md:col-span-2">
                            <label class="block text-[13px] font-semibold text-[#1C1917] uppercase tracking-wide mb-2">Unit Usaha <span class="text-[#DC2626]">*</span></label>
                            <select name="unit_usaha_id" x-model="editData.unit_usaha_id"
                                class="w-full px-4 py-3 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[8px] text-[#1C1917] focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15 transition-all appearance-none uppercase" required>
                                @foreach ($unit_usahas as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->nama_usaha }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Tanggal --}}
                        <div>
                            <label class="block text-[13px] font-semibold text-[#1C1917] uppercase tracking-wide mb-2">Tanggal <span class="text-[#DC2626]">*</span></label>
                            <input type="date" name="tanggal_transaksi" x-model="editData.tanggal_transaksi"
                                class="w-full px-4 py-3 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[8px] text-[#1C1917] focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15 transition-all" required>
                        </div>

                        {{-- Jenis Transaksi --}}
                        <div>
                            <label class="block text-[13px] font-semibold text-[#1C1917] uppercase tracking-wide mb-2">Jenis Transaksi <span class="text-[#DC2626]">*</span></label>
                            <select name="jenis_transaksi" x-model="editData.jenis_transaksi"
                                class="w-full px-4 py-3 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[8px] text-[#1C1917] focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15 transition-all appearance-none uppercase" required>
                                <option value="Pemasukan">PEMASUKAN</option>
                                <option value="Pengeluaran">PENGELUARAN</option>
                            </select>
                        </div>

                        {{-- Jumlah --}}
                        <div class="md:col-span-2">
                            <label class="block text-[13px] font-semibold text-[#1C1917] uppercase tracking-wide mb-2">Jumlah (Rp) <span class="text-[#DC2626]">*</span></label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-[#57534E] font-semibold pointer-events-none">Rp</span>
                                <input type="text" id="jumlah_edit_display"
                                    placeholder="0"
                                    autocomplete="off"
                                    data-currency-input
                                    data-target="jumlah_hidden_edit"
                                    class="w-full pl-12 pr-4 py-3 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[8px] text-[#1C1917] font-semibold focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15 transition-all" required>
                                <input type="hidden" id="jumlah_hidden_edit" name="jumlah">
                            </div>
                        </div>

                        {{-- Keterangan --}}
                        <div class="md:col-span-2">
                            <label class="block text-[13px] font-semibold text-[#1C1917] uppercase tracking-wide mb-2">Keterangan</label>
                            <textarea name="keterangan" rows="3" x-model="editData.keterangan"
                                class="w-full px-4 py-3 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[8px] text-[#1C1917] focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15 transition-all"></textarea>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Modal Footer --}}
            <div class="p-6 border-t border-[#D6D3D1] shrink-0 bg-[#FAFAF9] flex justify-end gap-3">
                <button @click="isEditModalOpen = false" type="button"
                    class="px-5 py-2.5 bg-transparent border border-[#D6D3D1] text-[#57534E] font-semibold rounded-[8px] hover:text-[#1C1917] hover:bg-[#F5F5F4] transition-colors">
                    Batal
                </button>
                <button type="submit" form="formEditTransaksi"
                    class="px-6 py-2.5 bg-[#C2410C] text-white font-semibold rounded-[8px] hover:bg-[#9A3412] shadow-sm transition-all">
                    Perbarui Transaksi
                </button>
            </div>
        </div>
    </div>

</div>

@if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                document.querySelector('[x-data]').__x.$data.isModalOpen = true;
            }, 100);
        });
    </script>
@endif

{{-- ============================================================ --}}
{{-- SCRIPT: Format Kurs Indonesia (Rp) real-time --}}
{{-- ============================================================ --}}
<script>
    function formatRupiah(value) {
        const digits = value.replace(/\D/g, '');
        if (!digits) return '';
        return digits.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    function unformatRupiah(displayValue) {
        return displayValue.replace(/\./g, '');
    }

    function initCurrencyInput(displayInput) {
        const targetId = displayInput.getAttribute('data-target');
        const hiddenInput = document.getElementById(targetId);
        if (!hiddenInput) return;

        displayInput.addEventListener('input', function () {
            const raw    = unformatRupiah(this.value);
            const formatted = formatRupiah(raw);
            this.value   = formatted;
            hiddenInput.value = raw;
        });

        displayInput.addEventListener('blur', function () {
            hiddenInput.value = unformatRupiah(this.value);
        });

        displayInput.addEventListener('keydown', function (e) {
            const allowed = [
                'Backspace', 'Delete', 'ArrowLeft', 'ArrowRight',
                'Home', 'End', 'Tab'
            ];
            if (allowed.includes(e.key)) return;
            if (!/^\d$/.test(e.key)) e.preventDefault();
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('[data-currency-input]').forEach(initCurrencyInput);
    });

    document.addEventListener('alpine:initialized', function () {
        document.querySelectorAll('[data-currency-input]').forEach(input => {
            if (!input.dataset.currencyBound) {
                input.dataset.currencyBound = '1';
                initCurrencyInput(input);
            }
        });
    });

    window.addEventListener('open-edit-transaksi', function (event) {
        const jumlah = event.detail && event.detail.jumlah ? event.detail.jumlah : '';
        setTimeout(function () {
            const displayInput = document.getElementById('jumlah_edit_display');
            const hiddenInput  = document.getElementById('jumlah_hidden_edit');
            if (displayInput && hiddenInput) {
                const raw = String(Math.round(parseFloat(jumlah) || 0));
                displayInput.value = formatRupiah(raw);
                hiddenInput.value  = raw;
            }
        }, 50);
    });
</script>
@endsection
