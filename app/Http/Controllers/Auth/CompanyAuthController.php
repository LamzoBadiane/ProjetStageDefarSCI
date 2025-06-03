<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyAuthController extends Controller
{
    public function showLoginForm() {
        return view('auth.company-login');
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('company')->attempt($request->only('email', 'password'))) {
            return redirect()->route('company.dashboard')->with('success', 'Bienvenue dans votre espace entreprise.');
        }

        return back()->withErrors(['email' => 'Email ou mot de passe incorrect.']);
    }

    public function logout() {
        Auth::guard('company')->logout();
        return redirect()->route('company.login')->with('success', 'Vous êtes déconnecté.');
    }
}
