<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VerificationController extends Controller
{
    public function index()
    {
        $company = Auth::guard('company')->user();

        // Si l'entreprise est encore en attente ET qu'il manque des infos de vérification
        if (
            $company->status === 'pending' &&
            (!$company->ninea || !$company->rccm || !$company->company_story || !$company->document)
        ) {
            return redirect()->route('company.verification')->with('error', 'Veuillez d’abord compléter vos informations pour la vérification.');
        }

        return view('company.dashboard');
    }
    public function show()
    {
        $company = Auth::guard('company')->user();
        return view('company.verify', compact('company'));
    }

    public function submit(Request $request)
    {
        $company = Auth::guard('company')->user();

        $request->validate([
            'ninea' => 'required|string|max:100',
            'rccm' => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'contact_phone' => 'required|string|max:50',
            'contact_email' => 'required|email|max:100',
            'company_story' => 'required|string|max:1000',
            'document' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $path = $request->file('document')->store('documents/companies', 'public');

        $company->update([
            'ninea' => $request->ninea,
            'rccm' => $request->rccm,
            'address' => $request->address,
            'contact_phone' => $request->contact_phone,
            'contact_email' => $request->contact_email,
            'company_story' => $request->company_story,
            'document' => $path,
            'status' => 'pending', // En attente de validation
        ]);

        return redirect()->back()->with('success', '✅ Votre demande de vérification a été soumise avec succès. Elle sera examinée par l’administration.');
    }
}
