<?php

namespace App\Http\Controllers;

use App\Models\Company;

class PublicCompanyController extends Controller
{
    public function show($id)
    {
        $company = Company::findOrFail($id);

        return view('public.company_profile', compact('company'));
    }
}
