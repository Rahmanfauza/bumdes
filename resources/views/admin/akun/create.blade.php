@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-3xl">
    <div class="mb-6">
        <a href="{{ route('admin.akun.index') }}" class="text-[#57534E] hover:text-[#C2410C] text-sm font-semibold mb-2 inline-flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar Akun
        </a>
        <h1 class="text-2xl font-display font-bold text-[#1C1917]">Tambah Akun Baru</h1>
        <p class="text-[#57534E] text-sm mt-1">Buat akun pengurus BUMDes untuk otorisasi akses sistem.</p>
    </div>

    @if($errors->any())
    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-lg">
        <div class="flex items-center gap-3 mb-2">
            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="text-red-800 font-bold text-sm">Gagal menyimpan data</span>
        </div>
        <ul class="list-disc list-inside text-sm text-red-700 ml-8">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-[#E7E5E4] p-6">
        <form action="{{ route('admin.akun.store') }}" method="POST">
            @csrf
            
            <div class="space-y-5">
                <!-- Nama Lengkap -->
                <div>
                    <label class="block text-sm font-bold text-[#1C1917] mb-1">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                           class="w-full px-4 py-2 border border-[#D6D3D1] rounded-lg focus:outline-none focus:border-[#C2410C] focus:ring-1 focus:ring-[#C2410C] transition-colors bg-[#FAFAF9] focus:bg-white text-sm"
                           placeholder="Contoh: Budi Santoso">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Username -->
                    <div>
                        <label class="block text-sm font-bold text-[#1C1917] mb-1">Username Login</label>
                        <input type="text" name="username" value="{{ old('username') }}" required
                               class="w-full px-4 py-2 border border-[#D6D3D1] rounded-lg focus:outline-none focus:border-[#C2410C] focus:ring-1 focus:ring-[#C2410C] transition-colors bg-[#FAFAF9] focus:bg-white text-sm"
                               placeholder="Contoh: direktur_budi">
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-bold text-[#1C1917] mb-1">Alamat Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                               class="w-full px-4 py-2 border border-[#D6D3D1] rounded-lg focus:outline-none focus:border-[#C2410C] focus:ring-1 focus:ring-[#C2410C] transition-colors bg-[#FAFAF9] focus:bg-white text-sm"
                               placeholder="Contoh: budi@bumdes.com">
                    </div>
                </div>

                <!-- Otoritas / Role -->
                <div>
                    <label class="block text-sm font-bold text-[#1C1917] mb-1">Otoritas (Role)</label>
                    <select name="id_role" required class="w-full px-4 py-2 border border-[#D6D3D1] rounded-lg focus:outline-none focus:border-[#C2410C] focus:ring-1 focus:ring-[#C2410C] transition-colors bg-[#FAFAF9] focus:bg-white text-sm">
                        <option value="">-- Pilih Otoritas Akses --</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id_role }}" {{ old('id_role') == $role->id_role ? 'selected' : '' }}>
                                {{ $role->nama_role }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- No HP -->
                <div>
                    <label class="block text-sm font-bold text-[#1C1917] mb-1">No. Handphone <span class="text-[#A8A29E] font-normal">(Opsional)</span></label>
                    <input type="text" name="no_hp" value="{{ old('no_hp') }}"
                           class="w-full px-4 py-2 border border-[#D6D3D1] rounded-lg focus:outline-none focus:border-[#C2410C] focus:ring-1 focus:ring-[#C2410C] transition-colors bg-[#FAFAF9] focus:bg-white text-sm"
                           placeholder="Contoh: 08123456789">
                </div>

                <!-- Divider -->
                <div class="border-t border-[#E7E5E4] py-2 mt-4">
                    <h3 class="text-sm font-bold text-[#1C1917]">Kredensial Keamanan</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Password -->
                    <div>
                        <label class="block text-sm font-bold text-[#1C1917] mb-1">Kata Sandi Baru</label>
                        <input type="password" name="password" required
                               class="w-full px-4 py-2 border border-[#D6D3D1] rounded-lg focus:outline-none focus:border-[#C2410C] focus:ring-1 focus:ring-[#C2410C] transition-colors bg-[#FAFAF9] focus:bg-white text-sm"
                               placeholder="Minimal 6 karakter">
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label class="block text-sm font-bold text-[#1C1917] mb-1">Konfirmasi Kata Sandi</label>
                        <input type="password" name="password_confirmation" required
                               class="w-full px-4 py-2 border border-[#D6D3D1] rounded-lg focus:outline-none focus:border-[#C2410C] focus:ring-1 focus:ring-[#C2410C] transition-colors bg-[#FAFAF9] focus:bg-white text-sm"
                               placeholder="Ulangi kata sandi">
                    </div>
                </div>

            </div>

            <div class="mt-8 flex items-center justify-end gap-3 pt-6 border-t border-[#E7E5E4]">
                <a href="{{ route('admin.akun.index') }}" class="px-5 py-2 text-sm font-semibold text-[#57534E] hover:bg-[#F5F5F4] rounded-lg transition-colors border border-transparent">Batal</a>
                <button type="submit" class="px-6 py-2 bg-[#1C1917] text-white text-sm font-bold rounded-lg hover:bg-[#C2410C] transition-colors shadow-sm">
                    Simpan Akun
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
