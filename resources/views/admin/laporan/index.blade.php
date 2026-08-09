@extends('layouts.admin')

@section('header_title', 'Laporan Keuangan')

@section('content')
<div class="bg-white border border-[#D6D3D1] rounded-[12px] p-6 shadow-sm mb-6 print:hidden">
    <div class="flex items-center justify-between mb-4">
        <div>
            <h2 class="text-xl font-semibold text-[#1C1917]">Filter Laporan</h2>
            <p class="text-sm text-[#57534E]">Pilih bulan dan tahun untuk melihat laporan keuangan.</p>
        </div>
    </div>
    
    <form action="{{ route('admin.laporan.index') }}" method="GET" class="flex gap-4 items-end">
        <div>
            <label class="block text-sm font-semibold text-[#1C1917] mb-1">Bulan</label>
            <select name="bulan" class="px-4 py-2 border border-[#D6D3D1] rounded-[8px] focus:outline-none focus:border-[#C2410C]">
                @for($i=1; $i<=12; $i++)
                    <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}" {{ $bulan == str_pad($i, 2, '0', STR_PAD_LEFT) ? 'selected' : '' }}>
                        {{ date('F', mktime(0, 0, 0, $i, 1)) }}
                    </option>
                @endfor
            </select>
        </div>
        <div>
            <label class="block text-sm font-semibold text-[#1C1917] mb-1">Tahun</label>
            <select name="tahun" class="px-4 py-2 border border-[#D6D3D1] rounded-[8px] focus:outline-none focus:border-[#C2410C]">
                @for($i=date('Y')-5; $i<=date('Y')+1; $i++)
                    <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
        </div>
        <button type="submit" class="bg-[#1C1917] hover:bg-[#44403C] text-white px-5 py-2 rounded-[8px] font-semibold text-sm">Tampilkan</button>
        
        <button type="button" onclick="window.print()" class="ml-auto bg-[#C2410C] hover:bg-[#9A3412] text-white px-5 py-2 rounded-[8px] font-semibold text-sm flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
            Cetak Laporan
        </button>
    </form>
</div>

