<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\BmiController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;


// Route publik (tanpa autentikasi)
Route::get('/', fn () => view('welcome'))->name('home');

Route::get('/bmi', [BmiController::class, 'index'])->name('bmi');
Route::get('/questions', [QuestionController::class, 'index'])->name('questions.index');
Route::get('/questions/{id}/answer', [QuestionController::class, 'answerForm'])->name('questions.answer.form');
Route::post('/questions/{id}/answer', [QuestionController::class, 'answer'])->name('questions.answer.store');
// routes/web.php






// Route yang memerlukan autentikasi dan verifikasi
Route::middleware(['auth', 'verified'])->group(function () {

    Route::middleware(['auth'])->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard', [DashboardController::class, 'store'])->name('dashboard.store');
    // Route Logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
// Route Login
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);


    // Profil pengguna
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Pertanyaan
    Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');
    Route::get('/questions/{id}', [QuestionController::class, 'show'])->name('questions.show');

    
Route::middleware('auth')->group(function () {
    Route::get('/pertanyaan', [QuestionController::class, 'index'])->name('questions.index');
    Route::post('/pertanyaan', [QuestionController::class, 'store'])->name('questions.store');
    Route::get('/pertanyaan', [QuestionController::class, 'index'])->name('pertanyaan');


});

});

// Memuat route autentikasi
require __DIR__.'/auth.php';