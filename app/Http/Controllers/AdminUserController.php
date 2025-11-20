<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


class AdminUserController extends Controller
{
    public function index()
    {
        // Ambil semua data pengguna
        $users = User::all(); // Bisa disesuaikan dengan pagination atau filter
        return view('admin.users.index', compact('users'));
    }

    //// Metode untuk menampilkan form edit pengguna
    public function edit($id)
    {
        // Temukan pengguna berdasarkan ID
        $user = User::findOrFail($id);

        // Kembalikan view 'edit' dengan data pengguna
        return view('admin.users.edit', compact('user'));
    }

    // Metode untuk memperbarui data pengguna
    public function update(Request $request, $id)
    {
        // Validasi input pengguna
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|string|in:admin,user',
        ]);

        // Temukan pengguna berdasarkan ID
        $user = User::findOrFail($id);

        // Perbarui data pengguna
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'role' => $request->input('role'),
        ]);

        // Redirect ke halaman pengguna dengan pesan sukses
        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil diperbarui');
    }

    public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus');
}

}
