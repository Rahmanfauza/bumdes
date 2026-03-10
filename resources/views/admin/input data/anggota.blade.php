@extends('layouts.admin')

@section('header_title', 'Input Data Awal & Master')

@section('content')
    <div class="space-y-6" x-data="{ isModalOpen: false }">
        <!-- Header Page (Optional, bisa dihilangkan jika title cukup) -->
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-800">Input Data Awal & Master</h2>
        </div>

        @include('admin.input data.inputdata')

        <!-- Data Table Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mt-8">
            <div class="px-6 py-4 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <h3 class="text-lg font-semibold text-gray-800">Master Data Anggota</h3>
                <button @click="isModalOpen = true"
                    class="flex items-center justify-center gap-2 px-4 py-2 bg-[#20b2aa] hover:bg-[#1c9c95] text-white rounded-lg font-medium transition shadow-sm text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tambah Anggota
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50/50 border-b border-gray-100">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-semibold">No. Anggota</th>
                            <th scope="col" class="px-6 py-4 font-semibold">Nama</th>
                            <th scope="col" class="px-6 py-4 font-semibold">Simpanan Pokok</th>
                            <th scope="col" class="px-6 py-4 font-semibold">Simpanan Wajib</th>
                            <th scope="col" class="px-6 py-4 font-semibold">Total Simpanan</th>
                            <th scope="col" class="px-6 py-4 font-semibold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($anggotas as $anggota)
                            <tr class="bg-white border-b border-gray-50 hover:bg-blue-50/20 transition-colors">
                                <td class="px-6 py-4 font-medium text-gray-900">
                                    AGN-{{ str_pad($anggota->id, 3, '0', STR_PAD_LEFT) }}</td>
                                <td class="px-6 py-4">{{ $anggota->nama }}</td>
                                <td class="px-6 py-4">Rp 0</td>
                                <td class="px-6 py-4">Rp 0</td>
                                <td class="px-6 py-4 font-medium text-blue-600">Rp 0</td>
                                <td class="px-6 py-4 text-right flex justify-end gap-2">
                                    <!-- Tombol Edit -->
                                    <button @click="$dispatch('open-edit', {{ json_encode($anggota) }})"
                                        class="flex items-center justify-center p-2 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition-colors"
                                        title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </button>
                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('anggota.destroy', $anggota->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus anggota ini?');"
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
                                <td colspan="6" class="p-8 text-center text-gray-500">
                                    Belum ada data anggota.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>


        <!-- Modal Background overlay -->
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
                <div class="p-5 md:p-6 border-b border-gray-100 shrink-0">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold text-white">Tambah Anggota Baru</h3>
                            <p class="text-white text-sm mt-1">Masukkan data lengkap anggota BUMDes.</p>
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
                        <div class="mt-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg relative"
                            role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mt-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg relative"
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
                    <form action="{{ route('anggota.store') }}" method="POST" enctype="multipart/form-data"
                        id="formTambahAnggota">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- NIK -->
                            <div class="md:col-span-2">
                                <label for="nik" class="block text-sm font-medium text-white mb-1">NIK (Nomor Induk
                                    Kependudukan) <span class="text-red-500">*</span></label>
                                <input type="text" id="nik" name="nik" placeholder="Masukkan 16 digit NIK"
                                    class="w-full px-4 py-2 bg-white/20 border border-gray-400/60 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 focus:bg-white/60 outline-none transition-all placeholder-gray-500 shadow-sm"
                                    required>
                            </div>

                            <!-- Nama Lengkap -->
                            <div class="md:col-span-2">
                                <label for="nama" class="block text-sm font-medium text-white mb-1">Nama Lengkap <span
                                        class="text-red-500">*</span></label>
                                <input type="text" id="nama" name="nama" placeholder="Sesuai KTP"
                                    class="w-full px-4 py-2 bg-white/20 border border-gray-400/60 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 focus:bg-white/60 outline-none transition-all placeholder-gray-500 shadow-sm"
                                    required>
                            </div>

                            <!-- Tempat Lahir -->
                            <div>
                                <label for="tempat_lahir" class="block text-sm font-medium text-white mb-1">Tempat
                                    Lahir</label>
                                <input type="text" id="tempat_lahir" name="tempat_lahir" placeholder="Kota/Kabupaten"
                                    class="w-full px-4 py-2 bg-white/20 border border-gray-400/60 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 focus:bg-white/60 outline-none transition-all placeholder-gray-500 shadow-sm">
                            </div>

                            <!-- Tanggal Lahir -->
                            <div>
                                <label for="tanggal_lahir" class="block text-sm font-medium text-white mb-1">Tanggal
                                    Lahir</label>
                                <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                                    class="w-full px-4 py-2 bg-white/20 border border-gray-400/60 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 focus:bg-white/60 outline-none transition-all text-gray-700 shadow-sm">
                            </div>

                            <!-- Jenis Kelamin -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-white mb-1">Jenis Kelamin</label>
                                <div class="flex gap-4 mt-2">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="jk" value="Laki-laki"
                                            class="w-4 h-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                        <span class="ml-2 text-sm text-white">Laki-laki</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="jk" value="Perempuan"
                                            class="w-4 h-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                        <span class="ml-2 text-sm text-white">Perempuan</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Alamat -->
                            <div class="md:col-span-2">
                                <label for="alamat" class="block text-sm font-medium text-white mb-1">Alamat
                                    Lengkap</label>
                                <textarea id="alamat" name="alamat" rows="2" placeholder="Jalan, RT/RW, Desa/Kelurahan"
                                    class="w-full px-4 py-2 bg-white/20 border border-gray-400/60 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 focus:bg-white/60 outline-none transition-all placeholder-gray-500 shadow-sm"></textarea>
                            </div>

                            <!-- No HP -->
                            <div class="md:col-span-2">
                                <label for="no_hp" class="block text-sm font-medium text-white mb-1">No. HP / WhatsApp
                                    <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <span
                                        class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-600 bg-gray-100/50 border-r border-gray-400/60 px-3 rounded-l-lg backdrop-blur-sm">+62</span>
                                    <input type="text" id="no_hp" name="no_hp" placeholder="81234567890"
                                        class="w-full pl-16 pr-4 py-2 bg-white/20 border border-gray-400/60 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 focus:bg-white/60 outline-none transition-all placeholder-gray-500 shadow-sm"
                                        required>
                                </div>
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
                    <button type="submit" form="formTambahAnggota"
                        class="px-5 py-2.5 bg-blue-300 text-white rounded-xl hover:bg-blue-700 font-medium transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Simpan Data
                    </button>
                </div>
            </div>
        </div>

        <!-- Edit Modal Background overlay -->
        <div x-data="{ 
                                                                            isEditModalOpen: false, 
                                                                            editData: {},
                                                                            submitUrl: '' 
                                                                         }"
            @open-edit.window="isEditModalOpen = true; editData = $event.detail; submitUrl = '{{ route('anggota.update', ':id') }}'.replace(':id', editData.id)"
            x-show="isEditModalOpen" x-transition.opacity.duration.300ms
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
                <div class="p-5 md:p-6 border-b border-gray-100 shrink-0">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold text-white">Edit Data Anggota</h3>
                            <p class="text-white text-sm mt-1">Perbarui data anggota BUMDes.</p>
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
                    <form :action="submitUrl" method="POST" enctype="multipart/form-data" id="formEditAnggota">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- NIK -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-white mb-1">NIK <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="nik" x-model="editData.nik"
                                    class="w-full px-4 py-2 bg-white/20 border border-gray-400/60 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 focus:bg-white/60 outline-none transition-all placeholder-gray-500 shadow-sm"
                                    required>
                            </div>

                            <!-- Nama Lengkap -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-white mb-1">Nama Lengkap <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="nama" x-model="editData.nama"
                                    class="w-full px-4 py-2 bg-white/20 border border-gray-400/60 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 focus:bg-white/60 outline-none transition-all placeholder-gray-500 shadow-sm"
                                    required>
                            </div>

                            <!-- Tempat Lahir -->
                            <div>
                                <label class="block text-sm font-medium text-white mb-1">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" x-model="editData.tempat_lahir"
                                    class="w-full px-4 py-2 bg-white/20 border border-gray-400/60 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 focus:bg-white/60 outline-none transition-all placeholder-gray-500 shadow-sm">
                            </div>

                            <!-- Tanggal Lahir -->
                            <div>
                                <label class="block text-sm font-medium text-white mb-1">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" x-model="editData.tanggal_lahir"
                                    class="w-full px-4 py-2 bg-white/20 border border-gray-400/60 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 focus:bg-white/60 outline-none transition-all text-gray-700 shadow-sm">
                            </div>

                            <!-- Jenis Kelamin -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-white mb-1">Jenis Kelamin</label>
                                <div class="flex gap-4 mt-2">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="jk" value="Laki-laki" x-model="editData.jk"
                                            class="w-4 h-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                        <span class="ml-2 text-sm text-white">Laki-laki</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="jk" value="Perempuan" x-model="editData.jk"
                                            class="w-4 h-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                        <span class="ml-2 text-sm text-white">Perempuan</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Alamat -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-white mb-1">Alamat Lengkap</label>
                                <textarea name="alamat" rows="2" x-model="editData.alamat"
                                    class="w-full px-4 py-2 bg-white/20 border border-gray-400/60 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 focus:bg-white/60 outline-none transition-all placeholder-gray-500 shadow-sm"></textarea>
                            </div>

                            <!-- No HP -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-white mb-1">No. HP / WhatsApp <span
                                        class="text-red-500">*</span></label>
                                <div class="relative">
                                    <span
                                        class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-600 bg-gray-100/50 border-r border-gray-400/60 px-3 rounded-l-lg backdrop-blur-sm">+62</span>
                                    <input type="text" name="no_hp" x-model="editData.no_hp"
                                        class="w-full pl-16 pr-4 py-2 bg-white/20 border border-gray-400/60 rounded-lg focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 focus:bg-white/60 outline-none transition-all placeholder-gray-500 shadow-sm"
                                        required>
                                </div>
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
                    <button type="submit" form="formEditAnggota"
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