<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function edit(Request $request){
        return Inertia::render('Profile/Edit', [
            'user' => $request->user(),
            'status' => session('status'),
        ]);
    }

    public function updateInfo(Request $request){


       $fields = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255',
                Rule::unique('users', 'email')->ignore($request->user()->id),
                'lowercase'],
        ]);

       $request->user()->fill($fields);

       if($request->user()->isDirty('email')){
           $request->user()->email_verified_at = null;
       }

       $request->user()->save();

       return Redirect::route('profile.edit')->with('success', 'Your profile has been updated.');
    }

    public function updatePassword(Request $request){

        $fields = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($fields['password']),
        ]);

        return Redirect::route('profile.edit')->with('success', 'Your password has been changed.');

    }

    public function destroy(Request $request){
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return Redirect::route('home');
    }
}
