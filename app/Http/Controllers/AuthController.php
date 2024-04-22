<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function registerForm()
    {
        return view('auth.register');
    }

    public function register( Request $request )
    {
        $validated = $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email:rfc,dns|max:255',
        'password' => 'required|min:6'
    ]);

    DB::table('users')->insert([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
    ]);

    $user = DB::table('users')->where('email', $validated['email'])->first();
    Auth::loginUsingId($user->id);
    return redirect('/email/verify/');
    }
    
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login( Request $request )
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->input('remember');

        if (Auth::attempt($credentials , $remember)) {
            $request->session()->regenerate();

            return redirect('/tasks');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
