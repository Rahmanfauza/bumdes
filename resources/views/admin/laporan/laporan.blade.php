@extends('layouts.admin')

@section('header_title', 'Laporan Keuangan')

@section('content')
<div class="space-y-6" x-data="{ activeTab: new URLSearchParams(window.location.search).get('active_tab') || null }">
    
    <!-- Header Page -->
    <div class="flex items-center justify-between">
        <div class="inline-block px-[14px] py-[6px] bg-[#F5F5F4] text-[#57534E] font-semibold text-[14px] rounded-[9999px]">
            Pusat Laporan
        </div>
    </div>

    <!-- Layout Container (Sidebar + Content) -->
    <div class="flex flex-col md:flex-row gap-6 mt-4 items-start">
        
        <!-- LEFT SIDEBAR MENUS -->
        <div class="w-full md:w-64 flex flex-col gap-3 flex-shrink-0">
            <!-- Buku kas harian -->
            <button @click="activeTab = 'buku_kas'" 
                :class="activeTab === 'buku_kas' ? 'bg-[#C2410C] text-white shadow-[0_4px_12px_rgba(194,65,12,0.25)] ring-2 ring-[#C2410C]/20' : 'bg-[#FAFAF9] text-[#57534E] border border-[#D6D3D1] hover:bg-[#F5F5F4] hover:text-[#1C1917]'" 
                class="px-5 py-4 text-left font-semibold text-[15px] rounded-[10px] transition-all flex items-center justify-between group">
                Buku Kas Harian
                <svg class="w-5 h-5 opacity-0 group-hover:opacity-100 transition-opacity" :class="activeTab === 'buku_kas' ? 'opacity-100 text-white' : 'text-[#A8A29E]'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </button>
            
            <!-- Laba Rugi -->
            <button @click="activeTab = 'laba_rugi'" 
                :class="activeTab === 'laba_rugi' ? 'bg-[#C2410C] text-white shadow-[0_4px_12px_rgba(194,65,12,0.25)] ring-2 ring-[#C2410C]/20' : 'bg-[#FAFAF9] text-[#57534E] border border-[#D6D3D1] hover:bg-[#F5F5F4] hover:text-[#1C1917]'" 
                class="px-5 py-4 text-left font-semibold text-[15px] rounded-[10px] transition-all flex items-center justify-between group">
                Laba Rugi
                <svg class="w-5 h-5 opacity-0 group-hover:opacity-100 transition-opacity" :class="activeTab === 'laba_rugi' ? 'opacity-100 text-white' : 'text-[#A8A29E]'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </button>
            
            <!-- Posisi Keuangan -->
            <button @click="activeTab = 'posisi_keuangan'" 
                :class="activeTab === 'posisi_keuangan' ? 'bg-[#C2410C] text-white shadow-[0_4px_12px_rgba(194,65,12,0.25)] ring-2 ring-[#C2410C]/20' : 'bg-[#FAFAF9] text-[#57534E] border border-[#D6D3D1] hover:bg-[#F5F5F4] hover:text-[#1C1917]'" 
                class="px-5 py-4 text-left font-semibold text-[15px] rounded-[10px] transition-all flex items-center justify-between group">
                Posisi Keuangan
                <svg class="w-5 h-5 opacity-0 group-hover:opacity-100 transition-opacity" :class="activeTab === 'posisi_keuangan' ? 'opacity-100 text-white' : 'text-[#A8A29E]'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </button>

            <!-- Laporan Stok -->
            <button @click="activeTab = 'laporan_stok'" 
                :class="activeTab === 'laporan_stok' ? 'bg-[#C2410C] text-white shadow-[0_4px_12px_rgba(194,65,12,0.25)] ring-2 ring-[#C2410C]/20' : 'bg-[#FAFAF9] text-[#57534E] border border-[#D6D3D1] hover:bg-[#F5F5F4] hover:text-[#1C1917]'" 
                class="px-5 py-4 text-left font-semibold text-[15px] rounded-[10px] transition-all flex items-center justify-between group">
                Laporan Stok
                <svg class="w-5 h-5 opacity-0 group-hover:opacity-100 transition-opacity" :class="activeTab === 'laporan_stok' ? 'opacity-100 text-white' : 'text-[#A8A29E]'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </button>
        </div>

        <!-- RIGHT MAIN CONTENT -->
        <div class="flex-grow w-full">
            
            <!-- DEFAULT / WELCOME -->
            <div x-show="activeTab === null" class="h-full min-h-[500px] flex flex-col items-center justify-center text-center bg-[#FAFAF9] border border-[#D6D3D1] rounded-[12px] shadow-sm">
                <svg class="w-16 h-16 text-[#D6D3D1] mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                <h3 class="text-2xl font-display font-semibold text-[#57534E]">
                    Pilih Menu Laporan
                </h3>
                <p class="text-[#78716C] mt-2">Silakan klik salah satu menu di bilah kiri untuk membuka dokumen.</p>
            </div>

            <!-- TAB 1: BUKU KAS HARIAN -->
            <div x-show="activeTab === 'buku_kas'" style="display: none;" class="w-full space-y-6">
                
                <div class="bg-[#FAFAF9] border border-[#D6D3D1] shadow-sm rounded-[12px] p-6 lg:p-8">
                    <div class="mb-8">
                        <h3 class="text-2xl font-display font-bold text-[#1C1917]">Buku Kas Harian</h3>
                        <p class="text-[#57534E] text-[14px] mt-1">Laporan terperinci mengenai arus kas harian.</p>
                    </div>

                    {{-- Controls (Filter & Export) --}}
                    <div class="flex flex-col lg:flex-row gap-5 items-start lg:items-center justify-between border-b border-[#D6D3D1] pb-8 mb-8">
                        {{-- Filter Form --}}
                        <form method="GET" action="{{ route('laporan.index') }}" class="flex flex-wrap items-end gap-3 w-full lg:w-auto">
                            <div class="flex flex-col gap-1.5">
                                <label class="font-semibold text-[#1C1917] text-[13px] uppercase tracking-wide">Dari Tanggal</label>
                                <input type="date" name="start_date" value="{{ request('start_date') }}" class="px-4 py-2 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[8px] focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15 text-[#1C1917] text-[14px]">
                            </div>
                            <div class="flex flex-col gap-1.5">
                                <label class="font-semibold text-[#1C1917] text-[13px] uppercase tracking-wide">Sampai Tanggal</label>
                                <input type="date" name="end_date" value="{{ request('end_date') }}" class="px-4 py-2 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[8px] focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15 text-[#1C1917] text-[14px]">
                            </div>
                            <button type="submit" class="px-5 py-2 h-[42px] bg-[#C2410C] text-white font-semibold rounded-[8px] hover:bg-[#9A3412] shadow-sm transition-all flex items-center justify-center">
                                Tampilkan
                            </button>
                            @if (request('start_date') || request('end_date'))
                                <a href="{{ route('laporan.index') }}" class="px-5 py-2 h-[42px] bg-transparent text-[#DC2626] border border-[#D6D3D1] font-semibold rounded-[8px] hover:bg-[#FEE2E2] hover:border-[#DC2626]/30 transition-all flex items-center justify-center text-[14px]">
                                    Reset
                                </a>
                            @endif
                        </form>

                        {{-- Export Buttons --}}
                        <div class="flex gap-3 w-full lg:w-auto shrink-0">
                            <button type="button" onclick="window.print()" class="px-4 py-2 h-[42px] bg-white text-[#1C1917] border border-[#D6D3D1] font-semibold rounded-[8px] hover:bg-[#F5F5F4] transition-all flex items-center gap-2 text-[14px] flex-1 lg:flex-none justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                                Print
                            </button>
                            <a href="{{ route('laporan.export.csv', request()->all()) }}" class="px-4 py-2 h-[42px] bg-white text-[#1C1917] border border-[#D6D3D1] font-semibold rounded-[8px] hover:bg-[#F5F5F4] transition-all flex items-center gap-2 text-[14px] flex-1 lg:flex-none justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                CSV
                            </a>
                        </div>
                    </div>

                    {{-- Data Table --}}
                    <div class="overflow-x-auto border border-[#D6D3D1] rounded-[8px] bg-white">
                        <table class="w-full text-left font-semibold text-[#1C1917]">
                            <thead class="text-[12px] uppercase bg-[#F5F5F4] border-b border-[#D6D3D1] text-[#78716C]">
                                <tr>
                                    <th class="px-5 py-4 font-semibold tracking-wide whitespace-nowrap">Tanggal</th>
                                    <th class="px-5 py-4 font-semibold tracking-wide whitespace-nowrap">No. Bukti</th>
                                    <th class="px-5 py-4 font-semibold tracking-wide min-w-[200px]">Keterangan</th>
                                    <th class="px-5 py-4 font-semibold tracking-wide text-right">Pemasukan</th>
                                    <th class="px-5 py-4 font-semibold tracking-wide text-right">Pengeluaran</th>
                                    <th class="px-5 py-4 font-semibold tracking-wide text-right">Saldo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $saldoKas = 0; @endphp
                                @forelse($transaksis as $t)
                                    @php
                                        if ($t->jenis_transaksi == 'Pemasukan') {
                                            $saldoKas += $t->jumlah;
                                        } else {
                                            $saldoKas -= $t->jumlah;
                                        }
                                    @endphp
                                    <tr class="border-b border-[#D6D3D1] hover:bg-[#F5F5F4] transition-colors last:border-b-0">
                                        <td class="px-5 py-4 text-[#57534E] whitespace-nowrap">{{ \Carbon\Carbon::parse($t->tanggal_transaksi)->format('d/m/Y') }}</td>
                                        <td class="px-5 py-4 font-bold uppercase text-[#1C1917] whitespace-nowrap">{{ $t->no_bukti ?? 'TRX-' . str_pad($t->id, 4, '0', STR_PAD_LEFT) }}</td>
                                        <td class="px-5 py-4 text-[#57534E]">{{ $t->keterangan ?: '-' }}</td>
                                        <td class="px-5 py-4 text-right text-[#16A34A] whitespace-nowrap">
                                            {{ $t->jenis_transaksi == 'Pemasukan' ? 'Rp ' . number_format($t->jumlah, 0, ',', '.') : '-' }}
                                        </td>
                                        <td class="px-5 py-4 text-right text-[#DC2626] whitespace-nowrap">
                                            {{ $t->jenis_transaksi == 'Pengeluaran' ? 'Rp ' . number_format($t->jumlah, 0, ',', '.') : '-' }}
                                        </td>
                                        <td class="px-5 py-4 text-right font-bold whitespace-nowrap {{ $saldoKas >= 0 ? 'text-[#C2410C]' : 'text-[#DC2626]' }}">
                                            Rp {{ number_format($saldoKas, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-5 py-12 text-center text-[#78716C] font-semibold bg-[#FAFAF9]">
                                            Belum ada data transaksi buku kas.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- TAB 2: LABA RUGI -->
            <div x-show="activeTab === 'laba_rugi'" style="display: none;" class="w-full space-y-6">
                @include('admin.laporan.laba_rugi')
            </div>

            <!-- TAB 3: POSISI KEUANGAN -->
            <div x-show="activeTab === 'posisi_keuangan'" style="display: none;" class="w-full space-y-6">
                @include('admin.laporan.posisikeuangan')
            </div>

            <!-- TAB 4: LAPORAN STOK -->
            <div x-show="activeTab === 'laporan_stok'" style="display: none;" class="w-full space-y-6">
                @include('admin.laporan.laporanstok')
            </div>
        </div>
    </div>
</div>

{{-- ================================================================ --}}
{{-- CHART.JS --}}
{{-- ================================================================ --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
<script>
    document.addEventListener('alpine:init', () => {
        // Alpine data init if needed
    });

    const labels = @json(array_values($namaBulan));
    const pemasukan = @json(array_values($pemasukanPerBulan));
    const pengeluaran = @json(array_values($pengeluaranPerBulan));

    const saldoKumulatif = [];
    let running = 0;
    for (let i = 0; i < 12; i++) {
        running += pemasukan[i] - pengeluaran[i];
        saldoKumulatif.push(running);
    }

    // Menggunakan tipografi dan warna netral dari Ember Studio
    Chart.defaults.font.family = "'Source Sans 3', 'Inter', sans-serif";
    Chart.defaults.color = '#57534E';
    Chart.defaults.font.weight = '600';

    setTimeout(() => {
        // ── 1. BAR CHART ────────────────────────────────────────────────────
        new Chart(document.getElementById('barChart'), {
            type: 'bar',
            data: {
                labels,
                datasets: [
                    { label: 'Pemasukan', data: pemasukan, backgroundColor: '#16A34A', borderRadius: 4 },
                    { label: 'Pengeluaran', data: pengeluaran, backgroundColor: '#DC2626', borderRadius: 4 },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { grid: { display: false }, border: { display: false } },
                    y: { border: { display: false }, grid: { color: '#E7E5E4', borderDash: [5, 5] } }
                }
            }
        });

        // ── 2. LINE CHART ───────────────────────────────────────────────────
        new Chart(document.getElementById('lineChart'), {
            type: 'line',
            data: {
                labels,
                datasets: [{
                    label: 'Saldo Kumulatif', data: saldoKumulatif, borderColor: '#C2410C',
                    pointBackgroundColor: '#FAFAF9', pointBorderColor: '#C2410C', pointBorderWidth: 2, pointRadius: 4,
                    borderWidth: 3, tension: 0.3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { grid: { display: false }, border: { display: false } },
                    y: { border: { display: false }, grid: { color: '#E7E5E4', borderDash: [5, 5] } }
                }
            }
        });

        // ── 3. PIE CHART ASET ───────────────────────────────────────────────
        const dLabels = @json($aktiva->pluck('nama_akun')->values());
        const dData = @json($aktiva->pluck('saldo_akhir')->values());
        // Ember semantic colors mapping
        const dColors = ['#C2410C', '#16A34A', '#D97706', '#DC2626', '#0284C7', '#7C3AED', '#0D9488'];

        let pieCanvas = document.getElementById('pieChartAset');
        if (pieCanvas) {
            new Chart(pieCanvas, {
                type: 'pie',
                data: {
                    labels: dLabels,
                    datasets: [{
                        data: dData, backgroundColor: dColors, borderWidth: 0, hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { 
                            display: true, 
                            position: 'bottom',
                            labels: {
                                font: { weight: '600', family: "'Source Sans 3', sans-serif" },
                                color: '#1C1917',
                                padding: 20,
                                usePointStyle: true,
                                pointStyle: 'circle'
                            }
                        } 
                    }
                }
            });
        }
    }, 500);
</script>
@endsection