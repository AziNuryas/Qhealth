<?php

namespace App\Http\Controllers;

use App\Services\GroqService; // ← ganti ke Groq
use Illuminate\Http\Request;

class ChatController extends Controller
{
    protected $aiService;

    public function __construct(GroqService $aiService)
    {
        $this->aiService = $aiService;
    }

    public function sendMessage(Request $request)
    {
        $message = $request->input('message');
        $response = $this->aiService->getAIResponse($message);

        return response()->json(['reply' => $response]);
    }
}