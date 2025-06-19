<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\CompanyActivityLog;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function show($id)
    {
        $studentUser = User::with('student')->findOrFail($id);

        if (!$studentUser->student) {
            return back()->with('warning', 'Ce profil étudiant est incomplet ou inexistant.');
        }

        CompanyActivityLog::create([
            'company_id' => Auth::guard('company')->id(),
            'type'       => 'consultation_profil_etudiant',
            'message'    => "Profil de l’étudiant #{$id} consulté.",
            'data'       => json_encode(['student_id'=>$id]),
        ]);

        return view('company.students.profile', [
            'user'    => $studentUser,
            'student' => $studentUser->student,
        ]);
    }
}
