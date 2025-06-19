<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Company;
use App\Models\Offer;
use App\Models\Application;
use App\Models\Interview;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStudents     = User::where('role', 'student')->count();
        $totalCompanies    = Company::count();
        $pendingCompanies  = Company::where('status', 'pending')->count();
        $validatedCompanies = Company::where('status', 'validated')->count();

        $totalOffers       = Offer::count();
        $offersPending     = Offer::where('status', 'en_attente')->count();
        $offersValidated   = Offer::where('status', 'validée')->count();

        $totalApplications = Application::count();
        $totalInterviews   = Interview::count();

        $monthlyApplications = Application::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $statusDistribution = Application::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        return view('admin.dashboard.index', compact(
            'totalStudents',
            'totalCompanies',
            'pendingCompanies',
            'validatedCompanies',
            'totalOffers',
            'offersPending',
            'offersValidated',
            'totalApplications',
            'totalInterviews',
            'statusDistribution',
            'monthlyApplications'
        ));
    }
}
