<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransaksiPenjualan;
use App\Models\DetailTransaksi;
use App\Models\Produk;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\PemasukanKas;

class TransaksiPenjualanController extends Controller
{
    public function index(Request $request)
    {
        $statusFilter = $request->query('status');

        $query = TransaksiPenjualan::with(['pelanggan', 'user', 'detail.produk']);

        if ($statusFilter && $statusFilter != 'all') {
            $query->where('status', $statusFilter);
        }

        $transaksis = $query->orderBy('tanggal', 'desc')->get();

        // Hitung count status untuk badge filter
        $countSemua = TransaksiPenjualan::count();
        $countMenunggu = TransaksiPenjualan::where('status', 'menunggu_konfirmasi')->count();
        $countDiproses = TransaksiPenjualan::where('status', 'diproses')->count();
        $countSelesai = TransaksiPenjualan::where('status', 'selesai')->count();
        $countBatal = TransaksiPenjualan::where('status', 'batal')->count();

        return view('admin.transaksi.index', compact(
            'transaksis', 'statusFilter', 'countSemua',
            'countMenunggu', 'countDiproses', 'countSelesai', 'countBatal'
        ));
    }

    public function create()
    {
        $produks = Produk::where('status', 'aktif')->where('stok', '>', 0)->get();
        $pelanggans = Pelanggan::all();
        return view('admin.transaksi.create', compact('produks', 'pelanggans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pelanggan' => 'nullable|exists:pelanggans,id_pelanggan',
            'metode_bayar' => 'required|string',
            'items' => 'required|array|min:1',
            'items.*.id_produk' => 'required|exists:produks,id_produk',
            'items.*.qty' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            $total = 0;
            $itemsData = [];

            // Calculate total and prepare items
            foreach ($request->items as $item) {
                $produk = Produk::findOrFail($item['id_produk']);
                
                if ($produk->stok < $item['qty']) {
                    throw new \Exception("Stok {$produk->nama_produk} tidak mencukupi.");
                }

                $subtotal = $produk->harga * $item['qty'];
                $total += $subtotal;

                $itemsData[] = [
                    'produk' => $produk,
                    'qty' => $item['qty'],
                    'harga' => $produk->harga,
                    'subtotal' => $subtotal
                ];
            }

            // Create Transaction
            $transaksi = TransaksiPenjualan::create([
                'id_user' => Session::get('admin_id') ?: 1, // Kasir / Admin
                'id_pelanggan' => $request->id_pelanggan,
                'tanggal' => now(),
                'total' => $total,
                'metode_bayar' => $request->metode_bayar,
                'status' => 'selesai'
            ]);

            // Save Details and Deduct Stock
            foreach ($itemsData as $data) {
                DetailTransaksi::create([
                    'id_transaksi' => $transaksi->id_transaksi,
                    'id_produk' => $data['produk']->id_produk,
                    'jumlah' => $data['qty'],
                    'harga' => $data['harga'],
                    'subtotal' => $data['subtotal'],
                ]);

                // Deduct stock
                $data['produk']->decrement('stok', $data['qty']);
            }

            // Create PemasukanKas automatically
            PemasukanKas::create([
                'tanggal' => now()->toDateString(),
                'nominal' => $total,
                'keterangan' => 'Pendapatan Penjualan Produk (ID Transaksi: ' . $transaksi->id_transaksi . ')',
                'id_transaksi' => $transaksi->id_transaksi
            ]);

            DB::commit();
            return redirect()->route('admin.transaksi.index')->with('success', 'Transaksi penjualan kasir berhasil dicatat.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $transaksi = TransaksiPenjualan::with(['pelanggan', 'user', 'detail.produk'])->findOrFail($id);
        return view('admin.transaksi.show', compact('transaksi'));
    }

    /**
     * Memperbarui status transaksi online (Konfirmasi / Proses / Selesai / Batal)
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu_konfirmasi,diproses,selesai,batal',
        ]);

        $transaksi = TransaksiPenjualan::with('detail.produk')->findOrFail($id);
        $oldStatus = $transaksi->status;
        $newStatus = $request->input('status');

        if ($oldStatus === $newStatus) {
            return redirect()->back()->with('info', 'Status transaksi tidak berubah.');
        }

        DB::beginTransaction();
        try {
            // Jika transaksi dibatalkan, kembalikan stok produk
            if ($newStatus === 'batal' && $oldStatus !== 'batal') {
                foreach ($transaksi->detail as $item) {
                    if ($item->produk) {
                        $item->produk->increment('stok', $item->jumlah);
                    }
                }
            }

            // Jika sebelumnya batal dan diaktifkan kembali
            if ($oldStatus === 'batal' && $newStatus !== 'batal') {
                foreach ($transaksi->detail as $item) {
                    if ($item->produk) {
                        if ($item->produk->stok < $item->jumlah) {
                            throw new \Exception("Stok {$item->produk->nama_produk} tidak mencukupi untuk mengaktifkan kembali transaksi ini.");
                        }
                        $item->produk->decrement('stok', $item->jumlah);
                    }
                }
            }

            // Update status dan catat admin yang memproses
            $transaksi->update([
                'status' => $newStatus,
                'id_user' => Session::get('admin_id') ?: $transaksi->id_user ?: 1,
            ]);

            // Auto-PemasukanKas Management
            if ($newStatus === 'selesai' && $oldStatus !== 'selesai') {
                PemasukanKas::firstOrCreate(
                    ['id_transaksi' => $transaksi->id_transaksi],
                    [
                        'tanggal' => now()->toDateString(),
                        'nominal' => $transaksi->total,
                        'keterangan' => 'Pendapatan Penjualan Produk (ID Transaksi: ' . $transaksi->id_transaksi . ')'
                    ]
                );
            } elseif ($oldStatus === 'selesai' && $newStatus !== 'selesai') {
                PemasukanKas::where('id_transaksi', $transaksi->id_transaksi)->delete();
            }

            DB::commit();

            $statusLabels = [
                'menunggu_konfirmasi' => 'Menunggu Konfirmasi',
                'diproses' => 'Sedang Diproses',
                'selesai' => 'Selesai & Dikonfirmasi',
                'batal' => 'Dibatalkan',
            ];

            return redirect()->back()->with('success', 'Status transaksi #' . $transaksi->id_transaksi . ' berhasil diubah menjadi: ' . ($statusLabels[$newStatus] ?? $newStatus));

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Gagal memperbarui status: ' . $e->getMessage()]);
        }
    }
}
