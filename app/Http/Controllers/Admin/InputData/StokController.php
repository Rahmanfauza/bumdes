<?php

namespace App\Http\Controllers\Admin\InputData;

use App\Http\Controllers\Controller;
use App\Models\ProdukJasa;
use Illuminate\Http\Request;

class StokController extends Controller
{
    public function index()
    {
        $produkJasas = ProdukJasa::latest()->get();
        return view('admin.input data.stok', compact('produkJasas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'stok_awal' => 'required|numeric|min:0',
        ]);

        $produkJasa = ProdukJasa::findOrFail($id);
        $produkJasa->update([
            'stok_awal' => $request->stok_awal,
        ]);

        return redirect()->route('stok.index')->with('success', 'Stok berhasil diperbarui!');
    }
}
