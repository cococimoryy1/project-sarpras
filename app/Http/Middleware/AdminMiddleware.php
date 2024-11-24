<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login'); // Arahkan ke halaman login jika pengguna belum login
        }

        // Cek apakah user memiliki role_id 1 (admin)
        if (Auth::user()->role_id != 1) {
            return abort(403, 'Unauthorized action.'); // Jika bukan admin, tampilkan error 403
        }

        return $next($request); // Lanjutkan ke request berikutnya
    }
}

