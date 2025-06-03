<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**
     * Affiche la liste des candidatures reçues par l'entreprise.
     */
    public function index()
    {
        $applications = Application::with(['user', 'offer'])
            ->whereHas('offer', function ($query) {
                $query->where('company_id', auth()->guard('company')->id());
            })
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('company.applications.index', compact('applications'));
    }

    /**
     * Affiche le détail d'une candidature spécifique.
     */
    public function show($id)
    {
        $application = Application::with(['user', 'offer'])
            ->whereHas('offer', function ($query) {
                $query->where('company_id', auth()->guard('company')->id());
            })
            ->findOrFail($id);

        return view('company.applications.show', compact('application'));
    }

    /**
     * Met à jour le statut d'une candidature (par exemple marquer comme "embauchée").
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:en attente,acceptée,refusée,embauchée',
        ]);

        $application = Application::with('offer')
            ->whereHas('offer', function ($query) {
                $query->where('company_id', auth()->guard('company')->id());
            })
            ->findOrFail($id);

        $application->status = $request->input('status');
        $application->save();

        return back()->with('success', 'Statut mis à jour avec succès.');
    }
}
