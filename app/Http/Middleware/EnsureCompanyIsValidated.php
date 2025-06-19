<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureCompanyIsValidated {
    public function handle(Request $request, Closure $next) {
        $company = Auth::guard('company')->user();

        if (!$company) {
            return redirect()->route('company.login');
        }

        if ($company->status === 'refusée') {
            return redirect()->route('company.refused');
        }

        if ($company->status === 'en attente') {
            if (
                !$company->ninea ||
                !$company->rccm ||
                !$company->company_story ||
                !$company->document
            ) {
                return redirect()->route('company.verification')
                    ->with('error', 'Merci de compléter vos informations pour vérification.');
            }

            return redirect()->route('company.awaiting');
        }

        return $next($request);
    }
}