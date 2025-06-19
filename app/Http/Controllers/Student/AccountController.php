<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Student;

class AccountController extends Controller
{
    /**
     * Affiche le formulaire "Mon compte"
     */
    public function edit()
    {
        $student = Auth::user()->student;

        if (! $student) {
            return redirect()->route('student.profile.create')->with('error', 'Veuillez d’abord compléter votre profil.');
        }
        if ($student) {
            $student->load(['applications.offer.company']);
        }

        $applications = $student->applications()->with(['offer.company'])->latest()->get();
        $interviews = $student->interviews()->with(['company', 'offer'])->latest()->get();

        return view('student.account.edit', compact('student', 'applications', 'interviews'));
    }

    /**
     * Met à jour les infos personnelles
     */
    public function update(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email|max:255',
        ]);

        $student = Auth::user()->student;

        if (! $student) {
            return back()->with('error', 'Profil étudiant non trouvé.');
        }

        $student->update([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
        ]);

        return back()->with('success', '✅ Informations mises à jour.');
    }

    /**
     * Met à jour le mot de passe
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password'      => 'required',
            'password'              => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (! Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => '⛔ Le mot de passe actuel est incorrect.']);
        }

        $user->update(['password' => Hash::make($request->password)]);

        return back()->with('success', '🔐 Mot de passe mis à jour.');
    }

    /**
     * Supprime le compte étudiant
     */
    public function destroy()
    {
        $user = Auth::user();
        $user->student()->delete(); // supprime les infos student
        $user->delete();            // supprime le compte utilisateur

        return redirect('/')->with('success', 'Votre compte a été supprimé.');
    }
}
