<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
    public function show()
    {
        $user = User::find(Session::get('user_id'));
        return view('profile.show', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::find(Session::get('user_id'));
        $request->validate([
        'name' => 'required',
        'email' => 'required|email'
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
        }

        $user->save();
        
        return back()->with('success', 'Profile updated successfully');
    }
}
