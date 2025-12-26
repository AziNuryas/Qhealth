<?php
// app/Http\Controllers\AdminController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Question;
use App\Models\Answer;

class AdminController extends Controller
{
    public function index()
    {
        // Cek role admin
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect('/dashboard')->with('error', 'Akses ditolak.');
        }
        
        // Ambil data untuk dashboard
        $data = [
            'userCount' => User::count(),
            'questionCount' => Question::count(),
            'answerCount' => Answer::count(),
            'recentUsers' => User::latest()->take(5)->get(),
        ];
        
        // Kirim data ke view
        return view('admin.index', $data);
    }
}