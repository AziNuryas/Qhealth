<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            // Validasi sederhana
            if (!$request->name || !$request->email || !$request->password) {
                return response()->json([
                    'success' => false,
                    'error' => 'Semua field harus diisi'
                ], 422);
            }

            if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                return response()->json([
                    'success' => false,
                    'error' => 'Format email tidak valid'
                ], 422);
            }

            if (strlen($request->password) < 6) {
                return response()->json([
                    'success' => false,
                    'error' => 'Password minimal 6 karakter'
                ], 422);
            }

            // Check if user exists
            if (User::where('email', $request->email)->exists()) {
                return response()->json([
                    'success' => false,
                    'error' => 'Email sudah terdaftar'
                ], 422);
            }

            // Create user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Registrasi berhasil',
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email
                ]
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function login(Request $request)
    {
        try {
            if (!$request->email || !$request->password) {
                return response()->json([
                    'success' => false,
                    'error' => 'Email dan password harus diisi'
                ], 422);
            }

            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'error' => 'User tidak ditemukan'
                ], 401);
            }

            if (!Hash::check($request->password, $user->password)) {
                return response()->json([
                    'success' => false,
                    'error' => 'Password salah'
                ], 401);
            }

            return response()->json([
                'success' => true,
                'message' => 'Login berhasil',
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}