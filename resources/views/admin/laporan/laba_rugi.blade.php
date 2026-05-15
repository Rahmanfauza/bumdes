{{-- Controls Card --}}
<div class="bg-[#FAFAF9] border border-[#D6D3D1] rounded-[12px] shadow-sm p-6 lg:p-8">
    <div class="mb-6">
        <h3 class="text-2xl font-display font-bold text-[#1C1917]">Laporan Laba Rugi</h3>
        <p class="text-[#57534E] text-[14px] mt-1">Rekapitulasi pendapatan dan beban usaha BUMDes per periode.</p>
    </div>

    {{-- Controls (Filter & Export) --}}
    <div class="flex flex-col lg:flex-row gap-5 items-start lg:items-center justify-between border-b border-[#D6D3D1] pb-8 mb-8">
        {{-- Filter Form --}}
        <form method="GET" action="{{ route('laporan.index') }}" class="flex flex-wrap items-end gap-3 w-full lg:w-auto">
            <input type="hidden" name="tab" value="laba_rugi">
            <div class="flex flex-col gap-1.5">
                <label class="font-semibold text-[#1C1917] text-[13px] uppercase tracking-wide">Per Tanggal</label>
                <input type="date" name="tanggal_laba_rugi" value="{{ request('tanggal_laba_rugi') }}" class="px-4 py-2 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[8px] focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15 text-[#1C1917] text-[14px]">
            </div>
            <button type="submit" class="px-5 py-2 h-[42px] bg-[#C2410C] text-white font-semibold rounded-[8px] hover:bg-[#9A3412] shadow-sm transition-all flex items-center justify-center">
                Tampilkan
            </button>
            @if (request('tanggal_laba_rugi'))
                <a href="{{ route('laporan.index') }}?tab=laba_rugi" class="px-5 py-2 h-[42px] bg-transparent text-[#DC2626] border border-[#D6D3D1] font-semibold rounded-[8px] hover:bg-[#FEE2E2] hover:border-[#DC2626]/30 transition-all flex items-center justify-center text-[14px]">
                    Reset
                </a>
            @endif
        </form>

        {{-- Export Buttons --}}
        <div class="flex gap-3 shrink-0">
            <button type="button" onclick="window.print()" class="px-4 py-2 h-[42px] bg-white text-[#1C1917] border border-[#D6D3D1] font-semibold rounded-[8px] hover:bg-[#F5F5F4] transition-all flex items-center gap-2 text-[14px]">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                Print
            </button>
            <a href="{{ route('laporan.export.csv', request()->all()) }}" class="px-4 py-2 h-[42px] bg-white text-[#1C1917] border border-[#D6D3D1] font-semibold rounded-[8px] hover:bg-[#F5F5F4] transition-all flex items-center gap-2 text-[14px]">
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
                    <th class="px-5 py-4 font-semibold tracking-wide">Keterangan Akun</th>
                    <th class="px-5 py-4 font-semibold tracking-wide text-center w-40">Kelompok</th>
                    <th class="px-5 py-4 font-semibold tracking-wide text-right">Jumlah (Rp)</th>
                </tr>
            </thead>
            <tbody>
                <!-- PENDAPATAN -->
                <tr class="bg-[#DCFCE7]/40 border-b border-[#D6D3D1]">
                    <td colspan="3" class="px-5 py-3 font-bold uppercase tracking-wide text-[#16A34A] text-[13px] flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                        Pendapatan Usaha
                    </td>
                </tr>
                @forelse($pendapatan as $akun)
                <tr class="border-b border-[#E7E5E4] hover:bg-[#F5F5F4] transition-colors">
                    <td class="px-5 py-3.5 text-[#1C1917]">{{ $akun->nomor_akun }} – {{ $akun->nama_akun }}</td>
                    <td class="px-5 py-3.5 text-center">
                        <span class="inline-block px-[10px] py-[3px] rounded-[9999px] text-[11px] font-bold bg-[#DCFCE7] text-[#16A34A]">Pendapatan</span>
                    </td>
                    <td class="px-5 py-3.5 text-right font-bold text-[#16A34A]">Rp {{ number_format($akun->saldo_akhir, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr class="border-b border-[#E7E5E4]">
                    <td colspan="3" class="px-5 py-4 text-center text-[#78716C]">Belum ada data pendapatan</td>
                </tr>
                @endforelse
                <tr class="border-b border-[#D6D3D1] bg-[#F0FDF4]">
                    <td colspan="2" class="px-5 py-4 font-bold uppercase text-[#16A34A] text-[13px] tracking-wide">Total Pendapatan</td>
                    <td class="px-5 py-4 text-right font-bold text-[#16A34A]">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</td>
                </tr>

                <!-- BEBAN -->
                <tr class="bg-[#FEE2E2]/40 border-b border-[#D6D3D1]">
                    <td colspan="3" class="px-5 py-3 font-bold uppercase tracking-wide text-[#DC2626] text-[13px] flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                        Beban Usaha (Pengeluaran)
                    </td>
                </tr>
                @forelse($beban as $akun)
                <tr class="border-b border-[#E7E5E4] hover:bg-[#F5F5F4] transition-colors">
                    <td class="px-5 py-3.5 text-[#1C1917]">{{ $akun->nomor_akun }} – {{ $akun->nama_akun }}</td>
                    <td class="px-5 py-3.5 text-center">
                        <span class="inline-block px-[10px] py-[3px] rounded-[9999px] text-[11px] font-bold bg-[#FEE2E2] text-[#DC2626]">Beban</span>
                    </td>
                    <td class="px-5 py-3.5 text-right font-bold text-[#DC2626]">Rp {{ number_format($akun->saldo_akhir, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr class="border-b border-[#E7E5E4]">
                    <td colspan="3" class="px-5 py-4 text-center text-[#78716C]">Belum ada data beban</td>
                </tr>
                @endforelse
                <tr class="border-b border-[#D6D3D1] bg-[#FFF5F5]">
                    <td colspan="2" class="px-5 py-4 font-bold uppercase text-[#DC2626] text-[13px] tracking-wide">Total Beban</td>
                    <td class="px-5 py-4 text-right font-bold text-[#DC2626]">Rp {{ number_format($totalBeban, 0, ',', '.') }}</td>
                </tr>

                <!-- LABA BERSIH -->
                <tr class="bg-[#1C1917] text-white">
                    <td colspan="2" class="px-5 py-5 font-bold uppercase tracking-wide text-right text-[#A8A29E] text-[13px]">
                        Laba Bersih (Pendapatan – Beban)
                    </td>
                    <td class="px-5 py-5 text-right font-display font-bold text-xl {{ $labaBersihAkuntansi >= 0 ? 'text-[#4ADE80]' : 'text-[#F87171]' }}">
                        Rp {{ number_format($labaBersihAkuntansi, 0, ',', '.') }}
                    </td>
                </tr>

                <!-- SIMULASI PEMBAGIAN SHU -->
                @if($labaBersihAkuntansi > 0)
                <tr class="bg-[#FEF3C7] border-b border-[#D6D3D1]">
                    <th class="px-5 py-3 font-bold tracking-wide text-[#D97706] text-[13px] uppercase">Simulasi Peruntukan (SHU)</th>
                    <th class="px-5 py-3 font-bold text-[#D97706] text-[13px] text-center">Presentase</th>
                    <th class="px-5 py-3 font-bold text-[#D97706] text-[13px] text-right">Jumlah (Rp)</th>
                </tr>
                @foreach([
                    ['label' => 'Pendapatan Asli Desa (PADes)', 'pct' => 0.20],
                    ['label' => 'Penambahan Modal BUMDes', 'pct' => 0.40],
                    ['label' => 'Insentif Pengurus & Penasihat', 'pct' => 0.20],
                    ['label' => 'Dana Pendidikan & Sosial', 'pct' => 0.10],
                    ['label' => 'Dana Cadangan', 'pct' => 0.10],
                ] as $shu)
                <tr class="border-b border-[#E7E5E4] hover:bg-[#F5F5F4] transition-colors bg-white">
                    <td class="px-5 py-3.5 text-[#1C1917]">{{ $shu['label'] }}</td>
                    <td class="px-5 py-3.5 text-center text-[#57534E]">{{ ($shu['pct'] * 100) . '%' }}</td>
                    <td class="px-5 py-3.5 text-right font-bold text-[#D97706]">Rp {{ number_format($labaBersihAkuntansi * $shu['pct'], 0, ',', '.') }}</td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

{{-- SUMMARY CARDS --}}
<div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
    <div class="bg-[#FAFAF9] border border-[#D6D3D1] rounded-[12px] p-6 shadow-sm hover:shadow-md transition-shadow flex items-center gap-5">
        <div class="w-14 h-14 rounded-full bg-[#DCFCE7] flex items-center justify-center shrink-0">
            <svg class="w-7 h-7 text-[#16A34A]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
            </svg>
        </div>
        <div>
            <p class="text-[13px] text-[#78716C] font-semibold uppercase tracking-wide">Total Pendapatan</p>
            <p class="text-2xl font-display font-bold text-[#1C1917] mt-1">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
        </div>
    </div>

    <div class="bg-[#FAFAF9] border border-[#D6D3D1] rounded-[12px] p-6 shadow-sm hover:shadow-md transition-shadow flex items-center gap-5">
        <div class="w-14 h-14 rounded-full bg-[#FEE2E2] flex items-center justify-center shrink-0">
            <svg class="w-7 h-7 text-[#DC2626]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
            </svg>
        </div>
        <div>
            <p class="text-[13px] text-[#78716C] font-semibold uppercase tracking-wide">Total Beban / Biaya</p>
            <p class="text-2xl font-display font-bold text-[#1C1917] mt-1">Rp {{ number_format($totalBeban, 0, ',', '.') }}</p>
        </div>
    </div>

    <div class="bg-[#FAFAF9] border border-[#D6D3D1] rounded-[12px] p-6 shadow-sm hover:shadow-md transition-shadow flex items-center gap-5">
        <div class="w-14 h-14 rounded-full {{ $labaBersihAkuntansi >= 0 ? 'bg-[#DBEAFE]' : 'bg-[#FEF3C7]' }} flex items-center justify-center shrink-0">
            <svg class="w-7 h-7 {{ $labaBersihAkuntansi >= 0 ? 'text-[#1D4ED8]' : 'text-[#D97706]' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <div>
            <p class="text-[13px] text-[#78716C] font-semibold uppercase tracking-wide">Laba Rugi Bersih</p>
            <p class="text-2xl font-display font-bold {{ $labaBersihAkuntansi >= 0 ? 'text-[#1D4ED8]' : 'text-[#D97706]' }} mt-1">Rp {{ number_format(abs($labaBersihAkuntansi), 0, ',', '.') }}</p>
            <span class="inline-block px-[10px] py-[3px] rounded-[9999px] text-[11px] font-bold mt-1 {{ $labaBersihAkuntansi >= 0 ? 'bg-[#DBEAFE] text-[#1D4ED8]' : 'bg-[#FEF3C7] text-[#D97706]' }}">
                {{ $labaBersihAkuntansi >= 0 ? 'Surplus (Laba)' : 'Defisit (Rugi)' }}
            </span>
        </div>
    </div>
</div>

{{-- Charts --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    {{-- Bar Chart: Pemasukan vs Pengeluaran per Bulan --}}
    <div class="bg-[#FAFAF9] border border-[#D6D3D1] rounded-[12px] shadow-sm p-6 flex flex-col h-[400px]">
        <div class="mb-4">
            <h3 class="text-xl font-display font-bold text-[#1C1917]">Metrik Bulanan {{ $tahunDipilih }}</h3>
            <p class="text-[#57534E] text-[13px] mt-0.5">Perbandingan pemasukan vs pengeluaran per bulan</p>
        </div>
        <div class="relative w-full flex-1 pb-4">
            <canvas id="barChart"></canvas>
        </div>
    </div>
    
    {{-- Line Chart: Tren Saldo Kumulatif --}}
    <div class="bg-[#FAFAF9] border border-[#D6D3D1] rounded-[12px] shadow-sm p-6 flex flex-col h-[400px]">
        <div class="mb-4">
            <h3 class="text-xl font-display font-bold text-[#1C1917]">Tren Saldo Kumulatif {{ $tahunDipilih }}</h3>
            <p class="text-[#57534E] text-[13px] mt-0.5">Pergerakan saldo bersih sepanjang tahun</p>
        </div>
        <div class="relative w-full flex-1 pb-4">
            <canvas id="lineChart"></canvas>
        </div>
    </div>
</div>
