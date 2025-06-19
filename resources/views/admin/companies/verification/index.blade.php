@extends('layouts.admin')

@section('title', 'Entreprises à valider')

@section('content')
<div class="container py-4">
    <h2 class="mb-4"><i class="bi bi-building-check"></i> Entreprises en attente de validation</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($companies->isEmpty())
        <div class="alert alert-info">Aucune entreprise en attente.</div>
    @else
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Nom</th>
                    <th>Secteur</th>
                    <th>Contact</th>
                    <th>Date inscription</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($companies as $company)
                <tr>
                    <td>{{ $company->name }}</td>
                    <td>{{ $company->sector }}</td>
                    <td>{{ $company->contact_email }}</td>
                    <td>{{ $company->created_at->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('admin.verifications.show', $company->id) }}" class="btn btn-sm btn-outline-primary">📄 Examiner</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $companies->links() }}
    @endif
</div>
@endsection
