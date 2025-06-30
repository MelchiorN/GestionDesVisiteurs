<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials=$request-> validate([
            'email'=> 'required|email',
            'password'=> 'required',
            'role' => 'required|in:admin,agent,locataire',
        ]);
        if (Auth::attempt([
        'email' => $credentials['email'],
        'password' => $credentials['password'],
        'role' => $credentials['role'],
    ])) {
        $request->session()->regenerate();

        // Redirection selon rôle
        $role = Auth::user()->role;
        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($role === 'agent') {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('locataire.dashboard');
        }
    }

    return back()->withErrors([
        'email' => 'Les identifiants sont incorrects ou le rôle ne correspond pas.',
    ]);
        // if (Auth::attempt($credentials)){
        //     return redirect()-> route('dashboard');
        // }
        // return back()-> withErrors([
        //     'email'=> 'Email ou mot de passe incorrect'
        
        
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}