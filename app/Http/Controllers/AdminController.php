<?php

namespace App\Http\Controllers;

use App\Models\User; // Correct import for User model
use App\Models\Question; // Correct import for Question model
use App\Models\Answer; // Correct import for Answer model


use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Ambil jumlah pengguna, pertanyaan, dan jawaban
        $userCount = User::count();
        $questionCount = Question::count();
        $answerCount = Answer::count();

        // Kirim data ke view
        return view('admin.index', compact('userCount', 'questionCount', 'answerCount'));
    }
}