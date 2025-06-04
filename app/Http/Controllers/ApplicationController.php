<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Offer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    /**
     * Liste des candidatures de l'utilisateur connecté.
     */
    public function index()
    {
        $applications = Application::where('user_id', Auth::id())
            ->with('offer')
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('applications.index', compact('applications'));
    }

    /**
     * Affiche le détail d'une candidature.
     */
    public function show($id)
    {
        $application = Application::with('offer')->findOrFail($id);
        return view('applications.show', compact('application'));
    }

    /**
     * Enregistre une nouvelle candidature.
     */
    public function store(Request $request, $offerId)
    {
        $request->validate([
            'motivation_text' => 'nullable|string|max:1000',
            'motivation_file' => 'nullable|mimes:pdf,doc,docx|max:2048',
        ]);

        $offer = Offer::findOrFail($offerId);

        // Vérifier si l'utilisateur a déjà postulé
        $existing = Application::where('user_id', Auth::id())
            ->where('offer_id', $offerId)
            ->first();

        if ($existing) {
            return back()->with('warning', 'Vous avez déjà postulé à cette offre.');
        }

        // Gestion du fichier motivation (PDF/DOC)
        $motivationPath = null;
        if ($request->hasFile('motivation_file')) {
            $motivationFile = $request->file('motivation_file');
            $motivationPath = $motivationFile->store('motivations', 'public');
        }

        // Créer la candidature
        Application::create([
            'user_id' => Auth::id(),
            'offer_id' => $offerId,
            'motivation' => $request->input('motivation_text'),
            'motivation_file' => $motivationPath,
            'status' => 'en attente',
        ]);

        return redirect()->route('applications.index')->with('success', 'Votre candidature a été envoyée avec succès.');
    }

    public function edit($id)
    {
        $application = Application::with('offer')->findOrFail($id);

        // Empêcher la modification si le statut est bloqué
        if (in_array($application->status, ['refusée', 'acceptée', 'embauchée'])) {
            return redirect()->route('applications.index')
                ->with('warning', 'Vous ne pouvez plus modifier cette candidature.');
        }

        return view('applications.edit', compact('application'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'motivation' => 'nullable|string|max:1000',
            'motivation_file' => 'required|mimes:pdf,doc,docx|max:2048',
            'status' => 'nullable|in:en attente,acceptée,refusée',
        ]);

        $application = Application::findOrFail($id);
        $application->motivation = $request->input('motivation');

        if ($request->filled('status')) {
            $application->status = $request->input('status');
        }

        if ($request->hasFile('motivation_file')) {
            if ($application->motivation_file) {
                Storage::disk('public')->delete($application->motivation_file);
            }
            $application->motivation_file = $request->file('motivation_file')->store('motivations', 'public');
        }

        $application->save();

        return redirect()->route('applications.show', $id)->with('success', 'Candidature mise à jour avec succès.');
    }


    public function destroy($id)
    {
        $application = Application::findOrFail($id);

        if ($application->motivation_file) {
            Storage::disk('public')->delete($application->motivation_file);
        }

        $application->delete();

        return redirect()->route('applications.index')->with('success', 'Candidature supprimée avec succès.');
    }

}