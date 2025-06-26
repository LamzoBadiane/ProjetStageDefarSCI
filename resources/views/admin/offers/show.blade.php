@extends('layouts.admin')

@section('title', 'Détail de l\'offre')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-primary fw-bold">
        <i class="bi bi-briefcase-fill"></i> Offre : {{ $offer->title }}
    </h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Informations générales -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-light fw-bold">
            📝 Informations sur l'offre
        </div>
        <div class="card-body">
            <p><strong>Titre :</strong> {{ $offer->title }}</p>
            <p><strong>Description :</strong><br> {!! nl2br(e($offer->description)) !!}</p>
            <p><strong>Compétences requises :</strong> {{ $offer->skills }}</p>
            <p><strong>Date de début :</strong> {{ $offer->start_date ? \Carbon\Carbon::parse($offer->start_date)->format('d/m/Y') : '-' }}</p>
            <p><strong>Date de fin :</strong> {{ $offer->end_date ? \Carbon\Carbon::parse($offer->end_date)->format('d/m/Y') : '-' }}</p>
            <p><strong>Statut :</strong>
                <span class="badge 
                    @if($offer->status === 'validée') bg-success 
                    @elseif($offer->status === 'en_attente') bg-warning 
                    @else bg-secondary @endif">
                    {{ ucfirst($offer->status) }}
                </span>
            </p>
        </div>
    </div>

    <!-- Informations sur l'entreprise -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-light fw-bold">
            🏢 Informations sur l’entreprise
        </div>
        <div class="card-body">
            <p><strong>Nom :</strong> {{ $offer->company->name }}</p>
            <p><strong>Email :</strong> {{ $offer->company->email }}</p>
            <p><strong>Téléphone :</strong> {{ $offer->company->contact_phone ?? '—' }}</p>
            <p><strong>Adresse :</strong> {{ $offer->company->address ?? '—' }}</p>
            <a href="{{ route('public.company.profile', $offer->company->id) }}" class="btn btn-outline-primary btn-sm">
                👁️ Voir le profil public
            </a>
        </div>
    </div>

    <!-- Actions admin -->
    <div class="card shadow-sm mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">
            <form action="{{ route('admin.offers.updateStatus', $offer->id) }}" method="POST" class="d-flex align-items-center gap-3">
                @csrf
                @method('PUT')
                <label for="status" class="mb-0">Changer le statut :</label>
                <select name="status" class="form-select w-auto">
                    <option value="en_attente" {{ $offer->status === 'en_attente' ? 'selected' : '' }}>🕒 En attente</option>
                    <option value="validée" {{ $offer->status === 'validée' ? 'selected' : '' }}>✅ Validée</option>
                </select>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Enregistrer
                </button>
            </form>

            <form action="{{ route('admin.offers.destroy', $offer->id) }}" method="POST" onsubmit="return confirm('Supprimer cette offre ?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger"><i class="bi bi-trash"></i> Supprimer</button>
            </form>
        </div>
    </div>

    <a href="{{ route('admin.offers.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Retour à la liste
    </a>
</div>
@endsection
