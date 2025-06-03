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

        $offersCount = Offer::where('company_id', $companyId)->count();
        $applicationsCount = Application::whereHas('offer', fn($q) => $q->where('company_id', $companyId))->count();
        $pendingOffersCount = Offer::where('company_id', $companyId)->where('status', 'en_attente')->count();

        // Dernières offres et candidatures récentes (optionnel)
        $recentOffers = Offer::where('company_id', $companyId)->latest()->take(5)->get();
        $recentApplications = Application::whereHas('offer', fn($q) => $q->where('company_id', $companyId))->latest()->take(5)->get();

        return view('company.dashboard', compact('offersCount', 'applicationsCount', 'pendingOffersCount', 'recentOffers', 'recentApplications'));
    }
}
