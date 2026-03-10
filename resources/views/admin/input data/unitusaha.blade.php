@extends('layouts.admin')

@section('header_title', 'Master Data Unit Usaha')

@section('content')
    <div class="space-y-6" x-data="{ isModalOpen: false }">
        <!-- Header Page (Optional, bisa dihilangkan jika title cukup) -->
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-800">Input Data Awal & Master</h2>
        </div>

        @include('admin.input data.inputdata')

        <!-- Data Table Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <h3 class="text-lg font-semibold text-gray-800">Daftar Unit Usaha</h3>
                <button @click="isModalOpen = true"
                    class="flex items-center justify-center gap-2 px-4 py-2 bg-[#20b2aa] hover:bg-[#1c9c95] text-white rounded-lg font-medium transition shadow-sm text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tambah Unit Usaha
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50/50 border-b border-gray-100">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-semibold w-16">No.</th>
                            <th scope="col" class="px-6 py-4 font-semibold w-64">Nama Usaha</th>
                            <th scope="col" class="px-6 py-4 font-semibold">Deskripsi</th>
                            <th scope="col" class="px-6 py-4 font-semibold w-40 text-center">Status</th>
                            <th scope="col" class="px-6 py-4 font-semibold w-32 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($unit_usahas as $index => $unit)
                            <tr class="bg-white border-b border-gray-50 hover:bg-blue-50/20 transition-colors">
                                <td class="px-6 py-4">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $unit->nama_usaha }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $unit->deskripsi_usaha ?: '-' }}</td>
                                <td class="px-6 py-4 text-center">
                                    @php
                                        $statusConfig = [
                                            'Aktif' => 'bg-green-100 text-green-700 border-green-200',
                                            'Tidak Aktif' => 'bg-red-100 text-red-700 border-red-200',
                                            'Dalam Pengembangan' => 'bg-yellow-100 text-yellow-700 border-yellow-200',
                                        ];
                                        $badgeClass = $statusConfig[$unit->status_usaha] ?? 'bg-gray-100 text-gray-700 border-gray-200';
                                    @endphp
                                    <span
                                        class="inline-flex px-2.5 py-1 text-xs font-medium border rounded-full {{ $badgeClass }}">
                                        {{ $unit->status_usaha }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right flex justify-end gap-2">
                                    <!-- Tombol Edit -->
                                    <button @click="$dispatch('open-edit', {{ json_encode($unit) }})"
                                        class="flex items-center justify-center p-2 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition-colors"
                                        title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </button>
                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('unit-usaha.destroy', $unit->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus Unit Usaha ini?');"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="flex items-center justify-center p-2 rounded-lg bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition-colors"
                                            title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-gray-500">
                                    Belum ada data unit usaha.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Tambah Unit Usaha (Glassmorphism) -->
        <div x-show="isModalOpen" x-transition.opacity.duration.300ms
            class="fixed inset-0 z-50 bg-gray-900/50 backdrop-blur-sm flex items-center justify-center overflow-y-auto overflow-x-hidden p-4 sm:p-0"
            style="display: none;">
            <!-- Modal Content -->
            <div x-show="isModalOpen" @click.away="isModalOpen = false" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative bg-white/40 backdrop-blur-md rounded-2xl shadow-xl border border-white/40 w-full max-w-2xl sm:mx-auto my-8 max-h-[90vh] flex flex-col overflow-hidden">

                <!-- Modal Header -->
                <div class="p-5 md:p-6 border-b border-gray-100/50 shrink-0">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold text-white">Tambah Unit Usaha Baru</h3>
                            <p class="text-white text-sm mt-1">Masukkan rincian unit usaha BUMDes.</p>
                        </div>
                        <button @click="isModalOpen = false" type="button"
                            class="text-white bg-transparent hover:bg-gray-100 hover:text-gray-900 rounded-lg text-sm w-8 h-8 flex justify-center items-center transition-colors">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Tutup modal</span>
                        </button>
                    </div>

                    <!-- Alert Messages -->
                    @if(session('success'))
                        <div class="mt-4 bg-green-50/90 backdrop-blur border border-green-200 text-green-700 px-4 py-3 rounded-lg relative"
                            role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mt-4 bg-red-50/90 backdrop-blur border border-red-200 text-red-700 px-4 py-3 rounded-lg relative"
                            role="alert">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <!-- Modal Body (Form) -->
                <div class="p-5 md:p-6 overflow-y-auto flex-1">
                    <form action="{{ route('unit-usaha.store') }}" method="POST" id="formTambahUnitUsaha">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nama Usaha -->
                            <div class="md:col-span-2">
                                <label for="nama_usaha" class="block text-sm font-medium text-white mb-1">Nama Usaha <span
                                        class="text-red-500">*</span></label>
                                <input type="text" id="nama_usaha" name="nama_usaha"
                                    placeholder="Cth: Pamsimas, Penyewaan Tratag, dll."
                                    class="w-full px-4 py-2 bg-white/20 border border-gray-400/60 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 focus:bg-white/60 outline-none transition-all placeholder-gray-500 shadow-sm"
                                    required>
                            </div>

                            <!-- Status Usaha -->
                            <div class="md:col-span-2">
                                <label for="status_usaha" class="block text-sm font-medium text-white mb-1">Status Usaha
                                    <span class="text-red-500">*</span></label>
                                <select id="status_usaha" name="status_usaha"
                                    class="w-full px-4 py-2 bg-white/20 border border-gray-400/60 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 focus:bg-white/60 outline-none transition-all text-gray-800 shadow-sm"
                                    required>
                                    <option value="Aktif" class="text-gray-900">Aktif</option>
                                    <option value="Tidak Aktif" class="text-gray-900">Tidak Aktif</option>
                                    <option value="Dalam Pengembangan" class="text-gray-900">Dalam Pengembangan</option>
                                </select>
                            </div>

                            <!-- Deskripsi Usaha -->
                            <div class="md:col-span-2">
                                <label for="deskripsi_usaha" class="block text-sm font-medium text-white mb-1">Deskripsi
                                    Usaha</label>
                                <textarea id="deskripsi_usaha" name="deskripsi_usaha" rows="4"
                                    placeholder="Detail jenis usaha, layanan yang diberikan, dll."
                                    class="w-full px-4 py-2 bg-white/20 border border-gray-400/60 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 focus:bg-white/60 outline-none transition-all placeholder-gray-500 shadow-sm"></textarea>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Modal Footer -->
                <div class="flex items-center justify-end p-5 md:p-6 border-t border-gray-100/50 gap-3 shrink-0">
                    <button @click="isModalOpen = false" type="button"
                        class="px-5 py-2.5 border border-gray-400/50 text-gray-700 bg-white/20 rounded-xl hover:bg-white/40 font-medium transition-all focus:outline-none focus:ring-2 focus:ring-gray-200 shadow-sm">
                        Batal
                    </button>
                    <button type="submit" form="formTambahUnitUsaha"
                        class="px-5 py-2.5 bg-blue-300 text-white rounded-xl hover:bg-blue-700 font-medium transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Simpan Data
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal Edit Unit Usaha (Glassmorphism) -->
        <div x-data="{ 
                                                isEditModalOpen: false, 
                                                editData: {},
                                                submitUrl: '' 
                                             }"
            @open-edit.window="isEditModalOpen = true; editData = $event.detail; submitUrl = '{{ route('unit-usaha.update', ':id') }}'.replace(':id', editData.id)"
            x-show=" isEditModalOpen" x-transition.opacity.duration.300ms
            class="fixed inset-0 z-50 bg-gray-900/50 backdrop-blur-sm flex items-center justify-center overflow-y-auto overflow-x-hidden p-4 sm:p-0"
            style="display: none;">
            <!-- Modal Content -->
            <div x-show="isEditModalOpen" @click.away="isEditModalOpen = false" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative bg-white/40 backdrop-blur-md rounded-2xl shadow-xl border border-white/40 w-full max-w-2xl sm:mx-auto my-8 max-h-[90vh] flex flex-col overflow-hidden">

                <!-- Modal Header -->
                <div class="p-5 md:p-6 border-b border-gray-100/50 shrink-0">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold text-white">Edit Unit Usaha</h3>
                            <p class="text-white text-sm mt-1">Perbarui rincian unit usaha BUMDes.</p>
                        </div>
                        <button @click="isEditModalOpen = false" type="button"
                            class="text-white bg-transparent hover:bg-gray-100 hover:text-gray-900 rounded-lg text-sm w-8 h-8 flex justify-center items-center transition-colors">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Tutup modal</span>
                        </button>
                    </div>
                </div>

                <!-- Modal Body (Form) -->
                <div class="p-5 md:p-6 overflow-y-auto flex-1">
                    <form :action="submitUrl" method="POST" id="formEditUnitUsaha">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nama Usaha -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-white mb-1">Nama Usaha <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="nama_usaha" x-model="editData.nama_usaha"
                                    class="w-full px-4 py-2 bg-white/20 border border-gray-400/60 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 focus:bg-white/60 outline-none transition-all placeholder-gray-500 shadow-sm"
                                    required>
                            </div>

                            <!-- Status Usaha -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-white mb-1">Status Usaha <span
                                        class="text-red-500">*</span></label>
                                <select name="status_usaha" x-model="editData.status_usaha"
                                    class="w-full px-4 py-2 bg-white/20 border border-gray-400/60 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 focus:bg-white/60 outline-none transition-all text-gray-800 shadow-sm"
                                    required>
                                    <option value="Aktif" class="text-gray-900">Aktif</option>
                                    <option value="Tidak Aktif" class="text-gray-900">Tidak Aktif</option>
                                    <option value="Dalam Pengembangan" class="text-gray-900">Dalam Pengembangan</option>
                                </select>
                            </div>

                            <!-- Deskripsi Usaha -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-white mb-1">Deskripsi Usaha</label>
                                <textarea name="deskripsi_usaha" rows="4" x-model="editData.deskripsi_usaha"
                                    class="w-full px-4 py-2 bg-white/20 border border-gray-400/60 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 focus:bg-white/60 outline-none transition-all placeholder-gray-500 shadow-sm"></textarea>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Modal Footer -->
                <div class="flex items-center justify-end p-5 md:p-6 border-t border-gray-100/50 gap-3 shrink-0">
                    <button @click="isEditModalOpen = false" type="button"
                        class="px-5 py-2.5 border border-gray-400/50 text-gray-700 bg-white/20 rounded-xl hover:bg-white/40 font-medium transition-all focus:outline-none focus:ring-2 focus:ring-gray-200 shadow-sm">
                        Batal
                    </button>
                    <button type="submit" form="formEditUnitUsaha"
                        class="px-5 py-2.5 bg-blue-300 text-white rounded-xl hover:bg-blue-700 font-medium transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Perbarui Data
                    </button>
                </div>
            </div>
        </div>
    </div>

    @if(session('success') || $errors->any())
        <script>
            document.addEventListener('alpine:init', () => {
                // Jika ada success/error message, modal otomatis terbuka kembali
                Alpine.data('modalData', () => ({
                    isModalOpen: true
                }));
            });
        </script>
    @endif
@endsection