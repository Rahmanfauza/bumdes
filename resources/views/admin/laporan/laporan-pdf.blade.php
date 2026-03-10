<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Keuangan BUMDes</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 20mm 15mm;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 10px;
            color: #000000; /* Strictly black for print */
            background: #ffffff;
            line-height: 1.5;
        }

        h1, h2, h3, h4, p, th, td {
            color: #000000;
        }

        /* ── HEADER KOP SURAT ──────────────────────────── */
        .kop-surat {
            width: 100%;
            border-bottom: 2px solid #000000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .kop-surat th, .kop-surat td { padding: 0; }
        
        .kop-logo {
            text-align: center;
            width: 70px;
        }
        .kop-logo-box {
            width: 50px;
            height: 50px;
            border: 2px solid #000000;
            margin: 0 auto;
            display: table;
        }
        .kop-logo-text {
            display: table-cell;
            vertical-align: middle;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
        }
        
        .kop-instansi { text-align: center; }
        .kop-instansi h1 { font-size: 16px; font-weight: bold; text-transform: uppercase; margin-bottom: 2px; }
        .kop-instansi h2 { font-size: 12px; font-weight: normal; margin-bottom: 2px; }
        .kop-instansi p { font-size: 9px; }

        .kop-kanan {
            width: 100px;
            text-align: right;
            vertical-align: top;
            font-size: 8px;
        }

        /* ── JUDUL DOKUMEN ───────────────────────────── */
        .doc-title {
            text-align: center;
            margin-bottom: 20px;
        }
        .doc-title h3 {
            font-size: 14px;
            text-transform: uppercase;
            text-decoration: underline;
            margin-bottom: 4px;
        }
        .doc-title p {
            font-size: 10px;
        }

        /* ── SUMMARY SECTION ─────────────────────────── */
        .summary-box {
            width: 100%;
            border: 1px solid #000000;
            margin-bottom: 20px;
            border-collapse: collapse;
        }
        .summary-box td {
            padding: 6px 10px;
            border: 1px solid #000000;
            width: 33.33%;
            vertical-align: top;
        }
        .summary-label {
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 4px;
        }
        .summary-value {
            font-size: 14px;
            font-weight: bold;
        }
        .summary-desc {
            font-size: 8px;
            margin-top: 2px;
            font-style: italic;
        }

        /* ── SECTION TITLE ───────────────────────────── */
        .section-title {
            font-size: 11px;
            font-weight: bold;
            margin-bottom: 8px;
            text-transform: uppercase;
        }

        /* ── TABEL DATA UTAMA ────────────────────────── */
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
            font-size: 9px;
        }
        table.data-table th, table.data-table td {
            border: 1px solid #000000;
            padding: 5px 6px;
            vertical-align: top;
        }
        table.data-table th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: center;
            text-transform: uppercase;
        }
        
        /* Utility classes for tables */
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-left { text-align: left; }
        .font-bold { font-weight: bold; }
        
        table.data-table tfoot th, table.data-table tfoot td {
            background-color: #f0f0f0;
            font-weight: bold;
        }

        /* ── TANDA TANGAN ────────────────────────────── */
        .ttd-container {
            width: 100%;
            margin-top: 40px;
            page-break-inside: avoid;
        }
        .ttd-table {
            width: 100%;
            border-collapse: collapse;
        }
        .ttd-table td {
            width: 33.33%;
            text-align: center;
            vertical-align: top;
        }
        .ttd-jabatan {
            margin-bottom: 60px; /* Space for signature */
        }
        .ttd-nama {
            font-weight: bold;
            text-decoration: underline;
        }
        .ttd-tgl {
            margin-bottom: 10px;
            text-align: right;
            padding-right: 40px;
        }

        /* ── FOOTER PAGE ─────────────────────────────── */
        .page-footer {
            position: fixed;
            bottom: -10mm;
            left: 0;
            width: 100%;
            font-size: 8px;
            border-top: 1px solid #000;
            padding-top: 5px;
        }
        .page-number:before {
            content: "Halaman " counter(page);
        }
    </style>
