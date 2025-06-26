<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisteredCompanyController extends Controller
{
    public function create() {
        return view('auth.company-register');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'sector' => 'required|string|max:255',
            'description' => 'nullable|string',
            'contact_name' => 'required|string|max:255',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:100',
            'email' => 'required|email|unique:companies,email',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $company = Company::create([
            'name' => $request->name,
            'sector' => $request->sector,
            'description' => $request->description,
            'logo' => null, // Gestion du logo plus tard
            'contact_name' => $request->contact_name,
            'contact_email' => $request->contact_email,
            'contact_phone' => $request->contact_phone,
            'address' => $request->address,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'country' => $request->country,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 'en attente',
        ]);

        Auth::guard('company')->login($company);
        return redirect()->route('company.dashboard')->with('success', 'Votre compte entreprise a été créé.');
    }
}
