<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function store(Request $req, $id)
    {
        $req->validate(['body' => 'required']);
        return response()->json(['id' => rand(100, 999), 'body' => $req->body], 201);
    }
}