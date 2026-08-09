<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Surat;

class ApprovalDokumenController extends Controller
{
    public function index()
    {
        // Get all surats that are pending approval ('diajukan') or already processed
        $suratMenunggu = Surat::where('status', 'diajukan')->orderBy('created_at', 'desc')->get();
        $suratSelesai = Surat::whereIn('status', ['disetujui', 'ditolak'])->orderBy('updated_at', 'desc')->get();
        
        return view('admin.approval.index', compact('suratMenunggu', 'suratSelesai'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:disetujui,ditolak'
        ]);

        $surat = Surat::findOrFail($id);
        
        if ($surat->status !== 'diajukan') {
            return back()->withErrors(['error' => 'Dokumen ini tidak dalam status diajukan.']);
        }

        $surat->update([
            'status' => $request->status
        ]);

        $pesan = $request->status == 'disetujui' ? 'Dokumen berhasil disetujui.' : 'Dokumen telah ditolak.';

        return redirect()->route('admin.approval.index')->with('success', $pesan);
    }
}
