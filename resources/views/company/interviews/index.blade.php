@extends('layouts.company')

@section('content')
<!-- FullCalendar CSS & JS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.8/index.global.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.8/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/locales/fr.global.min.js"></script>

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --success-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        --warning-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --danger-gradient: linear-gradient(135deg, #fc466b 0%, #3f5efb 100%);
        --info-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        --text-dark: #2d3748;
        --text-light: #ffffff;
        --bg-light: #f8fafc;
        --card-bg: #ffffff;
        --shadow-strong: 0 20px 40px rgba(0, 0, 0, 0.15);
        --shadow-soft: 0 10px 25px rgba(0, 0, 0, 0.08);
        --shadow-hover: 0 25px 50px rgba(0, 0, 0, 0.2);
        --transition-fast: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        --transition-smooth: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        --radius-xl: 24px;
        --radius-lg: 20px;
        --radius-md: 16px;
        --radius-sm: 12px;
    }

    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        font-family: 'Inter', 'Segoe UI', sans-serif;
        color: var(--text-dark);
        min-height: 100vh;
    }

    .fade-in {
        animation: fadeInUp 0.8s ease forwards;
        opacity: 0;
        transform: translateY(40px);
    }

    .fade-in:nth-child(2) { animation-delay: 0.1s; }
    .fade-in:nth-child(3) { animation-delay: 0.2s; }
    .fade-in:nth-child(4) { animation-delay: 0.3s; }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes shimmer {
        0% { transform: translateX(-100%) translateY(-100%) rotate(30deg); }
        100% { transform: translateX(100%) translateY(100%) rotate(30deg); }
    }

    .section-header {
        background: var(--primary-gradient);
        color: var(--text-light);
        padding: 50px 40px;
        border-radius: var(--radius-xl);
        font-size: 2.5rem;
        text-align: center;
        font-weight: 800;
        margin-bottom: 50px;
        box-shadow: var(--shadow-strong);
        position: relative;
        overflow: hidden;
    }

    .section-header::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
        animation: shimmer 3s infinite;
    }

    .alert {
        border: none;
        border-radius: var(--radius-lg);
        padding: 20px 30px;
        font-weight: 600;
        font-size: 1.1rem;
        box-shadow: var(--shadow-soft);
        position: relative;
        overflow: hidden;
    }

    .alert-success {
        background: var(--success-gradient);
        color: white;
    }

    .alert::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: rgba(255,255,255,0.3);
    }

    .card-container {
        background: var(--card-bg);
        border-radius: var(--radius-xl);
        padding: 40px;
        box-shadow: var(--shadow-strong);
        position: relative;
        overflow: hidden;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.3);
        margin-bottom: 40px;
        transition: var(--transition-smooth);
    }

    .card-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 8px;
        background: var(--primary-gradient);
    }

    .card-container:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-hover);
    }

    .table {
        margin-bottom: 0;
        border-radius: var(--radius-md);
        overflow: hidden;
        box-shadow: var(--shadow-soft);
    }

    .table thead th {
        background: var(--primary-gradient);
        color: var(--text-light);
        font-weight: 700;
        font-size: 1.1rem;
        padding: 20px 15px;
        border: none;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        position: relative;
    }

    .table thead th::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 2px;
        background: rgba(255,255,255,0.3);
    }

    .table tbody tr {
        background: var(--card-bg);
        transition: var(--transition-fast);
        border: none;
    }

    .table tbody tr:hover {
        background: linear-gradient(135deg, #f8f9ff 0%, #e3f2fd 100%);
        transform: scale(1.01);
        box-shadow: var(--shadow-soft);
    }

    .table tbody td {
        padding: 20px 15px;
        border: none;
        vertical-align: middle;
        font-weight: 600;
        position: relative;
    }

    .table tbody tr:not(:last-child) td {
        border-bottom: 1px solid rgba(0,0,0,0.05);
    }

    .badge {
        padding: 10px 20px;
        font-size: 0.9rem;
        font-weight: 700;
        border-radius: 50px;
        position: relative;
        overflow: hidden;
        animation: pulseGlow 3s infinite ease-in-out;
    }

    @keyframes pulseGlow {
        0%, 100% {
            opacity: 1;
            transform: scale(1);
            box-shadow: 0 0 0 0 rgba(255,255,255,0.4);
        }
        50% {
            opacity: 0.9;
            transform: scale(1.05);
            box-shadow: 0 0 0 10px rgba(255,255,255,0);
        }
    }

    .badge.bg-primary {
        background: var(--primary-gradient) !important;
        color: white;
    }

    .badge.bg-success {
        background: var(--success-gradient) !important;
        color: white;
    }

    .badge.bg-danger {
        background: var(--danger-gradient) !important;
        color: white;
    }

    .badge.bg-secondary {
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%) !important;
        color: white;
    }

    .btn {
        border-radius: var(--radius-sm);
        font-weight: 600;
        padding: 10px 20px;
        transition: var(--transition-fast);
        position: relative;
        overflow: hidden;
        border: none;
    }

    .btn::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(255,255,255,0.2);
        border-radius: 50%;
        transition: var(--transition-fast);
        transform: translate(-50%, -50%);
    }

    .btn:hover::before {
        width: 200px;
        height: 200px;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-soft);
    }

    .btn-primary {
        background: var(--primary-gradient);
        color: white;
    }

    .btn-outline-primary {
        border: 2px solid #667eea;
        color: #667eea;
        background: white;
    }

    .btn-outline-primary:hover {
        background: var(--primary-gradient);
        color: white;
        border-color: transparent;
    }

    .btn-outline-danger {
        border: 2px solid #fc466b;
        color: #fc466b;
        background: white;
    }

    .btn-outline-danger:hover {
        background: var(--danger-gradient);
        color: white;
        border-color: transparent;
    }

    .btn-outline-success {
        border: 2px solid #38ef7d;
        color: #11998e;
        background: white;
    }

    .btn-outline-success:hover {
        background: var(--success-gradient);
        color: white;
        border-color: transparent;
    }

    .btn-sm {
        padding: 8px 16px;
        font-size: 0.875rem;
    }

    .text-muted {
        color: #a0aec0 !important;
        font-style: italic;
    }

    .candidate-name {
        font-weight: 800;
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .offer-title {
        font-weight: 700;
        color: var(--text-dark);
        position: relative;
    }

    .offer-title::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background: var(--primary-gradient);
        transition: var(--transition-fast);
    }

    .offer-title:hover::after {
        width: 100%;
    }

    .section-title {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    /* Responsive améliorations */
    @media (max-width: 768px) {
        .section-header {
            font-size: 2rem;
            padding: 30px 20px;
        }

        .card-container {
            padding: 30px;
        }

        .table thead th,
        .table tbody td {
            padding: 15px 10px;
            font-size: 0.9rem;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 0.8rem;
        }
    }

    @media (max-width: 576px) {
        .section-header {
            font-size: 1.8rem;
            padding: 25px 15px;
        }

        .card-container {
            padding: 20px 15px;
        }

        .table thead th,
        .table tbody td {
            padding: 12px 8px;
            font-size: 0.8rem;
        }
    }
</style>

<div class="container py-5">
    <div class="section-header fade-in">
        📅 Gestion des Entretiens
    </div>

    @if(session('success'))
        <div class="alert alert-success text-center fade-in">{{ session('success') }}</div>
    @endif

    <!-- Section Liste des entretiens -->
    <div class="card-container fade-in">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="section-title">
                <i class="bi bi-people-fill"></i> Liste des Entretiens
            </h2>
            <a href="{{ route('company.interviews.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Programmer
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>📅 Date</th>
                        <th>🕒 Heure</th>
                        <th>👤 Candidat</th>
                        <th>💼 Poste</th>
                        <th>🌐 Mode</th>
                        <th>🏷️ Statut</th>
                        <th>⚙️ Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($interviews as $interview)
                        <tr>
                            <td>{{ $interview->date }}</td>
                            <td>{{ $interview->time }}</td>
                            <td>
                                <span class="candidate-name">
                                    {{ $interview->user->student->first_name ?? '' }} {{ $interview->user->student->last_name ?? $interview->user->name }}
                                </span>
                            </td>
                            <td>
                                <span class="offer-title">
                                    {{ $interview->offer->title ?? 'N/A' }}
                                </span>
                            </td>
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
                            <td class="d-flex gap-2">
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

    <!-- Section Calendrier -->
    <div class="card-container fade-in">
        <h2 class="section-title">
            <i class="bi bi-calendar-event-fill"></i> Calendrier des Entretiens
        </h2>
        <div id="calendar"></div>
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
            },
            eventContent: function(arg) {
                return {
                    html: `<div class="fc-event-title" style="font-weight:600;padding:2px 4px;border-radius:4px;background:${arg.event.backgroundColor}">
                              <i class="bi bi-person-circle"></i> ${arg.event.title}
                          </div>`
                };
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
