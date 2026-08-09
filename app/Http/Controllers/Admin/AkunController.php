<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AkunController extends Controller
{
    /**
     * Pastikan hanya direktur yang bisa akses (role = 4)
     */
    private function checkAccess()
    {
        $role = Session::get('admin_role');
        if ($role != 4) {
            abort(403, 'Akses Ditolak. Hanya Direktur yang dapat mengelola akun.');
        }
    }

    public function index()
    {
        $this->checkAccess();
        // Mengambil semua user beserta rolenya, kecuali Direktur (biasanya Direktur tidak dihapus sendiri)
        $users = User::with('role')->get();
        return view('admin.akun.index', compact('users'));
    }

    public function create()
    {
        $this->checkAccess();
        $roles = Role::all();
        return view('admin.akun.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->checkAccess();

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'id_role' => 'required|exists:roles,id_role',
            'no_hp' => 'nullable|string|max:20',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'id_role' => $request->id_role,
            'password' => Hash::make($request->password),
            'status' => 'aktif',
        ]);

        return redirect()->route('admin.akun.index')->with('success', 'Akun berhasil dibuat.');
    }

    public function edit($id)
    {
        $this->checkAccess();
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('admin.akun.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $this->checkAccess();
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,'.$id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'id_role' => 'required|exists:roles,id_role',
            'no_hp' => 'nullable|string|max:20',
            'status' => 'required|in:aktif,nonaktif',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'id_role' => $request->id_role,
            'status' => $request->status,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.akun.index')->with('success', 'Data akun berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $this->checkAccess();
        $user = User::findOrFail($id);
        
        // Mencegah direktur menghapus dirinya sendiri
        if (Session::get('admin_id') == $user->id) {
            return redirect()->route('admin.akun.index')->withErrors(['error' => 'Anda tidak dapat menghapus akun Anda sendiri.']);
        }
        
        $user->delete();

        return redirect()->route('admin.akun.index')->with('success', 'Akun berhasil dihapus.');
    }
}
