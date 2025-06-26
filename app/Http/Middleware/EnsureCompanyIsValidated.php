<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureCompanyIsValidated
{
    public function handle(Request $request, Closure $next)
    {
        $company = Auth::guard('company')->user();

        if (!$company) {
            return redirect()->route('company.login');
        }

        // Redirection vers la page de vérification si les infos sont incomplètes
        if (
            $company->status === 'en attente' &&
            (
                !$company->ninea ||
                !$company->rccm ||
                !$company->company_story ||
                !$company->document
            )
        ) {
            return redirect()->route('company.verification')
                ->with('error', 'Veuillez compléter vos informations pour vérification.');
        }

        // Si refusée → message refus
        if ($company->status === 'refusée') {
            return redirect()->route('company.refused');
        }

        // Si en attente mais avec tout rempli → redirection vers la page "en attente"
        if ($company->status === 'en attente') {
            return redirect()->route('company.awaiting');
        }

        // Sinon tout est bon, continuer
        return $next($request);
    }
}
