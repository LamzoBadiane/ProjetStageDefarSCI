<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $query = Company::withCount('offers');

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $companies = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.companies.index', compact('companies'));
    }

    public function show(Company $company)
    {
        $company->load(['offers' => function($query) {
            $query->orderBy('created_at', 'desc');
        }]);

        return view('admin.companies.show', compact('company'));
    }

    public function validateCompany($id) {
        $company = Company::findOrFail($id);
        $company->update(['status' => 'validée', 'rejected_at' => null]);
        return back()->with('success', '✅ Entreprise validée.');
    }

    public function refuseCompany($id) {
        $company = Company::findOrFail($id);
        $company->update(['status' => 'refusée', 'rejected_at' => now()]);
        return back()->with('danger', '❌ Entreprise refusée.');
    }

    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'sector' => 'nullable|string|max:255',
            'contact_name' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'status' => 'required|in:validated,pending,rejected',
        ]);

        $company->update($request->only([
            'name', 'email', 'sector', 'contact_name', 'contact_phone', 'status'
        ]));

        return redirect()->route('admin.companies.show', $company->id)
            ->with('success', '✅ Informations mises à jour avec succès.');
    }

    public function destroy(Company $company)
    {
        $company->delete();

        return back()->with('success', '🗑️ Entreprise supprimée.');
    }
}
