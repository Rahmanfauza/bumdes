<?php

namespace App\Http\Controllers\Admin\InputData;

use App\Http\Controllers\Controller;
use App\Models\SaldoAwal;
use Illuminate\Http\Request;

class SaldoAwalController extends Controller
{
    public function index()
    {
        $saldo_awals = SaldoAwal::orderBy('tanggal', 'desc')->get();
        // Hitung total saldo awal BUMDes
        $total_saldo = $saldo_awals->sum('jumlah');
        return view('admin.input data.saldo_awal', compact('saldo_awals', 'total_saldo'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric',
            'sumber_dana' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        SaldoAwal::create($request->all());

        return redirect()->back()->with('success', 'Saldo Awal berhasil ditambahkan.');
    }
}
