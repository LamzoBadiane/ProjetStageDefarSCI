@extends('layouts.sidebar')

@section('content')
<style>
    .form-section {
        background: #f8f9fa;
        padding: 2rem;
        border-radius: 1rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        margin-bottom: 2rem;
    }

    .form-label {
        font-weight: 600;
        color: #0d6efd;
    }

    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }

    .btn-success {
        font-weight: 600;
        font-size: 1rem;
        padding: 0.6rem 1.5rem;
    }

    .alert ul {
        margin: 0;
        padding-left: 1.2rem;
    }

    .alert li {
        list-style-type: "✅ ";
    }
</style>

<div class="container-fluid py-4 animate__animated animate__fadeIn">
    <h2 class="mb-4 text-primary">🎓 Création de mon profil étudiant</h2>

    <!-- Affichage des erreurs -->
    @if($errors->any())
        <div class="alert alert-danger animate__animated animate__fadeInDown">
            <strong>🚫 Veuillez corriger les erreurs suivantes :</strong>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('warning'))
        <div class="alert alert-warning animate__animated animate__fadeInDown">
            <i class="bi bi-exclamation-triangle-fill"></i> {{ session('warning') }}
        </div>
    @endif

    <!-- Formulaire -->
    <form action="{{ route('student.profile.store') }}" method="POST" enctype="multipart/form-data" class="form-section">
        @csrf

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">CIN *</label>
                <input type="text" name="cin" class="form-control" value="{{ old('cin') }}" required pattern="[0-9]+" title="Chiffres uniquement">
            </div>

            <div class="col-md-6">
                <label class="form-label">Prénom *</label>
                <input type="text" name="first_name" class="form-control" value="{{ old('first_name', Auth::user()->name) }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Nom *</label>
                <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Téléphone *</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Université *</label>
                <input type="text" name="university" class="form-control" value="{{ old('university') }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Niveau d'étude *</label>
                <input type="text" name="level" class="form-control" value="{{ old('level') }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Domaine *</label>
                <input type="text" name="domain" class="form-control" value="{{ old('domain') }}" required>
            </div>

            <div class="col-12">
                <label class="form-label">Éducation *</label>
                <textarea name="education" class="form-control" rows="3" required placeholder="Vos diplômes, établissements fréquentés, etc.">{{ old('education') }}</textarea>
            </div>

            <div class="col-12">
                <label class="form-label">Compétences *</label>
                <textarea name="skills" class="form-control" rows="3" required placeholder="Langages, outils, frameworks, etc.">{{ old('skills') }}</textarea>
            </div>

            <div class="col-12">
                <label class="form-label">CV (PDF ou DOC) (optionnel)</label>
                <input type="file" name="cv" accept=".pdf,.doc,.docx" class="form-control">
                <small class="text-muted">Taille max : 5 Mo</small>
            </div>
        </div>

        <div class="text-end mt-4">
            <button type="submit" class="btn btn-success"><i class="bi bi-person-check-fill"></i> Créer mon profil</button>
        </div>
    </form>
</div>
@endsection
