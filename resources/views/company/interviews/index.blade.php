@extends('layouts.company')

@section('content')
<!-- FullCalendar CSS & JS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.8/index.global.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.8/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/locales/fr.global.min.js"></script>

<style>
    :root {
        --primary-color: #0d6efd;
        --bg-light: #ffffff;
        --bg-dark: #1e1e2f;
        --text-dark: #212529;
        --text-light: #f1f1f1;
        --card-radius: 16px;
    }

    body.dark-mode {
        background-color: var(--bg-dark);
        color: var(--text-light);
    }

    .dashboard-section {
        display: flex;
        flex-wrap: wrap;
        gap: 2rem;
        margin-top: 2rem;
    }

    .interview-list, .calendar-block {
        background-color: var(--bg-light);
        border-radius: var(--card-radius);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        padding: 25px;
        flex: 1 1 48%;
        transition: 0.3s ease-in-out;
    }

    body.dark-mode .interview-list, 
    body.dark-mode .calendar-block {
        background-color: #2c2f4a;
        color: var(--text-light);
    }

    .interview-list:hover, .calendar-block:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
    }

    .section-title {
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 1.5rem;
    }

    .table thead {
        background-color: #f8f9fa;
    }

    .table th,
    .table td {
        vertical-align: middle;
        font-size: 0.95rem;
        padding: 0.75rem;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(13, 110, 253, 0.05);
    }

    .badge {
        font-size: 0.75rem;
        padding: 0.4em 0.6em;
    }

    .btn-sm:hover {
        transform: scale(1.05);
        transition: all 0.2s ease-in-out;
    }

    @media (max-width: 991px) {
        .interview-list, .calendar-block {
            flex: 1 1 100%;
        }
    }
</style>

<div class="container py-4">
    <h2 class="section-title"><i class="bi bi-calendar-week"></i> Entretiens & Calendrier</h2>

    @if(session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    <div class="dashboard-section">
        <!-- Liste des entretiens -->
        <div class="interview-list">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0"><i class="bi bi-people-fill"></i> Liste des entretiens</h5>
                <a href="{{ route('company.interviews.create') }}" class="btn btn-primary shadow-sm">
                    <i class="bi bi-plus-circle"></i> Programmer
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Heure</th>
                            <th>Candidat</th>
                            <th>Poste</th>
                            <th>Mode</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($interviews as $interview)
                            <tr>
                                <td>{{ $interview->date }}</td>
                                <td>{{ $interview->time }}</td>
                                <td>{{ $interview->user->student->first_name ?? '' }} {{ $interview->user->student->last_name ?? $interview->user->name }}</td>
                                <td>{{ $interview->offer->title ?? 'N/A' }}</td>
                                <td>
                                    @if($interview->mode === 'en ligne')
                                        <a href="{{ $interview->location }}" target="_blank" class="btn btn-sm btn-outline-success">
                                            <i class="bi bi-camera-video"></i> Visio
                                        </a>
                                    @else
                                        <span class="badge bg-secondary">Présentiel</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge 
                                        @if($interview->status === 'prévu') bg-primary
                                        @elseif($interview->status === 'terminé') bg-success
                                        @elseif($interview->status === 'annulé') bg-danger
                                        @else bg-secondary @endif">
                                        {{ ucfirst($interview->status) }}
                                    </span>
                                </td>
                                <td class="d-flex gap-1">
                                    <a href="{{ route('company.interviews.edit', $interview->id) }}" class="btn btn-sm btn-outline-primary" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('company.interviews.destroy', $interview->id) }}" method="POST" onsubmit="return confirm('Supprimer cet entretien ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Supprimer">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">Aucun entretien programmé.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Calendrier -->
        <div class="calendar-block">
            <h5 class="fw-bold mb-3"><i class="bi bi-calendar-event-fill"></i> Calendrier</h5>
            <div id="calendar"></div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const calendarEl = document.getElementById('calendar');
        const calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'fr',
            initialView: 'dayGridMonth',
            height: 500,
            events: @json($calendarEvents),
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,listWeek'
            },
            buttonText: {
                today: 'Aujourd\'hui',
                month: 'Mois',
                week: 'Semaine',
                day: 'Jour',
                list: 'Liste'
            }
        });
        calendar.render();
    });

    // Mode sombre si le système est en dark mode
    if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        document.body.classList.add('dark-mode');
    }
</script>
@endsection
