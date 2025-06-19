@extends('layouts.company')

@section('content')
<div class="container py-4">
    <h2 class="mb-4"><i class="bi bi-clock-history"></i> Historique des activités</h2>

    @forelse($logs as $log)
        @php
            $data = json_decode($log->data, true);
            $icon = match($log->type) {
                'modification_profil' => 'bi-pencil-square',
                'consultation_profil' => 'bi-eye',
                'creation_offre' => 'bi-plus-square',
                'modification_offre' => 'bi-pencil',
                'suppression_offre' => 'bi-trash',
                default => 'bi-info-circle'
            };
        @endphp

        <div class="alert alert-light border d-flex justify-content-between align-items-start shadow-sm mb-3">
            <div>
                <i class="bi {{ $icon }} me-2 text-primary"></i>
                <strong class="text-dark">{{ ucfirst(str_replace('_', ' ', $log->type)) }}</strong><br>
                <span class="text-muted">{{ $log->message }}</span>

                @if($log->type === 'consultation_profil' && isset($data['nom'], $data['prenom']))
                    <div class="mt-1">
                        👤 Étudiant : <strong>{{ $data['prenom'] }} {{ $data['nom'] }}</strong>
                    </div>
                @endif
            </div>
            <div>
                <span class="badge bg-secondary">{{ $log->created_at->diffForHumans() }}</span>
            </div>
        </div>
    @empty
        <div class="alert alert-info text-center">
            <i class="bi bi-info-circle"></i> Aucune activité enregistrée.
        </div>
    @endforelse

    @if($logs->count() > 0)
        <div class="d-flex justify-content-end mb-3">
            <form action="{{ route('company.history.destroyAll') }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer tout l\'historique ?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-trash3-fill"></i> Tout supprimer
                </button>
            </form>
        </div>
    @endif


    <div class="mt-4 d-flex justify-content-center">
        {{ $logs->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
