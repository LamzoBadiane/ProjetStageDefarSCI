@extends('layouts.admin')

@section('title', 'Liste des candidatures')

@section('content')
<div class="container py-4 animate__animated animate__fadeIn">
    <h2 class="mb-4 fw-bold text-primary">
        <i class="bi bi-envelope-paper"></i> Candidatures reçues
    </h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Offre</th>
                    <th>Entreprise</th>
                    <th>Candidat</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($applications as $application)
                    <tr>
                        <td>{{ $application->id }}</td>
                        <td>{{ $application->offer->title }}</td>
                        <td>{{ $application->offer->company->name ?? '—' }}</td>
                        <td>
                            @if($application->user)
                                <i class="bi bi-person-circle me-1 text-primary"></i>
                                <strong>{{ $application->user->first_name }} {{ $application->user->name }}</strong>
                            @else
                                —
                            @endif
                        </td>
                        <td>{{ $application->created_at->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('admin.applications.show', $application->id) }}" class="btn btn-sm btn-primary">
                                <i class="bi bi-eye"></i> Voir
                            </a>
                            <form action="{{ route('admin.applications.destroy', $application->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Confirmer la suppression ?')">
                                    <i class="bi bi-trash"></i> Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Aucune candidature pour le moment.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $applications->links() }}
    </div>
</div>
@endsection
