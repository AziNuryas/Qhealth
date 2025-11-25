<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChatController;

/* Mobile API (Sanctum) */

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Route yang membutuhkan auth (jika ada)

    Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user',     [ProfileController::class, 'show']);
    Route::put('/profile',  [ProfileController::class, 'update']);
    Route::get('/questions',        [QuestionController::class, 'apiIndex']);
    Route::post('/questions',       [QuestionController::class, 'apiStore']);
    Route::get('/questions/{id}',   [QuestionController::class, 'apiShow']);
    Route::post('/questions/{id}/vote', [QuestionController::class, 'apiVote']);
    Route::post('/questions/{id}/answers', [AnswerController::class, 'store']);

    Route::post('/chatbot', [ChatController::class, 'sendMessage']);
});