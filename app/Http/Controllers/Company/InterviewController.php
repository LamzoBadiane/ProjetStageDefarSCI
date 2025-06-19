<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Interview;
use App\Models\User;
use App\Models\Offer;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InterviewController extends Controller
{
    /**
     * Affiche la liste des entretiens + calendrier.
     */
    public function index()
    {
        $companyId = Auth::guard('company')->id();

        $interviews = Interview::with(['user.student', 'offer'])
            ->where('company_id', $companyId)
            ->latest()
            ->get();

        $calendarEvents = $interviews->map(function ($interview) {
            $fullName = $interview->user->student->first_name . ' ' . $interview->user->student->last_name;
            return [
                'title' => $fullName,
                'start' => $interview->date . 'T' . $interview->time,
                'description' => $interview->offer->title ?? 'Entretien',
            ];
        });

        return view('company.interviews.index', compact('interviews', 'calendarEvents'));
    }

    /**
     * Formulaire pour programmer un nouvel entretien.
     */
    public function create()
    {
        $companyId = Auth::guard('company')->id();

        $applications = Application::with(['user.student', 'offer'])
            ->whereHas('offer', fn ($q) => $q->where('company_id', $companyId))
            ->where('status', 'acceptée')
            ->get();

        $students = $applications->pluck('user')->unique('id');
        $offers = $applications->pluck('offer')->unique('id');

        return view('company.interviews.create', compact('students', 'offers', 'applications'));
    }

    /**
     * Enregistre un nouvel entretien.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'offer_id' => 'nullable|exists:offers,id',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'mode' => 'required|in:en ligne,présentiel',
            'location' => 'nullable|string|max:255',
            'message' => 'nullable|string|max:1000',
        ]);

        $application = Application::where('user_id', $request->user_id)
            ->when($request->offer_id, fn ($q) => $q->where('offer_id', $request->offer_id))
            ->where('status', 'acceptée')
            ->first();

        if (! $application) {
            return back()->withErrors(['user_id' => '❌ Cette candidature n’est pas encore acceptée.'])->withInput();
        }

        // Générer un lien visio automatique si en ligne
        $location = $request->mode === 'en ligne'
            ? 'https://meet.google.com/' . substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 0, 3) . '-' . rand(100,999) . '-' . rand(100,999)
            : $request->location;

        Interview::create([
            'company_id' => Auth::guard('company')->id(),
            'user_id' => $request->user_id,
            'application_id' => $application->id,
            'offer_id' => $request->offer_id,
            'date' => $request->date,
            'time' => $request->time,
            'mode' => $request->mode,
            'location' => $location,
            'message' => $request->message,
            'status' => 'prévu',
        ]);

        return redirect()->route('company.interviews.index')->with('success', '✅ Entretien programmé avec succès.');
    }

    /**
     * Affiche les détails d’un entretien (modifiable).
     */
    public function show($id)
    {
        $interview = Interview::with(['user.student', 'offer'])->findOrFail($id);

        if ($interview->company_id !== Auth::guard('company')->id()) {
            abort(403);
        }

        return view('company.interviews.show', compact('interview'));
    }

    /**
     * Met à jour un entretien existant.
     */
    public function update(Request $request, $id)
    {
        $interview = Interview::findOrFail($id);

        if ($interview->company_id !== Auth::guard('company')->id()) {
            abort(403);
        }

        $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'mode' => 'required|in:en ligne,présentiel',
            'location' => 'nullable|string|max:255',
            'status' => 'required|in:prévu,annulé,terminé',
        ]);

        $interview->update([
            'date' => $request->date,
            'time' => $request->time,
            'mode' => $request->mode,
            'location' => $request->mode === 'en ligne'
                ? $interview->location
                : $request->location,
            'status' => $request->status,
        ]);

        return redirect()->route('company.interviews.index')->with('success', '✅ Entretien mis à jour.');
    }

    /**
     * Supprime un entretien.
     */
    public function destroy($id)
    {
        $interview = Interview::findOrFail($id);

        if ($interview->company_id !== Auth::guard('company')->id()) {
            abort(403);
        }

        $interview->delete();

        return back()->with('success', '🗑️ Entretien supprimé.');
    }
    public function edit($id)
    {
        $interview = Interview::with('user.student', 'offer')->findOrFail($id);

        // Vérification de propriété
        if ($interview->company_id !== Auth::guard('company')->id()) {
            abort(403);
        }

        // Liste des offres de l'entreprise
        $offers = Offer::where('company_id', Auth::guard('company')->id())->get();

        return view('company.interviews.edit', compact('interview', 'offers'));
    }

}