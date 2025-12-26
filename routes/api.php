<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\ChatController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

// Register & Login tetap
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Health check global
Route::get('/health', function () {
    return response()->json([
        'status' => 'healthy',
        'service' => 'QHealth API',
        'supports_mobile' => true,
        'chat_endpoint' => '/api/chatbot', // endpoint resmi mobile/web
        'timestamp' => now()->toISOString()
    ]);
});

// === CHATBOT UTAMA UNTUK MOBILE & WEB ===
// ini endpoint yang dipakai AIChatModal.tsx
Route::post('/chatbot', [ChatController::class, 'sendMessage']);

// optional test route
Route::get('/chat/test', [ChatController::class, 'testConnection']);


/*
|--------------------------------------------------------------------------
| QUESTION ROUTES (PUBLIC)
|--------------------------------------------------------------------------
*/

Route::get('/questions', [QuestionController::class, 'apiIndex']);
Route::get('/questions/{id}', [QuestionController::class, 'apiShow']);


/*
|--------------------------------------------------------------------------
| PRIVATE ROUTES (NEED AUTH)
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [ProfileController::class, 'show']);
    Route::put('/profile', [ProfileController::class, 'apiUpdate']);
    Route::post('/questions', [QuestionController::class, 'apiStore']);
    Route::post('/questions/{id}/vote', [QuestionController::class, 'apiVote']);
    Route::post('/questions/{id}/answers', [AnswerController::class, 'store']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
