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
    /* ---------- API MOBILE (JSON) ---------- */
public function apiIndex()
{
    // stub 5 data demo (bisa Anda ganti dengan QueryBuilder asli jika ingin)
    $data = collect([
        ['id' => 1, 'title' => 'Best cardio exercise?', 'body' => 'How to strengthen heart effectively?', 'user' => ['name' => 'Sarah M'], 'tags' => ['cardio', 'exercise'], 'vote' => 45, 'answer_count' => 12, 'created_at' => now()->subHours(2)->toDateTimeString()],
        ['id' => 2, 'title' => 'Daily water intake?', 'body' => 'Does it vary by activity level?', 'user' => ['name' => 'John D'], 'tags' => ['hydration'], 'vote' => 32, 'answer_count' => 8, 'created_at' => now()->subHours(5)->toDateTimeString()],
        ['id' => 3, 'title' => 'Benefits of meditation?', 'body' => 'Interested in starting meditation.', 'user' => ['name' => 'Emma L'], 'tags' => ['mindfulness'], 'vote' => 28, 'answer_count' => 5, 'created_at' => now()->subDay()->toDateTimeString()],
    ]);
    return response()->json($data);
}

public function apiStore(Request $req)
{
    $req->validate(['title' => 'required', 'body' => 'required']);
    // simpan as-is (demo) – Anda bisa ganti pakai QueryBuilder jika ingin
    return response()->json(['id' => rand(10, 999), ...$req->only(['title', 'body'])], 201);
}

public function apiShow($id)
{
    // detail + jawaban stub
    return response()->json([
        'id' => $id,
        'title' => 'Sample title id '.$id,
        'body'  => 'Long description here...',
        'user'  => ['name' => 'Demo User'],
        'tags'  => ['demo'],
        'vote'  => 10,
        'answers' => [
            ['id' => 1, 'body' => 'Jawaban pertama demo', 'user' => ['name' => 'Dr. A']],
        ],
    ]);
}

public function apiVote(Request $req, $id)
{
    // demo vote +1/-1
    return response()->json(['vote' => rand(5, 50)]);
}
}