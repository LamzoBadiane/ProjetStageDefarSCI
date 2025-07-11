@extends('layouts.sidebar')

@section('content')
<style>
    :root {
        --primary: #5e72e4;
        --primary-light: #f0f5ff;
        --success: #2dce89;
        --danger: #f5365c;
        --warning: #fb6340;
        --info: #11cdef;
        --dark: #32325d;
        --light: #f8f9fe;
    }

    .interview-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
    }

    .interview-header {
        display: flex;
        align-items: center;
        margin-bottom: 2.5rem;
    }

    .interview-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, var(--primary), #434190);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1.5rem;
    }

    .interview-title {
        font-size: 1.8rem;
        font-weight: 600;
        color: var(--dark);
        margin: 0;
    }

    .next-interview-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        border-left: 4px solid var(--primary);
    }

    .next-interview-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
    }

    .interview-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .interview-table thead th {
        background-color: var(--light);
        color: var(--dark);
        font-weight: 600;
        padding: 1rem;
        border-bottom: 1px solid #e9ecef;
    }

    .interview-table tbody tr {
        transition: all 0.2s ease;
    }

    .interview-table tbody tr:hover {
        background-color: var(--light);
    }

    .interview-table td {
        padding: 1.25rem 1rem;
        border-bottom: 1px solid #e9ecef;
        vertical-align: middle;
    }

    .badge-status {
        padding: 0.35rem 0.75rem;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .btn-join {
        background: linear-gradient(135deg, var(--success), #24b47e);
        border: none;
        padding: 0.5rem 1.25rem;
        font-weight: 500;
        border-radius: 6px;
        color: white;
        transition: all 0.2s ease;
    }

    .btn-join:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(45, 206, 137, 0.3);
    }

    .btn-delete {
        border: 1px solid var(--danger);
        color: var(--danger);
        padding: 0.5rem 1rem;
        border-radius: 6px;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .btn-delete:hover {
        background-color: var(--danger);
        color: white;
    }

    .empty-state {
        text-align: center;
        padding: 2rem;
        color: #adb5bd;
    }

    @media (max-width: 768px) {
        .interview-container {
            padding: 1.5rem;
        }

        .interview-table thead {
            display: none;
        }

        .interview-table tr {
            display: block;
            margin-bottom: 1rem;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .interview-table td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: none;
        }

        .interview-table td::before {
            content: attr(data-label);
            font-weight: 600;
            color: var(--dark);
            margin-right: 1rem;
        }
    }
</style>

<div class="interview-container">
    <!-- En-tête -->
    <div class="interview-header">
        <div class="interview-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar text-white">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="16" y1="2" x2="16" y2="6"></line>
                <line x1="8" y1="2" x2="8" y2="6"></line>
                <line x1="3" y1="10" x2="21" y2="10"></line>
            </svg>
        </div>
        <h1 class="interview-title">Mes entretiens</h1>
    </div>

    <!-- Prochain entretien -->
    @if($nextInterview)
        @php
            $interviewDateTime = \Carbon\Carbon::parse($nextInterview->date . ' ' . $nextInterview->time);
            $diffInMinutes = now()->diffInMinutes($interviewDateTime, false);
        @endphp

        <div class="next-interview-card">
            <div class="next-interview-title">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell mr-2">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                    <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                </svg>
                Votre prochain entretien
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-2">
                        <strong>{{ $nextInterview->company->name }}</strong>
                    </div>
                    <div class="mb-2 text-muted">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase mr-1">
                            <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                        </svg>
                        {{ $nextInterview->offer->title ?? 'Non précisé' }}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock mr-1">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                        {{ $nextInterview->date }} à {{ $nextInterview->time }}
                    </div>

                    <div class="mb-2">
                        @if ($diffInMinutes > 15)
                            <span class="badge-status bg-primary-light text-primary">
                                Dans {{ $interviewDateTime->diffForHumans() }}
                            </span>
                        @elseif ($diffInMinutes <= 15 && $diffInMinutes >= -30)
                            <span class="badge-status bg-warning-light text-warning">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-circle mr-1">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" y1="8" x2="12" y2="12"></line>
                                    <line x1="12" y1="16" x2="12" y2="16"></line>
                                </svg>
                                Entretien imminent
                            </span>
                        @else
                            <span class="badge-status bg-secondary-light text-secondary">
                                Expiré
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            @if($nextInterview->mode === 'en ligne' && $diffInMinutes <= 15 && $diffInMinutes >= -30)
                <div class="mt-3">
                    <a href="{{ $nextInterview->location }}" class="btn-join" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-video mr-1">
                            <polygon points="23 7 16 12 23 17 23 7"></polygon>
                            <rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect>
                        </svg>
                        Rejoindre l'entretien
                    </a>
                </div>
            @endif
        </div>
    @endif

    <!-- Liste des entretiens -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="table-responsive">
            <table class="interview-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Entreprise</th>
                        <th>Poste</th>
                        <th>Statut</th>
                        <th>Mode</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($interviews as $interview)
                        <tr>
                            <td data-label="Date">{{ $interview->date }}</td>
                            <td data-label="Heure">{{ $interview->time }}</td>
                            <td data-label="Entreprise">{{ $interview->company->name }}</td>
                            <td data-label="Poste">{{ $interview->offer->title ?? 'Non précisé' }}</td>
                            <td data-label="Statut">
                                <span class="badge-status
                                    @if($interview->status === 'prévu') bg-primary-light text-primary
                                    @elseif($interview->status === 'terminé') bg-success-light text-success
                                    @elseif($interview->status === 'annulé') bg-danger-light text-danger
                                    @else bg-secondary-light text-secondary @endif">
                                    {{ ucfirst($interview->status) }}
                                </span>
                            </td>
                            <td data-label="Mode">
                                @if($interview->mode === 'en ligne')
                                    <a href="{{ $interview->location }}" target="_blank" class="text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-video mr-1">
                                            <polygon points="23 7 16 12 23 17 23 7"></polygon>
                                            <rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect>
                                        </svg>
                                        Visio
                                    </a>
                                @else
                                    <span class="text-muted">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin mr-1">
                                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                            <circle cx="12" cy="10" r="3"></circle>
                                        </svg>
                                        Présentiel
                                    </span>
                                @endif
                            </td>
                            <td data-label="Actions">
                                @if(in_array($interview->status, ['terminé', 'annulé']))
                                    <form action="{{ route('student.interviews.destroy', $interview->id) }}" method="POST" onsubmit="return confirm('Supprimer cet entretien ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 mr-1">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                            </svg>
                                            Supprimer
                                        </button>
                                    </form>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="empty-state">
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                <p class="mt-3">Aucun entretien programmé</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
