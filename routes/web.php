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
use Illuminate\Http\Request;



// Rute untuk admin (dengan middleware auth dan admin)
Route::middleware(['auth', 'admin'])->group(function () {
    // Rute untuk dashboard admin
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    
  // Route untuk mengelola Pengguna
    Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [AdminUserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [AdminUserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{user}', [AdminUserController::class, 'show'])->name('admin.users.show');
    Route::get('/admin/users/{user}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit'); // route edit manual
    Route::put('/admin/users/{user}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
    
    // Route untuk mengelola Pertanyaan
    Route::get('/admin/questions', [AdminQuestionController::class, 'index'])->name('admin.questions.index');
    Route::get('/admin/questions/create', [AdminQuestionController::class, 'create'])->name('admin.questions.create');
    Route::post('/admin/questions', [AdminQuestionController::class, 'store'])->name('admin.questions.store');
    Route::get('/admin/questions/{question}', [AdminQuestionController::class, 'show'])->name('admin.questions.show');
    Route::get('/admin/questions/{question}/edit', [AdminQuestionController::class, 'edit'])->name('admin.questions.edit');
    Route::put('/admin/questions/{question}', [AdminQuestionController::class, 'update'])->name('admin.questions.update');
    Route::delete('/admin/questions/{question}', [AdminQuestionController::class, 'destroy'])->name('admin.questions.destroy');
    Route::get('admin/answers', [AdminAnswerController::class, 'index'])->name('admin.answers.index');
    Route::get('admin/answers/{id}', [AdminAnswerController::class, 'show'])->name('admin.answers.show');
    Route::get('admin/answers/{id}/edit', [AdminAnswerController::class, 'edit'])->name('admin.answers.edit');
    Route::delete('admin/answers/{id}', [AdminAnswerController::class, 'destroy'])->name('admin.answers.destroy');
    Route::get('/admin/answers/{id}', [AdminAnswerController::class, 'show'])->name('admin.answers.show');


});
// Rute untuk pengguna biasa (auth)
Route::middleware('auth')->group(function () {
    // Dashboard untuk pengguna biasa
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard', [DashboardController::class, 'store'])->name('dashboard.store');
    
    // Profil pengguna
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Pertanyaan
    Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');
    Route::get('/questions/{id}', [QuestionController::class, 'show'])->name('questions.show');
    Route::get('/pertanyaan', [QuestionController::class, 'index'])->name('questions.index');
    Route::get('/questions/{id}/answer', [QuestionController::class, 'answerForm'])->name('questions.answer.form');
    Route::post('/questions/{id}/answer', [QuestionController::class, 'answer'])->name('questions.answer.store');
});

Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Rute publik (tanpa autentikasi)
Route::get('/', fn () => view('welcome'))->name('home');
Route::get('/bmi', [BmiController::class, 'index'])->name('bmi');

// Rute autentikasi
Route::middleware(['auth', 'verified'])->group(function () {
    // Route Logout
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    // Route Login
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

// Memuat route autentikasi
require __DIR__.'/auth.php';
