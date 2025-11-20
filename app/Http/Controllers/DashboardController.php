<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Tambahkan ini

class DashboardController extends Controller
{
    // Menampilkan dashboard
    public function index()
    {
        $questions = Question::with(['user', 'answers'])->latest()->paginate(10);
        return view('dashboard', compact('questions'));
    }

    // Menyimpan pertanyaan baru dari dashboard
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:5|max:255',
            'question' => 'required|string|min:5',
        ]);

        // Debug: cek data yang dikirim
        // Log::info('Data dari form:', $request->all()); // Opsional: uncomment jika perlu debug

        // Menyimpan pertanyaan ke database
        Question::create([
            'user_id' => Auth::id(),
            'title' => $request->input('title'),
            'question' => $request->input('question'),
        ]);

        return redirect()->route('dashboard')->with('success', 'Pertanyaan berhasil ditambahkan!');
    }
}