@extends('layouts.company')

@section('content')
<!-- Dépendances -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
:root {
    --primary: #4e54c8;
    --secondary: #8f94fb;
    --warning: #ffc107;
    --light-bg: #f3f5ff;
    --dark-bg: #1a1a2e;
    --dark-card: #232342;
    --transition: all 0.3s ease-in-out;
}

/* Thème général */
body {
    background: linear-gradient(to right, var(--light-bg), #e0f7fa);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    transition: var(--transition);
    color: #333;
}
body.dark-mode {
    background: var(--dark-bg);
    color: #e0e0e0;
}

/* Thème switch */
.toggle-theme {
    position: fixed;
    top: 20px;
    right: 20px;
    font-size: 1.6rem;
    cursor: pointer;
    color: var(--primary);
    z-index: 999;
    transition: var(--transition);
}
body.dark-mode .toggle-theme {
    color: #fff;
}

/* Titre principal */
.title {
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    color: white;
    padding: 20px;
    border-radius: 16px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

/* Boîte de bienvenue */
.welcome-box {
    background: linear-gradient(90deg, var(--primary), var(--secondary));
    color: white;
    padding: 20px;
    border-radius: 16px;
    font-size: 1.15rem;
    margin-bottom: 30px;
}

/* Cartes statistiques */
.card-stat {
    background: #fff;
    border-radius: 16px;
    text-align: center;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    transition: var(--transition);
}
.card-stat:hover {
    transform: translateY(-6px);
    box-shadow: 0 8px 24px rgba(0,0,0,0.15);
}
body.dark-mode .card-stat {
    background: var(--dark-card);
    color: white;
}

/* Alertes */
.alert {
    border-radius: 10px;
    transition: var(--transition);
}
body.dark-mode .alert-warning {
    background-color: #665c00;
    color: white;
}
body.dark-mode .alert-success {
    background-color: #225522;
    color: white;
}

/* Sections */
.section-title {
    font-size: 1.4rem;
    font-weight: 600;
    color: inherit;
    border-left: 5px solid var(--primary);
    padding-left: 12px;
    margin-bottom: 20px;
}

/* Listes */
.list-group-item {
    background: white;
    border-radius: 12px;
    margin-bottom: 10px;
    border: none;
    box-shadow: 0 2px 6px rgba(0,0,0,0.06);
    transition: var(--transition);
}
body.dark-mode .list-group-item {
    background: var(--dark-card);
    color: white;
}

/* Graphique */
.chart-card {
    background: white;
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.1);
    transition: var(--transition);
}
body.dark-mode .chart-card {
    background: var(--dark-card);
}

/* Calendrier */
.calendar-box {
    background: white;
    padding: 20px;
    border-radius: 20px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    transition: var(--transition);
}
body.dark-mode .calendar-box {
    background: var(--dark-card);
    color: white;
}

/* Actions rapides (futur ajout) */
.quick-action-card {
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    color: white;
    padding: 20px;
    border-radius: 16px;
    text-align: center;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    transition: var(--transition);
}
.quick-action-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
}
</style>

