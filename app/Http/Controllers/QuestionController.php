<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    // Menampilkan semua pertanyaan
    public function index()
    {
        $questions = Question::with(['user', 'answers'])->latest()->paginate(10); // atau ->get() kalau mau lihat error
        // Tambahkan baris ini untuk cek class sebenarnya
        return view('questions.index', compact('questions'));
    }

    // Menyimpan pertanyaan baru
  public function store(Request $request)
{
    // Debugging untuk melihat data yang diterima
    dd($request->all());

    // Validasi dan simpan data
    $request->validate([
        'question' => 'required|string|min:5', // pastikan field question tidak kosong
    ]);

    // Menyimpan pertanyaan ke database
    \App\Models\Question::create([
        'user_id' => auth()->id(),
        'question' => $request->question,  // Data yang dikirimkan
    ]);

    return redirect()->route('questions.index')->with('success', 'Pertanyaan berhasil ditambahkan!');
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

        $answer = new Answer();
        $answer->question_id = $question->id;
        $answer->user_id = auth()->id();
        $answer->content = $request->input('content');
        $answer->save();

        // Mengarahkan kembali ke halaman pertanyaan dengan pesan sukses
        if ($request->has('redirect_back') && $request->redirect_back == 1) {
            // Redirect ke halaman detail pertanyaan (pastikan route ini ada)
            return redirect()->route('questions.answer.form', $question->id)->with('success', 'Jawaban berhasil dikirim.');
        } else {
            // Redirect ke halaman daftar pertanyaan
            return redirect()->route('questions.index')->with('success', 'Jawaban berhasil dikirim.');
        }
    }

    // Menampilkan hasil pencarian pertanyaan
}