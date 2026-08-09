<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Produk;
use App\Models\Pelanggan;
use App\Models\Keranjang;
use App\Models\DetailKeranjang;
use App\Models\TransaksiPenjualan;
use App\Models\DetailTransaksi;

class KeranjangController extends Controller
{
    /**
     * Memastikan pelanggan sudah login sebelum mengakses fitur keranjang & checkout
     */
    private function getLoggedInPelangganId()
    {
        if (!Session::has('pelanggan_logged_in') || !Session::get('pelanggan_id')) {
            return null;
        }
        return Session::get('pelanggan_id');
    }

    /**
     * Menambahkan produk ke keranjang belanja
     */
    public function addToCart(Request $request)
    {
        $pelangganId = $this->getLoggedInPelangganId();

        if (!$pelangganId) {
            return redirect()->back()->with('open_login_modal', true)->withErrors([
                'auth_error' => 'Silakan login atau daftar akun terlebih dahulu untuk membeli produk.'
            ]);
        }

        $request->validate([
            'id_produk' => 'required|exists:produks,id_produk',
            'jumlah' => 'nullable|integer|min:1',
        ]);

        $produkId = $request->input('id_produk');
        $jumlah = $request->input('jumlah', 1);

        $produk = Produk::findOrFail($produkId);

        if ($produk->stok < $jumlah) {
            return redirect()->back()->withErrors(['error' => 'Stok produk tidak mencukupi (Tersisa: ' . $produk->stok . ' ' . $produk->satuan . ').']);
        }

        // Ambil atau buat keranjang belanja pelanggan
        $keranjang = Keranjang::firstOrCreate(
            ['id_pelanggan' => $pelangganId],
            ['tanggal' => now()]
        );

        // Cek apakah item sudah ada di detail keranjang
        $detail = DetailKeranjang::where('id_keranjang', $keranjang->id_keranjang)
            ->where('id_produk', $produkId)
            ->first();

        if ($detail) {
            $newQty = $detail->jumlah + $jumlah;
            if ($produk->stok < $newQty) {
                return redirect()->back()->withErrors(['error' => 'Jumlah melebihi stok yang tersedia.']);
            }
            $detail->update([
                'jumlah' => $newQty,
                'harga' => $produk->harga,
                'subtotal' => $newQty * $produk->harga,
            ]);
        } else {
            DetailKeranjang::create([
                'id_keranjang' => $keranjang->id_keranjang,
                'id_produk' => $produkId,
                'jumlah' => $jumlah,
                'harga' => $produk->harga,
                'subtotal' => $jumlah * $produk->harga,
            ]);
        }

        if ($request->input('direct_checkout')) {
            return redirect()->route('cart.checkout');
        }

        return redirect()->route('cart.index')->with('success', 'Produk "' . $produk->nama_produk . '" berhasil dimasukkan ke keranjang belanja!');
    }

    /**
     * Tampilan Halaman Keranjang Belanja
     */
    public function index()
    {
        $pelangganId = $this->getLoggedInPelangganId();

        if (!$pelangganId) {
            return redirect('/katalog')->with('open_login_modal', true)->withErrors([
                'auth_error' => 'Silakan login terlebih dahulu untuk melihat keranjang belanja Anda.'
            ]);
        }

        $keranjang = Keranjang::with('detail.produk')->where('id_pelanggan', $pelangganId)->first();
        $details = $keranjang ? $keranjang->detail : collect();
        $totalBelanja = $details->sum('subtotal');

        return view('cart.index', compact('keranjang', 'details', 'totalBelanja'));
    }

    /**
     * Update jumlah item di keranjang
     */
    public function update(Request $request, $id)
    {
        $pelangganId = $this->getLoggedInPelangganId();
        if (!$pelangganId) {
            return redirect()->route('katalog');
        }

        $request->validate([
            'jumlah' => 'required|integer|min:1',
        ]);

        $detail = DetailKeranjang::whereHas('keranjang', function ($q) use ($pelangganId) {
            $q->where('id_pelanggan', $pelangganId);
        })->findOrFail($id);

        $produk = $detail->produk;
        $jumlah = $request->input('jumlah');

        if ($produk->stok < $jumlah) {
            return redirect()->back()->withErrors(['error' => 'Stok produk ' . $produk->nama_produk . ' tidak mencukupi (Tersisa: ' . $produk->stok . ').']);
        }

        $detail->update([
            'jumlah' => $jumlah,
            'subtotal' => $jumlah * $detail->harga,
        ]);

        return redirect()->back()->with('success', 'Jumlah produk berhasil diperbarui.');
    }

    /**
     * Hapus item dari keranjang
     */
    public function destroy($id)
    {
        $pelangganId = $this->getLoggedInPelangganId();
        if (!$pelangganId) {
            return redirect()->route('katalog');
        }

        $detail = DetailKeranjang::whereHas('keranjang', function ($q) use ($pelangganId) {
            $q->where('id_pelanggan', $pelangganId);
        })->findOrFail($id);

        $detail->delete();

        return redirect()->back()->with('success', 'Item berhasil dihapus dari keranjang belanja.');
    }

