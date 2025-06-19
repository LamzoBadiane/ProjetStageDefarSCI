@extends('layouts.admin')

@section('title', 'Gestion des entreprises')

@section('content')
<div class="container py-4 animate__animated animate__fadeIn">
    <h2 class="mb-4 fw-bold text-primary"><i class="bi bi-building"></i> Entreprises enregistrées</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <!-- Filtres -->
    <div class="mb-3 d-flex justify-content-between align-items-center">
        <form method="GET" class="d-flex gap-2">
            <select name="status" class="form-select" onchange="this.form.submit()">
                <option value="">📋 Tous les statuts</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>🕒 En attente</option>
                <option value="validated" {{ request('status') == 'validated' ? 'selected' : '' }}>✅ Validées</option>
                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>❌ Refusées</option>
            </select>
        </form>
        <span class="text-muted">{{ $companies->total() }} entreprise(s) au total</span>
    </div>

    <!-- Tableau -->
    <div class="table-responsive shadow-sm">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Nom</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Secteur</th>
                    <th>Statut</th>
                    <th>Offres</th>
                    <th>Date d’inscription</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($companies as $company)
                    <tr>
                        <td>
                            <strong>{{ $company->name }}</strong>
                        </td>
                        <td>{{ $company->contact_name ?? '-' }}</td>
                        <td>{{ $company->email }}</td>
                        <td>{{ $company->sector ?? 'Non précisé' }}</td>
                        <td>
                            <span class="badge 
                                @if($company->status == 'validated') bg-success
                                @elseif($company->status == 'pending') bg-warning
                                @elseif($company->status == 'rejected') bg-danger
                                @else bg-secondary
                                @endif">
                                {{ ucfirst($company->status) }}
                            </span>
                        </td>
                        <td>{{ $company->offers_count ?? 0 }}</td>
                        <td>{{ $company->created_at->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('admin.companies.show', $company) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.companies.destroy', $company) }}" class="d-inline"
                                  onsubmit="return confirm('Confirmer la suppression de cette entreprise ?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash3"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">Aucune entreprise trouvée.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $companies->withQueryString()->links() }}
    </div>
</div>
@endsection
