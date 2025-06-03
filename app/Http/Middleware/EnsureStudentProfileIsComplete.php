<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;

class EnsureStudentProfileIsComplete
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Vérifie si l'utilisateur est connecté
        if (Auth::check()) {
            // Vérifie s'il a un profil étudiant
            $student = Student::where('email', Auth::user()->email)->first();

            // Si aucun profil, on redirige vers la création
            if (!$student) {
                return redirect()->route('student.profile.create')
                    ->with('warning', 'Veuillez compléter votre profil étudiant.');
            }
        }

        // Laisse passer la requête
        return $next($request);
    }
}
