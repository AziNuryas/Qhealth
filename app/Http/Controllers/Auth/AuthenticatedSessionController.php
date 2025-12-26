<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
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
    public function store(Request $request): RedirectResponse
    {
        // Validasi manual - JANGAN pakai LoginRequest
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // DEBUG
        \Log::info('=== LOGIN ATTEMPT ===');
        \Log::info('Email: ' . $request->email);

        // Coba login
        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            \Log::info('Login SUCCESS for: ' . $user->email);
            \Log::info('User Role: ' . $user->role);
            \Log::info('Role check: ' . ($user->role === 'admin' ? 'IS ADMIN' : 'NOT ADMIN'));
            
            // PASTI redirect ke admin jika role admin
            if ($user->role === 'admin') {
                \Log::info('Redirecting to ADMIN: /admin');
                return redirect('/admin'); // Langsung ke admin
            }
            
            \Log::info('Redirecting to USER: /dashboard');
            return redirect('/dashboard');
        }

        \Log::warning('Login FAILED for: ' . $request->email);
        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}