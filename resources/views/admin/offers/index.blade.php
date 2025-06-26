@extends('layouts.admin')

@section('title', 'Gestion des offres')

@section('content')
<div class="container py-4 animate__animated animate__fadeIn">

    <h2 class="mb-4 fw-bold text-primary">
        <i class="bi bi-briefcase"></i> Offres publiées
    </h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Filtres -->
    <form method="GET" class="mb-4">
        <div class="row g-2 align-items-center">
            <div class="col-auto">
                <label for="status" class="col-form-label">Filtrer par statut :</label>
            </div>
            <div class="col-auto">
                <select name="status" id="status" class="form-select" onchange="this.form.submit()">
                    <option value="">— Tous —</option>
                    <option value="validée" {{ request('status') === 'validée' ? 'selected' : '' }}>✅ Validée</option>
                    <option value="en_attente" {{ request('status') === 'en_attente' ? 'selected' : '' }}>🕒 En attente</option>
                </select>
            </div>
        </div>
    </form>

    <!-- Tableau des offres -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Titre</th>
                            <th>Entreprise</th>
                            <th>Date</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($offers as $offer)
                            <tr>
                                <td>{{ $offer->title }}</td>
                                <td>{{ $offer->company->name ?? '-' }}</td>
                                <td>{{ $offer->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <span class="badge 
                                        @if($offer->status === 'validée') bg-success 
                                        @elseif($offer->status === 'en_attente') bg-warning 
                                        @else bg-secondary @endif">
                                        {{ ucfirst($offer->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.offers.show', $offer->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.offers.destroy', $offer->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer cette offre ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Aucune offre trouvée.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-3">
        {{ $offers->withQueryString()->links() }}
    </div>

</div>
@endsection
