<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    /**
     * Affiche les candidatures reçues par l'entreprise connectée.
     */
    public function index()
    {
        $companyId = Auth::guard('company')->id();

        $applications = Application::with(['user', 'offer'])
            ->whereHas('offer', function ($query) use ($companyId) {
                $query->where('company_id', $companyId);
            })
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('company.applications.index', compact('applications'));
    }

    /**
     * Affiche les détails d'une candidature.
     */
    public function show($id)
    {
        $application = Application::with(['user', 'offer'])
            ->whereHas('offer', function ($query) {
                $query->where('company_id', Auth::guard('company')->id());
            })
            ->findOrFail($id);

        return view('company.applications.show', compact('application'));
    }

    /**
     * Met à jour uniquement le statut d'une candidature.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:en attente,acceptée,refusée,embauchée'
        ]);

        $application = Application::with('offer')->findOrFail($id);

        // Vérifie que l'entreprise possède cette offre
        if ($application->offer->company_id != Auth::guard('company')->id()) {
            abort(403, 'Action non autorisée.');
        }

        $application->status = $request->status;
        $application->save();

        return back()->with('success', 'Statut mis à jour avec succès.');
    }
}
