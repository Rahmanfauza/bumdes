<?php

namespace App\Http\Controllers\Admin\InputData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AkunCoa;

class AkunCoaController extends Controller
{
    public function index()
    {
        $akun_coas = AkunCoa::latest()->get();
        return view('admin.input data.akunCOA', compact('akun_coas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_akun' => 'required|unique:akun_coas,nomor_akun',
            'nama_akun' => 'required',
            'kelompok' => 'required',
            'saldo_nominal' => 'required|numeric',
        ]);

        AkunCoa::create($request->all());

        return back()->with('success', 'Akun COA berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nomor_akun' => 'required|unique:akun_coas,nomor_akun,'.$id,
            'nama_akun' => 'required',
            'kelompok' => 'required',
            'saldo_nominal' => 'required|numeric',
        ]);

        $akunCoa = AkunCoa::findOrFail($id);
        $akunCoa->update($request->all());

        return back()->with('success', 'Akun COA berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $akunCoa = AkunCoa::findOrFail($id);
        $akunCoa->delete();

        return back()->with('success', 'Akun COA berhasil dihapus!');
    }
}
