<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Chatcontroller;

Route::post('/login',    [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user',     [ProfileController::class, 'show']);
    Route::put('/profile',  [ProfileController::class, 'update']);

    Route::get('/questions',        [QuestionController::class, 'index']);
    Route::post('/questions',       [QuestionController::class, 'store']);
    Route::get('/questions/{id}',   [QuestionController::class, 'show']);
    Route::post('/questions/{id}/vote', [QuestionController::class, 'vote']);

   

    Route::post('/chatbot', [ChatController::class, '__invoke']);
});