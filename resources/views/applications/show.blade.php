@extends('layouts.sidebar')

@section('content')
<style>
    .fade-in {
        animation: fadeIn 0.6s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .card-custom {
        background-color: #f8f9fa;
        border-radius: 1rem;
        box-shadow: 0 0 20px rgba(0, 123, 255, 0.1);
        padding: 2rem;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card-custom:hover {
        transform: scale(1.01);
        box-shadow: 0 0 30px rgba(0, 123, 255, 0.15);
    }

    .badge-status {
        font-size: 0.9rem;
        padding: 0.4em 0.6em;
        transition: transform 0.2s ease;
    }

    .badge-status:hover {
        transform: scale(1.1);
    }

    .btn-action {
        margin-right: 0.5rem;
        transition: transform 0.2s ease;
    }

    .btn-action:hover {
        transform: scale(1.05);
    }

    .desc-title {
        font-weight: bold;
        color: #343a40;
    }
</style>

<div class="container py-5 fade-in">
    <h2 class="text-primary mb-4">🔍 Détails de la candidature</h2>

    <div class="card card-custom">
        <div class="row mb-3">
            <div class="col-md-4 desc-title">📌 Offre :</div>
            <div class="col-md-8">{{ $application->offer->title }}</div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4 desc-title">📅 Date de candidature :</div>
            <div class="col-md-8">{{ $application->created_at->format('d/m/Y à H:i') }}</div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4 desc-title">📊 Statut :</div>
            <div class="col-md-8">
                <span class="badge badge-status
                    @if($application->status == 'acceptée') bg-success
                    @elseif($application->status == 'refusée') bg-danger
                    @else bg-warning text-dark
                    @endif">
                    {{ ucfirst($application->status) }}
                </span>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4 desc-title">📄 Fichier joint :</div>
            <div class="col-md-8">
                @if($application->motivation_file)
                    <a href="{{ asset('storage/' . $application->motivation_file) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                        📥 Télécharger le fichier
                    </a>
                @else
                    <span class="text-muted">Aucun fichier joint</span>
                @endif
            </div>
        </div>

        <div class="mt-4 d-flex justify-content-between align-items-center">
            <a href="{{ route('applications.index') }}" class="btn btn-outline-secondary btn-action">⬅️ Retour</a>

            <div>
                <a href="{{ route('applications.edit', $application->id) }}" class="btn btn-info text-white btn-action">✏️ Modifier</a>

                <form action="{{ route('applications.destroy', $application->id) }}" method="POST" class="d-inline-block"
                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette candidature ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-action">🗑️ Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
