<?php

// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // Menampilkan dashboard dengan daftar pertanyaan
    public function index()
    {
        // Ambil semua pertanyaan dengan user yang mengajukan (relasi user)
        $questions = Question::with('user')->latest()->get();

        return view('dashboard', compact('questions'));
    }

    // Menyimpan pertanyaan yang diajukan oleh user
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'question' => 'required|string|max:1000',
        ]);

        // Simpan pertanyaan ke database
        Question::create([
            'user_id' => Auth::id(),
            'question' => $request->question,
        ]);

        // Redirect kembali ke dashboard dengan pesan sukses
        return redirect()->route('dashboard')->with('success', 'Pertanyaan berhasil dikirim!');
    }
}

