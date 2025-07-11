@extends('layouts.admin')

@section('title', 'Liste des entreprises')

@section('content')
<div class="container py-4 animate__animated animate__fadeIn">
    <h2 class="mb-4 fw-bold text-primary">
        <i class="bi bi-building"></i> Entreprises enregistrées
    </h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($companies->isEmpty())
        <div class="alert alert-info">Aucune entreprise enregistrée pour le moment.</div>
    @else
        <div class="table-responsive shadow-sm">
            <table class="table table-hover align-middle bg-white">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Secteur</th>
                        <th>Statut</th>
                        <th>Date création</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($companies as $company)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-semibold">{{ $company->name }}</td>
                            <td>{{ $company->email }}</td>
                            <td>{{ $company->contact_phone }}</td>
                            <td>{{ $company->sector }}</td>
                            <td>
                                <span class="badge 
                                    @if($company->status === 'validée') bg-success
                                    @elseif($company->status === 'en attente') bg-warning
                                    @elseif($company->status === 'refusée') bg-danger
                                    @else bg-secondary @endif">
                                    {{ ucfirst($company->status) }}
                                </span>
                            </td>
                            <td>{{ $company->created_at->format('d/m/Y') }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.companies.show', $company) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <form action="{{ route('admin.companies.destroy', $company) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Confirmer la suppression de cette entreprise ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-3">
            {{ $companies->links() }}
        </div>
    @endif
</div>
@endsection
