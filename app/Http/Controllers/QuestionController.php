<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class QuestionController extends Controller
{
    // Menampilkan semua pertanyaan (Web)
    public function index()
    {
        $questions = Question::with(['user', 'answers'])->latest()->paginate(10);
        return view('questions.index', compact('questions'));
    }

    // Menyimpan pertanyaan baru (Web)
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:5|max:255',
            'question' => 'required|string|min:5',
        ]);

        Question::create([
            'user_id' => Auth::id(),
            'title' => $request->input('title'),
            'question' => $request->input('question'),
        ]);

        return redirect()->route('dashboard')->with('success', 'Pertanyaan berhasil ditambahkan!');
    }

    // Menampilkan form untuk menjawab pertanyaan (Web)
    public function answerForm($id)
    {
        $question = Question::with('user')->findOrFail($id);
        return view('questions.answer', compact('question'));
    }

    // Menyimpan jawaban (Web)
    public function answer(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:5000',
        ]);

        $question = Question::findOrFail($id);

        Answer::create([
            'question_id' => $question->id,
            'user_id' => Auth::id(),
            'content' => $request->input('content'),
        ]);

        return redirect()->route('questions.index')->with('success', 'Jawaban berhasil dikirim.');
    }

    /* ---------- API MOBILE (JSON) ---------- */
    
    /**
     * API: Get all questions for mobile app - REAL DATABASE
     */
    public function apiIndex()
    {
        try {
            // ✅ AMBIL DATA REAL DARI DATABASE
            $questions = Question::with(['user', 'answers.user'])
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($question) {
                    return [
                        'id' => $question->id,
                        'title' => $question->title,
                        'body' => $question->question, // field name 'question' bukan 'body'
                        'user' => [
                            'name' => $question->user->name,
                            'email' => $question->user->email,
                        ],
                        'created_at' => $question->created_at->toISOString(),
                        'answers_count' => $question->answers->count(),
                        'likes_count' => $question->likes_count ?? 0,
                        'user_has_liked' => false,
                        'answers' => $question->answers->map(function ($answer) {
                            return [
                                'id' => $answer->id,
                                'body' => $answer->content, // field name 'content' bukan 'body'
                                'user' => [
                                    'name' => $answer->user->name,
                                    'email' => $answer->user->email,
                                ],
                                'created_at' => $answer->created_at->toISOString(),
                                'likes_count' => $answer->likes_count ?? 0,
                                'user_has_liked' => false,
                            ];
                        }),
                    ];
                });

            Log::info('API Questions fetched: ' . $questions->count() . ' items');
            return response()->json($questions);
            
        } catch (\Exception $e) {
            Log::error('API Questions Error: ' . $e->getMessage());
            return response()->json([
                'error' => 'Failed to fetch questions',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * API: Create new question - REAL DATABASE
     */
    public function apiStore(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'body' => 'required|string'
            ]);

            // ✅ SIMPAN KE DATABASE REAL
            $question = Question::create([
                'user_id' => Auth::id(),
                'title' => $request->title,
                'question' => $request->body, // field name 'question' bukan 'body'
            ]);

            Log::info('New question created: ' . $question->id);

            // Return data dengan format yang sesuai mobile app
            return response()->json([
                'id' => $question->id,
                'title' => $question->title,
                'body' => $question->question,
                'user' => [
                    'name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                ],
                'created_at' => $question->created_at->toISOString(),
                'answers_count' => 0,
                'likes_count' => 0,
                'user_has_liked' => false,
                'answers' => []
            ], 201);
            
        } catch (\Exception $e) {
            Log::error('API Create Question Error: ' . $e->getMessage());
            return response()->json([
                'error' => 'Failed to create question',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * API: Get single question - REAL DATABASE
     */
    public function apiShow($id)
    {
        try {
            // ✅ AMBIL DATA REAL DARI DATABASE
            $question = Question::with(['user', 'answers.user'])->findOrFail($id);

            $formattedQuestion = [
                'id' => $question->id,
                'title' => $question->title,
                'body' => $question->question,
                'user' => [
                    'name' => $question->user->name,
                    'email' => $question->user->email,
                ],
                'created_at' => $question->created_at->toISOString(),
                'answers_count' => $question->answers->count(),
                'likes_count' => $question->likes_count ?? 0,
                'user_has_liked' => false,
                'answers' => $question->answers->map(function ($answer) {
                    return [
                        'id' => $answer->id,
                        'body' => $answer->content,
                        'user' => [
                            'name' => $answer->user->name,
                            'email' => $answer->user->email,
                        ],
                        'created_at' => $answer->created_at->toISOString(),
                        'likes_count' => $answer->likes_count ?? 0,
                        'user_has_liked' => false,
                    ];
                }),
            ];

            Log::info('API Question detail fetched: ' . $question->id);
            return response()->json($formattedQuestion);
            
        } catch (\Exception $e) {
            Log::error('API Question Detail Error: ' . $e->getMessage());
            return response()->json([
                'error' => 'Failed to fetch question',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * API: Vote/like question
     */
    public function apiVote(Request $request, $id)
    {
        try {
            // Untuk sementara masih mock, bisa diimplementasikan later
            $question = Question::find($id);
            if ($question) {
                $question->increment('likes_count');
            }

            return response()->json([
                'likes_count' => $question->likes_count ?? rand(10, 50),
                'user_has_liked' => true
            ]);
            
        } catch (\Exception $e) {
            Log::error('API Vote Error: ' . $e->getMessage());
            return response()->json([
                'error' => 'Failed to process vote',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}