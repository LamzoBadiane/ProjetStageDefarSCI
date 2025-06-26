<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Offer;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::with(['offer.company', 'user'])
            ->latest()
            ->paginate(10);

        $offers = Offer::all(); // 👈 pour éviter l'erreur

        return view('admin.applications.index', compact('applications', 'offers'));
    }

    public function show($id)
    {
        $application = Application::with(['offer', 'user'])->findOrFail($id);
        return view('admin.applications.show', compact('application'));
    }

    public function destroy($id)
    {
        Application::destroy($id);
        return redirect()->route('admin.applications.index')->with('success', '🗑️ Candidature supprimée.');
    }
}
