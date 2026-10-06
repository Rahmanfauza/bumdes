@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-3xl">
    <div class="mb-6">
        <a href="{{ route('admin.akun.index') }}" class="text-[#57534E] hover:text-[#C2410C] text-sm font-semibold mb-2 inline-flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar Akun
        </a>
        <h1 class="text-2xl font-display font-bold text-[#1C1917]">Ubah Data Akun</h1>
        <p class="text-[#57534E] text-sm mt-1">Perbarui informasi, otorisasi, atau kata sandi pengurus.</p>
    </div>

    @if($errors->any())
    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-lg">
        <div class="flex items-center gap-3 mb-2">
            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="text-red-800 font-bold text-sm">Gagal memperbarui data</span>
        </div>
        <ul class="list-disc list-inside text-sm text-red-700 ml-8">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-[#E7E5E4] p-6">
        <form action="{{ route('admin.akun.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="space-y-5">
                <!-- Nama Lengkap -->
                <div>
                    <label class="block text-sm font-bold text-[#1C1917] mb-1">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                           class="w-full px-4 py-2 border border-[#D6D3D1] rounded-lg focus:outline-none focus:border-[#C2410C] focus:ring-1 focus:ring-[#C2410C] transition-colors bg-[#FAFAF9] focus:bg-white text-sm">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Username -->
                    <div>
                        <label class="block text-sm font-bold text-[#1C1917] mb-1">Username Login</label>
                        <input type="text" name="username" value="{{ old('username', $user->username) }}" required
                               class="w-full px-4 py-2 border border-[#D6D3D1] rounded-lg focus:outline-none focus:border-[#C2410C] focus:ring-1 focus:ring-[#C2410C] transition-colors bg-[#FAFAF9] focus:bg-white text-sm">
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-bold text-[#1C1917] mb-1">Alamat Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                               class="w-full px-4 py-2 border border-[#D6D3D1] rounded-lg focus:outline-none focus:border-[#C2410C] focus:ring-1 focus:ring-[#C2410C] transition-colors bg-[#FAFAF9] focus:bg-white text-sm">
                    </div>
                </div>

                @php
                    $isDirektur = ($user->id_role == 4 || strtolower(optional($user->role)->nama_role) === 'direktur');
                @endphp
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Otoritas / Role -->
                    <div>
                        <label class="block text-sm font-bold text-[#1C1917] mb-1">Otoritas (Role)</label>
                        @if($isDirektur)
                            <input type="hidden" name="id_role" value="{{ $user->id_role }}">
                            <div class="w-full px-4 py-2 border border-[#D6D3D1] rounded-lg bg-[#E7E5E4] text-[#1C1917] font-semibold text-sm flex items-center justify-between cursor-not-allowed">
                                <span>{{ $user->role->nama_role ?? 'Direktur' }}</span>
                                <span class="text-[11px] bg-[#1C1917] text-white px-2 py-0.5 rounded font-bold uppercase tracking-wider">Terkunci</span>
                            </div>
                            <p class="text-xs text-[#78716C] mt-1">Otoritas pimpinan tertinggi tidak dapat dialihkan ke peran staf.</p>
                        @else
                            <select name="id_role" required class="w-full px-4 py-2 border border-[#D6D3D1] rounded-lg focus:outline-none focus:border-[#C2410C] focus:ring-1 focus:ring-[#C2410C] transition-colors bg-[#FAFAF9] focus:bg-white text-sm">
                                <option value="">-- Pilih Otoritas Akses --</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id_role }}" {{ old('id_role', $user->id_role) == $role->id_role ? 'selected' : '' }}>
                                        {{ $role->nama_role }}
                                    </option>
                                @endforeach
                            </select>
                        @endif
                    </div>

                    <!-- Status Akun -->
                    <div>
                        <label class="block text-sm font-bold text-[#1C1917] mb-1">Status Akun</label>
                        @if($isDirektur)
                            <input type="hidden" name="status" value="aktif">
                            <div class="w-full px-4 py-2 border border-green-200 bg-green-50 rounded-lg flex items-center justify-between text-sm">
                                <span class="flex items-center gap-2 font-bold text-green-800">
                                    <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                                    Aktif (Permanen)
                                </span>
                                <span class="text-xs bg-green-200 text-green-900 px-2 py-0.5 rounded font-semibold">Pucuk Pimpinan</span>
                            </div>
                            <p class="text-xs text-[#78716C] mt-1">Status akun Direktur selalu aktif demi kelangsungan operasional sistem.</p>
                        @else
                            <select name="status" required class="w-full px-4 py-2 border border-[#D6D3D1] rounded-lg focus:outline-none focus:border-[#C2410C] focus:ring-1 focus:ring-[#C2410C] transition-colors bg-[#FAFAF9] focus:bg-white text-sm">
                                <option value="aktif" {{ old('status', $user->status) == 'aktif' ? 'selected' : '' }}>Aktif (Dapat Login)</option>
                                <option value="nonaktif" {{ old('status', $user->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif (Akses Ditutup)</option>
                            </select>
                        @endif
                    </div>
                </div>

                <!-- No HP -->
                <div>
                    <label class="block text-sm font-bold text-[#1C1917] mb-1">No. Handphone <span class="text-[#A8A29E] font-normal">(Opsional)</span></label>
                    <input type="text" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}"
                           class="w-full px-4 py-2 border border-[#D6D3D1] rounded-lg focus:outline-none focus:border-[#C2410C] focus:ring-1 focus:ring-[#C2410C] transition-colors bg-[#FAFAF9] focus:bg-white text-sm">
                </div>

                <!-- Divider -->
                <div class="border-t border-[#E7E5E4] py-2 mt-4">
                    <h3 class="text-sm font-bold text-[#1C1917]">Ubah Kredensial (Opsional)</h3>
                    <p class="text-xs text-[#78716C]">Biarkan kosong jika tidak ingin mengubah kata sandi.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Password -->
                    <div>
                        <label class="block text-sm font-bold text-[#1C1917] mb-1">Kata Sandi Baru</label>
                        <input type="password" name="password"
                               class="w-full px-4 py-2 border border-[#D6D3D1] rounded-lg focus:outline-none focus:border-[#C2410C] focus:ring-1 focus:ring-[#C2410C] transition-colors bg-[#FAFAF9] focus:bg-white text-sm"
                               placeholder="Minimal 6 karakter">
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label class="block text-sm font-bold text-[#1C1917] mb-1">Konfirmasi Kata Sandi</label>
                        <input type="password" name="password_confirmation"
                               class="w-full px-4 py-2 border border-[#D6D3D1] rounded-lg focus:outline-none focus:border-[#C2410C] focus:ring-1 focus:ring-[#C2410C] transition-colors bg-[#FAFAF9] focus:bg-white text-sm"
                               placeholder="Ulangi kata sandi">
                    </div>
                </div>

            </div>

            <div class="mt-8 flex items-center justify-end gap-3 pt-6 border-t border-[#E7E5E4]">
                <a href="{{ route('admin.akun.index') }}" class="px-5 py-2 text-sm font-semibold text-[#57534E] hover:bg-[#F5F5F4] rounded-lg transition-colors border border-transparent">Batal</a>
                <button type="submit" class="px-6 py-2 bg-[#1C1917] text-white text-sm font-bold rounded-lg hover:bg-[#C2410C] transition-colors shadow-sm">
                    Perbarui Akun
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
