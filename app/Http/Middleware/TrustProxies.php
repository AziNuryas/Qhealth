<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TrustProxies
{
    public function handle(Request $request, Closure $next)
    {
        // Implementasi middleware untuk memeriksa trust proxies
        return $next($request);
    }
}
