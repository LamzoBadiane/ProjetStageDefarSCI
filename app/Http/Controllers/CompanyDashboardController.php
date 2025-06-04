<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;

class CompanyDashboardController extends Controller
{
    public function index()
    {
        $companyId = Auth::guard('company')->id();

        // 🔢 Statistiques
        $offersCount = Offer::where('company_id', $companyId)->count();
        $applicationsCount = Application::whereHas('offer', function($q) use ($companyId) {
            $q->where('company_id', $companyId);
        })->count();
        $pendingOffersCount = Offer::where('company_id', $companyId)->where('status', 'en_attente')->count();

        // 🕓 Dernières offres publiées
        $recentOffers = Offer::where('company_id', $companyId)->latest()->take(5)->get();

        // 📨 Dernières candidatures reçues
        $recentApplications = Application::whereHas('offer', function($q) use ($companyId) {
            $q->where('company_id', $companyId);
        })->with(['offer', 'user'])->latest()->take(5)->get();

        // ✅ Vue avec tous les éléments
        return view('company.dashboard', compact(
            'offersCount',
            'applicationsCount',
            'pendingOffersCount',
            'recentOffers',
            'recentApplications'
        ));
    }
}
