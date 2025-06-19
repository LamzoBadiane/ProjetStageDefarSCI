@extends('layouts.company')

@section('content')
<style>
    .profile-card {
        background: #ffffff;
        padding: 2rem;
        border-radius: 1rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    .profile-avatar {
        max-width: 180px;
        border: 3px solid #0d6efd33;
    }
    .profile-title {
        color: #0d6efd;
        font-weight: 700;
        margin-bottom: 1.5rem;
    }
    .info-label {
        font-weight: 600;
        color: #0d6efd;
    }
</style>

<div class="container py-4 animate__animated animate__fadeIn">
    <h2 class="text-center profile-title">👤 Profil de l'Étudiant</h2>

    <div class="row g-4">
        <div class="col-md-4 text-center">
            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                 alt="Avatar Étudiant"
                 class="img-fluid rounded-circle shadow profile-avatar">
            <h5 class="mt-3">{{ $user->first_name?? 'prenom' }} {{ $user->name ?? 'Nom' }}</h5>
            <p class="text-muted">Étudiant(e) inscrit(e)</p>
        </div>

        <div class="col-md-8">
            <div class="profile-card">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="info-label">CIN</label>
                        <p>{{ $student->cin ?? 'Non renseigné' }}</p>
                    </div>

                    <div class="col-md-6">
                        <label class="info-label">Prénom</label>
                        <p>{{ $student->first_name ?? '-' }}</p>
                    </div>

                    <div class="col-md-6">
                        <label class="info-label">Nom</label>
                        <p>{{ $student->last_name ?? '-' }}</p>
                    </div>

                    <div class="col-md-6">
                        <label class="info-label">Téléphone</label>
                        <p>{{ $student->phone ?? '-' }}</p>
                    </div>

                    <div class="col-md-6">
                        <label class="info-label">Université</label>
                        <p>{{ $student->university ?? '-' }}</p>
                    </div>

                    <div class="col-md-6">
                        <label class="info-label">Niveau d'étude</label>
                        <p>{{ $student->level ?? '-' }}</p>
                    </div>

                    <div class="col-md-6">
                        <label class="info-label">Domaine</label>
                        <p>{{ $student->domain ?? '-' }}</p>
                    </div>

                    <div class="col-12">
                        <label class="info-label">Éducation</label>
                        <p>{{ $student->education ?? '-' }}</p>
                    </div>

                    <div class="col-12">
                        <label class="info-label">Compétences</label>
                        <p>{{ $student->skills ?? '-' }}</p>
                    </div>

                    @if($student->cv)
                        <div class="col-12">
                            <label class="info-label">📎 CV</label>
                            <p>
                                <a href="{{ asset('storage/' . $student->cv) }}"
                                   target="_blank"
                                   class="btn btn-outline-primary btn-sm">
                                   Voir le CV
                                </a>
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-3 text-end">
                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">⬅️ Retour</a>
            </div>
        </div>
    </div>
</div>
@endsection
