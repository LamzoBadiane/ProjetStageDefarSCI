<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureCompanyIsVerified
{
    public function handle(Request $request, Closure $next)
    {
        $company = Auth::guard('company')->user();

        if (!$company) {
            return redirect()->route('company.login');
        }

        // Redirection vers le formulaire de vérification si infos manquantes
        if (
            $company->status === 'pending' &&
            (
                !$company->ninea ||
                !$company->rccm ||
                !$company->company_story ||
                !$company->document
            )
        ) {
            return redirect()->route('company.verification')
                ->with('error', 'Merci de compléter vos informations pour vérification.');
        }

        // Redirection vers "en attente" si infos OK mais admin n’a pas encore validé
        if ($company->status === 'pending') {
            return redirect()->route('company.awaiting')
                ->with('warning', 'Votre compte est en cours de validation.');
        }

        // Si rejeté
        if ($company->status === 'rejected') {
            abort(403, 'Votre compte a été refusé. Contactez un administrateur.');
        }

        return $next($request);
    }
}
