<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
{
    // Autentikasi pengguna
    $request->authenticate();

    // Regenerasi session setelah login
    $request->session()->regenerate();

    // Cek jika pengguna adalah admin dan arahkan ke halaman admin
    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.index');  // Ganti dengan rute admin kamu
    }

    // Pengalihan untuk pengguna biasa ke dashboard
    return redirect()->intended(route('dashboard', absolute: false));
}

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
{
    Auth::logout();

    // Hapus session dan regenerasi token
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
}

}
