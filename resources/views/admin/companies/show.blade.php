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

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row g-4 mb-4">
        <!-- Infos principales -->
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
                    <p><strong>Statut :</strong>
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

        <!-- Documents & détails -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-secondary text-white">
                    <i class="bi bi-folder2-open"></i> Informations administratives
                </div>
                <div class="card-body">
                    <p><strong>NINEA :</strong> {{ $company->ninea }}</p>
                    <p><strong>RCCM :</strong> {{ $company->rccm }}</p>
                    <p><strong>Histoire :</strong><br> {{ $company->company_story }}</p>
                    @if($company->document)
                        <p><strong>Document justificatif :</strong>
                            <a href="{{ asset('storage/' . $company->document) }}" class="btn btn-outline-dark btn-sm" target="_blank">
                                📄 Voir le fichier
                            </a>
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Formulaire modification statut -->
    <div class="mb-4">
        <form method="POST" action="{{ route('admin.companies.updateStatus', $company) }}" class="d-flex align-items-center gap-3">
            @csrf
            @method('PUT')

            <label for="status" class="mb-0">Changer le statut :</label>

            <select name="status" id="status" class="form-select w-auto">
                <option value="en attente" {{ $company->status === 'en attente' ? 'selected' : '' }}>🕒 En attente</option>
                <option value="validée" {{ $company->status === 'validée' ? 'selected' : '' }}>✅ Validée</option>
                <option value="refusée" {{ $company->status === 'refusée' ? 'selected' : '' }}>❌ Refusée</option>
            </select>

            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-circle"></i> Enregistrer
            </button>
        </form>
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
                            <span class="badge bg-secondary">{{ ucfirst($offer->status) }}</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
@endsection
