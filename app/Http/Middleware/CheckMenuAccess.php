<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Akses;
use Illuminate\Support\Facades\Auth;

class CheckMenuAccess
{
    public function handle(Request $request, Closure $next)
    {
        $roleId = Auth::user()->role_id;

        // Cek apakah menu dapat diakses oleh role yang sedang login
        $accessibleMenus = Akses::where('role_id', $roleId)
                                ->where('hak_akses', 'lihat') // Hanya untuk hak akses lihat
                                ->pluck('menu_id');

        // Menyimpan daftar menu yang bisa diakses ke dalam session
        session(['accessible_menus' => $accessibleMenus]);

        return $next($request);
    }
}

