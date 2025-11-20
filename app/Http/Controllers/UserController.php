<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;

class UserController extends Controller
{
    public function edit()
    {
        return view('profile');
    }

   public function update(Request $request)
{   
    /** @var \App\Models\User $user */
    $user = Auth::user();

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'gender' => 'required|in:male,female',
        'phone' => 'required|string|max:20',
    ]);

    $user->update($validated);

    return Redirect::route('profile.show')->with('status', 'profile-updated');
}}