<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PemasukanKas;
use App\Models\PengeluaranKas;
use Illuminate\Support\Facades\DB;

class KasController extends Controller
{
    public function index()
    {
        $pemasukan = PemasukanKas::orderBy('tanggal', 'desc')->get();
        $pengeluaran = PengeluaranKas::orderBy('tanggal', 'desc')->get();
        
        $totalPemasukan = $pemasukan->sum('nominal');
        $totalPengeluaran = $pengeluaran->sum('nominal');
        $saldo = $totalPemasukan - $totalPengeluaran;

        return view('admin.kas.index', compact('pemasukan', 'pengeluaran', 'totalPemasukan', 'totalPengeluaran', 'saldo'));
    }

    public function storePemasukan(Request $request)
    {
        if ($request->has('nominal')) {
            $request->merge(['nominal' => (float) preg_replace('/[^0-9]/', '', (string) $request->nominal)]);
        }

        $request->validate([
            'tanggal' => 'required|date',
            'nominal' => 'required|numeric|min:1',
            'keterangan' => 'required|string|max:255',
        ]);

        PemasukanKas::create($request->all());

        return redirect()->route('admin.kas.index')->with('success', 'Data pemasukan kas berhasil ditambahkan.');
    }

    public function storePengeluaran(Request $request)
    {
        if ($request->has('nominal')) {
            $request->merge(['nominal' => (float) preg_replace('/[^0-9]/', '', (string) $request->nominal)]);
        }

        $request->validate([
            'tanggal' => 'required|date',
            'nominal' => 'required|numeric|min:1',
            'keterangan' => 'required|string|max:255',
        ]);

        PengeluaranKas::create($request->all());

        return redirect()->route('admin.kas.index')->with('success', 'Data pengeluaran kas berhasil ditambahkan.');
    }

    public function destroyPemasukan($id)
    {
        PemasukanKas::findOrFail($id)->delete();
        return redirect()->route('admin.kas.index')->with('success', 'Data pemasukan kas berhasil dihapus.');
    }

    public function destroyPengeluaran($id)
    {
        PengeluaranKas::findOrFail($id)->delete();
        return redirect()->route('admin.kas.index')->with('success', 'Data pengeluaran kas berhasil dihapus.');
    }
}
