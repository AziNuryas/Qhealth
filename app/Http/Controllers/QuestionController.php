<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    // Menampilkan semua pertanyaan
    public function index()
    {
        $questions = Question::with(['user', 'answers'])->latest()->paginate(10);
        return view('questions.index', compact('questions'));
    }

    // Menyimpan pertanyaan baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:5|max:255',
            'question' => 'required|string|min:5',
        ]);

        // Menyimpan pertanyaan ke database
        Question::create([
            'user_id' => Auth::id(),
            'title' => $request->input('title'),
            'question' => $request->input('question'),
        ]);

        return redirect()->route('dashboard')->with('success', 'Pertanyaan berhasil ditambahkan!');
    }

    // Menampilkan form untuk menjawab pertanyaan
    public function answerForm($id)
    {
        $question = Question::with('user')->findOrFail($id);
        return view('questions.answer', compact('question'));
    }

    // Menyimpan jawaban
    public function answer(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:5000',
        ]);

        $question = Question::findOrFail($id);

        // Menyimpan jawaban ke database
        Answer::create([
            'question_id' => $question->id,
            'user_id' => Auth::id(),
            'content' => $request->input('content'),
        ]);

        return redirect()->route('questions.index')->with('success', 'Jawaban berhasil dikirim.');
    }
}