    /**
     * Halaman Form Checkout Pembelian
     */
    public function checkoutView()
    {
        $pelangganId = $this->getLoggedInPelangganId();
        if (!$pelangganId) {
            return redirect('/katalog')->with('open_login_modal', true)->withErrors([
                'auth_error' => 'Silakan login terlebih dahulu untuk melakukan checkout.'
            ]);
        }

        $pelanggan = Pelanggan::findOrFail($pelangganId);
        $keranjang = Keranjang::with('detail.produk')->where('id_pelanggan', $pelangganId)->first();

        if (!$keranjang || $keranjang->detail->isEmpty()) {
            return redirect()->route('cart.index')->withErrors(['error' => 'Keranjang belanja Anda masih kosong. Silakan pilih produk terlebih dahulu.']);
        }

        // Cek ketersediaan stok semua item
        foreach ($keranjang->detail as $item) {
            if ($item->produk->stok < $item->jumlah) {
                return redirect()->route('cart.index')->withErrors([
                    'error' => 'Maaf, stok produk "' . $item->produk->nama_produk . '" tidak mencukupi untuk jumlah yang Anda pesan.'
                ]);
            }
        }

        $details = $keranjang->detail;
        $totalBelanja = $details->sum('subtotal');

        return view('cart.checkout', compact('pelanggan', 'keranjang', 'details', 'totalBelanja'));
    }

    /**
     * Proses Pemesanan / Checkout
     */
    public function processCheckout(Request $request)
    {
        $pelangganId = $this->getLoggedInPelangganId();
        if (!$pelangganId) {
            return redirect('/katalog')->with('open_login_modal', true);
        }

        $request->validate([
            'nama_penerima' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat_pengiriman' => 'required|string',
            'metode_bayar' => 'required|string|in:COD / Bayar di Tempat,Transfer Bank (BCA / Mandiri / BRI),QRIS BUMDes',
            'catatan' => 'nullable|string',
        ]);

        $pelanggan = Pelanggan::findOrFail($pelangganId);
        $keranjang = Keranjang::with('detail.produk')->where('id_pelanggan', $pelangganId)->first();

        if (!$keranjang || $keranjang->detail->isEmpty()) {
            return redirect()->route('cart.index')->withErrors(['error' => 'Keranjang belanja kosong.']);
        }

        DB::beginTransaction();
        try {
            $total = 0;
            $itemsData = [];

            // Validasi stok ulang
            foreach ($keranjang->detail as $item) {
                $produk = $item->produk;
                if ($produk->stok < $item->jumlah) {
                    throw new \Exception("Stok produk {$produk->nama_produk} tidak mencukupi.");
                }

                $subtotal = $produk->harga * $item->jumlah;
                $total += $subtotal;

                $itemsData[] = [
                    'produk' => $produk,
                    'qty' => $item->jumlah,
                    'harga' => $produk->harga,
                    'subtotal' => $subtotal,
                ];
            }

            // Buat Transaksi Penjualan (Status menunggu konfirmasi admin)
            $transaksi = TransaksiPenjualan::create([
                'id_user' => null, // Akan diisi saat Admin mengonfirmasi / kasir memproses
                'id_pelanggan' => $pelangganId,
                'tanggal' => now(),
                'total' => $total,
                'metode_bayar' => $request->input('metode_bayar'),
                'alamat_pengiriman' => $request->input('alamat_pengiriman') . ' (Penerima: ' . $request->input('nama_penerima') . ' - Telp: ' . $request->input('no_hp') . ')',
                'catatan' => $request->input('catatan'),
                'status' => 'menunggu_konfirmasi',
            ]);

            // Buat Detail Transaksi dan Kurangi Stok
            foreach ($itemsData as $data) {
                DetailTransaksi::create([
                    'id_transaksi' => $transaksi->id_transaksi,
                    'id_produk' => $data['produk']->id_produk,
                    'jumlah' => $data['qty'],
                    'harga' => $data['harga'],
                    'subtotal' => $data['subtotal'],
                ]);

                // Kurangi stok produk
                $data['produk']->decrement('stok', $data['qty']);
            }

            // Perbarui data alamat & telepon pelanggan jika belum lengkap
            $pelanggan->update([
                'no_hp' => $request->input('no_hp'),
                'alamat' => $request->input('alamat_pengiriman'),
            ]);

            // Kosongkan keranjang belanja
            DetailKeranjang::where('id_keranjang', $keranjang->id_keranjang)->delete();

            DB::commit();

            return redirect()->route('cart.order.detail', $transaksi->id_transaksi)->with('success', 'Pesanan Anda berhasil dibuat dan sedang menunggu konfirmasi pengelola BUMDes!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Gagal memproses pesanan: ' . $e->getMessage()]);
        }
    }

    /**
     * Riwayat Pesanan Pelanggan
     */
    public function myOrders()
    {
        $pelangganId = $this->getLoggedInPelangganId();
        if (!$pelangganId) {
            return redirect('/katalog')->with('open_login_modal', true);
        }

        $pesanans = TransaksiPenjualan::with('detail.produk')
            ->where('id_pelanggan', $pelangganId)
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('cart.my_orders', compact('pesanans'));
    }

    /**
     * Detail / Invoice Pesanan Pelanggan
     */
    public function showOrder($id)
    {
        $pelangganId = $this->getLoggedInPelangganId();
        if (!$pelangganId) {
            return redirect('/katalog')->with('open_login_modal', true);
        }

        $pesanan = TransaksiPenjualan::with(['detail.produk', 'pelanggan'])
            ->where('id_pelanggan', $pelangganId)
            ->findOrFail($id);

        return view('cart.order_detail', compact('pesanan'));
    }
}
