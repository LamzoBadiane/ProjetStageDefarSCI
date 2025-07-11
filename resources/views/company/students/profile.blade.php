@extends('layouts.company')

@section('content')
<style>
    .profile-card {
        background: white;
        padding: 2.5rem;
        border-radius: 12px;
        box-shadow: 0 6px 18px rgba(0,0,0,0.05);
        transition: transform 0.3s ease;
    }

    .profile-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }

    .profile-avatar {
        width: 180px;
        height: 180px;
        object-fit: cover;
        border: 4px solid white;
        box-shadow: 0 8px 24px rgba(0,0,0,0.1);
    }

    .profile-title {
        color: #2c3e50;
        font-weight: 700;
        position: relative;
        padding-bottom: 1rem;
        margin-bottom: 2rem;
    }

    .profile-title:after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: linear-gradient(90deg, #4a6cf7, #a855f7);
        border-radius: 2px;
    }

    .info-label {
        font-weight: 600;
        color: #4a6cf7;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
    }

    .info-label i {
        margin-right: 0.5rem;
        font-size: 1.1em;
    }

    .info-value {
        background: #f8fafc;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        border-left: 3px solid #4a6cf7;
        margin-bottom: 1rem;
    }

    .back-btn {
        border-radius: 8px;
        padding: 0.5rem 1.5rem;
        transition: all 0.3s ease;
    }

    .back-btn:hover {
        transform: translateX(-3px);
    }

    .section-divider {
        border: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(74, 108, 247, 0.3), transparent);
        margin: 1.5rem 0;
    }

    .animate-float {
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
        100% { transform: translateY(0px); }
    }
</style>

<div class="container py-4">
    <h2 class="text-center profile-title animate__animated animate__fadeIn">
        <i class="bi bi-person-badge-fill"></i> Profil de l'Étudiant
    </h2>

    <div class="row g-4">
        <!-- Colonne Photo de profil -->
        <div class="col-lg-4 text-center">
            <div class="mb-4">
                <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                     alt="Avatar Étudiant"
                     class="img-fluid rounded-circle shadow profile-avatar animate-float">
                <h4 class="mt-3 mb-1">{{ $user->first_name ?? 'Prénom' }} {{ $user->name ?? 'Nom' }}</h4>
                <div class="d-flex align-items-center justify-content-center text-muted">
                    <i class="bi bi-patch-check-fill text-primary me-2"></i>
                    <span>Étudiant(e) vérifié(e)</span>
                </div>
            </div>

            <div class="profile-card mb-4">
                <h5 class="mb-3"><i class="bi bi-info-circle-fill text-primary me-2"></i>Informations de contact</h5>
                <div class="mb-3">
                    <label class="info-label"><i class="bi bi-envelope-fill"></i> Email</label>
                    <div class="info-value">{{ $user->email ?? '-' }}</div>
                </div>
                <div>
                    <label class="info-label"><i class="bi bi-telephone-fill"></i> Téléphone</label>
                    <div class="info-value">{{ $student->phone ?? '-' }}</div>
                </div>
            </div>
        </div>

        <!-- Colonne Informations principales -->
        <div class="col-lg-8">
            <div class="profile-card">
                <h5 class="mb-4"><i class="bi bi-person-vcard-fill text-primary me-2"></i>Informations personnelles</h5>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="info-label"><i class="bi bi-credit-card-fill"></i> CIN</label>
                        <div class="info-value">{{ $student->cin ?? 'Non renseigné' }}</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="info-label"><i class="bi bi-person-fill"></i> Nom complet</label>
                        <div class="info-value">{{ $student->first_name ?? '-' }} {{ $student->last_name ?? '-' }}</div>
                    </div>
                </div>

                <hr class="section-divider">

                <h5 class="mb-4"><i class="bi bi-book-fill text-primary me-2"></i>Informations académiques</h5>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="info-label"><i class="bi bi-building-fill"></i> Université</label>
                        <div class="info-value">{{ $student->university ?? '-' }}</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="info-label"><i class="bi bi-bar-chart-steps"></i> Niveau d'étude</label>
                        <div class="info-value">{{ $student->level ?? '-' }}</div>
                    </div>

                    <div class="col-12 mb-3">
                        <label class="info-label"><i class="bi bi-briefcase-fill"></i> Domaine</label>
                        <div class="info-value">{{ $student->domain ?? '-' }}</div>
                    </div>
                </div>

                <hr class="section-divider">

                <div class="mb-4">
                    <label class="info-label"><i class="bi bi-mortarboard-fill"></i> Parcours éducatif</label>
                    <div class="info-value" style="white-space: pre-line">{{ $student->education ?? '-' }}</div>
                </div>

                <div class="mb-4">
                    <label class="info-label"><i class="bi bi-tools"></i> Compétences</label>
                    <div class="info-value" style="white-space: pre-line">{{ $student->skills ?? '-' }}</div>
                </div>

                @if($student->cv)
                <hr class="section-divider">

                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <label class="info-label"><i class="bi bi-file-earmark-pdf-fill"></i> CV de l'étudiant</label>
                        <div class="text-muted">Document téléchargé</div>
                    </div>
                    <a href="{{ asset('storage/' . $student->cv) }}"
                       target="_blank"
                       class="btn btn-primary">
                       <i class="bi bi-download me-2"></i>Télécharger le CV
                    </a>
                </div>
                @endif
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary back-btn">
                    <i class="bi bi-arrow-left me-2"></i>Retour
                </a>

                <!-- Boutons supplémentaires optionnels -->
                <div>
                    <button class="btn btn-outline-primary me-2">
                        <i class="bi bi-printer-fill me-2"></i>Imprimer
                    </button>
                    <button class="btn btn-outline-success">
                        <i class="bi bi-envelope-fill me-2"></i>Contacter
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
