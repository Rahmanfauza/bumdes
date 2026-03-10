@extends('layouts.admin')

@section('header_title', 'Transaksi')

@section('content')
    <div class="space-y-6" x-data="{ isModalOpen: false }">

        {{-- Header --}}
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-800">Manajemen Transaksi</h2>
        </div>

        {{-- Summary Cards --}}
        @php
            $totalPemasukan  = $transaksis->where('jenis_transaksi', 'Pemasukan')->sum('jumlah');
            $totalPengeluaran = $transaksis->where('jenis_transaksi', 'Pengeluaran')->sum('jumlah');
            $saldo           = $totalPemasukan - $totalPengeluaran;
        @endphp
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            {{-- Pemasukan --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 10l7-7m0 0l7 7m-7-7v18" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Total Pemasukan</p>
                    <p class="text-xl font-bold text-green-600">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</p>
                </div>
            </div>
            {{-- Pengeluaran --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-red-100 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Total Pengeluaran</p>
                    <p class="text-xl font-bold text-red-500">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</p>
                </div>
            </div>
            {{-- Saldo --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Saldo Bersih</p>
                    <p class="text-xl font-bold {{ $saldo >= 0 ? 'text-blue-600' : 'text-red-600' }}">
                        Rp {{ number_format($saldo, 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>

        {{-- Success Notification --}}
        @if (session('success'))
            <div class="flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl"
                role="alert">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        {{-- Data Table --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <h3 class="text-lg font-semibold text-gray-800">Daftar Transaksi</h3>
                <button @click="isModalOpen = true"
                    class="flex items-center justify-center gap-2 px-4 py-2 bg-[#20b2aa] hover:bg-[#1c9c95] text-white rounded-lg font-medium transition shadow-sm text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Tambah Transaksi
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50/50 border-b border-gray-100">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-semibold w-12">No.</th>
                            <th scope="col" class="px-6 py-4 font-semibold">Tanggal</th>
                            <th scope="col" class="px-6 py-4 font-semibold">Unit Usaha</th>
                            <th scope="col" class="px-6 py-4 font-semibold w-36 text-center">Jenis</th>
                            <th scope="col" class="px-6 py-4 font-semibold text-right">Jumlah (Rp)</th>
                            <th scope="col" class="px-6 py-4 font-semibold">Keterangan</th>
                            <th scope="col" class="px-6 py-4 font-semibold w-28 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksis as $index => $transaksi)
                            <tr class="bg-white border-b border-gray-50 hover:bg-blue-50/20 transition-colors">
                                <td class="px-6 py-4">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->translatedFormat('d M Y') }}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900">
                                    {{ $transaksi->unitUsaha->nama_usaha ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if ($transaksi->jenis_transaksi === 'Pemasukan')
                                        <span
                                            class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-medium border rounded-full bg-green-100 text-green-700 border-green-200">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 10l7-7m0 0l7 7m-7-7v18" /></svg>
                                            Pemasukan
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-medium border rounded-full bg-red-100 text-red-700 border-red-200">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 14l-7 7m0 0l-7-7m7 7V3" /></svg>
                                            Pengeluaran
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right font-mono font-semibold
                                    {{ $transaksi->jenis_transaksi === 'Pemasukan' ? 'text-green-600' : 'text-red-500' }}">
                                    {{ number_format($transaksi->jumlah, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-gray-600 max-w-xs truncate">
                                    {{ $transaksi->keterangan ?: '-' }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        {{-- Edit --}}
                                        <button @click="$dispatch('open-edit-transaksi', {{ json_encode($transaksi) }})"
                                            class="flex items-center justify-center p-2 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition-colors"
                                            title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
                                        {{-- Hapus --}}
                                        <form action="{{ route('transaksi.destroy', $transaksi->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus transaksi ini?');"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="flex items-center justify-center p-2 rounded-lg bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition-colors"
                                                title="Hapus">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-10 text-center text-gray-400">
                                    <div class="flex flex-col items-center gap-2">
                                        <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                        </svg>
                                        <span>Belum ada data transaksi.</span>
                                    </div>
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
            class="fixed inset-0 z-50 bg-gray-900/50 backdrop-blur-sm flex items-center justify-center overflow-y-auto overflow-x-hidden p-4 sm:p-0"
            style="display: none;">
            <div x-show="isModalOpen" @click.away="isModalOpen = false"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative bg-white/40 backdrop-blur-md rounded-2xl shadow-xl border border-white/40 w-full max-w-2xl sm:mx-auto my-8 max-h-[90vh] flex flex-col overflow-hidden">

                {{-- Modal Header --}}
                <div class="p-5 md:p-6 border-b border-gray-100/50 shrink-0">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold text-white">Tambah Transaksi Baru</h3>
                            <p class="text-white/80 text-sm mt-1">Catat transaksi pemasukan atau pengeluaran BUMDes.</p>
                        </div>
                        <button @click="isModalOpen = false" type="button"
                            class="text-white bg-transparent hover:bg-gray-100 hover:text-gray-900 rounded-lg text-sm w-8 h-8 flex justify-center items-center transition-colors">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Tutup modal</span>
                        </button>
                    </div>

                    @if ($errors->any())
                        <div class="mt-4 bg-red-50/90 backdrop-blur border border-red-200 text-red-700 px-4 py-3 rounded-lg"
                            role="alert">
                            <ul class="list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                {{-- Modal Body --}}
                <div class="p-5 md:p-6 overflow-y-auto flex-1">
                    <form action="{{ route('transaksi.store') }}" method="POST" id="formTambahTransaksi">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                            {{-- Unit Usaha --}}
                            <div class="md:col-span-2">
                                <label for="unit_usaha_id"
                                    class="block text-sm font-medium text-white mb-1">Unit Usaha <span
                                        class="text-red-400">*</span></label>
                                <select id="unit_usaha_id" name="unit_usaha_id"
                                    class="w-full px-4 py-2 bg-white/20 border border-gray-400/60 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 focus:bg-white/60 outline-none transition-all text-gray-800 shadow-sm"
                                    required>
                                    <option value="" class="text-gray-400">-- Pilih Unit Usaha --</option>
                                    @foreach ($unit_usahas as $unit)
                                        <option value="{{ $unit->id }}" class="text-gray-900"
                                            {{ old('unit_usaha_id') == $unit->id ? 'selected' : '' }}>
                                            {{ $unit->nama_usaha }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Tanggal --}}
                            <div>
                                <label for="tanggal_transaksi"
                                    class="block text-sm font-medium text-white mb-1">Tanggal <span
                                        class="text-red-400">*</span></label>
                                <input type="date" id="tanggal_transaksi" name="tanggal_transaksi"
                                    value="{{ old('tanggal_transaksi', date('Y-m-d')) }}"
                                    class="w-full px-4 py-2 bg-white/20 border border-gray-400/60 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 focus:bg-white/60 outline-none transition-all text-gray-800 shadow-sm"
                                    required>
                            </div>

                            {{-- Jenis Transaksi --}}
                            <div>
                                <label for="jenis_transaksi"
                                    class="block text-sm font-medium text-white mb-1">Jenis Transaksi <span
                                        class="text-red-400">*</span></label>
                                <select id="jenis_transaksi" name="jenis_transaksi"
                                    class="w-full px-4 py-2 bg-white/20 border border-gray-400/60 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 focus:bg-white/60 outline-none transition-all text-gray-800 shadow-sm"
                                    required>
                                    <option value="Pemasukan" class="text-gray-900"
                                        {{ old('jenis_transaksi') === 'Pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                                    <option value="Pengeluaran" class="text-gray-900"
                                        {{ old('jenis_transaksi') === 'Pengeluaran' ? 'selected' : '' }}>Pengeluaran
                                    </option>
                                </select>
                            </div>

                            {{-- Jumlah --}}
                            <div class="md:col-span-2">
                                <label for="jumlah_display"
                                    class="block text-sm font-medium text-white mb-1">Jumlah (Rp) <span
                                        class="text-red-400">*</span></label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500 font-medium pointer-events-none">Rp</span>
                                    <input type="text" id="jumlah_display"
                                        value="{{ old('jumlah') ? number_format(old('jumlah'), 0, ',', '.') : '' }}"
                                        placeholder="0"
                                        autocomplete="off"
                                        data-currency-input
                                        data-target="jumlah_hidden_tambah"
                                        class="w-full pl-11 pr-4 py-2 bg-white/20 border border-gray-400/60 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 focus:bg-white/60 outline-none transition-all placeholder-gray-400 shadow-sm font-mono"
                                        required>
                                    <input type="hidden" id="jumlah_hidden_tambah" name="jumlah"
                                        value="{{ old('jumlah') }}">
                                </div>
                            </div>

                            {{-- Keterangan --}}
                            <div class="md:col-span-2">
                                <label for="keterangan"
                                    class="block text-sm font-medium text-white mb-1">Keterangan</label>
                                <textarea id="keterangan" name="keterangan" rows="3"
                                    placeholder="Deskripsi singkat transaksi..."
                                    class="w-full px-4 py-2 bg-white/20 border border-gray-400/60 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 focus:bg-white/60 outline-none transition-all placeholder-gray-400 shadow-sm">{{ old('keterangan') }}</textarea>
                            </div>
                        </div>
                    </form>
                </div>

                {{-- Modal Footer --}}
                <div class="flex items-center justify-end p-5 md:p-6 border-t border-gray-100/50 gap-3 shrink-0">
                    <button @click="isModalOpen = false" type="button"
                        class="px-5 py-2.5 border border-gray-400/50 text-gray-700 bg-white/20 rounded-xl hover:bg-white/40 font-medium transition-all focus:outline-none focus:ring-2 focus:ring-gray-200 shadow-sm">
                        Batal
                    </button>
                    <button type="submit" form="formTambahTransaksi"
                        class="px-5 py-2.5 bg-blue-300 text-white rounded-xl hover:bg-blue-700 font-medium transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan Transaksi
                    </button>
                </div>
            </div>
        </div>

        {{-- ============================================================ --}}
        {{-- MODAL EDIT TRANSAKSI --}}
        {{-- ============================================================ --}}
        <div x-data="{
                isEditModalOpen: false,
                editData: {},
                submitUrl: ''
             }"
            @open-edit-transaksi.window="
                isEditModalOpen = true;
                editData = $event.detail;
                submitUrl = '{{ route('transaksi.update', ':id') }}'.replace(':id', editData.id)
            "
            x-show="isEditModalOpen" x-transition.opacity.duration.300ms
            class="fixed inset-0 z-50 bg-gray-900/50 backdrop-blur-sm flex items-center justify-center overflow-y-auto overflow-x-hidden p-4 sm:p-0"
            style="display: none;">

            <div x-show="isEditModalOpen" @click.away="isEditModalOpen = false"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative bg-white/40 backdrop-blur-md rounded-2xl shadow-xl border border-white/40 w-full max-w-2xl sm:mx-auto my-8 max-h-[90vh] flex flex-col overflow-hidden">

                {{-- Modal Header --}}
                <div class="p-5 md:p-6 border-b border-gray-100/50 shrink-0">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold text-white">Edit Transaksi</h3>
                            <p class="text-white/80 text-sm mt-1">Perbarui data transaksi yang sudah dicatat.</p>
                        </div>
                        <button @click="isEditModalOpen = false" type="button"
                            class="text-white bg-transparent hover:bg-gray-100 hover:text-gray-900 rounded-lg text-sm w-8 h-8 flex justify-center items-center transition-colors">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Tutup modal</span>
                        </button>
                    </div>
                </div>

                {{-- Modal Body --}}
                <div class="p-5 md:p-6 overflow-y-auto flex-1">
                    <form :action="submitUrl" method="POST" id="formEditTransaksi">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                            {{-- Unit Usaha --}}
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-white mb-1">Unit Usaha <span
                                        class="text-red-400">*</span></label>
                                <select name="unit_usaha_id" x-model="editData.unit_usaha_id"
                                    class="w-full px-4 py-2 bg-white/20 border border-gray-400/60 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 focus:bg-white/60 outline-none transition-all text-gray-800 shadow-sm"
                                    required>
                                    @foreach ($unit_usahas as $unit)
                                        <option value="{{ $unit->id }}" class="text-gray-900">{{ $unit->nama_usaha }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Tanggal --}}
                            <div>
                                <label class="block text-sm font-medium text-white mb-1">Tanggal <span
                                        class="text-red-400">*</span></label>
                                <input type="date" name="tanggal_transaksi"
                                    x-model="editData.tanggal_transaksi"
                                    class="w-full px-4 py-2 bg-white/20 border border-gray-400/60 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 focus:bg-white/60 outline-none transition-all text-gray-800 shadow-sm"
                                    required>
                            </div>

                            {{-- Jenis Transaksi --}}
                            <div>
                                <label class="block text-sm font-medium text-white mb-1">Jenis Transaksi <span
                                        class="text-red-400">*</span></label>
                                <select name="jenis_transaksi" x-model="editData.jenis_transaksi"
                                    class="w-full px-4 py-2 bg-white/20 border border-gray-400/60 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 focus:bg-white/60 outline-none transition-all text-gray-800 shadow-sm"
                                    required>
                                    <option value="Pemasukan" class="text-gray-900">Pemasukan</option>
                                    <option value="Pengeluaran" class="text-gray-900">Pengeluaran</option>
                                </select>
                            </div>

                            {{-- Jumlah --}}
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-white mb-1">Jumlah (Rp) <span
                                        class="text-red-400">*</span></label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500 font-medium pointer-events-none">Rp</span>
                                    <input type="text" id="jumlah_edit_display"
                                        placeholder="0"
                                        autocomplete="off"
                                        data-currency-input
                                        data-target="jumlah_hidden_edit"
                                        class="w-full pl-11 pr-4 py-2 bg-white/20 border border-gray-400/60 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 focus:bg-white/60 outline-none transition-all shadow-sm font-mono"
                                        required>
                                    <input type="hidden" id="jumlah_hidden_edit" name="jumlah">
                                </div>
                            </div>

                            {{-- Keterangan --}}
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-white mb-1">Keterangan</label>
                                <textarea name="keterangan" rows="3" x-model="editData.keterangan"
                                    class="w-full px-4 py-2 bg-white/20 border border-gray-400/60 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 focus:bg-white/60 outline-none transition-all placeholder-gray-400 shadow-sm"></textarea>
                            </div>
                        </div>
                    </form>
                </div>

                {{-- Modal Footer --}}
                <div class="flex items-center justify-end p-5 md:p-6 border-t border-gray-100/50 gap-3 shrink-0">
                    <button @click="isEditModalOpen = false" type="button"
                        class="px-5 py-2.5 border border-gray-400/50 text-gray-700 bg-white/20 rounded-xl hover:bg-white/40 font-medium transition-all focus:outline-none focus:ring-2 focus:ring-gray-200 shadow-sm">
                        Batal
                    </button>
                    <button type="submit" form="formEditTransaksi"
                        class="px-5 py-2.5 bg-blue-300 text-white rounded-xl hover:bg-blue-700 font-medium transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7" />
                        </svg>
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
                    // Re-buka modal tambah jika ada validation error
                    document.querySelector('[x-data]').__x.$data.isModalOpen = true;
                }, 100);
            });
        </script>
    @endif

    {{-- ============================================================ --}}
    {{-- SCRIPT: Format Kurs Indonesia (Rp) real-time --}}
    {{-- ============================================================ --}}
    <script>
        /**
         * Format angka ke format titik ribuan Indonesia
         * Contoh: 1500000 → "1.500.000"
         */
        function formatRupiah(value) {
            // Hapus semua non-digit
            const digits = value.replace(/\D/g, '');
            if (!digits) return '';
            // Tambahkan titik setiap 3 digit dari kanan
            return digits.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        /**
         * Kembalikan angka murni dari tampilan berformat
         * Contoh: "1.500.000" → "1500000"
         */
        function unformatRupiah(displayValue) {
            return displayValue.replace(/\./g, '');
        }

        /**
         * Pasang event listener format ke satu input display
         */
        function initCurrencyInput(displayInput) {
            const targetId = displayInput.getAttribute('data-target');
            const hiddenInput = document.getElementById(targetId);
            if (!hiddenInput) return;

            // Format saat user mengetik
            displayInput.addEventListener('input', function () {
                const raw    = unformatRupiah(this.value);
                const formatted = formatRupiah(raw);
                this.value   = formatted;
                hiddenInput.value = raw; // simpan angka murni ke hidden
            });

            // Pastikan hidden input sync saat blur
            displayInput.addEventListener('blur', function () {
                hiddenInput.value = unformatRupiah(this.value);
            });

            // Blokir karakter non-angka (kecuali navigasi keyboard)
            displayInput.addEventListener('keydown', function (e) {
                const allowed = [
                    'Backspace', 'Delete', 'ArrowLeft', 'ArrowRight',
                    'Home', 'End', 'Tab'
                ];
                if (allowed.includes(e.key)) return;
                if (!/^\d$/.test(e.key)) e.preventDefault();
            });
        }

        // Inisialisasi semua currency input saat DOM siap
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('[data-currency-input]').forEach(initCurrencyInput);
        });

        // Inisialisasi ulang jika Alpine me-render ulang setelah mount
        document.addEventListener('alpine:initialized', function () {
            document.querySelectorAll('[data-currency-input]').forEach(input => {
                // Hindari double-binding
                if (!input.dataset.currencyBound) {
                    input.dataset.currencyBound = '1';
                    initCurrencyInput(input);
                }
            });
        });

        /**
         * Saat modal EDIT dibuka:
         * Isi display input dengan nilai jumlah yang sudah diformat
         */
        window.addEventListener('open-edit-transaksi', function (event) {
            const jumlah = event.detail && event.detail.jumlah ? event.detail.jumlah : '';
            // Tunggu Alpine selesai render modal
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

