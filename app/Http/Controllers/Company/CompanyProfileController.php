<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Company;
use App\Models\CompanyActivityLog;

class CompanyProfileController extends Controller
{
    /**
     * Affiche le formulaire de modification du profil entreprise.
     */
    public function edit()
    {
        $company = Auth::guard('company')->user();
        return view('company.profile.edit', compact('company'));
    }

    /**
     * Met à jour les informations du profil entreprise.
     */
    public function update(Request $request)
    {
        $company = Company::findOrFail(Auth::guard('company')->id());

        // Validation complète
        $request->validate([
            'name'           => 'required|string|max:255',
            'sector'         => 'required|string|max:255',
            'description'    => 'nullable|string',
            'contact_name'   => 'required|string|max:255',
            'contact_email'  => 'required|email|max:255',
            'contact_phone'  => 'required|string|max:30',
            'address'        => 'required|string|max:255',
            'city'           => 'nullable|string|max:100',
            'postal_code'    => 'nullable|string|max:20',
            'country'        => 'nullable|string|max:100',
            'ninea'          => 'nullable|string|max:255',
            'rccm'           => 'nullable|string|max:255',
            'company_story'  => 'nullable|string',
            'document'       => 'nullable|mimes:pdf,jpg,jpeg,png|max:5120',
            'logo'           => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Gérer le logo
        if ($request->hasFile('logo')) {
            if ($company->logo) {
                Storage::disk('public')->delete($company->logo);
            }
            $company->logo = $request->file('logo')->store('logos', 'public');
        }

        // Gérer le document justificatif
        if ($request->hasFile('document')) {
            if ($company->document) {
                Storage::disk('public')->delete($company->document);
            }
            $company->document = $request->file('document')->store('documents', 'public');
        }

        // Mettre à jour tous les champs
        $company->update([
            'name'           => $request->name,
            'sector'         => $request->sector,
            'description'    => $request->description,
            'contact_name'   => $request->contact_name,
            'contact_email'  => $request->contact_email,
            'contact_phone'  => $request->contact_phone,
            'address'        => $request->address,
            'city'           => $request->city,
            'postal_code'    => $request->postal_code,
            'country'        => $request->country,
            'ninea'          => $request->ninea,
            'rccm'           => $request->rccm,
            'company_story'  => $request->company_story,
        ]);

        // Journalisation
        CompanyActivityLog::create([
            'company_id' => $company->id,
            'type' => 'modification_profil',
            'message' => 'L\'entreprise a mis à jour son profil.',
            'data' => json_encode($request->except(['_token', '_method', 'logo', 'document'])),
        ]);

        return back()->with('success', '✅ Profil mis à jour avec succès. Il sera vérifié par l’administration.');
    }

    public function showPublic($id)
    {
        $company = Company::findOrFail($id);

        // Journaliser uniquement si un étudiant connecté consulte
        if (Auth::check()) {
            $user = Auth::user();
            $student = $user->student; // relation student() dans User.php

            CompanyActivityLog::create([
                'company_id' => $company->id,
                'type'       => 'consultation_profil',
                'message'    => 'Un étudiant a consulté le profil de l’entreprise.',
                'data'       => json_encode([
                    'etudiant_id' => $user->id,
                    'nom'         => $user->name ?? '',
                    'prenom'      => $user->first_name ?? '',
                ]),
            ]);
        }

        return view('public.company_profile', compact('company'));
    }
    public function show()
    {
        $company = Auth::guard('company')->user();
        return view('company.profile.show', compact('company'));
    }
}
