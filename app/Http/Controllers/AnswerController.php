<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AnswerController extends Controller
{
    /**
     * API: Store new answer - REAL DATABASE
     */
    public function store(Request $request, $questionId)
    {
        try {
            $request->validate([
                'body' => 'required|string'
            ]);

            $question = Question::findOrFail($questionId);

            // ✅ SIMPAN JAWABAN REAL KE DATABASE
            $answer = Answer::create([
                'question_id' => $question->id,
                'user_id' => Auth::id(),
                'content' => $request->body,
            ]);

            Log::info('New answer created for question: ' . $question->id);

            // Return data dengan format yang sesuai mobile app
            return response()->json([
                'id' => $answer->id,
                'body' => $answer->content,
                'user' => [
                    'name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                ],
                'created_at' => $answer->created_at->toISOString(),
               
                'user_has_liked' => false,
            ], 201);
            
        } catch (\Exception $e) {
            Log::error('API Answer Store Error: ' . $e->getMessage());
            return response()->json([
                'error' => 'Failed to post answer',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}