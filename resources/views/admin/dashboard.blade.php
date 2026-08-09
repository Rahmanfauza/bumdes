@extends('layouts.admin')

@section('header_title', 'Dashboard')

@section('content')

{{-- ══════════════════════════════════════════════════════════════
     1. WELCOME BANNER
══════════════════════════════════════════════════════════════ --}}
<div class="bg-[#F5F5F4] border border-[#D6D3D1] border-l-[4px] border-l-[#C2410C] rounded-[12px] p-5 mb-6 flex items-center justify-between gap-4">
    <div>
        <p class="text-[#1C1917] font-display font-bold text-2xl tracking-tight leading-snug">
            Selamat datang di aplikasi BUMDes berbasis web
        </p>
        <p class="text-[#57534E] text-[15px] mt-1 font-semibold">Kita melayani dengan sepenuh hati 🤝</p>
    </div>
    <div class="w-12 h-12 bg-white rounded-[9999px] border border-[#D6D3D1] flex items-center justify-center shrink-0 text-[#C2410C]">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
        </svg>
    </div>
</div>

{{-- ══════════════════════════════════════════════════════════════
     2. PROFIL BUMDES CARD
══════════════════════════════════════════════════════════════ --}}
<div class="bg-[#F5F5F4] border border-[#D6D3D1] rounded-[12px] p-6 mb-6">

    {{-- Header profil --}}
    <div class="flex items-start justify-between mb-6">
        <div class="flex items-center gap-5">
            {{-- Logo BUMDes --}}
            <div class="w-16 h-16 rounded-[9999px] border border-[#D6D3D1] bg-[#FAFAF9] flex flex-col items-center justify-center text-center shrink-0">
                <span class="text-[9px] font-bold uppercase tracking-widest text-[#78716C] leading-tight">LOGO</span>
                <span class="text-[9px] font-bold uppercase tracking-widest text-[#78716C] leading-tight">BUMDES</span>
            </div>
            <div>
                <h2 class="text-2xl font-display font-bold text-[#1C1917] tracking-tight">BumBlam App</h2>
                <p class="text-[14px] text-[#57534E] mt-0.5">Jln Bojong Salam Kecamatan Rongga Kab.Bandung Barat</p>
                <div class="mt-2 flex items-center gap-2">
                    <span class="bg-[#16A34A] text-white text-[12px] font-semibold px-2 py-0.5 rounded-[9999px]">Aktif</span>
                    <span class="text-[12px] text-[#78716C] font-semibold">{{ now()->format('d F Y') }}</span>
                </div>
            </div>
        </div>
        {{-- Logo Desa --}}
        <div class="w-16 h-16 rounded-[9999px] border border-[#D6D3D1] bg-[#FAFAF9] flex flex-col items-center justify-center text-center shrink-0">
            <span class="text-[9px] font-bold uppercase tracking-widest text-[#78716C] leading-tight">LOGO</span>
            <span class="text-[9px] font-bold uppercase tracking-widest text-[#78716C] leading-tight">DESA</span>
        </div>
    </div>

    {{-- 3 Stat Chips + Profil Pengurus --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

        {{-- Total Aktiva --}}
        <div class="col-span-1 bg-[#F5F5F4] border border-[#D6D3D1] border-l-[4px] border-l-[#16A34A] rounded-[12px] p-5 flex flex-col gap-1 hover:shadow-[0_4px_16px_rgba(28,25,23,0.06)] transition-shadow">
            <span class="text-[11px] font-semibold uppercase tracking-wide text-[#78716C]">Total Aktiva</span>
            <span class="text-2xl font-display font-bold text-[#1C1917] leading-tight">
                Rp {{ number_format($totalAktiva ?? 0, 0, ',', '.') }}
            </span>
            <span class="text-[12px] text-[#57534E]">Nilai stok produk</span>
        </div>

        {{-- Modal --}}
        <div class="col-span-1 bg-[#F5F5F4] border border-[#D6D3D1] border-l-[4px] border-l-[#F59E0B] rounded-[12px] p-5 flex flex-col gap-1 hover:shadow-[0_4px_16px_rgba(28,25,23,0.06)] transition-shadow">
            <span class="text-[11px] font-semibold uppercase tracking-wide text-[#78716C]">Modal</span>
            <span class="text-2xl font-display font-bold text-[#1C1917] leading-tight">
                Rp {{ number_format($modalBumdes ?? 0, 0, ',', '.') }}
            </span>
            <span class="text-[12px] text-[#57534E]">Saldo bersih kumulatif</span>
        </div>

        {{-- Laba / Rugi --}}
        @php
            $isLaba = ($labaRugiHariIni ?? 0) >= 0;
            $labaColor = $isLaba ? '#C2410C' : '#DC2626';
        @endphp
        <div class="col-span-1 bg-[#F5F5F4] border border-[#D6D3D1] border-l-[4px] rounded-[12px] p-5 flex flex-col gap-1 hover:shadow-[0_4px_16px_rgba(28,25,23,0.06)] transition-shadow"
             style="border-left-color: {{ $labaColor }}">
            <span class="text-[11px] font-semibold uppercase tracking-wide text-[#78716C]">Laba/Rugi Tahun Berjalan</span>
            <span class="text-2xl font-display font-bold text-[#1C1917] leading-tight">
                Rp {{ number_format(abs($labaRugiHariIni ?? 0), 0, ',', '.') }}
            </span>
            <span class="text-[12px] text-[#57534E]">{{ $isLaba ? 'Laba hari ini' : 'Rugi hari ini' }}</span>
        </div>

        {{-- Profil Pengurus --}}
        <a href="{{ Session::get('admin_role') == 1 ? route('admin.akun.index') : '#' }}"
           onclick="{{ Session::get('admin_role') != 1 ? 'event.preventDefault(); alert(\'Hanya Direktur yang dapat mengelola akun pengurus.\');' : '' }}"
           class="col-span-1 bg-[#FAFAF9] border border-[#D6D3D1] rounded-[12px] p-5 flex flex-col items-center justify-center gap-2 hover:shadow-[0_4px_16px_rgba(28,25,23,0.06)] hover:bg-[#F5F5F4] transition-all group">
            <svg class="w-8 h-8 text-[#C2410C]" fill="currentColor" viewBox="0 0 24 24">
                <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
            </svg>
            <div class="text-center">
                <p class="text-[14px] font-semibold text-[#1C1917]">Akun Pengurus</p>
                <p class="text-[12px] text-[#57534E]">Manajemen Akses</p>
            </div>
        </a>
    </div>
</div>

{{-- ══════════════════════════════════════════════════════════════
     3. BAWAH: GRAFIK + QUICK ACTION + NOTIFIKASI
══════════════════════════════════════════════════════════════ --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    {{-- GRAFIK — 2/3 lebar --}}
    <div class="md:col-span-2 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[12px] p-6 shadow-sm">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-[18px] font-semibold text-[#1C1917]">Grafik Pendapatan & Biaya</h3>
                <p class="text-[14px] text-[#57534E]">Perbandingan performa keuangan tahun {{ now()->year }}</p>
            </div>
        </div>
        <div class="relative h-64">
            <canvas id="dashboardChart"></canvas>
        </div>
    </div>

    {{-- KANAN: Quick Action + Notifikasi — 1/3 lebar --}}
    <div class="md:col-span-1 flex flex-col gap-6">

        {{-- Quick Action --}}
        <div class="bg-[#F5F5F4] border border-[#D6D3D1] rounded-[12px] p-5 shadow-sm">
            <h3 class="text-[16px] font-semibold text-[#1C1917] mb-4">Aksi Cepat</h3>
            <div class="flex flex-col gap-3">
                <a href="{{ route('admin.surat.create') }}"
                   class="flex items-center gap-3 px-4 py-3 bg-[#FAFAF9] border border-[#D6D3D1] rounded-[8px] font-semibold text-[14px] text-[#1C1917] hover:border-[#C2410C] hover:shadow-[0_4px_12px_rgba(194,65,12,0.1)] transition-all">
                    <svg class="w-5 h-5 shrink-0 text-[#C2410C]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Buat Surat / Dokumen
                </a>
                <a href="{{ route('admin.transaksi.index') }}"
                   class="flex items-center gap-3 px-4 py-3 bg-[#FAFAF9] border border-[#D6D3D1] rounded-[8px] font-semibold text-[14px] text-[#1C1917] hover:border-[#C2410C] hover:shadow-[0_4px_12px_rgba(194,65,12,0.1)] transition-all">
                    <svg class="w-5 h-5 shrink-0 text-[#C2410C]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                    </svg>
                    Transaksi Hari Ini
                    @if(($transaksiHariIni ?? 0) > 0)
                        <span class="ml-auto bg-[#F59E0B] text-white text-[12px] font-semibold px-2 py-0.5 rounded-[9999px]">
                            {{ $transaksiHariIni }}
                        </span>
                    @endif
                </a>
                <a href="{{ route('admin.transaksi.create') }}"
                   class="flex items-center gap-3 px-4 py-3 bg-[#FAFAF9] border border-[#D6D3D1] rounded-[8px] font-semibold text-[14px] text-[#1C1917] hover:border-[#C2410C] hover:shadow-[0_4px_12px_rgba(194,65,12,0.1)] transition-all">
                    <svg class="w-5 h-5 shrink-0 text-[#C2410C]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    Kasir / POS
                </a>
            </div>
        </div>

        {{-- Notifikasi Hari Ini --}}
        <div class="bg-[#FAFAF9] border border-[#D6D3D1] rounded-[12px] p-5 flex-1 shadow-sm">
            <h3 class="text-[16px] font-semibold text-[#1C1917] mb-3">Notifikasi</h3>
            <div class="flex flex-col gap-2">
                @if(($transaksiHariIni ?? 0) > 0)
                    <div class="flex items-start gap-3 py-2 border-b border-[#D6D3D1] last:border-0">
                        <div class="w-2 h-2 mt-1.5 bg-[#16A34A] rounded-full shrink-0"></div>
                        <span class="text-[#57534E] text-[14px]">{{ $transaksiHariIni }} transaksi tercatat hari ini</span>
                    </div>
                @endif
                @php
                    $produkHabis = \App\Models\Produk::where('stok', '<=', 5)->count();
                @endphp
                @if($produkHabis > 0)
                    <div class="flex items-start gap-3 py-2 border-b border-[#D6D3D1] last:border-0">
                        <div class="w-2 h-2 mt-1.5 bg-[#D97706] rounded-full shrink-0"></div>
                        <span class="text-[#57534E] text-[14px]">{{ $produkHabis }} produk stok menipis (≤ 5)</span>
                    </div>
                @endif
                @if(($transaksiHariIni ?? 0) === 0 && ($produkHabis ?? 0) === 0)
                    <div class="flex items-start gap-3 py-2 border-b border-[#D6D3D1] last:border-0">
                        <div class="w-2 h-2 mt-1.5 bg-[#D6D3D1] rounded-full shrink-0"></div>
                        <span class="text-[#78716C] text-[14px] font-semibold">Semua aman, tidak ada notifikasi mendesak.</span>
                    </div>
                @endif
                <div class="flex items-start gap-3 py-2 border-b border-[#D6D3D1] last:border-0">
                    <div class="w-2 h-2 mt-1.5 bg-[#78716C] rounded-full shrink-0"></div>
                    <span class="text-[#78716C] text-[14px]">{{ $jumlahPelanggan ?? 0 }} pelanggan terdaftar</span>
                </div>
                <div class="flex items-start gap-3 py-2 border-b border-[#D6D3D1] last:border-0">
                    <div class="w-2 h-2 mt-1.5 bg-[#78716C] rounded-full shrink-0"></div>
                    <span class="text-[#78716C] text-[14px]">{{ $jumlahProduk ?? 0 }} jenis produk tersedia</span>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
(function () {
    const labels = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des'];
    const pemasukan   = @json(array_values($pemasukanPerBulan ?? array_fill(1,12,0)));
    const pengeluaran = @json(array_values($pengeluaranPerBulan ?? array_fill(1,12,0)));

    const ctx = document.getElementById('dashboardChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels,
            datasets: [
                {
                    label: 'Pendapatan',
                    data: pemasukan,
                    backgroundColor: '#C2410C', // Terracotta
                    borderRadius: 4,
                    barPercentage: 0.6,
                    categoryPercentage: 0.8
                },
                {
                    label: 'Biaya',
                    data: pengeluaran,
                    backgroundColor: '#78716C', // Stone
                    borderRadius: 4,
                    barPercentage: 0.6,
                    categoryPercentage: 0.8
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                    align: 'end',
                    labels: {
                        font: { family: 'Source Sans 3', size: 13, weight: '600' },
                        color: '#57534E',
                        usePointStyle: true,
                        boxWidth: 8,
                        padding: 20,
                    },
                },
                tooltip: {
                    backgroundColor: '#1C1917',
                    titleColor: '#F5F5F4',
                    bodyColor: '#F5F5F4',
                    padding: 12,
                    cornerRadius: 8,
                    callbacks: {
                        label: ctx => ' Rp ' + ctx.parsed.y.toLocaleString('id-ID'),
                    },
                    titleFont: { family: 'Source Sans 3', weight: '600' },
                    bodyFont:  { family: 'Source Sans 3', weight: '400' },
                },
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { font: { family: 'Source Sans 3', size: 12 }, color: '#78716C' },
                    border: { display: false },
                },
                y: {
                    grid: { color: '#E7E5E4', drawBorder: false },
                    ticks: {
                        font: { family: 'Source Sans 3', size: 12 },
                        color: '#78716C',
                        callback: v => 'Rp ' + (v / 1000000).toFixed(0) + 'Jt',
                        maxTicksLimit: 6
                    },
                    border: { display: false },
                },
            },
            interaction: {
                mode: 'index',
                intersect: false,
            },
        },
    });
})();
</script>

@endsection