<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('backend.auth.login');
    }

    public function request(Request $req)
    {

        $req->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt($req->only('email', 'password'))) {
            return redirect()->intended('/admin');
        }

        return redirect()->route('home')->withErrors(['email' => 'Invalid credentials.'])->withInput();
    }



    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
