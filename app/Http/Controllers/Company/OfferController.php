<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\CompanyActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfferController extends Controller
{
    public function index()
    {
        $offers = Offer::where('company_id', Auth::guard('company')->id())
                       ->orderByDesc('created_at')
                       ->paginate(10);

        // Log
        CompanyActivityLog::create([
            'company_id' => Auth::guard('company')->id(),
            'type'       => 'consultation_offres',
            'message'    => 'Liste des offres consultée.',
            'data'       => null,
        ]);

        return view('company.offers.index', compact('offers'));
    }

    public function create()
    {
        // Log
        CompanyActivityLog::create([
            'company_id' => Auth::guard('company')->id(),
            'type'       => 'create_offre_page',
            'message'    => 'Page de création d’une offre ouverte.',
            'data'       => null,
        ]);

        return view('company.offers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'domain'      => 'required|string|max:255',
            'type'        => 'required|string|max:50',
            'location'    => 'required|string|max:255',
            'deadline'    => 'required|date|after_or_equal:today',
        ]);

        $offer = Offer::create([
            'company_id' => Auth::guard('company')->id(),
            'title'      => $request->title,
            'description'=> $request->description,
            'domain'     => $request->domain,
            'type'       => $request->type,
            'location'   => $request->location,
            'deadline'   => $request->deadline,
            'status'     => 'en_attente',
        ]);

        CompanyActivityLog::create([
            'company_id' => $offer->company_id,
            'type'       => 'creation_offre',
            'message'    => "Offre « {$offer->title} » créée (en attente).",
            'data'       => json_encode($offer->toArray()),
        ]);

        return redirect()->route('company.offers.index')
                         ->with('success', 'Offre créée avec succès (en attente de validation).');
    }

    public function show(Offer $offer)
    {
        $this->authorizeOffer($offer);

        CompanyActivityLog::create([
            'company_id' => $offer->company_id,
            'type'       => 'consultation_offre',
            'message'    => "Détail de l’offre « {$offer->title} » consulté.",
            'data'       => null,
        ]);

        return view('company.offers.show', compact('offer'));
    }

    public function edit(Offer $offer)
    {
        $this->authorizeOffer($offer);

        CompanyActivityLog::create([
            'company_id' => $offer->company_id,
            'type'       => 'edition_offre_page',
            'message'    => "Page d’édition de l’offre « {$offer->title} » ouverte.",
            'data'       => null,
        ]);

        return view('company.offers.edit', compact('offer'));
    }

    public function update(Request $request, Offer $offer)
    {
        $this->authorizeOffer($offer);

        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'domain'      => 'required|string|max:255',
            'type'        => 'required|string|max:50',
            'location'    => 'required|string|max:255',
            'deadline'    => 'required|date|after_or_equal:today',
        ]);

        $old = $offer->toArray();
        $offer->update($request->only('title','description','domain','type','location','deadline'));

        CompanyActivityLog::create([
            'company_id' => $offer->company_id,
            'type'       => 'modification_offre',
            'message'    => "Offre « {$offer->title} » mise à jour.",
            'data'       => json_encode([
                'before' => $old,
                'after'  => $offer->toArray(),
            ]),
        ]);

        return redirect()->route('company.offers.index')
                         ->with('success', 'Offre mise à jour avec succès.');
    }

    public function destroy(Offer $offer)
    {
        $this->authorizeOffer($offer);
        $title = $offer->title;
        $offer->delete();

        CompanyActivityLog::create([
            'company_id' => Auth::guard('company')->id(),
            'type'       => 'suppression_offre',
            'message'    => "Offre « {$title} » supprimée.",
            'data'       => null,
        ]);

        return redirect()->route('company.offers.index')
                         ->with('success', 'Offre supprimée avec succès.');
    }

    public function updateStatus(Request $request, Offer $offer)
    {
        $this->authorizeOffer($offer);

        $request->validate(['status' => 'required|in:en_attente,validée']);

        $oldStatus = $offer->status;
        $offer->status = $request->status;
        $offer->save();

        CompanyActivityLog::create([
            'company_id' => $offer->company_id,
            'type'       => 'changement_statut_offre',
            'message'    => "Statut de l’offre « {$offer->title} » changé de « {$oldStatus} » à « {$offer->status} ».",
            'data'       => json_encode(['old' => $oldStatus, 'new' => $offer->status]),
        ]);

        return redirect()->route('company.offers.index')
                         ->with('success', 'Statut de l’offre mis à jour avec succès.');
    }

    private function authorizeOffer(Offer $offer)
    {
        if ($offer->company_id !== Auth::guard('company')->id()) {
            abort(403, 'Accès non autorisé.');
        }
    }
}
