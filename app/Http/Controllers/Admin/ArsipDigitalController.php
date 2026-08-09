<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArsipDigital;
use Illuminate\Support\Facades\Storage;

class ArsipDigitalController extends Controller
{
    public function index()
    {
        $arsips = ArsipDigital::orderBy('id_arsip', 'desc')->get();
        return view('admin.arsip.index', compact('arsips'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,png,zip|max:10240',
            'kategori' => 'nullable|string|max:100',
            'id_surat' => 'nullable|exists:surats,id_surat',
        ]);

        $file = $request->file('file');
        $path = $file->store('arsip', 'public');

        ArsipDigital::create([
            'id_surat' => $request->id_surat,
            'nama_file' => $path, // We store path in nama_file since there's no file_path column
            'kategori' => $request->kategori,
            'upload_date' => now(),
        ]);

        return redirect()->route('admin.arsip.index')->with('success', 'File arsip berhasil diunggah.');
    }

    public function destroy($id)
    {
        $arsip = ArsipDigital::findOrFail($id);
        
        if (Storage::disk('public')->exists($arsip->nama_file)) {
            Storage::disk('public')->delete($arsip->nama_file);
        }
        
        $arsip->delete();

        return redirect()->route('admin.arsip.index')->with('success', 'File arsip berhasil dihapus.');
    }
}
