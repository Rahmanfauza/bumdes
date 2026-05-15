<div class="bg-[#FAFAF9] border border-[#D6D3D1] rounded-[12px] shadow-sm p-6 lg:p-8">

    <div class="mb-6">
        <h3 class="text-2xl font-display font-bold text-[#1C1917]">Laporan Stok Produk</h3>
        <p class="text-[#57534E] text-[14px] mt-1">Ringkasan sisa stok dan nilai persediaan seluruh produk.</p>
    </div>

    {{-- Controls (Filter & Export) --}}
    <div class="flex flex-col lg:flex-row gap-5 items-start lg:items-center justify-between border-b border-[#D6D3D1] pb-8 mb-8">
        {{-- Filter Form --}}
        <form method="GET" action="{{ route('laporan.stok') }}" class="flex flex-wrap items-end gap-3 w-full lg:w-auto">

            <div class="flex flex-col gap-1.5">
                <label class="font-semibold text-[#1C1917] text-[13px] uppercase tracking-wide">Pilih Produk</label>
                <select name="produk_id" class="px-4 py-2 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[8px] focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15 text-[#1C1917] text-[14px] appearance-none w-52">
                    <option value="">-- Semua Produk --</option>
                    @foreach($allProduk as $p)
                        <option value="{{ $p->id }}" {{ request('produk_id') == $p->id ? 'selected' : '' }}>{{ $p->nama_produk }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex flex-col gap-1.5">
                <label class="font-semibold text-[#1C1917] text-[13px] uppercase tracking-wide">Dari Tanggal</label>
                <input type="date" name="stok_start_date" value="{{ $stokStartDate ?? '' }}" class="px-4 py-2 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[8px] focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15 text-[#1C1917] text-[14px]">
            </div>

            <div class="flex flex-col gap-1.5">
                <label class="font-semibold text-[#1C1917] text-[13px] uppercase tracking-wide">Sampai Tanggal</label>
                <input type="date" name="stok_end_date" value="{{ $stokEndDate ?? '' }}" class="px-4 py-2 bg-[#F5F5F4] border border-[#D6D3D1] rounded-[8px] focus:outline-none focus:border-[#C2410C] focus:ring-[3px] focus:ring-[#C2410C]/15 text-[#1C1917] text-[14px]">
            </div>

            <button type="submit" class="px-5 py-2 h-[42px] bg-[#C2410C] text-white font-semibold rounded-[8px] hover:bg-[#9A3412] shadow-sm transition-all flex items-center justify-center self-end">
                Tampilkan
            </button>
            @if (($produkId ?? '') || ($stokStartDate ?? '') || ($stokEndDate ?? ''))
                <a href="{{ route('laporan.stok') }}" class="px-5 py-2 h-[42px] bg-transparent text-[#DC2626] border border-[#D6D3D1] font-semibold rounded-[8px] hover:bg-[#FEE2E2] hover:border-[#DC2626]/30 transition-all flex items-center justify-center text-[14px] self-end">
                    Reset
                </a>
            @endif
        </form>

        {{-- Export Buttons --}}
        <div class="flex gap-3 shrink-0">
            <a href="{{ route('laporan.stok.export.pdf', request()->all()) }}" target="_blank" class="px-4 py-2 h-[42px] bg-white text-[#1C1917] border border-[#D6D3D1] font-semibold rounded-[8px] hover:bg-[#F5F5F4] transition-all flex items-center gap-2 text-[14px]">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                Cetak
            </a>
            <a href="{{ route('laporan.stok.export.csv', request()->all()) }}" class="px-4 py-2 h-[42px] bg-[#C2410C] text-white border border-transparent font-semibold rounded-[8px] hover:bg-[#9A3412] transition-all flex items-center gap-2 text-[14px] shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                Ekspor Excel
            </a>
        </div>
    </div>

    {{-- Data Table --}}
    <div class="overflow-x-auto border border-[#D6D3D1] rounded-[8px] bg-white">
        <table class="w-full text-left font-semibold text-[#1C1917]">
            <thead class="text-[12px] uppercase bg-[#F5F5F4] border-b border-[#D6D3D1] text-[#78716C]">
                <tr>
                    <th class="px-5 py-4 font-semibold tracking-wide text-center w-14">No.</th>
                    <th class="px-5 py-4 font-semibold tracking-wide">Nama Produk</th>
                    <th class="px-5 py-4 font-semibold tracking-wide">Unit Usaha</th>
                    <th class="px-5 py-4 font-semibold tracking-wide text-right">Harga Jual</th>
                    <th class="px-5 py-4 font-semibold tracking-wide text-center">Sisa Stok</th>
                    <th class="px-5 py-4 font-semibold tracking-wide text-right">Nilai Persediaan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($produkJasas as $index => $produk)
                    <tr class="border-b border-[#D6D3D1] hover:bg-[#F5F5F4] transition-colors last:border-b-0">
                        <td class="px-5 py-4 text-center text-[#57534E]">{{ $index + 1 }}</td>
                        <td class="px-5 py-4 font-semibold uppercase text-[#C2410C]">{{ $produk->nama_produk }}</td>
                        <td class="px-5 py-4 text-[#57534E]">{{ $produk->unitUsaha->nama_usaha ?? '-' }}</td>
                        <td class="px-5 py-4 text-right text-[#1C1917] whitespace-nowrap">
                            Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}
                        </td>
                        <td class="px-5 py-4 text-center">
                            @php
                                $stokClass = $produk->stok_awal > 10
                                    ? 'bg-[#DCFCE7] text-[#16A34A]'
                                    : ($produk->stok_awal > 0
                                        ? 'bg-[#FEF3C7] text-[#D97706]'
                                        : 'bg-[#FEE2E2] text-[#DC2626]');
                            @endphp
                            <span class="inline-block px-[10px] py-[4px] rounded-[9999px] text-[12px] font-bold {{ $stokClass }}">
                                {{ $produk->stok_awal }}
                            </span>
                        </td>
                        <td class="px-5 py-4 text-right font-bold text-[#16A34A] whitespace-nowrap">
                            Rp {{ number_format($produk->nilai_persediaan, 0, ',', '.') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-5 py-12 text-center text-[#78716C] font-semibold bg-[#FAFAF9]">
                            Belum ada data stok produk.
                        </td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot class="border-t border-[#D6D3D1] bg-[#F5F5F4]">
                <tr>
                    <td colspan="5" class="px-5 py-4 text-right font-bold text-[#1C1917] uppercase tracking-wide text-[13px]">
                        Total Nilai Persediaan
                    </td>
                    <td class="px-5 py-4 text-right font-display font-bold text-[#16A34A] text-lg whitespace-nowrap">
                        Rp {{ number_format($totalNilaiPersediaan, 0, ',', '.') }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>

</div>
