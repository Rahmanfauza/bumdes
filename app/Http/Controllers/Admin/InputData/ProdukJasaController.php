<?php

namespace App\Http\Controllers\Admin\InputData;

use App\Http\Controllers\Controller;
use App\Models\ProdukJasa;
use App\Models\UnitUsaha;
use Illuminate\Http\Request;

class ProdukJasaController extends Controller
{
    public function index()
    {
        $produkJasas = ProdukJasa::with('unitUsaha')->latest()->get();
        $unitUsahas = UnitUsaha::orderBy('nama_usaha', 'asc')->get();
        return view('admin.input data.produkjasa', compact('produkJasas', 'unitUsahas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'unit_usaha_id' => 'required|exists:unit_usahas,id',
            'harga_jual' => 'required|numeric|min:0',
            'stok_awal' => 'required|integer|min:0',
        ]);

        ProdukJasa::create($request->all());

        return redirect()->route('produkjasa.index')->with('success', 'Data Produk/Jasa berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'unit_usaha_id' => 'required|exists:unit_usahas,id',
            'harga_jual' => 'required|numeric|min:0',
            'stok_awal' => 'required|integer|min:0',
        ]);

        $produkJasa = ProdukJasa::findOrFail($id);
        $produkJasa->update($request->all());

        return redirect()->route('produkjasa.index')->with('success', 'Data Produk/Jasa berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $produkJasa = ProdukJasa::findOrFail($id);
        $produkJasa->delete();

        return redirect()->route('produkjasa.index')->with('success', 'Data Produk/Jasa berhasil dihapus!');
    }
}