</head>
<body>

    {{-- ── FOOTER HALAMAN (Fixed di setiap halaman) ── --}}
    <div class="page-footer">
        <table style="width: 100%;">
            <tr>
                <td style="text-align: left;">Sistem Informasi Keuangan - BUMDesGO</td>
                <td style="text-align: center;" class="page-number"></td>
                <td style="text-align: right;">Dicetak: {{ now()->format('d/m/Y H:i') }}</td>
            </tr>
        </table>
    </div>

    {{-- ── KOP SURAT ── --}}
    <table class="kop-surat">
        <tr>
            <td class="kop-logo">
                <div class="kop-logo-box">
                    <div class="kop-logo-text">B</div>
                </div>
            </td>
            <td class="kop-instansi">
                <h1>BADAN USAHA MILIK DESA (BUMDes)</h1>
                <h2>BUMDesGO</h2>
                <p>Laporan Keuangan Resmi Sistem Terintegrasi</p>
            </td>
            <td class="kop-kanan">
                Doc: LK-{{ date('Y') }}-{{ str_pad(rand(1,999),3,'0',STR_PAD_LEFT) }}
            </td>
        </tr>
    </table>

    {{-- ── JUDUL DOKUMEN ── --}}
    <div class="doc-title">
        <h3>LAPORAN KEUANGAN</h3>
        <p>Periode: <strong>{{ strtoupper($periodLabel) }}</strong></p>
    </div>

    {{-- ── RINGKASAN EKSEKUTIF ── --}}
    <div class="section-title">A. RINGKASAN EKSEKUTIF</div>
    <table class="summary-box">
        <tr>
            <td>
                <div class="summary-label">Total Pemasukan</div>
                <div class="summary-value">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</div>
                <div class="summary-desc">{{ $transaksis->where('jenis_transaksi','Pemasukan')->count() }} transaksi</div>
            </td>
            <td>
                <div class="summary-label">Total Pengeluaran</div>
                <div class="summary-value">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
                <div class="summary-desc">{{ $transaksis->where('jenis_transaksi','Pengeluaran')->count() }} transaksi</div>
            </td>
            @php $surplus = $saldo >= 0; @endphp
            <td>
                <div class="summary-label">Saldo Bersih</div>
                <div class="summary-value">Rp {{ number_format(abs($saldo), 0, ',', '.') }}</div>
                <div class="summary-desc">Status: <strong>{{ $surplus ? 'SURPLUS' : 'DEFISIT' }}</strong></div>
            </td>
        </tr>
    </table>

    {{-- ── RINGKASAN PER UNIT USAHA ── --}}
    @if($perUnitUsaha->isNotEmpty())
        <div class="section-title">B. REKAPITULASI PER UNIT USAHA</div>
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 35%;">Unit Usaha</th>
                    <th style="width: 20%;">Pemasukan (Rp)</th>
                    <th style="width: 20%;">Pengeluaran (Rp)</th>
                    <th style="width: 20%;">Saldo (Rp)</th>
                </tr>
            </thead>
            <tbody>
                @php 
                    $noUnit = 1; 
                    $gt = $totalPemasukan + $totalPengeluaran;
                @endphp
                @foreach ($perUnitUsaha as $uid => $rows)
                    @php
                        $nama   = $rows->first()->unitUsaha->nama_usaha ?? 'Unit #'.$uid;
                        $pIn    = $rows->where('jenis_transaksi','Pemasukan')->sum('total');
                        $pOut   = $rows->where('jenis_transaksi','Pengeluaran')->sum('total');
                        $uS     = $pIn - $pOut;
                    @endphp
                    <tr>
                        <td class="text-center">{{ $noUnit++ }}</td>
                        <td>{{ $nama }}</td>
                        <td class="text-right">{{ number_format($pIn, 0, ',', '.') }}</td>
                        <td class="text-right">{{ number_format($pOut, 0, ',', '.') }}</td>
                        <td class="text-right font-bold">{{ $uS < 0 ? '(' : '' }}{{ number_format(abs($uS), 0, ',', '.') }}{{ $uS < 0 ? ')' : '' }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2" class="text-right"><strong>TOTAL KESELURUHAN</strong></td>
                    <td class="text-right"><strong>{{ number_format($totalPemasukan, 0, ',', '.') }}</strong></td>
                    <td class="text-right"><strong>{{ number_format($totalPengeluaran, 0, ',', '.') }}</strong></td>
                    <td class="text-right"><strong>{{ $saldo < 0 ? '(' : '' }}{{ number_format(abs($saldo), 0, ',', '.') }}{{ $saldo < 0 ? ')' : '' }}</strong></td>
                </tr>
            </tfoot>
        </table>
    @endif

    {{-- ── BUKU KAS / RINCIAN TRANSAKSI ── --}}
    <div class="section-title">C. BUKU KAS (RINCIAN TRANSAKSI)</div>
    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 12%;">Tanggal</th>
                <th style="width: 23%;">Unit Usaha</th>
                <th style="width: 30%;">Uraian / Keterangan</th>
                <th style="width: 15%;">Debet (Masuk)</th>
                <th style="width: 15%;">Kredit (Keluar)</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transaksis as $i => $t)
                @php 
                    $isMasuk = $t->jenis_transaksi === 'Pemasukan';
                @endphp
                <tr>
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($t->tanggal_transaksi)->format('d/m/Y') }}</td>
                    <td>{{ $t->unitUsaha->nama_usaha ?? '-' }}</td>
                    <td>{{ $t->keterangan ?: 'Transaksi ' . strtolower($t->jenis_transaksi) }}</td>
                    <td class="text-right">{{ $isMasuk ? number_format($t->jumlah, 0, ',', '.') : '-' }}</td>
                    <td class="text-right">{{ !$isMasuk ? number_format($t->jumlah, 0, ',', '.') : '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center" style="padding: 20px;">Tidak ada transaksi pada periode ini.</td>
                </tr>
            @endforelse
        </tbody>
        @if($transaksis->count() > 0)
        <tfoot>
            <tr>
                <td colspan="4" class="text-right"><strong>TOTAL PERIODE INI</strong></td>
                <td class="text-right"><strong>{{ number_format($totalPemasukan, 0, ',', '.') }}</strong></td>
                <td class="text-right"><strong>{{ number_format($totalPengeluaran, 0, ',', '.') }}</strong></td>
            </tr>
            <tr>
                <td colspan="4" class="text-right"><strong>SALDO AKHIR</strong></td>
                <td colspan="2" class="text-center font-bold" style="font-size: 11px;">
                    Rp {{ number_format($saldo, 0, ',', '.') }}
                </td>
            </tr>
        </tfoot>
        @endif
    </table>

    {{-- ── TANDA TANGAN BAST ── --}}
    <div class="ttd-container">
        <div class="ttd-tgl">
            ..., ................................ {{ date('Y') }}
        </div>
        <table class="ttd-table">
            <tr>
                <td>
                    <div class="ttd-jabatan">Dibuat oleh,<br>Bendahara BUMDes</div>
                    <div class="ttd-nama">( ........................................ )</div>
                </td>
                <td>
                    <div class="ttd-jabatan">Diperiksa oleh,<br>Sekretaris BUMDes</div>
                    <div class="ttd-nama">( ........................................ )</div>
                </td>
                <td>
                    <div class="ttd-jabatan">Mengetahui,<br>Direktur BUMDes</div>
                    <div class="ttd-nama">( ........................................ )</div>
                </td>
            </tr>
        </table>
    </div>

</body>
</html>