@extends('layouts.company')

@section('content')
<div class="container py-5">
    <h2 class="text-center section-header mb-4">
        📨 Candidatures Reçues
    </h2>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if($applications->count() > 0)
    <div class="table-responsive bg-white p-4 rounded shadow-sm">
        <table class="table table-hover align-middle text-center">
            <thead class="table-primary">
                <tr>
                    <th>Candidat</th>
                    <th>Offre</th>
                    <th>Motivation</th>
                    <th>CV</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($applications as $app)
                <tr>
                    <td>{{ $app->user->first_name?? '' }} {{ $app->user->name ?? 'Nom inconnu' }}</td>
                    <td>{{ $app->offer->title ?? 'Offre supprimée' }}</td>
                    <td>
                        @if($app->motivation_file)
                            <a href="{{ asset('storage/' . $app->motivation_file) }}" target="_blank" class="btn btn-sm btn-outline-info">📄 Fichier</a>
                        @elseif($app->motivation)
                            <button class="btn btn-sm btn-info" data-bs-toggle="collapse" data-bs-target="#motivation-{{ $app->id }}">📜 Voir</button>
                            <div id="motivation-{{ $app->id }}" class="collapse mt-2 text-start">{{ $app->motivation }}</div>
                        @else
                            <span class="text-muted">Aucune</span>
                        @endif
                    </td>
                    <td>
                        @if($app->user)
                            <a href="{{ route('company.students.profile', $app->user->id) }}" class="btn btn-sm btn-outline-secondary">
                                👤 Voir Profil Étudiant
                            </a>
                        @else
                            <span class="text-muted">Profil introuvable</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge
                            @if($app->status == 'acceptée') bg-success
                            @elseif($app->status == 'refusée') bg-danger
                            @else bg-warning text-dark
                            @endif">
                            {{ ucfirst($app->status) }}
                        </span>
                    </td>
                    <td>
                        <form action="{{ route('company.applications.updateStatus', $app->id) }}" method="POST" class="d-flex flex-column gap-1">
                            @csrf
                            @method('PUT')
                            <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                <option value="en attente" {{ $app->status == 'en attente' ? 'selected' : '' }}>En attente</option>
                                <option value="acceptée" {{ $app->status == 'acceptée' ? 'selected' : '' }}>Acceptée</option>
                                <option value="refusée" {{ $app->status == 'refusée' ? 'selected' : '' }}>Refusée</option>
                                <option value="embauchée" {{ $app->status == 'embauchée' ? 'selected' : '' }}>Embauchée</option>
                            </select>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4 d-flex justify-content-center">
        {{ $applications->links('pagination::bootstrap-5') }}
    </div>
    @else
        <div class="alert alert-info text-center">Aucune candidature reçue pour l'instant.</div>
    @endif
</div>
@endsection
