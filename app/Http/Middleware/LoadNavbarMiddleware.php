<?php

namespace App\Http\Middleware;

use App\Models\MenuUser;
use App\Models\MenuUserModel;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class LoadNavbarMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $navbar = MenuUser::with('menu')->where('user_id', Auth::user()->id_jenis_user)->get();
            View::share('navbar', $navbar);
        }

        return $next($request);
    }
}
    