@extends('layouts.admin')

@section('title', 'Étudiants')

@section('content')
<div class="container py-4">
    <h2 class="mb-4"><i class="bi bi-mortarboard"></i> Étudiants</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" placeholder="Rechercher par nom ou email" value="{{ request('search') }}" class="form-control">
            <button class="btn btn-outline-secondary">🔍</button>
        </div>
    </form>

    <table class="table table-hover table-bordered">
        <thead class="table-light">
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Date d’inscription</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($students as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('admin.students.show', $user->id) }}" class="btn btn-sm btn-info">👁️ Voir</a>
                        <a href="{{ route('admin.students.edit', $user->id) }}" class="btn btn-sm btn-primary">✏️ Modifier</a>
                        <form action="{{ route('admin.students.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer cet étudiant ?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">🗑️ Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center">Aucun étudiant trouvé.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-end">
        {{ $students->withQueryString()->links() }}
    </div>
</div>
@endsection
