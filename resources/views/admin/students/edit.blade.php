@extends('layouts.admin')

@section('title', 'Modifier un étudiant')

@section('content')
<div class="container py-4 animate__animated animate__fadeIn">
    <h2 class="mb-4 text-primary fw-bold"><i class="bi bi-pencil-square"></i> Modifier l’étudiant</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Erreurs :</strong>
            <ul class="mb-0 mt-1">
                @foreach($errors->all() as $error)
                    <li>⚠️ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.students.update', $student->id) }}">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <!-- Prénom -->
                    <div class="col-md-6">
                        <label class="form-label">Prénom</label>
                        <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $student->student->first_name ?? '') }}" required>
                    </div>

                    <!-- Nom -->
                    <div class="col-md-6">
                        <label class="form-label">Nom</label>
                        <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $student->student->last_name ?? '') }}" required>
                    </div>

                    <!-- Nom d'utilisateur -->
                    <div class="col-md-6">
                        <label class="form-label">Nom d’utilisateur</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $student->name) }}" required>
                    </div>

                    <!-- Email -->
                    <div class="col-md-6">
                        <label class="form-label">Adresse email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $student->email) }}" required>
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <a href="{{ route('admin.students.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                    <button type="submit" class="btn btn-primary fw-bold">
                        <i class="bi bi-save"></i> Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
