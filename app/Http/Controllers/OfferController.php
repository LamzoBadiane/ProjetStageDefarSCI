<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;

class OfferController extends Controller
{
    /**
     * Affiche la liste des offres avec filtres et recherche
     */
    public function index(Request $request)
    {
        $query = Offer::where('status', 'validée')
            ->whereDate('deadline', '>=', now()); // exclut les offres expirées;
        // 🔍 Recherche par titre ou description
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // 🎯 Filtres dynamiques
        if ($request->filled('domain')) {
            $query->where('domain', $request->domain);
        }
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }
        if ($request->filled('deadline')) {
            $query->whereDate('deadline', '<=', $request->deadline);
        }

        // 📜 Pagination 9 offres par page
        $offers = $query->paginate(9);

        // 🔖 Exemple : favoris simulés (à remplacer par DB ou session)
        $favorites = []; // $request->user()->favorites()->pluck('offer_id')->toArray();

        return view('offers.index', compact('offers', 'favorites'));
    }

    /**
     * Affiche le détail d'une offre spécifique
     */
    public function show($id) {
        $offer = Offer::find($id);
        if (!$offer) {
            abort(404, "Offre non trouvée !");
        }
        return view('offers.show', compact('offer'));
    }
    public function toggleFavorite($offerId)
    {
        $user = auth()->user();
        if ($user->favorites()->where('offer_id', $offerId)->exists()) {
            $user->favorites()->detach($offerId);
        } else {
            $user->favorites()->attach($offerId);
        }
        return back()->with('success', 'Favoris mis à jour.');
    }

}
