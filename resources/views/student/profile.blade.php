@extends('layouts.sidebar')

@section('content')
<style>
    .form-section {
        background: #f8f9fa;
        padding: 2rem;
        border-radius: 1rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }

    .form-label {
        font-weight: 600;
        color: #0d6efd;
    }

    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }

    .btn-primary {
        font-weight: 600;
        font-size: 1rem;
        padding: 0.6rem 1.5rem;
    }

    .profile-avatar {
        max-width: 180px;
        border: 3px solid #0d6efd33;
    }

    .alert li {
        list-style-type: "❗ ";
    }
</style>

<div class="container-fluid py-4 animate__animated animate__fadeIn">
    <h2 class="mb-4 text-primary">📝 Mon profil étudiant</h2>

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

    @if(session('success'))
        <div class="alert alert-success animate__animated animate__fadeInDown">
            ✅ {{ session('success') }}
        </div>
    @endif

    <div class="row g-4">
        <div class="col-md-4 text-center">
            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                alt="Avatar" class="img-fluid rounded-circle shadow profile-avatar">
            <h5 class="mt-3">{{ Auth::user()->first_name }} {{ Auth::user()->name }}</h5>
            <p class="text-muted">Étudiant</p>
        </div>

        <div class="col-md-8">
            <form action="{{ route('student.profile.update') }}" method="POST" enctype="multipart/form-data" class="form-section">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">CIN *</label>
                        <input type="text" name="cin" class="form-control" value="{{ old('cin', $student->cin) }}" required pattern="[0-9]+" title="Chiffres uniquement">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Prénom *</label>
                        <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $student->first_name) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Nom *</label>
                        <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $student->last_name) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Téléphone *</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $student->phone) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Université *</label>
                        <input type="text" name="university" class="form-control" value="{{ old('university', $student->university) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Niveau d'étude *</label>
                        <input type="text" name="level" class="form-control" value="{{ old('level', $student->level) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Domaine *</label>
                        <input type="text" name="domain" class="form-control" value="{{ old('domain', $student->domain) }}" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Éducation *</label>
                        <textarea name="education" class="form-control" rows="3" required>{{ old('education', $student->education) }}</textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Compétences *</label>
                        <textarea name="skills" class="form-control" rows="3" required>{{ old('skills', $student->skills) }}</textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label">CV (PDF/DOC) (optionnel)</label>
                        @if($student->cv)
                            <p class="mb-1">📎 CV actuel :
                                <a href="{{ asset('storage/' . $student->cv) }}" target="_blank" class="text-decoration-underline">
                                    Voir le fichier
                                </a>
                            </p>
                        @endif
                        <input type="file" name="cv" accept=".pdf,.doc,.docx" class="form-control">
                        <small class="text-muted">Taille max : 5 Mo</small>
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save2-fill"></i> Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
