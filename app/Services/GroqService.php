<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class GroqService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = config('services.groq.api_key');

        if (empty($this->apiKey)) {
            Log::error('Groq API Key tidak ditemukan! Periksa .env dan config/services.php');
        }
    }

    public function getAIResponse($message)
    {
        try {
            $systemPrompt = "Anda adalah asisten AI yang cerdas, membantu, dan berpengetahuan luas. " .
                            "Jawab semua pertanyaan dalam bahasa Indonesia yang alami, jelas, dan informatif. " .
                            "Jangan ulangi pertanyaan pengguna. Fokus pada jawaban yang berguna.";

            $response = $this->client->post('https://api.groq.com/openai/v1/chat/completions', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Content-Type'  => 'application/json',
                ],
                'json' => [
                    'model'    => 'llama-3.1-8b-instant', // Gratis & cepat
                    'messages' => [
                        ['role' => 'system', 'content' => $systemPrompt],
                        ['role' => 'user',   'content' => $message],
                    ],
                    'max_tokens'  => 1024,
                    'temperature' => 0.7,
                ],
                'timeout' => 20,
            ]);

            $data = json_decode($response->getBody(), true);

            if (isset($data['choices'][0]['message']['content'])) {
                return trim($data['choices'][0]['message']['content']);
            }

            Log::warning('Groq API tidak mengembalikan konten', ['response' => $data]);

        } catch (RequestException $e) {
            Log::error('Groq API Error', [
                'status' => $e->getResponse()?->getStatusCode(),
                'error'  => $e->getMessage(),
                'message'=> $message,
            ]);
        } catch (\Exception $e) {
            Log::error('Groq Service Error', ['exception' => $e->getMessage()]);
        }

        // Fallback jika Groq error (tapi jarang terjadi)
        return "Maaf, sedang ada gangguan. Coba tanya lagi, ya!";
    }
}