<!-- Laporan Cetak -->
<div class="bg-white border border-[#D6D3D1] rounded-[12px] p-8 shadow-sm">
    <div class="text-center border-b-2 border-[#1C1917] pb-6 mb-8">
        <h1 class="text-2xl font-bold text-[#1C1917] font-display uppercase tracking-wider">Laporan Keuangan BUMDes</h1>
        <p class="text-lg text-[#57534E] mt-1">Periode: {{ date('F', mktime(0, 0, 0, $bulan, 1)) }} {{ $tahun }}</p>
    </div>

    <!-- Ringkasan Saldo -->
    <div class="grid grid-cols-2 gap-8 mb-8">
        <div class="bg-[#FAFAF9] p-5 rounded-[8px] border border-[#E7E5E4]">
            <p class="text-sm font-semibold text-[#78716C] mb-1">Total Pemasukan (Kas + Penjualan)</p>
            <h3 class="text-2xl font-bold text-[#16A34A]">Rp {{ number_format($labaKotor, 0, ',', '.') }}</h3>
        </div>
        <div class="bg-[#FAFAF9] p-5 rounded-[8px] border border-[#E7E5E4]">
            <p class="text-sm font-semibold text-[#78716C] mb-1">Total Pengeluaran (Biaya/Beban)</p>
            <h3 class="text-2xl font-bold text-[#DC2626]">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</h3>
        </div>
    </div>

    <div class="flex justify-between items-center bg-[#F5F5F4] p-5 rounded-[8px] border border-[#D6D3D1] mb-8">
        <span class="text-lg font-bold text-[#1C1917]">LABA BERSIH (PROFIT)</span>
        <span class="text-2xl font-bold {{ $labaBersih >= 0 ? 'text-[#16A34A]' : 'text-[#DC2626]' }}">
            Rp {{ number_format($labaBersih, 0, ',', '.') }}
        </span>
    </div>

    <!-- Grafik Tren Harian -->
    <div class="mb-8 print:hidden">
        <h3 class="font-bold text-[#1C1917] border-b border-[#D6D3D1] pb-2 mb-4">Grafik Tren Keuangan Harian</h3>
        <div class="bg-[#FAFAF9] p-4 rounded-[8px] border border-[#E7E5E4] h-80">
            <canvas id="keuanganChart"></canvas>
        </div>
    </div>

    <!-- Top Produk Terlaris -->
    <div class="mb-8">
        <h3 class="font-bold text-[#1C1917] border-b border-[#D6D3D1] pb-2 mb-3">5 Produk Terlaris (Kontribusi Penjualan)</h3>
        <div class="bg-[#FAFAF9] rounded-[8px] border border-[#E7E5E4] overflow-hidden">
            <table class="w-full text-left text-sm">
                <thead class="bg-[#F5F5F4] border-b border-[#D6D3D1]">
                    <tr>
                        <th class="py-2 px-4 font-semibold text-[#57534E]">Nama Produk</th>
                        <th class="py-2 px-4 font-semibold text-[#57534E] text-center">Terjual</th>
                        <th class="py-2 px-4 font-semibold text-[#57534E] text-right">Omzet</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#E7E5E4]">
                    @forelse($topProduk as $tp)
                    <tr>
                        <td class="py-2 px-4 font-medium text-[#1C1917]">{{ $tp->produk->nama_produk ?? 'Produk Dihapus' }}</td>
                        <td class="py-2 px-4 text-center">
                            <span class="bg-[#C2410C] text-white px-2 py-0.5 rounded-full text-xs">{{ $tp->total_terjual }}</span>
                        </td>
                        <td class="py-2 px-4 text-right font-semibold text-[#16A34A]">Rp {{ number_format($tp->total_pendapatan, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="py-4 text-center text-[#78716C] italic">Tidak ada data penjualan produk bulan ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Rincian Pemasukan -->
        <div>
            <h3 class="font-bold text-[#1C1917] border-b border-[#D6D3D1] pb-2 mb-3">Rincian Pemasukan & Pendapatan</h3>
            <table class="w-full text-left text-sm mb-4">
                <tbody>
                    <tr>
                        <td class="py-2 text-[#57534E] font-medium">Pendapatan Penjualan / POS</td>
                        <td class="py-2 text-right font-bold text-[#1C1917]">Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</td>
                    </tr>
                    @foreach($pemasukan as $p)
                    <tr>
                        <td class="py-2 text-[#57534E] pl-4">- {{ $p->keterangan }}</td>
                        <td class="py-2 text-right text-[#1C1917]">Rp {{ number_format($p->nominal, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="border-t border-[#D6D3D1]">
                        <td class="py-3 font-bold text-[#1C1917]">Total Pemasukan Kas</td>
                        <td class="py-3 text-right font-bold text-[#1C1917]">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Rincian Pengeluaran -->
        <div>
            <h3 class="font-bold text-[#1C1917] border-b border-[#D6D3D1] pb-2 mb-3">Rincian Pengeluaran & Biaya</h3>
            <table class="w-full text-left text-sm mb-4">
                <tbody>
                    @forelse($pengeluaran as $p)
                    <tr>
                        <td class="py-2 text-[#57534E]">- {{ $p->keterangan }}</td>
                        <td class="py-2 text-right text-[#1C1917]">Rp {{ number_format($p->nominal, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2" class="py-2 text-[#78716C] italic text-center">Tidak ada pengeluaran pada periode ini.</td>
                    </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr class="border-t border-[#D6D3D1]">
                        <td class="py-3 font-bold text-[#1C1917]">Total Pengeluaran</td>
                        <td class="py-3 text-right font-bold text-[#DC2626]">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    
    <div class="mt-16 pt-8 flex justify-end text-center print:block">
        <div>
            <p class="text-sm text-[#1C1917] mb-16">Mengetahui,<br><strong>Direktur BUMDes</strong></p>
            <p class="text-sm font-bold text-[#1C1917] underline">(...................................)</p>
        </div>
    </div>
</div>

<style>
    @media print {
        body { background: white !important; }
        aside, header, .print\:hidden { display: none !important; }
        main { padding: 0 !important; margin: 0 !important; overflow: visible !important; }
        .bg-white { box-shadow: none !important; border: none !important; }
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('keuanganChart').getContext('2d');
        const keuanganChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($labelsHarian) !!},
                datasets: [
                    {
                        label: 'Total Pemasukan (Rp)',
                        data: {!! json_encode($dataPemasukanHarian) !!},
                        borderColor: '#16A34A', // Green
                        backgroundColor: 'rgba(22, 163, 74, 0.1)',
                        borderWidth: 2,
                        tension: 0.3,
                        fill: true
                    },
                    {
                        label: 'Total Pengeluaran (Rp)',
                        data: {!! json_encode($dataPengeluaranHarian) !!},
                        borderColor: '#DC2626', // Red
                        backgroundColor: 'rgba(220, 38, 38, 0.1)',
                        borderWidth: 2,
                        tension: 0.3,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += 'Rp ' + new Intl.NumberFormat('id-ID').format(context.parsed.y);
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                            }
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Tanggal'
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
