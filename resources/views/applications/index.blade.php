@extends('layouts.sidebar')

@section('content')
<style>
    .table-blue thead {
        background: linear-gradient(90deg, #007bff, #3399ff);
        color: #fff;
        text-transform: uppercase;
        font-weight: bold;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #0056b3;
    }

    .table-blue tbody tr {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .table-blue tbody tr:hover {
        transform: scale(1.02);
        box-shadow: 0 8px 15px rgba(0, 123, 255, 0.2);
    }

    .badge-status {
        font-size: 0.85rem;
        padding: 0.4em 0.6em;
        animation: pulse 1.5s infinite;
        transition: transform 0.3s ease;
    }

    .badge-status:hover {
        transform: scale(1.1);
    }

    @keyframes pulse {
        0% { box-shadow: 0 0 0 0 rgba(0,123,255, 0.7); }
        70% { box-shadow: 0 0 0 10px rgba(0,123,255, 0); }
        100% { box-shadow: 0 0 0 0 rgba(0,123,255, 0); }
    }

    .fade-in {
        animation: fadeIn 0.8s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="container-fluid py-4 fade-in">
    <h2 class="text-primary mb-4">📋 Mes candidatures</h2>

    @if(session('success'))
        <div class="alert alert-success fade-in">{{ session('success') }}</div>
    @endif
    @if(session('warning'))
        <div class="alert alert-warning fade-in">{{ session('warning') }}</div>
    @endif

    @if($applications->count() > 0)
    <div class="table-responsive fade-in">
        <table class="table table-striped table-hover table-blue shadow-sm">
            <thead>
                <tr>
                    <th>📄 Offre</th>
                    <th>📌 Statut</th>
                    <th>✍️ Motivation</th>
                    <th>📎 Fichier</th>
                    <th>📅 Date</th>
                    <th>🔍 Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($applications as $app)
                <tr class="fade-in">
                    <td>{{ $app->offer->title }}</td>
                    <td>
                        <span class="badge badge-status
                            @if($app->status == 'acceptée') bg-success
                            @elseif($app->status == 'refusée') bg-danger
                            @else bg-warning text-dark
                            @endif">
                            {{ ucfirst($app->status) }}
                        </span>
                    </td>
                    <td>
                        @if($app->motivation)
                            {{ \Illuminate\Support\Str::limit($app->motivation, 50) }}
                        @else
                            <span class="text-muted">Aucune</span>
                        @endif
                    </td>
                    <td>
                        @if($app->motivation_file)
                            <a href="{{ asset('storage/' . $app->motivation_file) }}" target="_blank" class="btn btn-sm btn-outline-primary">📄 Télécharger</a>
                        @else
                            <span class="text-muted">Aucun</span>
                        @endif
                    </td>
                    <td>{{ $app->created_at->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('applications.show', $app->id) }}" class="btn btn-sm btn-info">Détails</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-3 d-flex justify-content-center fade-in">
        {{ $applications->links('pagination::bootstrap-5') }}
    </div>
    @else
        <div class="alert alert-info fade-in">Vous n'avez pas encore de candidatures.</div>
    @endif
</div>
@endsection
