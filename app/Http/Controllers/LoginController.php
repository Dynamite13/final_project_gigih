<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function postLogin(RequestLogin $request)
    {
        $validated = $request->validated();

        if (Auth::attempt($validated, $request->has('remember') ? true : false)) {
            return redirect()->route('home')->with('success', 'Selamat datang ' . Auth::user()->username);
        }
        return back()->with('error', 'Username atau password salah');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Anda telah logout');
    }
}
