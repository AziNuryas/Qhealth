<?php

// app/Http/Controllers/AdminQuestionController.php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class AdminQuestionController extends Controller
{
    // Menampilkan daftar pertanyaan
    public function index()
    {
        $questions = Question::paginate(10); // Ambil 10 pertanyaan per halaman
        return view('admin.questions.index', compact('questions'));
    }

    // Menampilkan form untuk membuat pertanyaan baru
    public function create()
    {
        return view('admin.questions.create'); // Pastikan ada file create.blade.php
    }

    // Menyimpan pertanyaan baru
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            // validasi lainnya sesuai kebutuhan
        ]);

        Question::create([
            'question' => $request->question,
            // kolom lainnya
        ]);

        return redirect()->route('admin.questions.index')->with('success', 'Pertanyaan berhasil ditambahkan');
    }

    // Menghapus pertanyaan
    public function destroy(Question $question)
    {
        // Hapus pertanyaan dari database
        $question->delete();

        // Kembali ke halaman daftar pertanyaan dengan pesan sukses
        return redirect()->route('admin.questions.index')->with('success', 'Pertanyaan berhasil dihapus');
    }
}
