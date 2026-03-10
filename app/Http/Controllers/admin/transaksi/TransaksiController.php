<?php

namespace App\Http\Controllers\Admin\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\UnitUsaha;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with('unitUsaha')->latest()->get();
        $unit_usahas = UnitUsaha::where('status_usaha', 'Aktif')->get();

        return view('admin.transaksi.transaksi', compact('transaksis', 'unit_usahas'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'unit_usaha_id' => 'required|exists:unit_usahas,id',
            'tanggal_transaksi' => 'required|date',
            'jenis_transaksi' => 'required|in:Pemasukan,Pengeluaran',
            'jumlah' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string',
        ]);

        Transaksi::create($validatedData);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'unit_usaha_id' => 'required|exists:unit_usahas,id',
            'tanggal_transaksi' => 'required|date',
            'jenis_transaksi' => 'required|in:Pemasukan,Pengeluaran',
            'jumlah' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update($validatedData);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
