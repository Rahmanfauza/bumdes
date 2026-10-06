<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthMiddleware
{
    /**
     * Memastikan hanya pengguna admin/pengurus yang telah login dan berstatus aktif
     * yang dapat mengakses rute di grup admin.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek keberadaan sesi login admin
        if (!Session::get('admin_logged_in') || !Session::has('admin_id')) {
            return redirect()->route('admin.login')->withErrors([
                'error' => 'Sesi Anda belum dimulai atau telah berakhir. Silakan login terlebih dahulu.'
            ]);
        }

        // 2. Verifikasi status akun di database secara realtime
        $adminId = Session::get('admin_id');
        $user = User::find($adminId);

        if (!$user) {
            Session::forget(['admin_logged_in', 'admin_id', 'admin_username', 'admin_role']);
            return redirect()->route('admin.login')->withErrors([
                'error' => 'Akun Anda tidak ditemukan di sistem.'
            ]);
        }

        if ($user->status !== 'aktif') {
            Session::forget(['admin_logged_in', 'admin_id', 'admin_username', 'admin_role']);
            return redirect()->route('admin.login')->withErrors([
                'error' => 'Akun Anda sedang dinonaktifkan. Hubungi Direktur untuk mengaktifkan kembali.'
            ]);
        }

        return $next($request);
    }
}
