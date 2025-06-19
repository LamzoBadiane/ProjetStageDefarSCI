<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'student')->with('student');

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%");
            });
        }

        $students = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.students.index', compact('students'));
    }

    public function show($id)
    {
        $student = User::with([
            'student',
            'applications.offer.company',
            'interviews.offer',
        ])->where('role', 'student')->findOrFail($id);

        return view('admin.students.show', compact('student'));
    }

    public function edit($id)
    {
        $student = User::with('student')->where('role', 'student')->findOrFail($id);
        return view('admin.students.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'       => 'required|string|max:100',
            'email'      => 'required|email|max:255',
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
        ]);

        $student = User::where('role', 'student')->findOrFail($id);
        $student->update($request->only(['name', 'email']));

        if ($student->student) {
            $student->student->update($request->only(['first_name', 'last_name']));
        }

        return redirect()->route('admin.students.index')->with('success', '✅ Étudiant mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $student = User::where('role', 'student')->findOrFail($id);
        $student->delete();

        return redirect()->back()->with('success', 'Étudiant supprimé.');
    }
}
