@extends('layouts.admin')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-display font-bold text-[#1C1917]">Manajemen Akun Pengurus</h1>
            <p class="text-[#57534E] text-sm mt-1">Kelola akses untuk Admin, Bendahara, dan Sekretaris BUMDes.</p>
        </div>
        <a href="{{ route('admin.akun.create') }}" class="px-4 py-2 bg-[#C2410C] text-white rounded-lg font-semibold hover:bg-[#9A3412] transition-colors flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Akun
        </a>
    </div>

    @if(session('success'))
    <div class="mb-4 p-4 bg-green-50 border-l-4 border-green-500 rounded-r-lg">
        <div class="flex items-center gap-3">
            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="text-green-800 font-semibold text-sm">{{ session('success') }}</span>
        </div>
    </div>
    @endif
    @if($errors->any())
    <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-lg">
        <div class="flex items-center gap-3">
            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="text-red-800 font-semibold text-sm">{{ $errors->first() }}</span>
        </div>
    </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-[#E7E5E4] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-[#57534E]">
                <thead class="bg-[#F5F5F4] text-[#1C1917] font-semibold">
                    <tr>
                        <th class="px-6 py-4">Nama</th>
                        <th class="px-6 py-4">Username / Email</th>
                        <th class="px-6 py-4">Otoritas (Role)</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#E7E5E4]">
                    @foreach($users as $user)
                    <tr class="hover:bg-[#FAFAF9] transition-colors">
                        <td class="px-6 py-4 font-semibold text-[#1C1917]">{{ $user->name }}</td>
                        <td class="px-6 py-4">
                            <div class="font-semibold">{{ $user->username }}</div>
                            <div class="text-xs text-[#78716C]">{{ $user->email }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 rounded bg-[#E7E5E4] text-[#1C1917] text-xs font-bold uppercase tracking-wider">
                                {{ $user->role->nama_role ?? 'Unknown' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if($user->id_role == 4 || strtolower(optional($user->role)->nama_role) === 'direktur')
                                <span class="px-2.5 py-1 rounded-full bg-green-100 text-green-800 text-xs font-bold flex inline-flex items-center gap-1 w-max border border-green-200">
                                    <span class="w-1.5 h-1.5 bg-green-600 rounded-full"></span> Aktif (Permanen)
                                </span>
                            @elseif($user->status == 'aktif')
                                <span class="px-2.5 py-1 rounded-full bg-green-100 text-green-700 text-xs font-bold flex inline-flex items-center gap-1 w-max">
                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> Aktif
                                </span>
                            @else
                                <span class="px-2.5 py-1 rounded-full bg-red-100 text-red-700 text-xs font-bold flex inline-flex items-center gap-1 w-max">
                                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span> Nonaktif
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.akun.edit', $user->id) }}" class="inline-block text-[#C2410C] hover:text-[#9A3412] font-semibold text-xs border border-[#C2410C] px-3 py-1.5 rounded-lg transition-colors">
                                Edit
                            </a>
                            @if(Session::get('admin_id') != $user->id && $user->id_role != 4 && strtolower(optional($user->role)->nama_role) !== 'direktur')
                            <form action="{{ route('admin.akun.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-white hover:bg-red-600 font-semibold text-xs border border-red-600 px-3 py-1.5 rounded-lg transition-colors">
                                    Hapus
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        @if($users->isEmpty())
        <div class="p-8 text-center text-[#78716C]">
            <p>Belum ada data akun pengurus yang terdaftar.</p>
        </div>
        @endif
    </div>
</div>
@endsection
