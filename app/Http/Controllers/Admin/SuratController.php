<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Surat;
use App\Models\ArsipDigital;
use Illuminate\Support\Facades\Storage;

class SuratController extends Controller
{
    public function index()
    {
        $surats = Surat::orderBy('id_surat', 'desc')->get();
        return view('admin.surat.index', compact('surats'));
    }

    public function create()
    {
        return view('admin.surat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required|string|max:100',
            'jenis_surat' => 'required|in:masuk,keluar',
            'perihal' => 'required|string|max:255',
            'penerima' => 'nullable|string|max:100',
            'pengirim' => 'nullable|string|max:100',
            'status' => 'required|in:draft,diajukan,disetujui,ditolak',
            'file_dokumen' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:10240',
        ]);

        $surat = Surat::create($request->except('file_dokumen'));

        if ($request->hasFile('file_dokumen')) {
            $path = $request->file('file_dokumen')->store('arsip', 'public');
            ArsipDigital::create([
                'id_surat' => $surat->id_surat,
                'nama_file' => $path,
                'kategori' => $surat->jenis_surat == 'masuk' ? 'Surat Masuk' : 'Surat Keluar',
                'upload_date' => now(),
            ]);
        }

        return redirect()->route('admin.surat.index')->with('success', 'Surat berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $surat = Surat::findOrFail($id);
        return view('admin.surat.edit', compact('surat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nomor_surat' => 'required|string|max:100',
            'jenis_surat' => 'required|in:masuk,keluar',
            'perihal' => 'required|string|max:255',
            'penerima' => 'nullable|string|max:100',
            'pengirim' => 'nullable|string|max:100',
            'status' => 'required|in:draft,diajukan,disetujui,ditolak',
            'file_dokumen' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:10240',
        ]);

        $surat = Surat::findOrFail($id);
        $surat->update($request->except('file_dokumen'));

        if ($request->hasFile('file_dokumen')) {
            // Hapus file lama jika ada
            if ($surat->arsip && Storage::disk('public')->exists($surat->arsip->nama_file)) {
                Storage::disk('public')->delete($surat->arsip->nama_file);
                $surat->arsip->delete();
            }

            $path = $request->file('file_dokumen')->store('arsip', 'public');
            ArsipDigital::create([
                'id_surat' => $surat->id_surat,
                'nama_file' => $path,
                'kategori' => $surat->jenis_surat == 'masuk' ? 'Surat Masuk' : 'Surat Keluar',
                'upload_date' => now(),
            ]);
        }

        return redirect()->route('admin.surat.index')->with('success', 'Surat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $surat = Surat::findOrFail($id);
        $surat->delete();

        return redirect()->route('admin.surat.index')->with('success', 'Surat berhasil dihapus.');
    }
}
