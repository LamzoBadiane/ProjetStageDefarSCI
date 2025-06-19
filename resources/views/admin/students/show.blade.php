@extends('layouts.admin')

@section('title', 'Fiche étudiant')

@section('content')
<div class="container py-4 animate__animated animate__fadeIn">
    <h2 class="mb-4 text-primary fw-bold">
        <i class="bi bi-person-badge"></i> Fiche de l’étudiant
    </h2>

    <!-- Infos personnelles -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-light">
            <i class="bi bi-info-circle"></i> Informations personnelles
        </div>
        <div class="card-body">
            <p><strong>Nom complet :</strong> {{ $student->student->first_name }} {{ $student->student->last_name }}</p>
            <p><strong>Nom d’utilisateur :</strong> {{ $student->name }}</p>
            <p><strong>Email :</strong> {{ $student->email }}</p>
            <p><strong>Date d’inscription :</strong> {{ $student->created_at->format('d/m/Y à H:i') }}</p>
        </div>
    </div>

    <!-- CV -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-info text-white">
            <i class="bi bi-file-earmark-person"></i> CV
        </div>
        <div class="card-body">
            @if($student->student->cv)
                <a href="{{ asset('storage/cv/' . $student->student->cv) }}" target="_blank" class="btn btn-outline-primary">
                    <i class="bi bi-download"></i> Télécharger le CV
                </a>
            @else
                <p class="text-muted">Aucun CV disponible.</p>
            @endif
        </div>
    </div>

    <!-- Candidatures -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-warning text-dark">
            <i class="bi bi-send"></i> Candidatures
        </div>
        <div class="card-body">
            @if($student->applications->isEmpty())
                <p class="text-muted">Aucune candidature enregistrée.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-sm align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Offre</th>
                                <th>Entreprise</th>
                                <th>Date</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($student->applications as $app)
                                <tr>
                                    <td>{{ $app->offer->title ?? 'Offre supprimée' }}</td>
                                    <td>{{ $app->offer->company->name ?? 'N/A' }}</td>
                                    <td>{{ $app->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <span class="badge
                                            @if($app->status === 'acceptée') bg-success
                                            @elseif($app->status === 'refusée') bg-danger
                                            @elseif($app->status === 'embauchée') bg-info
                                            @else bg-warning @endif">
                                            {{ ucfirst($app->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <!-- Entretiens -->
    <div class="card shadow-sm border-0 mb-5">
        <div class="card-header bg-secondary text-white">
            <i class="bi bi-calendar-check"></i> Entretiens
        </div>
        <div class="card-body">
            @if($student->interviews->isEmpty())
                <p class="text-muted">Aucun entretien programmé.</p>
            @else
                <ul class="list-group list-group-flush">
                    @foreach($student->interviews as $interview)
                        <li class="list-group-item">
                            <strong>Poste :</strong> {{ $interview->offer->title ?? 'Offre inconnue' }} <br>
                            <strong>Date :</strong> {{ \Carbon\Carbon::parse($interview->date)->format('d/m/Y') }} à {{ $interview->time }}<br>
                            <strong>Mode :</strong> {{ ucfirst($interview->mode) }} <br>
                            <strong>Statut :</strong> 
                            <span class="badge bg-{{ $interview->status === 'prévu' ? 'primary' : ($interview->status === 'terminé' ? 'success' : 'secondary') }}">
                                {{ ucfirst($interview->status) }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    <div class="text-end">
        <a href="{{ route('admin.students.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Retour à la liste
        </a>
    </div>
</div>
@endsection
