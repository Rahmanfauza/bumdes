@extends('layouts.admin')

@section('header_title', 'Simpan Pinjam')

@section('content')
<div class="space-y-6" x-data="simpanPinjamApp()">
    <!-- Header Page -->
    <div class="flex items-center justify-between">
        <div class="inline-block px-[14px] py-[6px] bg-[#F5F5F4] text-[#57534E] font-semibold text-[14px] rounded-[9999px]">
            Modul Simpan Pinjam Koperasi
        </div>
        <a href="{{ route('unit-usaha') }}" class="px-5 py-2.5 bg-white text-[#57534E] font-semibold border border-[#D6D3D1] rounded-[8px] hover:text-[#1C1917] hover:bg-[#F5F5F4] transition-colors flex items-center gap-2 text-[14px]">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Unit Usaha
        </a>
    </div>

    @if(session('success'))
        <div class="mt-4 bg-[#DCFCE7] border border-[#16A34A]/20 text-[#16A34A] px-4 py-3 rounded-[8px] font-semibold text-[14px]" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div class="mt-4 bg-[#FEE2E2] border border-[#DC2626]/20 text-[#DC2626] px-4 py-3 rounded-[8px] font-semibold text-[14px]" role="alert">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Tabs Navigation -->
    <div class="flex flex-wrap gap-3 mt-6">
        <button @click="tab = 'simpanan'" :class="tab === 'simpanan' ? 'bg-[#C2410C] text-white shadow-[0_4px_12px_rgba(194,65,12,0.25)]' : 'bg-white text-[#57534E] border border-[#D6D3D1] hover:bg-[#F5F5F4] hover:text-[#1C1917]'" class="px-6 py-2.5 font-semibold text-[14px] rounded-[8px] transition-all">
            Simpanan Anggota
        </button>
        <button @click="tab = 'pinjaman'" :class="tab === 'pinjaman' ? 'bg-[#C2410C] text-white shadow-[0_4px_12px_rgba(194,65,12,0.25)]' : 'bg-white text-[#57534E] border border-[#D6D3D1] hover:bg-[#F5F5F4] hover:text-[#1C1917]'" class="px-6 py-2.5 font-semibold text-[14px] rounded-[8px] transition-all">
            Pinjaman Anggota
        </button>
    </div>

    <!-- TAB: SIMPANAN -->
    <div x-show="tab === 'simpanan'" style="display: none;" class="mt-6 grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Form Kiri -->
        <div class="bg-[#FAFAF9] border border-[#D6D3D1] rounded-[12px] shadow-sm p-6 h-fit">
            <h3 class="text-xl font-display font-bold text-[#1C1917] mb-6 border-b border-[#D6D3D1] pb-4">Input Setoran Simpanan</h3>
            
            <form action="{{ route('simpan-pinjam.simpanan.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-[13px] font-semibold text-[#1C1917] tracking-wide uppercase mb-2">Tanggal Setor</label>
                    <input type="date" name="tanggal" required class="w-full px-4 py-2.5 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[8px] text-[#1C1917] focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15 transition-all">
                </div>
                <div>
                    <label class="block text-[13px] font-semibold text-[#1C1917] tracking-wide uppercase mb-2">Pilih Anggota</label>
                    <select name="anggota_id" required class="w-full px-4 py-2.5 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[8px] text-[#1C1917] focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15 transition-all appearance-none">
                        <option value="">-- Pilih Anggota --</option>
                        @foreach($anggotas as $anggota)
                            <option value="{{ $anggota->id }}">{{ strtoupper($anggota->nama ?? 'Anggota '.$anggota->id) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-[13px] font-semibold text-[#1C1917] tracking-wide uppercase mb-2">Jenis Simpanan</label>
                    <select name="jenis" class="w-full px-4 py-2.5 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[8px] text-[#1C1917] focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15 transition-all appearance-none uppercase">
                        <option value="pokok">Simpanan Pokok</option>
                        <option value="wajib">Simpanan Wajib</option>
                        <option value="sukarela">Simpanan Sukarela</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[13px] font-semibold text-[#1C1917] tracking-wide uppercase mb-2">Jumlah Simpanan (Rp)</label>
                    <input type="text" name="jumlah" required class="format-rupiah w-full px-4 py-2.5 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[8px] text-[#1C1917] focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15 transition-all">
                </div>
                <div>
                    <label class="block text-[13px] font-semibold text-[#1C1917] tracking-wide uppercase mb-2">Keterangan (Opsional)</label>
                    <input type="text" name="keterangan" class="w-full px-4 py-2.5 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[8px] text-[#1C1917] focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15 transition-all placeholder-[#A8A29E]" placeholder="Catatan setoran...">
                </div>
                <button type="submit" class="w-full py-3 bg-[#C2410C] text-white font-semibold rounded-[8px] hover:bg-[#9A3412] shadow-sm transition-all mt-6 flex justify-center items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Simpan Data
                </button>
            </form>
        </div>

        <!-- Tabel Kanan -->
        <div class="lg:col-span-2 bg-[#FAFAF9] border border-[#D6D3D1] rounded-[12px] shadow-sm overflow-hidden h-fit">
            <div class="px-6 py-5 border-b border-[#D6D3D1]">
                <h3 class="text-xl font-display font-bold text-[#1C1917]">Riwayat Simpanan Anggota</h3>
                <p class="text-[14px] text-[#57534E] mt-1">Daftar transaksi setoran seluruh anggota BUMDes</p>
            </div>
            <div class="p-6 overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="text-[12px] uppercase bg-[#F5F5F4] border-b border-[#D6D3D1] text-[#78716C]">
                        <tr>
                            <th class="px-4 py-3 font-semibold tracking-wide whitespace-nowrap">Tanggal</th>
                            <th class="px-4 py-3 font-semibold tracking-wide">Nama Anggota</th>
                            <th class="px-4 py-3 font-semibold tracking-wide">Jenis</th>
                            <th class="px-4 py-3 font-semibold tracking-wide text-right">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($simpanans as $simpanan)
                        <tr class="border-b border-[#D6D3D1] hover:bg-[#F5F5F4] transition-colors last:border-0">
                            <td class="px-4 py-3 text-[#57534E] whitespace-nowrap">{{ \Carbon\Carbon::parse($simpanan->tanggal)->format('d/m/Y') }}</td>
                            <td class="px-4 py-3 font-semibold text-[#C2410C] uppercase">{{ $simpanan->anggota->nama ?? 'Anggota '.$simpanan->anggota_id }}</td>
                            <td class="px-4 py-3">
                                @php
                                    $jenisConfig = [
                                        'wajib' => 'bg-[#DBEAFE] text-[#1D4ED8]',
                                        'pokok' => 'bg-[#FEF3C7] text-[#D97706]',
                                        'sukarela' => 'bg-[#DCFCE7] text-[#16A34A]',
                                    ];
                                    $badge = $jenisConfig[$simpanan->jenis] ?? 'bg-[#F5F5F4] text-[#57534E]';
                                @endphp
                                <span class="inline-block px-[10px] py-[4px] rounded-[9999px] text-[11px] font-bold uppercase tracking-wide {{ $badge }}">
                                    {{ $simpanan->jenis }}
                                </span>
                            </td>
                            <td class="px-4 py-3 font-bold text-[#16A34A] text-right whitespace-nowrap">Rp {{ number_format($simpanan->jumlah, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-4 py-12 text-center text-[#78716C] font-semibold bg-[#FAFAF9]">
                                Belum ada data simpanan tercatat.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- TAB: PINJAMAN -->
    <div x-show="tab === 'pinjaman'" style="display: none;" class="mt-6 space-y-6">
        
        <!-- Top Stats & Action -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="bg-[#FAFAF9] border border-[#D6D3D1] shadow-sm rounded-[12px] px-6 py-4 flex-1 max-w-sm">
                <div class="text-[13px] font-semibold text-[#78716C] uppercase tracking-wide mb-1">Limit Pinjaman Tersedia</div>
                <div class="text-3xl font-display font-bold text-[#16A34A]">Rp {{ number_format($limitPinjaman, 0, ',', '.') }}</div>
            </div>

            <button @click="pinjamanModalOpen = true" class="px-6 py-3.5 bg-[#C2410C] text-white font-semibold rounded-[8px] shadow-sm hover:bg-[#9A3412] transition-all flex items-center justify-center gap-2 whitespace-nowrap">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Ajukan Pinjaman
            </button>
        </div>

        <!-- Tabel Pinjaman -->
        <div class="bg-[#FAFAF9] border border-[#D6D3D1] rounded-[12px] shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-[#D6D3D1]">
                <h3 class="text-xl font-display font-bold text-[#1C1917]">Daftar Pinjaman Berjalan</h3>
            </div>
            <div class="p-6 overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="text-[12px] uppercase bg-[#F5F5F4] border-b border-[#D6D3D1] text-[#78716C]">
                        <tr>
                            <th class="px-4 py-3 font-semibold tracking-wide whitespace-nowrap">Tanggal Pencairan</th>
                            <th class="px-4 py-3 font-semibold tracking-wide">Nama Anggota</th>
                            <th class="px-4 py-3 font-semibold tracking-wide text-right">Jumlah Pinjaman</th>
                            <th class="px-4 py-3 font-semibold tracking-wide text-right">Sisa Pokok</th>
                            <th class="px-4 py-3 font-semibold tracking-wide text-center">Status</th>
                            <th class="px-4 py-3 font-semibold tracking-wide text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pinjamans as $pinjaman)
                        <tr class="border-b border-[#D6D3D1] hover:bg-[#F5F5F4] transition-colors last:border-0">
                            <td class="px-4 py-3 text-[#57534E] whitespace-nowrap">{{ \Carbon\Carbon::parse($pinjaman->tanggal_pencairan)->format('d/m/Y') }}</td>
                            <td class="px-4 py-3 font-semibold text-[#C2410C] uppercase">{{ $pinjaman->anggota->nama ?? 'Anggota '.$pinjaman->anggota_id }}</td>
                            <td class="px-4 py-3 font-bold text-[#1C1917] text-right whitespace-nowrap">Rp {{ number_format($pinjaman->jumlah_pinjaman, 0, ',', '.') }}</td>
                            <td class="px-4 py-3 font-bold text-[#DC2626] text-right whitespace-nowrap">Rp {{ number_format($pinjaman->sisa_pokok, 0, ',', '.') }}</td>
                            <td class="px-4 py-3 text-center">
                                @php
                                    $statusBadge = $pinjaman->status == 'LUNAS' 
                                        ? 'bg-[#DCFCE7] text-[#16A34A]' 
                                        : 'bg-[#FEF3C7] text-[#D97706]';
                                @endphp
                                <span class="inline-block px-[10px] py-[4px] rounded-[9999px] text-[11px] font-bold uppercase tracking-wide {{ $statusBadge }}">
                                    {{ $pinjaman->status }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <button onclick="window.print()" class="text-[12px] font-semibold bg-transparent border border-[#D6D3D1] text-[#1C1917] hover:bg-[#E7E5E4] px-3 py-1.5 rounded-[8px] transition-all flex items-center justify-center gap-1 mx-auto whitespace-nowrap">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                                    Cetak
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-4 py-12 text-center text-[#78716C] font-semibold bg-[#FAFAF9]">
                                Belum ada data pinjaman anggota.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- END TAB PINJAMAN -->

    <!-- MODAL PENGAJUAN PINJAMAN -->
    <div x-show="pinjamanModalOpen" style="display: none;" 
        class="fixed inset-0 z-[70] bg-[#1C1917]/80 backdrop-blur-sm flex items-center justify-center p-4">
        
        <div @click.away="pinjamanModalOpen = false" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            class="relative bg-[#FAFAF9] border border-[#D6D3D1] shadow-[0_24px_48px_rgba(28,25,23,0.12)] w-full max-w-3xl flex flex-col overflow-hidden rounded-[12px] max-h-[90vh]">
            
            <div class="p-6 border-b border-[#D6D3D1] shrink-0 bg-[#FAFAF9] relative">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-display font-bold text-[#1C1917]">Form Pengajuan Pinjaman</h3>
                        <p class="text-[14px] text-[#57534E] mt-1">Isi rincian pengajuan pinjaman anggota</p>
                    </div>
                    <button @click="pinjamanModalOpen = false" type="button"
                        class="text-[#78716C] hover:text-[#1C1917] p-1 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="p-6 overflow-y-auto">
                <form action="{{ route('simpan-pinjam.pinjaman.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-5">
                        <label class="block text-[13px] font-semibold text-[#1C1917] tracking-wide uppercase mb-2">Pilih Anggota <span class="text-[#DC2626]">*</span></label>
                        <select name="anggota_id" required class="w-full px-4 py-3 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[8px] text-[#1C1917] focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15 transition-all appearance-none uppercase">
                            <option value="">-- Pilih Anggota --</option>
                            @foreach($anggotas as $anggota)
                                <option value="{{ $anggota->id }}">{{ strtoupper($anggota->nama ?? 'Anggota '.$anggota->id) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                        <div>
                            <label class="block text-[13px] font-semibold text-[#1C1917] tracking-wide uppercase mb-2">Jumlah Pinjaman (Rp) <span class="text-[#DC2626]">*</span></label>
                            <input type="text" name="jumlah_pinjaman" required x-model="jumlahPinjaman" class="format-rupiah w-full px-4 py-3 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[8px] text-[#1C1917] focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15 transition-all">
                        </div>
                        <div>
                            <label class="block text-[13px] font-semibold text-[#1C1917] tracking-wide uppercase mb-2">Tanggal Pencairan <span class="text-[#DC2626]">*</span></label>
                            <input type="date" name="tanggal_pencairan" required class="w-full px-4 py-3 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[8px] text-[#1C1917] focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15 transition-all">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                        <div>
                            <label class="block text-[13px] font-semibold text-[#1C1917] tracking-wide uppercase mb-2">Bunga Pinjaman (%) <span class="text-[#DC2626]">*</span></label>
                            <input type="number" step="0.01" name="bunga" required x-model.number="bunga" class="w-full px-4 py-3 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[8px] text-[#1C1917] focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15 transition-all">
                        </div>
                        <div>
                            <label class="block text-[13px] font-semibold text-[#1C1917] tracking-wide uppercase mb-2">Jangka Waktu (Bulan) <span class="text-[#DC2626]">*</span></label>
                            <input type="number" name="jangka_waktu" required x-model.number="jangkaWaktu" class="w-full px-4 py-3 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[8px] text-[#1C1917] focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15 transition-all">
                        </div>
                    </div>

                    <div class="mb-5">
                        <label class="block text-[13px] font-semibold text-[#1C1917] tracking-wide uppercase mb-2">Pencairan Dari Akun Koperasi <span class="text-[#DC2626]">*</span></label>
                        <select name="akun_pencairan" required class="w-full px-4 py-3 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[8px] text-[#1C1917] focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15 transition-all appearance-none uppercase">
                            <option value="kas">KAS UTAMA (1101)</option>
                            <option value="bank">BANK KOPERASI (1102)</option>
                        </select>
                    </div>

                    <!-- Simulasi Angsuran (Read-only) -->
                    <div class="bg-[#F5F5F4] p-6 border border-[#D6D3D1] rounded-[8px] text-center mt-8">
                        <div class="text-[13px] font-semibold text-[#78716C] uppercase tracking-wide mb-2">Estimasi Angsuran Per Bulan</div>
                        <div class="text-3xl font-display font-bold text-[#C2410C]">Rp <span x-text="formatRupiah(hitungAngsuran())"></span></div>
                    </div>

                    <div class="flex justify-end gap-3 pt-8">
                        <button type="button" @click="pinjamanModalOpen = false" class="px-5 py-2.5 bg-transparent border border-[#D6D3D1] text-[#57534E] font-semibold rounded-[8px] hover:text-[#1C1917] hover:bg-[#F5F5F4] transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="px-6 py-2.5 bg-[#C2410C] text-white font-semibold rounded-[8px] hover:bg-[#9A3412] shadow-sm transition-colors flex items-center justify-center gap-2">
                            Simpan dan Cairkan
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- END MODAL -->

</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('simpanPinjamApp', () => ({
            tab: 'simpanan', // 'simpanan' atau 'pinjaman'
            pinjamanModalOpen: false,
            
            // Variabel untuk modal pinjaman
            jumlahPinjaman: 0,
            bunga: 0,
            jangkaWaktu: 0,

            hitungAngsuran() {
                let rawPokok = this.jumlahPinjaman ? this.jumlahPinjaman.toString().replace(/\./g, '') : 0;
                let pokok = parseInt(rawPokok) || 0;
                let bng = this.bunga || 0;
                let jw = this.jangkaWaktu || 0;
                
                if(jw <= 0) return 0;
                
                let totalBunga = pokok * (bng / 100); 
                let cicilanPokok = pokok / jw;
                return cicilanPokok + totalBunga;
            },

            formatRupiah(angka) {
                if(!angka || angka < 0 || !isFinite(angka)) return 0;
                return Math.round(angka).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
        }));
    });
</script>

<style>
    @media print {
        body * {
            visibility: hidden;
        }
    }
</style>
@endsection
