<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class RedirectController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        switch ($user->role) {
            case 'student':
                return redirect()->route('student.dashboard');
            case 'company':
                return redirect()->route('company.dashboard');
            case 'admin':
                return redirect()->route('admin.dashboard');
            default:
                abort(403, 'Rôle utilisateur inconnu');
        }
    }
}
