<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriProduk;

class KategoriProdukController extends Controller
{
    public function index()
    {
        $kategori = KategoriProduk::orderBy('nama_kategori', 'asc')->get();
        return view('admin.kategori.index', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255'
        ]);

        KategoriProduk::create($request->all());

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori produk berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255'
        ]);

        $kategori = KategoriProduk::findOrFail($id);
        $kategori->update($request->all());

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kategori = KategoriProduk::findOrFail($id);
        
        // Check if there are products using this category
        if ($kategori->produk()->count() > 0) {
            return redirect()->route('admin.kategori.index')->withErrors(['error' => 'Kategori ini tidak dapat dihapus karena masih digunakan oleh produk.']);
        }

        $kategori->delete();
        return redirect()->route('admin.kategori.index')->with('success', 'Kategori produk berhasil dihapus.');
    }
}
