<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    /**
     * Handle chatbot requests for Mobile + Web
     */
    public function sendMessage(Request $request)
    {
        Log::info('Chat Request Received', [
            'message' => $request->input('message'),
            'ip' => $request->ip(),
            'mobile_request' => $request->header('X-Mobile-Request'),
            'user_agent' => $request->header('User-Agent')
        ]);

        try {
            $request->validate([
                'message' => 'required|string|max:2000'
            ]);

            $message = trim($request->input('message'));

            /**
             * TEST MODE — digunakan oleh Expo saat testAPIConnection()
             */
            if (strtolower($message) === 'test') {
                return response()->json([
                    'success' => true,
                    'reply' => "🟢 **QHealth AI Mobile Connected!**\n\nServer Status: **ONLINE**\nModel: Auto\nTime: " . now()->format('H:i:s'),
                    'model_used' => 'test-mode',
                    'timestamp' => now()->toISOString()
                ]);
            }

            /**
             * CEK API KEY GROQ
             */
            $apiKey = env('GROQ_API_KEY');

            if (empty($apiKey)) {
                Log::warning("GROQ_API_KEY missing — fallback activated.");
                return $this->fallbackResponse($message);
            }

            /**
             * PILIH MODEL TERBAIK
             */
            $model = $this->getBestModel($apiKey);

            if (!$model) {
                Log::warning("Best Model Not Found — fallback");
                return $this->fallbackResponse($message);
            }

            /**
             * GROQ API CALL
             */
            $response = Http::timeout(20)
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $apiKey,
                    'Content-Type' => 'application/json',
                ])
                ->post('https://api.groq.com/openai/v1/chat/completions', [
                    'model' => $model,
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' => "Kamu adalah QHealth AI, asisten kesehatan profesional yang menjawab dalam bahasa Indonesia dengan format rapi, bullet points, dan aman."
                        ],
                        [
                            'role' => 'user',
                            'content' => $message
                        ]
                    ],
                    'max_tokens' => 1200,
                    'temperature' => 0.7,
                ]);

            if ($response->successful()) {
                $reply = $response->json('choices.0.message.content', null);

                return response()->json([
                    'success' => true,
                    'reply' => trim($reply ?? "Maaf, saya tidak bisa merespons sekarang."),
                    'api' => 'groq',
                    'model_used' => $model,
                    'timestamp' => now()->toISOString()
                ]);
            }

            Log::error("Groq API error", [
                'error' => $response->body()
            ]);

            return $this->fallbackResponse($message);

        } catch (\Exception $e) {
            Log::error("ChatController Exception: " . $e->getMessage());

            return $this->fallbackResponse($message);
        }
    }

    /**
     * Mendapatkan model terbaik dari Groq API
     */
    private function getBestModel($apiKey)
    {
        try {
            $res = Http::timeout(10)
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $apiKey
                ])
                ->get('https://api.groq.com/openai/v1/models');

            if (!$res->successful()) {
                return null;
            }

            $models = collect($res->json('data', []));

            $priorityList = [
                'llama-3.2-3b-preview',
                'llama-3.1-8b-instant',
                'mixtral-8x7b-32768',
                'gemma2-9b-it'
            ];

            foreach ($priorityList as $model) {
                if ($models->pluck('id')->contains($model)) {
                    return $model;
                }
            }

            return $models->first()['id'] ?? null;

        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Fallback Response jika API Groq gagal
     */
    private function fallbackResponse($message)
    {
        $lower = strtolower($message);

        $patterns = [
            'halo|hai' => "👋 Halo! Saya QHealth AI.\nSiap bantu kamu tentang kesehatan!",
            'diet|makan' => "🥗 **Tips Diet Sehat**\n• Perbanyak sayur dan buah\n• Kurangi gula & gorengan\n• Minum 6–8 gelas air per hari\n• Prioritaskan protein dan serat",
            'olahraga|exercise' => "💪 **Olahraga Ringan**\n• Jalan 20–30 menit\n• Squat & plank\n• Push-up 3×10\n• Lakukan rutin 3–4x/minggu",
            'tidur|sleep' => "😴 **Tips Tidur Nyenyak**\n• Hindari HP 1 jam sebelum tidur\n• Atur suhu kamar 20–24°C\n• Hindari kopi setelah jam 5 sore\n• Tetapkan jam tidur tetap"
        ];

        foreach ($patterns as $pattern => $response) {
            if (preg_match("/$pattern/i", $lower)) {
                return response()->json([
                    'success' => true,
                    'reply' => $response,
                    'fallback' => true,
                    'timestamp' => now()->toISOString()
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'reply' => "⚠️ Saat ini server sedang sibuk.\nCoba lagi sebentar ya!",
            'fallback' => true,
            'timestamp' => now()->toISOString()
        ]);
    }

    /**
     * Test API endpoint untuk mobile
     */
    public function testConnection()
    {
        return response()->json([
            'status' => 'OK',
            'message' => 'QHealth Mobile API READY',
            'endpoint' => '/api/chatbot',
            'timestamp' => now()->toISOString()
        ]);
    }
}
