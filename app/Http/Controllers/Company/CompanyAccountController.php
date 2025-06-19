<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class CompanyAccountController extends Controller
{
    /**
     * Affiche la page "Mon compte".
     */
    public function edit()
    {
        $company = Auth::guard('company')->user();
    return view('company.account.index', compact('company'));
    }

    /**
     * Met à jour les informations générales (nom, email).
     */
    public function update(Request $request)
    {
        $company = Auth::guard('company')->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|max:255|unique:companies,email,{$company->id}",
        ]);

        $company->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return back()->with('success', '✅ Informations mises à jour avec succès.');
    }

    /**
     * Change le mot de passe.
     */
    public function updatePassword(Request $request)
    {
        $company = Auth::guard('company')->user();

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, $company->password)) {
            throw ValidationException::withMessages([
                'current_password' => 'Le mot de passe actuel est incorrect.',
            ]);
        }

        $company->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', '🔐 Mot de passe mis à jour avec succès.');
    }

    /**
     * Supprime le compte entreprise.
     */
    public function destroy(Request $request)
    {
        $company = Auth::guard('company')->user();

        Auth::guard('company')->logout();

        $company->delete();

        return redirect('/')->with('success', 'Votre compte a été supprimé.');
    }
}
