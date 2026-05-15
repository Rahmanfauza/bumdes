<?php

namespace App\Http\Controllers\Admin\UnitUsaha;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProdukJasa;
use App\Models\Transaksi;
use App\Models\Jurnal;
use App\Models\AkunCoa;
use App\Models\UnitUsaha;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PosController extends Controller
{
    public function index()
    {
        $produks = ProdukJasa::where('stok_awal', '>', 0)->get();
        $pelanggans = \App\Models\Pelanggan::all();
        return view('admin.unitusaha.pos', compact('produks', 'pelanggans'));
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'cart' => 'required|string', // JSON Array
            'total' => 'required|numeric',
            'metode' => 'required|string',
            'pelanggan_id' => 'nullable|exists:pelanggans,id',
        ]);

        $cart = json_decode($request->cart, true);
        if (empty($cart)) {
            return redirect()->back()->withErrors(['error' => 'Keranjang kosong.']);
        }

        DB::beginTransaction();
        try {
            // Ambil Unit Usaha Pertama sebagai referensi (karena master POS butuh referensi)
            $unitUsahaId = UnitUsaha::first()->id ?? 1;

            // 1. Catat Transaksi POS
            $transaksi = Transaksi::create([
                'unit_usaha_id' => $unitUsahaId,
                'pelanggan_id' => $request->pelanggan_id,
                'tanggal_transaksi' => Carbon::now()->toDateString(),
                'jenis_transaksi' => 'Pemasukan',
                'jumlah' => $request->total,
                'keterangan' => 'Penjualan POS via ' . strtoupper($request->metode),
            ]);

            // 2. Kurangi Stok pada Produk Jasa
            foreach ($cart as $item) {
                $produk = ProdukJasa::find($item['id']);
                if ($produk) {
                    // Update stok 
                    $produk->stok_awal -= $item['qty'];
                    $produk->save();
                }
            }

            // 3. Jurnal Otomatis Pemasukan & Penjualan
            // Cari Akun Kas untuk Debit
            $akunKas = AkunCoa::where('nama_akun', 'like', '%Kas%')->orWhere('nama_akun', 'like', '%Bank%')->first();
            if (!$akunKas) {
                // Buatkan jika tidak ada
                $akunKas = AkunCoa::create([
                    'nomor_akun' => '100.1.POS',
                    'nama_akun' => 'Kas Tunai POS',
                    'kelompok' => 'Aset',
                    'saldo_nominal' => 0
                ]);
            }

            // Cari Akun Penjualan / Pendapatan untuk Kredit
            $akunPendapatan = AkunCoa::where('nama_akun', 'like', '%Pendapatan%')->orWhere('kelompok', 'Pendapatan')->first();
            if (!$akunPendapatan) {
                // Buatkan jika tidak ada
                $akunPendapatan = AkunCoa::create([
                    'nomor_akun' => '400.1.POS',
                    'nama_akun' => 'Pendapatan Penjualan POS',
                    'kelompok' => 'Pendapatan',
                    'saldo_nominal' => 0
                ]);
            }

            // A. Jurnal Debit (Kas POS bertambah)
            Jurnal::create([
                'tanggal' => Carbon::now()->toDateString(),
                'kode_bantu' => 'POS-' . $transaksi->id,
                'keterangan' => 'Penerimaan Penjualan POS (' . strtoupper($request->metode) . ')',
                'akun_coa_id' => $akunKas->id,
                'debit' => $request->total,
                'kredit' => 0,
            ]);

            // B. Jurnal Kredit (Pendapatan bertabmah)
            Jurnal::create([
                'tanggal' => Carbon::now()->toDateString(),
                'kode_bantu' => 'POS-' . $transaksi->id,
                'keterangan' => 'Pendapatan Penjualan POS',
                'akun_coa_id' => $akunPendapatan->id,
                'debit' => 0,
                'kredit' => $request->total,
            ]);

            DB::commit();

            return redirect()->route('jurnal.index')->with('success', 'Transaksi berhasil diproses dan jurnal telah dibuat otomatis!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Gagal memproses transaksi kasir: ' . $e->getMessage()]);
        }
    }
}
