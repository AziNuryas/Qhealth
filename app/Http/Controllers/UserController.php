<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function edit()
    {
        return view('profile');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'gender' => 'required|in:male,female',
            'phone' => 'required|string|max:20',
        ]);

        $user->update($validated);

        return Redirect::route('profile.show')->with('status', 'profile-updated');
    }
}