<div class="container py-5">
    <!-- Thème toggle -->
    <div class="toggle-theme" onclick="toggleTheme()">
        <i class="bi bi-circle-half"></i>
    </div>

    <!-- Titre -->
    <h2 class="text-center title mb-5 animate__animated animate__fadeInDown">
        🏢 Tableau de bord Entreprise
    </h2>

    <!-- Bienvenue -->
    <div class="welcome-box animate__animated animate__fadeIn">
        👋 Gérez vos offres et suivez vos recrutements en toute simplicité.
    </div>

    <!-- Alertes -->
    @if($pendingOffersCount > 0)
        <div class="alert alert-warning text-center animate__animated animate__fadeIn">
            ⚠️ {{ $pendingOffersCount }} offre{{ $pendingOffersCount > 1 ? 's' : '' }} en attente de validation.
            <a href="{{ route('company.offers.index') }}" class="fw-bold text-decoration-underline">Valider maintenant</a>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success text-center animate__animated animate__fadeIn">
            {{ session('success') }}
        </div>
    @endif

    <!-- Statistiques -->
    <div class="row g-4 mb-4">
        <div class="col-md-4 animate__animated animate__zoomIn">
            <div class="card card-stat">
                <div class="card-body">
                    <h5 class="text-primary">📄 Offres publiées</h5>
                    <p class="fs-3 text-primary">{{ $offersCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 animate__animated animate__zoomIn animate__delay-1s">
            <div class="card card-stat">
                <div class="card-body">
                    <h5 class="text-success">📨 Candidatures reçues</h5>
                    <p class="fs-3 text-success">{{ $applicationsCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 animate__animated animate__zoomIn animate__delay-2s">
            <div class="card card-stat">
                <div class="card-body">
                    <h5 class="text-warning">⏳ Offres en attente</h5>
                    <p class="fs-3 text-warning">{{ $pendingOffersCount }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Listes -->
    <div class="row g-4">
        <div class="col-md-6">
            <h4 class="section-title">🆕 Dernières Offres</h4>
            <ul class="list-group">
                @forelse($recentOffers as $offer)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $offer->title }}
                        <span class="badge bg-primary">{{ $offer->created_at->format('d/m/Y') }}</span>
                    </li>
                @empty
                    <li class="list-group-item text-muted">Aucune offre récente.</li>
                @endforelse
            </ul>
        </div>

        <div class="col-md-6">
            <h4 class="section-title">📝 Dernières Candidatures</h4>
            <ul class="list-group">
                @forelse($recentApplications as $app)
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between">
                            <strong>{{ $app->offer->title ?? 'Offre supprimée' }}</strong>
                            <span class="badge bg-success">{{ $app->created_at->format('d/m/Y') }}</span>
                        </div>
                        <small class="text-muted">👤 {{ $app->user->name ?? 'Nom inconnu' }} {{ $app->user->first_name ?? '' }}</small>
                    </li>
                @empty
                    <li class="list-group-item text-muted">Aucune candidature récente.</li>
                @endforelse
            </ul>
        </div>
    </div>

    <!-- Statistiques -->
    <div class="chart-card mt-5 animate__animated animate__fadeInUp">
        <h4 class="section-title">📊 Statistiques Visuelles</h4>
        <canvas id="statsChart" height="120"></canvas>
    </div>

    <!-- Calendrier -->
    <div class="calendar-box mt-5">
        <h4 class="section-title">📅 Calendrier</h4>
        <div id="calendar"></div>
    </div>
</div>

<!-- Script JS -->
<script>
    const ctx = document.getElementById('statsChart').getContext('2d');
    const statsChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Offres publiées', 'Candidatures reçues', 'Offres en attente'],
            datasets: [{
                label: 'Statistiques',
                data: [{{ $offersCount }}, {{ $applicationsCount }}, {{ $pendingOffersCount }}],
                backgroundColor: [
                    'rgba(78, 84, 200, 0.6)',
                    'rgba(143, 148, 251, 0.6)',
                    'rgba(255, 193, 7, 0.6)'
                ],
                borderColor: [
                    'rgba(78, 84, 200, 1)',
                    'rgba(143, 148, 251, 1)',
                    'rgba(255, 193, 7, 1)'
                ],
                borderWidth: 1,
                borderRadius: 10
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    const calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
        initialView: 'dayGridMonth',
        height: 500,
        events: [] // Tu pourras y injecter des événements dynamiques plus tard
    });
    calendar.render();

    function toggleTheme() {
        document.body.classList.toggle('dark-mode');
        localStorage.setItem('theme', document.body.classList.contains('dark-mode') ? 'dark' : 'light');
    }

    document.addEventListener('DOMContentLoaded', () => {
        if (localStorage.getItem('theme') === 'dark') {
            document.body.classList.add('dark-mode');
        }
    });
</script>
@endsection
