<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyVerificationController extends Controller
{
    public function index(Request $request)
    {
        $companies = Company::where('status', 'pending')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.companies.verification.index', compact('companies'));
    }

    public function show($id)
    {
        $company = Company::findOrFail($id);
        return view('admin.companies.verification.show', compact('company'));
    }

    public function approve($id)
    {
        $company = Company::findOrFail($id);
        $company->update(['status' => 'validated']);

        return redirect()->route('admin.verifications.index')->with('success', '✅ Entreprise validée.');
    }

    public function reject($id)
    {
        $company = Company::findOrFail($id);
        $company->update(['status' => 'rejected']);

        return redirect()->route('admin.verifications.index')->with('danger', '❌ Entreprise refusée.');
    }
}
