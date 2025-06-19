@extends('layouts.admin')

@section('title', 'Fiche entreprise')

@section('content')
<div class="container py-4 animate__animated animate__fadeIn">

    <h2 class="mb-4 fw-bold text-primary">
        <i class="bi bi-building"></i> Profil de l’entreprise : {{ $company->name }}
    </h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('danger'))
        <div class="alert alert-danger">{{ session('danger') }}</div>
    @endif

    <div class="row g-4 mb-4">
        <!-- Informations générales -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <i class="bi bi-info-circle"></i> Informations générales
                </div>
                <div class="card-body">
                    <p><strong>Nom :</strong> {{ $company->name }}</p>
                    <p><strong>Email :</strong> {{ $company->email }}</p>
                    <p><strong>Téléphone :</strong> {{ $company->contact_phone }}</p>
                    <p><strong>Adresse :</strong> {{ $company->address }}</p>
                    <p><strong>Secteur :</strong> {{ $company->sector }}</p>
                    <p><strong>Status :</strong>
                        <span class="badge
                            @if($company->status === 'validée') bg-success
                            @elseif($company->status === 'en attente') bg-warning
                            @elseif($company->status === 'refusée') bg-danger
                            @else bg-secondary @endif">
                            {{ ucfirst($company->status) }}
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Informations administratives -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-secondary text-white">
                    <i class="bi bi-folder2-open"></i> Données vérification
                </div>
                <div class="card-body">
                    <p><strong>NINEA :</strong> {{ $company->ninea ?? 'Non fourni' }}</p>
                    <p><strong>RCCM :</strong> {{ $company->rccm ?? 'Non fourni' }}</p>
                    <p><strong>Histoire :</strong><br> {{ $company->company_story ?? 'Non fournie' }}</p>

                    @if($company->document)
                        <p><strong>Document justificatif :</strong>
                            <a href="{{ asset('storage/' . $company->document) }}" target="_blank" class="btn btn-outline-dark btn-sm">
                                📄 Voir le fichier
                            </a>
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Actions Admin -->
    <div class="mb-4">
        @if($company->status === 'en attente')
            <form method="POST" action="{{ route('admin.companies.validate', $company) }}" class="d-inline">
                @csrf
                <button class="btn btn-success">
                    <i class="bi bi-check-circle"></i> Valider
                </button>
            </form>

            <form method="POST" action="{{ route('admin.companies.reject', $company) }}" class="d-inline ms-2">
                @csrf
                <button class="btn btn-danger">
                    <i class="bi bi-x-circle"></i> Refuser
                </button>
            </form>
        @elseif($company->status === 'validée')
            <div class="alert alert-success d-inline-block">
                ✅ Compte validé — cette entreprise peut désormais utiliser son espace.
            </div>
        @elseif($company->status === 'refusée')
            <div class="alert alert-danger d-inline-block">
                ❌ Compte refusé — il sera supprimé automatiquement sous peu.
            </div>
        @endif
    </div>

    <!-- Offres publiées -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-light">
            <i class="bi bi-briefcase"></i> Offres publiées par cette entreprise
        </div>
        <div class="card-body">
            @if($company->offers->isEmpty())
                <p class="text-muted">Aucune offre publiée pour le moment.</p>
            @else
                <ul class="list-group">
                    @foreach($company->offers as $offer)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                <strong>{{ $offer->title }}</strong><br>
                                <small class="text-muted">Publié le {{ $offer->created_at->format('d/m/Y') }}</small>
                            </span>
                            <span class="badge bg-secondary text-capitalize">{{ $offer->status }}</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

</div>
@endsection
