<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Cek apakah user memiliki role yang sesuai
        if (!Auth::check() || Auth::user()->role !== $role) {
            // Redirect jika role tidak sesuai
            return redirect('/');
        }

        return $next($request);
    }
}
