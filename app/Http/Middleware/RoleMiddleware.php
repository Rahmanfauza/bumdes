<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Role-Based Access Control (RBAC):
     * Membatasi akses modul admin berdasarkan peran pengguna.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles (Contoh: 'admin', 'sekretaris', 'bendahara', 'direktur', atau angka 1, 2, 3, 4)
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $userRoleId = (int) Session::get('admin_role');

        $roleMap = [
            'admin' => 1,
            'sekretaris' => 2,
            'bendahara' => 3,
            'direktur' => 4,
        ];

        $allowedRoleIds = [];
        foreach ($roles as $role) {
            $roleClean = strtolower(trim($role));
            if (is_numeric($roleClean)) {
                $allowedRoleIds[] = (int) $roleClean;
            } elseif (isset($roleMap[$roleClean])) {
                $allowedRoleIds[] = $roleMap[$roleClean];
            }
        }

        // Direktur (Role 4) memiliki otoritas tertinggi untuk mengawasi modul staf
        // KECUALI jika rute diproteksi eksklusif, maka cek kesesuaian role
        $isAuthorized = in_array($userRoleId, $allowedRoleIds, true);

        // Jika rute ditujukan untuk divisi staf tertentu, Direktur selalu boleh mengawasi
        if (!$isAuthorized && $userRoleId === 4) {
            $isAuthorized = true;
        }

        if (!$isAuthorized) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Akses ditolak. Anda tidak memiliki otoritas untuk mengakses fitur ini.'
                ], 403);
            }

            return redirect('/admin/dashboard')->withErrors([
                'error' => 'Akses Ditolak: Anda tidak memiliki otoritas untuk mengakses halaman tersebut.'
            ]);
        }

        return $next($request);
    }
}
