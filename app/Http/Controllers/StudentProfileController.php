<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Student;

class StudentProfileController extends Controller
{
    /**
     * Afficher le formulaire de profil.
     */
    public function edit()
    {
        $student = Student::where('email', Auth::user()->email)->first();

        if (!$student) {
            return redirect()->route('student.profile.create')->with('warning', 'Veuillez compléter votre profil.');
        }

        return view('student.profile', compact('student'));
    }

    /**
     * Afficher le formulaire de création du profil.
     */
    public function create()
    {
        return view('student.create-profile');
    }

    /**
     * Créer un nouveau profil étudiant.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cin' => 'required|digits_between:8,12|unique:students',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'required|string',
            'university' => 'required|string',
            'level' => 'required|string',
            'domain' => 'required|string',
            'education' => 'required|string',
            'skills' => 'required|string',
            'cv' => 'nullable|mimes:pdf,doc,docx|max:2048',
        ]);

        $cvPath = null;
        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cvs', 'public');
        }

        Student::create([
            'user_id' => Auth::id(),
            'cin' => $request->cin,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => Auth::user()->email,
            'phone' => $request->phone,
            'university' => $request->university,
            'level' => $request->level,
            'domain' => $request->domain,
            'education' => $request->education,
            'skills' => $request->skills,
            'cv' => $cvPath,
        ]);

        return redirect()->route('student.profile.edit')->with('success', 'Profil créé avec succès.');
    }

    /**
     * Mettre à jour le profil existant.
     */
    public function update(Request $request)
    {
        $request->validate([
            'cin' => 'required|digits_between:8,12|unique:students,cin,' . Auth::user()->id,
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'required|string',
            'university' => 'required|string',
            'level' => 'required|string',
            'domain' => 'required|string',
            'education' => 'required|string',
            'skills' => 'required|string',
            'cv' => 'nullable|mimes:pdf,doc,docx|max:2048',
        ]);

        $student = Student::where('user_id', Auth::id())->first();

        if (!$student) {
            return redirect()->route('student.profile.create')->with('warning', 'Veuillez d\'abord créer votre profil.');
        }

        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cvs', 'public');
            $student->cv = $cvPath;
        }

        $student->update([
            'cin' => $request->cin,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'university' => $request->university,
            'level' => $request->level,
            'domain' => $request->domain,
            'education' => $request->education,
            'skills' => $request->skills,
        ]);

        return back()->with('success', 'Profil mis à jour avec succès.');
    }
}
