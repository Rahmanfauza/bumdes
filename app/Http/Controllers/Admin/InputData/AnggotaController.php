<?php

namespace App\Http\Controllers\Admin\InputData;

use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Http\Controllers\Controller;

class AnggotaController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|string|max:16|unique:anggotas,nik',
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'jk' => 'nullable|in:Laki-laki,Perempuan',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:15',
        ]);

        $validated['tanggal_bergabung'] = now();

        Anggota::create($validated);

        return redirect()->back()->with('success', 'Data anggota berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $anggota = Anggota::findOrFail($id);
        return response()->json($anggota);
    }

    public function update(Request $request, $id)
    {
        $anggota = Anggota::findOrFail($id);

        $validated = $request->validate([
            'nik' => 'required|string|max:16|unique:anggotas,nik,' . $anggota->id,
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'jk' => 'nullable|in:Laki-laki,Perempuan',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:15',
        ]);

        $anggota->update($validated);

        return redirect()->back()->with('success', 'Data anggota berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $anggota = Anggota::findOrFail($id);
        $anggota->delete();

        return redirect()->back()->with('success', 'Data anggota berhasil dihapus!');
    }
}
