<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function dologin(Request $request)
    {
        // dd($request->all());
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            if (auth()->user()->role == 'admin') {
                return redirect('/admin/dashboard');
            } else {
                return redirect()->route('home');
            }
        } else {
            return redirect()->to('/login')->with('error', 'Login gagal, username / password salah');
        }
    }
    public function dologout()
    {
        Auth::logout();
        session()->flush();
        return redirect('/login');
    }
}
