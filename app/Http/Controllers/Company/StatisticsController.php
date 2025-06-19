<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\CompanyActivityLog;
use App\Models\Interview;
use App\Models\Offer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function index()
    {
        $companyId = Auth::guard('company')->id();

        // 🧳 Offres publiées
        $totalOffers = Offer::where('company_id', $companyId)->count();

        // 📬 Candidatures reçues
        $totalApplications = Application::whereHas('offer', fn ($q) => $q->where('company_id', $companyId))->count();

        // 🎯 Entretiens programmés
        $totalInterviews = Interview::where('company_id', $companyId)->count();

        // ✅ Taux de sélection
        $selectedCount = Interview::where('company_id', $companyId)->distinct('user_id')->count();
        $selectionRate = $totalApplications > 0 ? round(($selectedCount / $totalApplications) * 100, 1) : 0;

        // ❌ Taux de refus
        $refusedCount = Application::whereHas('offer', fn ($q) => $q->where('company_id', $companyId))
                                   ->where('status', 'refusée')->count();
        $refusalRate = $totalApplications > 0 ? round(($refusedCount / $totalApplications) * 100, 1) : 0;

        // 👁️ Consultations du profil
        $profileViews = CompanyActivityLog::where('company_id', $companyId)
                                          ->where('type', 'consultation_profil')
                                          ->count();

        // 📊 Candidatures par offre (Bar Chart)
        $applicationsByOffer = Application::selectRaw('offers.title as offer, COUNT(applications.id) as count')
            ->join('offers', 'applications.offer_id', '=', 'offers.id')
            ->where('offers.company_id', $companyId)
            ->groupBy('offers.title')
            ->get();

        // 🍩 Répartition des statuts
        $statusDistribution = Application::selectRaw('status, COUNT(*) as total')
            ->whereHas('offer', fn ($q) => $q->where('company_id', $companyId))
            ->groupBy('status')
            ->pluck('total', 'status');

        // 📈 Candidatures mensuelles
        $monthlyApplications = Application::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereHas('offer', fn ($q) => $q->where('company_id', $companyId))
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        // 📘 Offres par type de contrat (stage, cdd, cdi)
        $offersByType = Offer::selectRaw('type, COUNT(*) as total')
            ->where('company_id', $companyId)
            ->groupBy('type')
            ->pluck('total', 'type');

        return view('company.statistics.index', compact(
            'totalOffers',
            'totalApplications',
            'totalInterviews',
            'selectionRate',
            'refusalRate',
            'profileViews',
            'applicationsByOffer',
            'statusDistribution',
            'monthlyApplications',
            'offersByType'
        ));
    }
}
