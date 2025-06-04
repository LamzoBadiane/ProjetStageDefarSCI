<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfferController extends Controller
{
    public function index()
    {
        $offers = Offer::where('company_id', Auth::guard('company')->id())
                       ->orderByDesc('created_at')
                       ->paginate(10);

        return view('company.offers.index', compact('offers'));
    }

    public function create()
    {
        return view('company.offers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'domain' => 'required|string|max:255',
            'type' => 'required|string|max:50',
            'location' => 'required|string|max:255',
            'deadline' => 'required|date|after_or_equal:today',
        ]);

        Offer::create([
            'company_id' => Auth::guard('company')->id(),
            'title' => $request->title,
            'description' => $request->description,
            'domain' => $request->domain,
            'type' => $request->type,
            'location' => $request->location,
            'deadline' => $request->deadline,
            'status' => 'en_attente', // Toujours créé en attente
        ]);

        return redirect()->route('company.offers.index')->with('success', 'Offre créée avec succès (en attente de validation).');
    }

    public function show(Offer $offer)
    {
        $this->authorizeOffer($offer);
        return view('company.offers.show', compact('offer'));
    }

    public function edit(Offer $offer)
    {
        $this->authorizeOffer($offer);
        return view('company.offers.edit', compact('offer'));
    }

    public function update(Request $request, Offer $offer)
    {
        $this->authorizeOffer($offer);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'domain' => 'required|string|max:255',
            'type' => 'required|string|max:50',
            'location' => 'required|string|max:255',
            'deadline' => 'required|date|after_or_equal:today',
        ]);

        $offer->update($request->only('title', 'description', 'domain', 'type', 'location', 'deadline'));

        return redirect()->route('company.offers.index')->with('success', 'Offre mise à jour avec succès.');
    }

    public function destroy(Offer $offer)
    {
        $this->authorizeOffer($offer);
        $offer->delete();

        return redirect()->route('company.offers.index')->with('success', 'Offre supprimée avec succès.');
    }

    public function updateStatus(Request $request, Offer $offer)
    {
        $this->authorizeOffer($offer);

        $request->validate([
            'status' => 'required|in:en_attente,validée', // Statuts valides uniquement
        ]);

        $offer->status = $request->status;
        $offer->save();

        return redirect()->route('company.offers.index')->with('success', 'Statut de l\'offre mis à jour avec succès.');
    }

    private function authorizeOffer(Offer $offer)
    {
        if ($offer->company_id !== Auth::guard('company')->id()) {
            abort(403, 'Accès non autorisé.');
        }
    }
}
