<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // Akun statis dari array
    private $users = [
        'admin' => 'admin123',
    ];

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $username = $request->input('username');
        $password = $request->input('password');

        // Cek kecocokan data dengan dummy array
        if (array_key_exists($username, $this->users) && $this->users[$username] === $password) {
            // Set session login sukses
            Session::put('logged_in', true);
            Session::put('username', $username);

            return redirect('/admin/dashboard');
        }

        // Jika salah, kembali ke halaman asal (/) dengan error
        return back()->withErrors(['error' => 'Username atau password salah.']);
    }

    public function logout()
    {
        // Hapus session dan arahkan ke beranda (welcome)
        Session::forget('logged_in');
        Session::forget('username');

        return redirect('/')->with('success', 'Berhasil logout.');
    }
}