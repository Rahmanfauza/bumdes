@extends('layouts.admin')

@section('header_title', 'Laporan Keuangan')

@section('content')
    <div class="space-y-6">

        {{-- ================================================================ --}}
        {{-- PAGE HEADER --}}
        {{-- ================================================================ --}}
        <div class="flex flex-col gap-3">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Laporan Keuangan BUMDes</h2>
                    <p class="text-sm text-gray-500 mt-0.5">Ringkasan dan analisis transaksi pemasukan & pengeluaran</p>
                </div>
                {{-- Filter Form --}}
                <form method="GET" action="{{ route('laporan.index') }}" class="flex flex-wrap items-center gap-2">
                    <select name="tahun"
                        class="px-3 py-2 text-sm border border-gray-200 rounded-lg bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40 text-gray-700">
                        @foreach ($tahunTersedia as $tahun)
                            <option value="{{ $tahun }}" {{ $tahunDipilih == $tahun ? 'selected' : '' }}>
                                Tahun {{ $tahun }}
                            </option>
                        @endforeach
                    </select>
                    <select name="bulan"
                        class="px-3 py-2 text-sm border border-gray-200 rounded-lg bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40 text-gray-700">
                        <option value="">Semua Bulan</option>
                        @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $i => $bln)
                            <option value="{{ $i + 1 }}" {{ $bulanDipilih == $i + 1 ? 'selected' : '' }}>{{ $bln }}</option>
                        @endforeach
                    </select>
                    <select name="minggu"
                        class="px-3 py-2 text-sm border border-gray-200 rounded-lg bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40 text-gray-700">
                        <option value="">Semua Pekan</option>
                        @foreach ([1, 2, 3, 4, 5] as $pekan)
                            <option value="{{ $pekan }}" {{ (isset($mingguDipilih) && $mingguDipilih == $pekan) ? 'selected' : '' }}>
                                Pekan ke-{{ $pekan }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit"
                        class="flex items-center gap-1.5 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z" />
                        </svg>
                        Filter
                    </button>
                    @if ($bulanDipilih)
                        <a href="{{ route('laporan.index', ['tahun' => $tahunDipilih]) }}"
                            class="px-3 py-2 text-sm text-gray-500 hover:text-gray-700 border border-gray-200 bg-white rounded-lg transition shadow-sm">
                            Reset
                        </a>
                    @endif
                </form>
            </div>

            {{-- Tombol Export --}}
            <div class="flex flex-wrap items-center gap-2">
                <span class="text-xs text-gray-400 font-medium uppercase tracking-wide mr-1">Export:</span>

                <a href="{{ route('laporan.export.csv', ['tahun' => $tahunDipilih, 'bulan' => $bulanDipilih, 'minggu' => $mingguDipilih ?? '']) }}"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Excel / Spreadsheet (.csv)
                </a>

                <a href="{{ route('laporan.export.pdf', ['tahun' => $tahunDipilih, 'bulan' => $bulanDipilih, 'minggu' => $mingguDipilih ?? '']) }}"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-rose-600 hover:bg-rose-700 text-white text-sm font-medium rounded-lg transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                    PDF (.pdf)
                </a>

                <span class="text-xs text-gray-400 ml-1 italic">
                    Periode:
                    @php
                        $strPekan = !empty($mingguDipilih) ? 'Pekan ke-'.$mingguDipilih.', ' : '';
                        $strBulan = !empty($bulanDipilih) ? ['', 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'][$bulanDipilih] . ' ' : 'Seluruh ';
                    @endphp
                    {{ $strPekan }}{{ $strBulan }}{{ $tahunDipilih }}
                </span>
            </div>
        </div>

        {{-- ================================================================ --}}
        {{-- SUMMARY CARDS --}}
        {{-- ================================================================ --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            {{-- Pemasukan --}}
            <div
                class="relative bg-gradient-to-br from-emerald-500 to-green-600 rounded-2xl p-5 text-white shadow-md overflow-hidden">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-white/10 rounded-full"></div>
                <div class="absolute -right-2 -bottom-6 w-32 h-32 bg-white/10 rounded-full"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-3">
                        <p class="text-sm font-medium text-white/80">Total Pemasukan</p>
                        <div class="w-9 h-9 rounded-xl bg-white/20 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 10l7-7m0 0l7 7m-7-7v18" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-2xl font-bold">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</p>
                    <p class="text-xs text-white/70 mt-1">
                        {{ $transaksis->where('jenis_transaksi', 'Pemasukan')->count() }} transaksi
                        {{ $bulanDipilih ? 'bulan ini' : 'tahun ' . $tahunDipilih }}
                    </p>
                </div>
            </div>

            {{-- Pengeluaran --}}
            <div
                class="relative bg-gradient-to-br from-rose-500 to-red-600 rounded-2xl p-5 text-white shadow-md overflow-hidden">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-white/10 rounded-full"></div>
                <div class="absolute -right-2 -bottom-6 w-32 h-32 bg-white/10 rounded-full"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-3">
                        <p class="text-sm font-medium text-white/80">Total Pengeluaran</p>
                        <div class="w-9 h-9 rounded-xl bg-white/20 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-2xl font-bold">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</p>
                    <p class="text-xs text-white/70 mt-1">
                        {{ $transaksis->where('jenis_transaksi', 'Pengeluaran')->count() }} transaksi
                        {{ $bulanDipilih ? 'bulan ini' : 'tahun ' . $tahunDipilih }}
                    </p>
                </div>
            </div>

            {{-- Saldo --}}
            <div
                class="relative bg-gradient-to-br {{ $saldo >= 0 ? 'from-blue-500 to-indigo-600' : 'from-orange-500 to-amber-600' }} rounded-2xl p-5 text-white shadow-md overflow-hidden">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-white/10 rounded-full"></div>
                <div class="absolute -right-2 -bottom-6 w-32 h-32 bg-white/10 rounded-full"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-3">
                        <p class="text-sm font-medium text-white/80">Saldo Bersih</p>
                        <div class="w-9 h-9 rounded-xl bg-white/20 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-2xl font-bold">Rp {{ number_format(abs($saldo), 0, ',', '.') }}</p>
                    <p class="text-xs text-white/70 mt-1">
                        {{ $saldo >= 0 ? '✅ Surplus' : '⚠️ Defisit' }}
                        — {{ $transaksis->count() }} total transaksi
                    </p>
                </div>
            </div>
        </div>

        {{-- ================================================================ --}}
        {{-- CHARTS ROW --}}
        {{-- ================================================================ --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

            {{-- Bar Chart: Pemasukan vs Pengeluaran per Bulan --}}
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-base font-semibold text-gray-800">Perbandingan Bulanan</h3>
                        <p class="text-xs text-gray-400 mt-0.5">Pemasukan vs Pengeluaran — Tahun {{ $tahunDipilih }}</p>
                    </div>
                    <div class="flex items-center gap-3 text-xs text-gray-500">
                        <span class="flex items-center gap-1"><span
                                class="w-3 h-3 rounded-sm bg-emerald-500 inline-block"></span> Pemasukan</span>
                        <span class="flex items-center gap-1"><span
                                class="w-3 h-3 rounded-sm bg-rose-500 inline-block"></span> Pengeluaran</span>
                    </div>
                </div>
                <div style="position: relative; height: 260px;">
                    <canvas id="barChart"></canvas>
                </div>
            </div>

            {{-- Doughnut Chart: Per Unit Usaha --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <div class="mb-4">
                    <h3 class="text-base font-semibold text-gray-800">Per Unit Usaha</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Distribusi total transaksi</p>
                </div>
                <div style="position: relative; height: 200px;">
                    <canvas id="doughnutChart"></canvas>
                </div>
                {{-- Legend --}}
                <div class="mt-3 space-y-1.5" id="doughnutLegend"></div>
            </div>
        </div>

        {{-- ================================================================ --}}
        {{-- LINE CHART: TREND SALDO --}}
        {{-- ================================================================ --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-base font-semibold text-gray-800">Tren Saldo Kumulatif</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Akumulasi saldo bersih per bulan — Tahun {{ $tahunDipilih }}</p>
                </div>
            </div>
            <div style="position: relative; height: 200px;">
                <canvas id="lineChart"></canvas>
            </div>
        </div>

        {{-- ================================================================ --}}
        {{-- PER UNIT USAHA TABLE --}}
        {{-- ================================================================ --}}
        @if($perUnitUsaha->isNotEmpty())
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h3 class="text-base font-semibold text-gray-800">Ringkasan per Unit Usaha</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Breakdown pemasukan & pengeluaran untuk setiap unit usaha</p>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-gray-500 uppercase bg-gray-50/70 border-b border-gray-100">
                            <tr>
                                <th class="px-6 py-3 font-semibold">Unit Usaha</th>
                                <th class="px-6 py-3 font-semibold text-right text-emerald-600">Pemasukan</th>
                                <th class="px-6 py-3 font-semibold text-right text-rose-600">Pengeluaran</th>
                                <th class="px-6 py-3 font-semibold text-right">Saldo Unit</th>
                                <th class="px-6 py-3 font-semibold text-center">Kontribusi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @php $grandTotal = $totalPemasukan + $totalPengeluaran; @endphp
                            @foreach ($perUnitUsaha as $unitId => $rows)
                                @php
                                    $namaUnit = $rows->first()->unitUsaha->nama_usaha ?? 'Unit #' . $unitId;
                                    $pIn = $rows->where('jenis_transaksi', 'Pemasukan')->sum('total');
                                    $pOut = $rows->where('jenis_transaksi', 'Pengeluaran')->sum('total');
                                    $unitSaldo = $pIn - $pOut;
                                    $unitTotal = $pIn + $pOut;
                                    $pct = $grandTotal > 0 ? round(($unitTotal / $grandTotal) * 100, 1) : 0;
                                @endphp
                                <tr class="hover:bg-blue-50/20 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <div
                                                class="w-2 h-8 rounded-full {{ $unitSaldo >= 0 ? 'bg-emerald-400' : 'bg-rose-400' }}">
                                            </div>
                                            <span class="font-medium text-gray-900">{{ $namaUnit }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-right font-mono text-emerald-600 font-semibold">
                                        Rp {{ number_format($pIn, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 text-right font-mono text-rose-500 font-semibold">
                                        Rp {{ number_format($pOut, 0, ',', '.') }}
                                    </td>
                                    <td
                                        class="px-6 py-4 text-right font-mono font-bold {{ $unitSaldo >= 0 ? 'text-blue-600' : 'text-orange-500' }}">
                                        {{ $unitSaldo >= 0 ? '' : '-' }}Rp {{ number_format(abs($unitSaldo), 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col items-center gap-1">
                                            <span class="text-xs font-semibold text-gray-600">{{ $pct }}%</span>
                                            <div class="w-full bg-gray-100 rounded-full h-1.5">
                                                <div class="h-1.5 rounded-full bg-blue-500 transition-all"
                                                    style="width: {{ $pct }}%"></div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        {{-- ================================================================ --}}
        {{-- DETAIL TRANSAKSI TABLE --}}
        {{-- ================================================================ --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                <div>
                    <h3 class="text-base font-semibold text-gray-800">Rincian Transaksi</h3>
                    <p class="text-xs text-gray-400 mt-0.5">
                        Menampilkan {{ $transaksis->count() }} transaksi
                        {{ $bulanDipilih ? '— ' . ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'][$bulanDipilih] : '' }}
                        {{ $tahunDipilih }}
                    </p>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-600 uppercase bg-gray-50/70 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-3 font-semibold w-10">No.</th>
                            <th class="px-6 py-3 font-semibold">Tanggal</th>
                            <th class="px-6 py-3 font-semibold">Unit Usaha</th>
                            <th class="px-6 py-3 font-semibold text-center w-36">Jenis</th>
                            <th class="px-6 py-3 font-semibold text-right">Jumlah</th>
                            <th class="px-6 py-3 font-semibold">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse ($transaksis as $i => $t)
                            <tr class="hover:bg-blue-50/20 transition-colors">
                                <td class="px-6 py-3.5 text-gray-400">{{ $i + 1 }}</td>
                                <td class="px-6 py-3.5 whitespace-nowrap text-gray-700">
                                    {{ \Carbon\Carbon::parse($t->tanggal_transaksi)->translatedFormat('d M Y') }}
                                </td>
                                <td class="px-6 py-3.5 font-medium text-gray-800">
                                    {{ $t->unitUsaha->nama_usaha ?? '-' }}
                                </td>
                                <td class="px-6 py-3.5 text-center">
                                    @if($t->jenis_transaksi === 'Pemasukan')
                                        <span
                                            class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700 border border-emerald-200">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                            </svg>
                                            Pemasukan
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-rose-100 text-rose-600 border border-rose-200">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                                            </svg>
                                            Pengeluaran
                                        </span>
                                    @endif
                                </td>
                                <td
                                    class="px-6 py-3.5 text-right font-mono font-semibold {{ $t->jenis_transaksi === 'Pemasukan' ? 'text-emerald-600' : 'text-rose-500' }}">
                                    {{ $t->jenis_transaksi === 'Pemasukan' ? '+' : '-' }}
                                    Rp {{ number_format($t->jumlah, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-3.5 text-gray-500 max-w-xs truncate">
                                    {{ $t->keterangan ?: '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                                    <div class="flex flex-col items-center gap-2">
                                        <svg class="w-10 h-10 text-gray-200" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <span>Tidak ada transaksi pada periode ini.</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    @if($transaksis->count() > 0)
                        <tfoot class="bg-gray-50/80 border-t-2 border-gray-200">
                            <tr>
                                <td colspan="4" class="px-6 py-3 font-semibold text-gray-700 text-sm">TOTAL</td>
                                <td class="px-6 py-3 text-right font-mono font-bold text-gray-800">
                                    <div class="flex flex-col gap-0.5 items-end">
                                        <span class="text-emerald-600 text-xs">+Rp
                                            {{ number_format($totalPemasukan, 0, ',', '.') }}</span>
                                        <span class="text-rose-500 text-xs">-Rp
                                            {{ number_format($totalPengeluaran, 0, ',', '.') }}</span>
                                        <span class="text-sm {{ $saldo >= 0 ? 'text-blue-700' : 'text-orange-600' }}">
                                            = Rp {{ number_format($saldo, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                        </tfoot>
                    @endif
                </table>
            </div>
        </div>
    </div>

    {{-- ================================================================ --}}
    {{-- CHART.JS --}}
    {{-- ================================================================ --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
    <script>
        // ── Data dari PHP → JS ──────────────────────────────────────────────
        const labels = @json(array_values($namaBulan));
        const pemasukan = @json(array_values($pemasukanPerBulan));
        const pengeluaran = @json(array_values($pengeluaranPerBulan));

        // Kumulatif saldo per bulan
        const saldoKumulatif = [];
        let running = 0;
        for (let i = 0; i < 12; i++) {
            running += pemasukan[i] - pengeluaran[i];
            saldoKumulatif.push(running);
        }

        // Warna Chart.js global
        Chart.defaults.font.family = "'Inter', sans-serif";
        Chart.defaults.color = '#374151';

        // ── 1. BAR CHART ────────────────────────────────────────────────────
        new Chart(document.getElementById('barChart'), {
            type: 'bar',
            data: {
                labels,
                datasets: [
                    {
                        label: 'Pemasukan',
                        data: pemasukan,
                        backgroundColor: 'rgba(16, 185, 129, 0.75)',
                        borderColor: 'rgb(16, 185, 129)',
                        borderWidth: 1.5,
                        borderRadius: 6,
                    },
                    {
                        label: 'Pengeluaran',
                        data: pengeluaran,
                        backgroundColor: 'rgba(239, 68, 68, 0.75)',
                        borderColor: 'rgb(239, 68, 68)',
                        borderWidth: 1.5,
                        borderRadius: 6,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { mode: 'index', intersect: false },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: ctx => ` ${ctx.dataset.label}: Rp ${ctx.parsed.y.toLocaleString('id-ID')}`,
                        },
                    },
                },
                scales: {
                    x: { grid: { display: false } },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: val => 'Rp ' + (val >= 1e6 ? (val / 1e6).toFixed(1) + 'jt' : val >= 1e3 ? (val / 1e3).toFixed(0) + 'rb' : val),
                        },
                        grid: { color: 'rgba(156,163,175,0.15)' },
                    },
                },
            },
        });

        // ── 2. DOUGHNUT CHART ───────────────────────────────────────────────
        @php
            $doughnutLabels = [];
            $doughnutData = [];
            foreach ($perUnitUsaha as $unitId => $rows) {
                $nama = $rows->first()->unitUsaha->nama_usaha ?? 'Unit #' . $unitId;
                $total = $rows->sum('total');
                $doughnutLabels[] = $nama;
                $doughnutData[] = (float) $total;
            }
        @endphp
        const dLabels = @json($doughnutLabels);
        const dData = @json($doughnutData);
        const dColors = [
            '#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6',
            '#06b6d4', '#f97316', '#ec4899', '#14b8a6', '#6366f1',
        ];

        if (dData.length > 0) {
            new Chart(document.getElementById('doughnutChart'), {
                type: 'doughnut',
                data: {
                    labels: dLabels,
                    datasets: [{
                        data: dData,
                        backgroundColor: dColors.slice(0, dLabels.length),
                        borderWidth: 2,
                        hoverOffset: 8,
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '68%',
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: ctx => ` Rp ${ctx.parsed.toLocaleString('id-ID')}`,
                            },
                        },
                    },
                },
            });

            // Custom legend
            const legend = document.getElementById('doughnutLegend');
            dLabels.forEach((lbl, i) => {
                const pct = dData.reduce((a, b) => a + b, 0) > 0
                    ? ((dData[i] / dData.reduce((a, b) => a + b, 0)) * 100).toFixed(1)
                    : 0;
                legend.innerHTML += `
                        <div class="flex items-center justify-between text-xs">
                            <span class="flex items-center gap-1.5">
                                <span class="w-2.5 h-2.5 rounded-full shrink-0" style="background:${dColors[i]}"></span>
                                <span class="text-gray-600 truncate max-w-[130px]">${lbl}</span>
                            </span>
                            <span class="font-semibold text-gray-700">${pct}%</span>
                        </div>`;
            });
        } else {
            document.getElementById('doughnutChart').parentElement.innerHTML =
                '<p class="text-center text-gray-400 text-sm py-16">Tidak ada data.</p>';
        }

        // ── 3. LINE CHART (Saldo Kumulatif) ─────────────────────────────────
        new Chart(document.getElementById('lineChart'), {
            type: 'line',
            data: {
                labels,
                datasets: [{
                    label: 'Saldo Kumulatif',
                    data: saldoKumulatif,
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59,130,246,0.08)',
                    pointBackgroundColor: saldoKumulatif.map(v => v >= 0 ? '#10b981' : '#ef4444'),
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    tension: 0.35,
                    fill: true,
                    borderWidth: 2.5,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { mode: 'index', intersect: false },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: ctx => ` Saldo: Rp ${ctx.parsed.y.toLocaleString('id-ID')}`,
                        },
                    },
                },
                scales: {
                    x: { grid: { display: false } },
                    y: {
                        grid: { color: 'rgba(156,163,175,0.15)' },
                        ticks: {
                            callback: val => 'Rp ' + (Math.abs(val) >= 1e6 ? (val / 1e6).toFixed(1) + 'jt' : Math.abs(val) >= 1e3 ? (val / 1e3).toFixed(0) + 'rb' : val),
                        },
                    },
                },
            },
        });
    </script>
@endsection