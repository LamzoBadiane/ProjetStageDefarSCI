<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Setting;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register', [
            'settings' => [
                'registration_students_enabled' => Setting::get('registration_students_enabled', 'yes'),
                'registration_companies_enabled' => Setting::get('registration_companies_enabled', 'yes'),
                'registration_admins_enabled' => Setting::get('registration_admins_enabled', 'no'),
            ]
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => 'required|in:student,company,admin',
        ]);

        // ❌ Vérification avant création
        if ($request->role === 'student' && Setting::get('registration_students_enabled') !== 'yes') {
            return redirect()->route('register')->withErrors(['role' => 'Les inscriptions pour les étudiants sont désactivées.']);
        }

        if ($request->role === 'company' && Setting::get('registration_companies_enabled') !== 'yes') {
            return redirect()->route('register')->withErrors(['role' => 'Les inscriptions pour les entreprises sont désactivées.']);
        }
        if ($request->role === 'admin' && Setting::get('registration_admins_enabled') !== 'yes') {
            return redirect()->route('register')->withErrors(['role' => 'Les inscriptions pour les administrateurs sont désactivées.']);
        }
        // ✅ Création de l'utilisateur
        $user = User::create([
            'first_name' => $request->first_name,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        event(new Registered($user));

        return redirect()->route('login')->with('status', 'Inscription réussie ! Vous pouvez maintenant vous connecter.');
    }

}
