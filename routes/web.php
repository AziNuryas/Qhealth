<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BmiController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminQuestionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAnswerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use Illuminate\Http\Request;

Route::get('/home', function () {
    if (Auth::check()) {
        if (Auth::user()->role === 'admin') {
            return redirect('/admin');
        }
        return redirect('/dashboard');
    }
    return redirect('/login');
})->name('admin/index');

// =============== PUBLIC ROUTES ===============
Route::get('/', fn () => view('welcome'))->name('home');
Route::get('/bmi', [BmiController::class, 'index'])->name('bmi');

// =============== AUTH ROUTES ===============
// Login/Logout routes (TARUH DI ATAS!)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// =============== ADMIN ROUTES ===============
// PENTING: Taruh admin routes SEBELUM middleware auth umum
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        
        // Users Management
        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [AdminUserController::class, 'create'])->name('users.create');
        Route::post('/users', [AdminUserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}', [AdminUserController::class, 'show'])->name('users.show');
        Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');
        
        // Questions Management
        Route::get('/questions', [AdminQuestionController::class, 'index'])->name('questions.index');
        Route::get('/questions/create', [AdminQuestionController::class, 'create'])->name('questions.create');
        Route::post('/questions', [AdminQuestionController::class, 'store'])->name('questions.store');
        Route::get('/questions/{question}', [AdminQuestionController::class, 'show'])->name('questions.show');
        Route::get('/questions/{question}/edit', [AdminQuestionController::class, 'edit'])->name('questions.edit');
        Route::put('/questions/{question}', [AdminQuestionController::class, 'update'])->name('questions.update');
        Route::delete('/questions/{question}', [AdminQuestionController::class, 'destroy'])->name('questions.destroy');
        
        // Answers Management
        Route::get('/answers', [AdminAnswerController::class, 'index'])->name('answers.index');
        Route::get('/answers/{id}', [AdminAnswerController::class, 'show'])->name('answers.show');
        Route::get('/answers/{id}/edit', [AdminAnswerController::class, 'edit'])->name('answers.edit');
        Route::delete('/answers/{id}', [AdminAnswerController::class, 'destroy'])->name('answers.destroy');
    });
});

// =============== USER ROUTES (Regular Users) ===============
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard', [DashboardController::class, 'store'])->name('dashboard.store');
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Questions
    Route::get('/pertanyaan', [QuestionController::class, 'index'])->name('questions.index');
    Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');
    Route::get('/questions/{id}', [QuestionController::class, 'show'])->name('questions.show');
    Route::get('/questions/{id}/answer', [QuestionController::class, 'answerForm'])->name('questions.answerForm');
    Route::post('/questions/{id}/answer', [QuestionController::class, 'answer'])->name('questions.answer.store');
    
    // Chat
    Route::post('/chat', [ChatController::class, 'sendMessage']);
});

// =============== API ROUTES ===============
Route::post('/api/login', [AuthController::class, 'login'])->name('api.login');
Route::middleware('auth:sanctum')->get('/api/user', function (Request $request) {
    return $request->user();
});

require __DIR__.'/auth.php';