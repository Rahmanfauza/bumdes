@extends('layouts.admin')

@section('header_title', 'Input Jurnal')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div class="inline-block px-[14px] py-[6px] bg-[#F5F5F4] text-[#57534E] font-semibold text-[14px] rounded-[9999px]">
            Data Input Jurnal
        </div>
    </div>

    <div class="flex flex-col xl:flex-row gap-8 items-start">
        <!-- Sidebar Buttons (Kiri) -->
        <div class="w-full xl:w-1/4 shrink-0">
            @include('admin.input data.inputdata')
        </div>

        <!-- Content Area (Kanan) -->
        <div class="w-full xl:w-3/4 flex-1">
            
            <div class="bg-[#FAFAF9] border border-[#D6D3D1] rounded-[12px] shadow-sm overflow-hidden hover:shadow-[0_4px_16px_rgba(28,25,23,0.06)] transition-shadow">
                
                <div class="bg-[#FAFAF9] px-6 py-5 border-b border-[#D6D3D1] flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <h3 class="text-2xl font-display font-bold text-[#1C1917] tracking-tight">Input Jurnal</h3>
                        <p class="text-[#57534E] text-[14px] mt-1">Sistem pencatatan terintegrasi POS</p>
                    </div>
                </div>

                <div class="p-6">
                    <!-- Filter Section -->
                    <form action="{{ route('jurnal.index') }}" method="GET" class="mb-8 p-5 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[8px]">
                        <div class="flex flex-col md:flex-row items-end gap-4">
                            
                            <!-- Cari Berdasarkan Keterangan -->
                            <div class="flex-1 w-full">
                                <label class="block text-[13px] font-semibold text-[#1C1917] mb-2 uppercase tracking-wide">Cari Berdasarkan Keterangan</label>
                                <input type="text" name="keterangan" value="{{ request('keterangan') }}" placeholder="Contoh: Penjualan POS..." 
                                    class="w-full px-4 py-2.5 bg-white border border-[#D6D3D1] rounded-[8px] text-[#1C1917] text-[15px] transition-all focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15">
                            </div>

                            <!-- Dari Tanggal -->
                            <div class="w-full md:w-auto">
                                <label class="block text-[13px] font-semibold text-[#1C1917] mb-2 uppercase tracking-wide">Dari Tgl</label>
                                <input type="date" name="dari" value="{{ request('dari') }}" 
                                    class="w-full md:w-40 px-4 py-2.5 bg-white border border-[#D6D3D1] rounded-[8px] text-[#1C1917] text-[15px] transition-all focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15">
                            </div>

                            <!-- Sampai Tanggal -->
                            <div class="w-full md:w-auto">
                                <label class="block text-[13px] font-semibold text-[#1C1917] mb-2 uppercase tracking-wide">Sampai Tgl</label>
                                <input type="date" name="sampai" value="{{ request('sampai') }}" 
                                    class="w-full md:w-40 px-4 py-2.5 bg-white border border-[#D6D3D1] rounded-[8px] text-[#1C1917] text-[15px] transition-all focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15">
                            </div>
                            
                            <!-- Search & Print Actions -->
                            <div class="flex gap-2 w-full md:w-auto">
                                <button type="submit" class="h-[46px] px-6 bg-[#C2410C] text-white font-semibold rounded-[8px] hover:bg-[#9A3412] shadow-sm transition-colors flex items-center justify-center">
                                    Cari
                                </button>
                                <button type="button" onclick="window.print()" class="h-[46px] px-5 bg-transparent border border-[#D6D3D1] text-[#1C1917] font-semibold rounded-[8px] hover:bg-[#E7E5E4] transition-colors flex items-center justify-center gap-2" title="Print">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                    </svg>
                                    Print
                                </button>
                            </div>

                        </div>
                        @if(request()->anyFilled(['keterangan', 'dari', 'sampai']))
                            <div class="mt-4 pt-3 border-t border-[#D6D3D1]">
                                <a href="{{ route('jurnal.index') }}" class="text-[13px] font-semibold text-[#DC2626] hover:underline flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    Bersihkan Filter
                                </a>
                            </div>
                        @endif
                    </form>

                    <!-- Table Section -->
                    <div class="overflow-x-auto min-h-[300px] border border-[#D6D3D1] rounded-[8px] bg-white">
                        <table class="w-full text-left font-semibold text-[#1C1917]">
                            <thead class="text-[12px] uppercase bg-[#F5F5F4] border-b border-[#D6D3D1] text-[#78716C]">
                                <tr>
                                    <th scope="col" class="px-5 py-4 font-semibold tracking-wide whitespace-nowrap">Tanggal</th>
                                    <th scope="col" class="px-5 py-4 font-semibold tracking-wide whitespace-nowrap">Kode Bantu</th>
                                    <th scope="col" class="px-5 py-4 font-semibold tracking-wide min-w-[200px]">Keterangan</th>
                                    <th scope="col" class="px-5 py-4 font-semibold tracking-wide">Akun</th>
                                    <th scope="col" class="px-5 py-4 font-semibold tracking-wide text-right">Debit</th>
                                    <th scope="col" class="px-5 py-4 font-semibold tracking-wide text-right">Kredit</th>
                                    <th scope="col" class="px-5 py-4 font-semibold tracking-wide text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($jurnals as $jurnal)
                                    <tr class="border-b border-[#D6D3D1] hover:bg-[#F5F5F4] transition-colors last:border-0">
                                        <td class="px-5 py-4 whitespace-nowrap text-[#57534E]">{{ \Carbon\Carbon::parse($jurnal->tanggal)->format('d/m/Y') }}</td>
                                        <td class="px-5 py-4 text-[#57534E]">{{ $jurnal->kode_bantu ?? '-' }}</td>
                                        <td class="px-5 py-4 font-semibold text-[#C2410C]">{{ $jurnal->keterangan }}</td>
                                        <td class="px-5 py-4">
                                            @if($jurnal->akun)
                                                <div class="inline-block px-[8px] py-[2px] bg-[#E7E5E4] text-[#1C1917] rounded-[9999px] text-[11px] font-bold tracking-wide">
                                                    {{ $jurnal->akun->nomor_akun }}
                                                </div>
                                                <div class="mt-1 text-[13px] text-[#57534E]">{{ $jurnal->akun->nama_akun }}</div>
                                            @else
                                                <span class="text-[#A8A29E]">-</span>
                                            @endif
                                        </td>
                                        <td class="px-5 py-4 text-right text-[#16A34A] whitespace-nowrap">
                                            {{ $jurnal->debit > 0 ? 'Rp ' . number_format($jurnal->debit, 0, ',', '.') : '-' }}
                                        </td>
                                        <td class="px-5 py-4 text-right text-[#DC2626] whitespace-nowrap">
                                            {{ $jurnal->kredit > 0 ? 'Rp ' . number_format($jurnal->kredit, 0, ',', '.') : '-' }}
                                        </td>
                                        <td class="px-5 py-4 text-center">
                                            <form action="{{ route('jurnal.destroy', $jurnal->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus jurnal ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-4 py-2 bg-[#FEE2E2] text-[#DC2626] hover:bg-[#DC2626] hover:text-white rounded-[8px] font-semibold text-[13px] transition-colors">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="p-8 text-center text-[#78716C] font-semibold">
                                            Pencatatan jurnal masih kosong / tidak ditemukan.
                                        </td>
                                    </tr>
                                @endforelse
                                
                                {{-- Baris Total --}}
                                @if($jurnals->count() > 0)
                                    <tr class="bg-[#F5F5F4] border-t border-[#D6D3D1]">
                                        <td colspan="4" class="px-5 py-4 text-right font-bold text-[#1C1917] uppercase tracking-wide">
                                            Total
                                        </td>
                                        <td class="px-5 py-4 text-right font-bold text-[#16A34A] whitespace-nowrap">
                                            Rp {{ number_format($jurnals->sum('debit'), 0, ',', '.') }}
                                        </td>
                                        <td class="px-5 py-4 text-right font-bold text-[#DC2626] whitespace-nowrap">
                                            Rp {{ number_format($jurnals->sum('kredit'), 0, ',', '.') }}
                                        </td>
                                        <td></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
