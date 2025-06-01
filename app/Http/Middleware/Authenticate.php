<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            return $next($request);  // Melanjutkan jika pengguna sudah login
        }

        return redirect()->route('login');  // Redirect ke halaman login jika belum login
    }
}
