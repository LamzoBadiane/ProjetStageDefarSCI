@extends('layouts.admin')

@section('title', 'Détail de la candidature')

@section('content')
<div class="container py-4 animate__animated animate__fadeIn">
    <h2 class="mb-4 fw-bold text-primary">
        <i class="bi bi-person-lines-fill"></i> Détails de la candidature #{{ $application->id }}
    </h2>

    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            Informations générales
        </div>
        <div class="card-body">
            <p><strong>Offre :</strong> {{ $application->offer->title }}</p>
            <p><strong>Entreprise :</strong> {{ $application->offer->company->name ?? '—' }}</p>
            <p><strong>Candidat :</strong> {{ $application->user->name ?? '—' }}</p>
            <p><strong>Email candidat :</strong> {{ $application->user->email ?? '—' }}</p>
            <p><strong>Date de candidature :</strong> {{ $application->created_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <div class="mb-4">
        <a href="{{ route('admin.applications.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Retour à la liste
        </a>
        <form action="{{ route('admin.applications.destroy', $application->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Confirmer la suppression ?')">
                <i class="bi bi-trash"></i> Supprimer
            </button>
        </form>
    </div>
</div>
@endsection
