<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index(Request $request)
    {
        $query = Offer::with('company')->latest();

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $offers = $query->paginate(10);

        return view('admin.offers.index', compact('offers'));
    }

    public function show($id)
    {
        $offer = Offer::with('company')->findOrFail($id);
        return view('admin.offers.show', compact('offer'));
    }

    public function updateStatus(Request $request, $id)
    {
        $offer = Offer::findOrFail($id);

        $request->validate([
            'status' => 'required|in:validée,en_attente'
        ]);

        $offer->update(['status' => $request->status]);

        return back()->with('success', '✅ Statut mis à jour avec succès.');
    }

    public function destroy($id)
    {
        Offer::destroy($id);
        return redirect()->route('admin.offers.index')->with('success', '🗑️ Offre supprimée.');
    }
}
