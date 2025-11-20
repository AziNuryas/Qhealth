<?php

namespace App\Http\Controllers;

use App\Services\OpenAIService;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    protected $openAIService;

    public function __construct(OpenAIService $openAIService)
    {
        $this->openAIService = $openAIService;
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000'
        ]);

        $message = $request->input('message');
        $response = $this->openAIService->getChatGPTResponse($message);
        
        return response()->json([
            'success' => true,
            'response' => $response
        ]);
    }
}