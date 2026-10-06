<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\Pelanggan;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $username = trim($request->input('username'));
        $password = $request->input('password');

        // Cek apakah login menggunakan nama atau email
        $pelanggan = Pelanggan::where('nama', $username)
                              ->orWhere('email', $username)
                              ->first();

        // Cek kecocokan data dengan database
        if ($pelanggan && Hash::check($password, $pelanggan->password)) {
            // Regenerasi sesi untuk mencegah session fixation
            $request->session()->regenerate();

            // Set session login sukses
            Session::put('pelanggan_logged_in', true);
            Session::put('pelanggan_id', $pelanggan->id_pelanggan);
            Session::put('pelanggan_nama', $pelanggan->nama);
            Session::put('pelanggan_email', $pelanggan->email);

            return redirect()->back()->with('success', 'Selamat datang kembali, ' . $pelanggan->nama . '!');
        }

        // Jika salah, kembali ke halaman asal dengan error
        return back()->withErrors(['auth_error' => 'Username/Email atau password tidak sesuai.'])->withInput();
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:pelanggans,email',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'password' => 'required|string|min:8',
        ]);

        $pelanggan = Pelanggan::create([
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'no_hp' => $request->input('no_hp'),
            'alamat' => $request->input('alamat'),
            'password' => Hash::make($request->input('password')),
            'status' => 'aktif',
        ]);

        // Auto login setelah sukses registrasi
        $request->session()->regenerate();
        Session::put('pelanggan_logged_in', true);
        Session::put('pelanggan_id', $pelanggan->id_pelanggan);
        Session::put('pelanggan_nama', $pelanggan->nama);
        Session::put('pelanggan_email', $pelanggan->email);

        return redirect()->back()->with('success', 'Pendaftaran akun berhasil! Selamat berbelanja di BUMDesGO.');
    }

    public function logout(Request $request)
    {
        Session::forget(['pelanggan_logged_in', 'pelanggan_id', 'pelanggan_nama', 'pelanggan_email']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Anda telah berhasil keluar dari akun pembeli.');
    }
}