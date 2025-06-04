<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function show($id)
    {
        $studentUser = User::with('student')->findOrFail($id);

        if (!$studentUser->student) {
            return back()->with('warning', 'Ce profil étudiant est incomplet ou inexistant.');
        }

        return view('company.students.profile', [
            'user' => $studentUser,
            'student' => $studentUser->student
        ]);
    }
}
