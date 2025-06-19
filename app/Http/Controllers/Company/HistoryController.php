<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\CompanyActivityLog;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $logs = CompanyActivityLog::where('company_id', Auth::guard('company')->id())
            ->latest()
            ->paginate(15);

        return view('company.history.index', compact('logs'));
    }
    public function destroyAll()
    {
        $companyId = Auth::guard('company')->id();

        CompanyActivityLog::where('company_id', $companyId)->delete();

        return back()->with('success', '🧹 Historique entièrement supprimé.');
    }
}
