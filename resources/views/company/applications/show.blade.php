@extends('layouts.company')

@section('content')
<div class="container py-5">
    <h2 class="text-center section-header mb-4">
        📄 Détails de la Candidature
    </h2>

    <div class="card shadow-sm p-4">
        <h4 class="mb-3">Informations du candidat</h4>
        <p><strong>Nom :</strong> {{ $application->user->name ?? 'Nom inconnu' }} {{ $application->user->first_name ?? '' }}</p>
        <p><strong>Email :</strong> {{ $application->user->email ?? '-' }}</p>

        <h4 class="mt-4">Offre concernée</h4>
        <p><strong>Titre :</strong> {{ $application->offer->title ?? 'Offre supprimée' }}</p>

        <h4 class="mt-4">Motivation</h4>
        <p>
            @if($application->motivation)
                {{ $application->motivation }}
            @else
                <span class="text-muted">Aucune motivation fournie.</span>
            @endif
        </p>

        <h4 class="mt-4">Fichiers</h4>
        <p>
            @if($application->motivation_file)
                <a href="{{ asset('storage/' . $application->motivation_file) }}" target="_blank" class="btn btn-outline-primary btn-sm">📜 Voir Motivation</a>
            @else
                <span class="text-muted">Aucun fichier motivation.</span>
            @endif
        </p>
        <p>
            @if($application->cv_file)
                <a href="{{ asset('storage/' . $application->cv_file) }}" target="_blank" class="btn btn-outline-success btn-sm">📄 Voir CV</a>
            @else
                <span class="text-muted">Aucun CV.</span>
            @endif
        </p>

        <h4 class="mt-4">Statut</h4>
        <p><span class="badge
            @if($application->status == 'acceptée') bg-success
            @elseif($application->status == 'refusée') bg-danger
            @else bg-warning text-dark
            @endif">
            {{ ucfirst($application->status) }}
        </span></p>

        <a href="{{ route('company.applications.index') }}" class="btn btn-secondary mt-3">⬅️ Retour à la liste</a>
    </div>
</div>
@endsection
