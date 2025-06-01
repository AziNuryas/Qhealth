<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect('/login')->with('error', 'Login required');
        }
        
        // Ganti logic ini - cek role bukan is_admin
      if ($user->role !== 'admin') {
    return redirect('/home')->with('error', 'Akses ditolak');
}

        
        
        return $next($request);
    }
}