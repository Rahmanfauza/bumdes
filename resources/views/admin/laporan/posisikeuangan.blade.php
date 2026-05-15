<div class="space-y-6">

    {{-- Controls Card --}}
    <div class="bg-[#FAFAF9] border border-[#D6D3D1] rounded-[12px] shadow-sm p-6 lg:p-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6 mb-8">
            <div>
                <h3 class="text-2xl font-display font-bold text-[#1C1917]">Posisi Keuangan (Neraca)</h3>
                <p class="text-[#57534E] text-[14px] mt-1">Gambaran aset, kewajiban, dan ekuitas BUMDes per periode.</p>
            </div>
            {{-- Controls (Export & Print) --}}
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

        {{-- SUMMARY CARDS --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
            {{-- Total Aktiva --}}
            <div class="bg-[#FAFAF9] border border-[#D6D3D1] rounded-[12px] p-6 shadow-sm hover:shadow-md transition-shadow flex items-center gap-5">
                <div class="w-14 h-14 rounded-full bg-[#DBEAFE] flex items-center justify-center shrink-0">
                    <svg class="w-7 h-7 text-[#1D4ED8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                    </svg>
                </div>
                <div>
                    <p class="text-[13px] text-[#78716C] font-semibold uppercase tracking-wide">Total Aktiva (Aset)</p>
                    <p class="text-xl font-display font-bold text-[#1C1917] mt-1">Rp {{ number_format($totalAktiva, 0, ',', '.') }}</p>
                    <p class="text-[12px] text-[#78716C] mt-1">Kekayaan BUMDes saat ini</p>
                </div>
            </div>

            {{-- Total Pasiva --}}
            <div class="bg-[#FAFAF9] border border-[#D6D3D1] rounded-[12px] p-6 shadow-sm hover:shadow-md transition-shadow flex items-center gap-5">
                <div class="w-14 h-14 rounded-full bg-[#FEE2E2] flex items-center justify-center shrink-0">
                    <svg class="w-7 h-7 text-[#DC2626]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z" />
                    </svg>
                </div>
                <div>
                    <p class="text-[13px] text-[#78716C] font-semibold uppercase tracking-wide">Total Pasiva (Kewajiban)</p>
                    <p class="text-xl font-display font-bold text-[#1C1917] mt-1">Rp {{ number_format($totalPasiva, 0, ',', '.') }}</p>
                    <p class="text-[12px] text-[#78716C] mt-1">Kewajiban & utang operasional</p>
                </div>
            </div>

            {{-- Total Ekuitas --}}
            <div class="bg-[#FAFAF9] border border-[#D6D3D1] rounded-[12px] p-6 shadow-sm hover:shadow-md transition-shadow flex items-center gap-5">
                <div class="w-14 h-14 rounded-full bg-[#FEF3C7] flex items-center justify-center shrink-0">
                    <svg class="w-7 h-7 text-[#D97706]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-[13px] text-[#78716C] font-semibold uppercase tracking-wide">Total Ekuitas + Laba</p>
                    <p class="text-xl font-display font-bold text-[#1C1917] mt-1">Rp {{ number_format($totalModalDanLaba, 0, ',', '.') }}</p>
                    <p class="text-[12px] text-[#78716C] mt-1">Modal bersih termasuk laba berjalan</p>
                </div>
            </div>
        </div>

        {{-- Tabel Data and Pie Chart Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            
            {{-- Tabel Detail Neraca --}}
            <div class="overflow-hidden border border-[#D6D3D1] rounded-[12px] bg-white shadow-sm">
                <div class="px-5 py-4 border-b border-[#D6D3D1] bg-[#F5F5F4]">
                    <h4 class="font-bold text-[#1C1917] text-[15px]">Detail Neraca Saldo</h4>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left font-semibold text-[#1C1917]">
                        <tbody>
                            <!-- AKTIVA -->
                            <tr class="bg-[#DBEAFE]/40 border-b border-[#D6D3D1]">
                                <td colspan="2" class="px-5 py-3 font-bold uppercase tracking-wide text-[#1D4ED8] text-[12px] flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path></svg>
                                    Kategori: Aktiva (Aset)
                                </td>
                            </tr>
                            @forelse($aktiva as $akun)
                            <tr class="border-b border-[#E7E5E4] hover:bg-[#F5F5F4] transition-colors">
                                <td class="px-5 py-3 text-[#1C1917] text-[14px]">{{ $akun->nomor_akun }} – {{ $akun->nama_akun }}</td>
                                <td class="px-5 py-3 text-right font-bold text-[#1C1917] text-[14px] whitespace-nowrap">Rp {{ number_format($akun->saldo_akhir, 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr class="border-b border-[#E7E5E4]">
                                <td colspan="2" class="px-5 py-4 text-center text-[#78716C]">Belum ada data Aset</td>
                            </tr>
                            @endforelse
                            <tr class="border-b border-[#D6D3D1] bg-[#EFF6FF]">
                                <td class="px-5 py-4 font-bold uppercase text-[#1D4ED8] text-[13px] tracking-wide">Total Aktiva</td>
                                <td class="px-5 py-4 text-right font-bold text-[#1D4ED8] whitespace-nowrap">Rp {{ number_format($totalAktiva, 0, ',', '.') }}</td>
                            </tr>

                            <!-- PASIVA -->
                            <tr class="bg-[#FEE2E2]/40 border-b border-[#D6D3D1]">
                                <td colspan="2" class="px-5 py-3 font-bold uppercase tracking-wide text-[#DC2626] text-[12px] flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z"></path></svg>
                                    Kategori: Pasiva (Kewajiban)
                                </td>
                            </tr>
                            @forelse($pasiva as $akun)
                            <tr class="border-b border-[#E7E5E4] hover:bg-[#F5F5F4] transition-colors">
                                <td class="px-5 py-3 text-[#1C1917] text-[14px]">{{ $akun->nomor_akun }} – {{ $akun->nama_akun }}</td>
                                <td class="px-5 py-3 text-right font-bold text-[#1C1917] text-[14px] whitespace-nowrap">Rp {{ number_format($akun->saldo_akhir, 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr class="border-b border-[#E7E5E4]">
                                <td colspan="2" class="px-5 py-4 text-center text-[#78716C]">Belum ada data Kewajiban</td>
                            </tr>
                            @endforelse
                            <tr class="border-b border-[#D6D3D1] bg-[#FFF5F5]">
                                <td class="px-5 py-4 font-bold uppercase text-[#DC2626] text-[13px] tracking-wide">Total Pasiva</td>
                                <td class="px-5 py-4 text-right font-bold text-[#DC2626] whitespace-nowrap">Rp {{ number_format($totalPasiva, 0, ',', '.') }}</td>
                            </tr>

                            <!-- MODAL / EKUITAS -->
                            <tr class="bg-[#FEF3C7]/50 border-b border-[#D6D3D1]">
                                <td colspan="2" class="px-5 py-3 font-bold uppercase tracking-wide text-[#D97706] text-[12px] flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Kategori: Modal (Ekuitas)
                                </td>
                            </tr>
                            @forelse($ekuitas as $akun)
                            <tr class="border-b border-[#E7E5E4] hover:bg-[#F5F5F4] transition-colors">
                                <td class="px-5 py-3 text-[#1C1917] text-[14px]">{{ $akun->nomor_akun }} – {{ $akun->nama_akun }}</td>
                                <td class="px-5 py-3 text-right font-bold text-[#1C1917] text-[14px] whitespace-nowrap">Rp {{ number_format($akun->saldo_akhir, 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr class="border-b border-[#E7E5E4]">
                                <td colspan="2" class="px-5 py-4 text-center text-[#78716C]">Belum ada data Ekuitas</td>
                            </tr>
                            @endforelse
                            <tr class="border-b border-[#E7E5E4] hover:bg-[#F5F5F4] transition-colors">
                                <td class="px-5 py-3 text-[#57534E] italic text-[14px]">Laba Bersih Tahun Berjalan</td>
                                <td class="px-5 py-3 text-right font-bold text-[#1C1917] text-[14px] whitespace-nowrap">Rp {{ number_format($labaBersihAkuntansi, 0, ',', '.') }}</td>
                            </tr>
                            <tr class="border-b border-[#D6D3D1] bg-[#FFFBEB]">
                                <td class="px-5 py-4 font-bold uppercase text-[#D97706] text-[13px] tracking-wide">Total Modal + Laba</td>
                                <td class="px-5 py-4 text-right font-bold text-[#D97706] whitespace-nowrap">Rp {{ number_format($totalModalDanLaba, 0, ',', '.') }}</td>
                            </tr>

                            <!-- BALANCE CHECK -->
                            <tr class="bg-[#1C1917] text-white">
                                <td class="px-5 py-5 font-semibold text-[#A8A29E] text-right text-[13px]">
                                    Balance: Aktiva = Pasiva + Modal
                                </td>
                                <td class="px-5 py-5 text-center">
                                    @if($totalAktiva == ($totalPasiva + $totalModalDanLaba))
                                        <span class="inline-block px-[12px] py-[5px] rounded-[9999px] text-[12px] font-bold bg-[#DCFCE7] text-[#16A34A]">
                                            ✓ Seimbang
                                        </span>
                                    @else
                                        <span class="inline-block px-[12px] py-[5px] rounded-[9999px] text-[12px] font-bold bg-[#FEE2E2] text-[#DC2626]">
                                            ✗ Tidak Seimbang
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Pie Chart Komposisi Aset --}}
            <div class="bg-[#FAFAF9] border border-[#D6D3D1] rounded-[12px] p-6 shadow-sm flex flex-col">
                <div class="mb-5 flex items-center justify-between">
                    <div>
                        <h4 class="font-bold text-[#1C1917] text-[15px]">Grafik Komposisi Aset</h4>
                        <p class="text-[#57534E] text-[13px] mt-0.5">Distribusi nilai aset per akun aktiva</p>
                    </div>
                    <span class="inline-block px-[10px] py-[4px] bg-[#F5F5F4] border border-[#D6D3D1] text-[#78716C] text-[11px] font-bold uppercase tracking-wide rounded-[9999px]">Pie Chart</span>
                </div>
                <div class="relative w-full flex-grow flex justify-center items-center min-h-[280px]">
                    <canvas id="pieChartAset"></canvas>
                </div>
            </div>
            
        </div>
    </div>
</div>
