<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $username = $request->input('username');
        $password = $request->input('password');

        $user = User::where('name', $username)->first();

        // Cek kecocokan data dengan database
        if ($user && Hash::check($password, $user->password)) {
            // Set session login sukses
            Session::put('logged_in', true);
            Session::put('username', $username);

            return redirect('/admin/dashboard');
        }

        // Jika salah, kembali ke halaman asal (/) dengan error
        return back()->withErrors(['error' => 'Username atau password salah.']);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:users,name',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:4',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        // Auto login setelah sukses registrasi
        Session::put('logged_in', true);
        Session::put('username', $user->name);

        return redirect('/admin/dashboard');
    }

    public function logout()
    {
        // Hapus session dan arahkan ke beranda (welcome)
        Session::forget('logged_in');
        Session::forget('username');

        return redirect('/')->with('success', 'Berhasil logout.');
    }
}