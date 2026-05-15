<?php

namespace App\Http\Controllers\Admin\InputData;

use App\Http\Controllers\Controller;
use App\Models\Jurnal;
use App\Models\AkunCoa;
use Illuminate\Http\Request;

class JurnalController extends Controller
{
    public function index(Request $request)
    {
        $query = Jurnal::with('akun')->latest('tanggal');

        // Filter by Keterangan
        if ($request->filled('keterangan')) {
            $query->where('keterangan', 'like', '%' . $request->keterangan . '%');
        }

        // Filter by Date From
        if ($request->filled('dari')) {
            $query->whereDate('tanggal', '>=', $request->dari);
        }

        // Filter by Date To
        if ($request->filled('sampai')) {
            $query->whereDate('tanggal', '<=', $request->sampai);
        }

        $jurnals = $query->get();
        // Ambil data akun coa apabila dibutuhkan untuk modal tambah manual
        $akunCoas = AkunCoa::orderBy('nomor_akun')->get();

        return view('admin.input data.inputjurnal', compact('jurnals', 'akunCoas'));
    }

    public function destroy($id)
    {
        $jurnal = Jurnal::findOrFail($id);
        $jurnal->delete();

        return redirect()->route('jurnal.index')->with('success', 'Jurnal berhasil dihapus!');
    }
}
