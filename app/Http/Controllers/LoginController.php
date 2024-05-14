<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->only('email', 'password');

        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];


        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('/');
        }

        return redirect('/login')->withErrors([
            'email' => 'Invalid credentials'
        ]);
    }  
    
    public function logout() {
        Auth::logout();
        return redirect('/login')->with('destroyed', true);
    }
}
