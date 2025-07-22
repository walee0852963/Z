<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Mime\Part\Multipart\AlternativePart;

class AuthController extends Controller
{
    public function showRegister() {
        return view('register');
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login')->with('success', 'تم إنشاء الحساب بنجاح');
    }

    public function showLogin() {
        return view('login');
    }

  
    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/posts'); // ✔️ ينقلك مباشرة
    }
    

    return back()->withErrors([
        'email' => 'بيانات الدخول غير صحيحة.',
    ]);
    
}


    public function logout() {
        Auth::logout();
        return redirect('/login');
    }
}
