<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        if (Session::has('admin_logged_in')) {
            return redirect('/admin/dashboard');
        }
        return view('auth.login'); // The view I created earlier
    }

    public function login(Request $request)
    {
        $request->validate([
            'actor' => 'required|in:admin,sekretaris,bendahara,direktur',
            'username' => 'required',
            'password' => 'required'
        ]);

        $roleMap = [
            'admin' => 1,
            'sekretaris' => 2,
            'bendahara' => 3,
            'direktur' => 4,
        ];
        $expectedRoleId = $roleMap[$request->actor];

        $user = User::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            if ($user->id_role !== $expectedRoleId) {
                return back()->withErrors(['actor' => 'Username tersebut tidak memiliki otoritas sebagai ' . ucfirst($request->actor) . '.']);
            }
            if ($user->status !== 'aktif') {
                return back()->withErrors(['username' => 'Akun Anda sedang dinonaktifkan. Hubungi Direktur.']);
            }

            $request->session()->regenerate();
            Session::put('admin_logged_in', true);
            Session::put('admin_id', $user->id);
            Session::put('admin_username', $user->username);
            Session::put('admin_role', $user->id_role);
            return redirect('/admin/dashboard')->with('success', 'Berhasil login sebagai ' . ucfirst($request->actor) . '.');
        }

        return back()->withErrors(['username' => 'Username atau password salah.']);
    }

    public function logout(Request $request)
    {
        Session::forget(['admin_logged_in', 'admin_id', 'admin_username', 'admin_role']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login')->with('success', 'Berhasil logout.');
    }
}
