@extends('layouts.sidebar')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

<style>
    .timeline {
        list-style: none;
        padding-left: 0;
        border-left: 3px solid #0d6efd;
        margin-left: 20px;
    }
    .timeline li {
        margin-bottom: 15px;
        position: relative;
        padding-left: 20px;
    }
    .timeline li::before {
        content: "\2022";
        color: #0d6efd;
        position: absolute;
        left: -11px;
        top: 0;
    }
</style>

<div class="container py-5 animate__animated animate__fadeIn">
    <h2 class="text-center mb-4 text-primary fw-bold section-title">
        <i class="bi bi-person-circle"></i> Mon compte étudiant
    </h2>

    @if(session('success'))
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div class="toast align-items-center text-bg-success border-0 show" role="alert">
                <div class="d-flex">
                    <div class="toast-body">{{ session('success') }}</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            </div>
        </div>
    @endif

    <div class="row g-4">
        <!-- Informations personnelles -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0 glass-card">
                <div class="card-header bg-primary text-white">
                    <i class="bi bi-person-lines-fill"></i> Informations personnelles
                </div>
                <div class="card-body">
                    <form action="{{ route('student.account.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <div class="mb-3 text-center">
                            <img id="previewImage" src="{{ asset('storage/avatars/' . ($student->avatar ?? 'default.png')) }}" 
                                 class="rounded-circle shadow" width="100" height="100" alt="Avatar">
                            <input type="file" name="avatar" class="form-control mt-2" accept="image/*"
                                   onchange="document.getElementById('previewImage').src = window.URL.createObjectURL(this.files[0])">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Prénom</label>
                            <input type="text" name="first_name" value="{{ old('first_name', $student->first_name) }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nom</label>
                            <input type="text" name="last_name" value="{{ old('last_name', $student->last_name) }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Adresse email</label>
                            <input type="email" name="email" value="{{ old('email', $student->email) }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Remplissage du profil</label>
                            <div class="progress">
                                <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" 
                                     role="progressbar" style="width: 100%">100%</div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button class="btn btn-primary"><i class="bi bi-save"></i> Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Mot de passe -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0 glass-card">
                <div class="card-header bg-warning text-dark">
                    <i class="bi bi-lock"></i> Sécurité & mot de passe
                </div>
                <div class="card-body">
                    <form action="{{ route('student.account.password') }}" method="POST">
                        @csrf @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Mot de passe actuel</label>
                            <input type="password" name="current_password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nouveau mot de passe</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Confirmation</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>
                        <div class="text-end">
                            <button class="btn btn-warning"><i class="bi bi-arrow-repeat"></i> Mettre à jour</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Timeline -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0 glass-card">
                <div class="card-header bg-info text-white">
                    <i class="bi bi-clock-history"></i> Historique de votre parcours
                </div>
                <div class="card-body">
                    <ul class="timeline">
                        <li>
                            <i class="bi bi-calendar-check text-primary me-2"></i>
                            <strong>Inscription :</strong> {{ optional($student->created_at)->format('d/m/Y') }}
                        </li>

                        @if($student->updated_at && $student->updated_at != $student->created_at)
                            <li>
                                <i class="bi bi-pencil-square text-warning me-2"></i>
                                <strong>Profil mis à jour :</strong> {{ optional($student->updated_at)->format('d/m/Y à H:i') }}
                            </li>
                        @endif

                        @if(!empty($student->cv_updated_at))
                            <li>
                                <i class="bi bi-file-earmark-person text-success me-2"></i>
                                <strong>CV modifié :</strong> {{ \Carbon\Carbon::parse($student->cv_updated_at)->format('d/m/Y à H:i') }}
                            </li>
                        @endif

                        @if(!empty($applications) && $applications->count() > 0)
                            @foreach($applications as $application)
                                <li>
                                    <i class="bi bi-send-check text-info me-2"></i>
                                    <strong>Candidature :</strong> {{ optional($application->created_at)->format('d/m/Y') }}
                                    <small class="text-muted d-block">Offre : {{ $application->offer->title ?? 'Offre supprimée' }}</small>
                                </li>
                            @endforeach
                        @endif

                        @if(!empty($interviews) && $interviews->count() > 0)
                            @foreach($interviews as $interview)
                                <li>
                                    <i class="bi bi-calendar-event text-secondary me-2"></i>
                                    <strong>Entretien :</strong>
                                    {{ \Carbon\Carbon::parse($interview->date . ' ' . $interview->time)->format('d/m/Y à H:i') }}
                                    <small class="text-muted d-block">Statut : {{ ucfirst($interview->status) }}</small>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>

    </div>


        <!-- Suppression -->
        <div class="col-md-6">
            <div class="card border-danger shadow-sm glass-card">
                <div class="card-header bg-danger text-white">
                    <i class="bi bi-trash3"></i> Supprimer mon compte
                </div>
                <div class="card-body">
                    <p class="text-danger fw-semibold">⚠️ Cette action supprimera définitivement votre compte et vos candidatures.</p>
                    <form id="deleteForm" action="{{ route('student.account.delete') }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger"><i class="bi bi-x-circle"></i> Supprimer mon compte</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    gsap.from(".glass-card", {
        opacity: 0,
        y: 50,
        duration: 0.7,
        stagger: 0.2,
        ease: "power2.out"
    });
    gsap.from(".section-title", {
        opacity: 0,
        scale: 0.9,
        duration: 1,
        delay: 0.2,
        ease: "back.out(1.7)"
    });

    document.getElementById("deleteForm").addEventListener("submit", function(e){
        e.preventDefault();
        Swal.fire({
            title: "Supprimer votre compte ?",
            text: "Cette action est irréversible.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Oui, supprimer",
            cancelButtonText: "Annuler",
        }).then((result) => {
            if (result.isConfirmed) {
                e.target.submit();
            }
        });
    });
</script>
@endsection
