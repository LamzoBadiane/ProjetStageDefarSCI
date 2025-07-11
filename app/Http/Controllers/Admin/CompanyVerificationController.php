<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyVerificationController extends Controller
{
    public function index(Request $request)
    {
        $companies = Company::where('status', 'en attente')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.companies.verification.index', compact('companies'));
    }

    public function approve($id)
    {
        $company = Company::findOrFail($id);
        $company->update(['status' => 'validée']);

        return redirect()->route('admin.verifications.index')->with('success', '✅ Entreprise validée.');
    }

    public function reject($id)
    {
        $company = Company::findOrFail($id);
        $company->update(['status' => 'refusée']);

        return redirect()->route('admin.verifications.index')->with('danger', '❌ Entreprise refusée.');
    }
}
