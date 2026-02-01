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
            'email' => 'required|email',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = 'profile_' . $user->id . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            
            if ($user->profile_image && file_exists(public_path('images/' . $user->profile_image))) {
                unlink(public_path('images/' . $user->profile_image));
            }
            
            $user->profile_image = $imageName;
        }

        $user->save();
        
        return back()->with('success', 'Profile updated successfully');
    }

    public function removeImage()
    {
        $user = User::find(Session::get('user_id'));
        
        if ($user->profile_image && file_exists(public_path('images/' . $user->profile_image))) {
            unlink(public_path('images/' . $user->profile_image));
        }
        
        $user->profile_image = null;
        $user->save();
        
        return back()->with('success', 'Profile image removed successfully');
    }
}
