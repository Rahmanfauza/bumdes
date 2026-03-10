<?php

namespace App\Http\Controllers\Admin\InputData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UnitUsaha;

class UnitUsahaController extends Controller
{
    public function index()
    {
        $unit_usahas = UnitUsaha::latest()->get();
        return view('admin.input data.unitusaha', compact('unit_usahas'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_usaha' => 'required|string|max:255',
            'deskripsi_usaha' => 'nullable|string',
            'status_usaha' => 'required|in:Aktif,Tidak Aktif,Dalam Pengembangan',
        ]);

        UnitUsaha::create($validatedData);

        return redirect()->route('unit-usaha')->with('success', 'Data unit usaha berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_usaha' => 'required|string|max:255',
            'deskripsi_usaha' => 'nullable|string',
            'status_usaha' => 'required|in:Aktif,Tidak Aktif,Dalam Pengembangan',
        ]);

        $unitUsaha = UnitUsaha::findOrFail($id);
        $unitUsaha->update($validatedData);

        return redirect()->route('unit-usaha')->with('success', 'Data unit usaha berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $unitUsaha = UnitUsaha::findOrFail($id);
        $unitUsaha->delete();

        return redirect()->route('unit-usaha')->with('success', 'Data unit usaha berhasil dihapus.');
    }
}
