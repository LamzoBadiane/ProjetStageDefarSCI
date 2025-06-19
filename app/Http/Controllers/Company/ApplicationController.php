<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\CompanyActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function index()
    {
        $companyId = Auth::guard('company')->id();

        $applications = Application::with(['user','offer'])
            ->whereHas('offer', fn($q) => $q->where('company_id', $companyId))
            ->orderByDesc('created_at')
            ->paginate(10);

        CompanyActivityLog::create([
            'company_id' => $companyId,
            'type'       => 'consultation_candidatures',
            'message'    => 'Liste des candidatures reçues consultée.',
            'data'       => null,
        ]);

        return view('company.applications.index', compact('applications'));
    }

    public function show($id)
    {
        $application = Application::with(['user','offer'])
            ->whereHas('offer', fn($q) => $q->where('company_id', Auth::guard('company')->id()))
            ->findOrFail($id);

        CompanyActivityLog::create([
            'company_id' => Auth::guard('company')->id(),
            'type'       => 'consultation_candidature',
            'message'    => "Détail de la candidature #{$id} consulté.",
            'data'       => null,
        ]);

        return view('company.applications.show', compact('application'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:en attente,acceptée,refusée,embauchée'
        ]);

        $application = Application::findOrFail($id);

        // Vérifie que l'offre appartient bien à l'entreprise
        if ($application->offer->company_id != Auth::guard('company')->id()) {
            abort(403, 'Action non autorisée.');
        }

        $old = $application->status;
        $application->status = $request->status;
        $application->save();

        CompanyActivityLog::create([
            'company_id' => Auth::guard('company')->id(),
            'type'       => 'changement_statut_candidature',
            'message'    => "Statut de la candidature #{$id} changé de « {$old} » à « {$application->status} ».",
            'data'       => json_encode(['old'=>$old,'new'=>$application->status]),
        ]);

        return back()->with('success', 'Statut mis à jour avec succès.');
    }
}
