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
        // Mendapatkan data user yang sedang login
        $user = Auth::user();

        // Jika user belum login, redirect ke halaman login
        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Mendapatkan role_id dari user
        $roleId = $user->role_id;

        // Mendapatkan nama menu yang sedang diminta berdasarkan route
        $currentMenu = $request->route()->getName(); // Mendapatkan nama route

        // Cek jika halaman yang diminta adalah dashboard untuk menghindari loop
        if ($currentMenu == 'dashboard') {
            return $next($request);
        }

        // Mengecek apakah user memiliki hak akses pada menu yang diminta
        $menuAccess = Akses::where('role_id', $roleId)
            ->whereHas('menu', function ($query) use ($currentMenu) {
                $query->where('link', $currentMenu); // Cek menu berdasarkan nama route
            })
            ->where('hak_akses', 'like', '%lihat%') // Menyaring berdasarkan hak akses yang dimiliki, misalnya 'lihat'
            ->exists();

        // Jika tidak ada akses untuk menu tersebut, redirect ke dashboard
        if (!$menuAccess) {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke menu ini.');
        }

        // Lanjutkan ke request berikutnya jika akses diterima
        return $next($request);
    }
}

