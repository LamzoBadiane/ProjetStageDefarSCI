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
    --primary-light: #8f94fb;
    --secondary: #00b4d8;
    --accent: #ff9e00;
    --light-bg: #f8f9ff;
    --dark-bg: #0f172a;
    --dark-card: #1e293b;
    --transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.1);
    --shadow-sm: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    --shadow-md: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

/* Thème général */
body {
    background: var(--light-bg);
    font-family: 'Calibri', 'Arial', sans-serif;
    font-size: 17px; /* Augmenté de 16px à 18px */
    transition: var(--transition);
    color: #334155;
    line-height: 1.6;
}
body.dark-mode {
    background: var(--dark-bg);
    color: #e2e8f0;
}

/* Thème switch */
.theme-toggle {
    position: fixed;
    top: 20px;
    right: 20px;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: white;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: var(--shadow-md);
    cursor: pointer;
    z-index: 999;
    transition: var(--transition);
}
.theme-toggle i {
    font-size: 2rem; /* Augmenté de 1.4rem à 1.6rem */
    color: var(--primary);
    transition: var(--transition);
}
body.dark-mode .theme-toggle {
    background: var(--dark-card);
}
body.dark-mode .theme-toggle i {
    color: var(--accent);
}

/* Container principal */
.dashboard-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 2rem;
}

/* Titre principal */
.dashboard-title {
    font-size: 2.5rem; /* Augmenté de 2.5rem à 3rem */
    font-weight: 700;
    font-family: 'Calibri', 'Arial', sans-serif;
    background: linear-gradient(135deg, var(--primary), var(--primary-light));
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    margin-bottom: 2rem;
    position: relative;
    display: inline-block;
    padding-bottom: 0.5rem;
}
.dashboard-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(90deg, var(--primary), var(--primary-light));
    border-radius: 2px;
}
body.dark-mode .dashboard-title {
    background: linear-gradient(135deg, var(--primary-light), var(--secondary));
    -webkit-background-clip: text;
    background-clip: text;
}

/* Boîte de bienvenue */
.welcome-card {
    background: linear-gradient(135deg, var(--primary), var(--primary-light));
    color: white;
    padding: 2rem;
    border-radius: 16px;
    margin-bottom: 2rem;
    box-shadow: var(--shadow-md);
    position: relative;
    overflow: hidden;
    transition: var(--transition);
}
.welcome-card::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
    transform: rotate(30deg);
    transition: var(--transition);
}
.welcome-card:hover::before {
    transform: rotate(45deg);
}
.welcome-content {
    position: relative;
    z-index: 2;
    display: flex;
    align-items: center;
    gap: 1.5rem;
}
.welcome-icon {
    font-size: 3rem; /* Augmenté de 2.5rem à 3rem */
    flex-shrink: 0;
}
.welcome-text {
    font-size: 1.3rem; /* Augmenté de 1.3rem à 1.5rem */
    font-weight: 500;
    font-family: 'Calibri', 'Arial', sans-serif;
}

/* Alertes */
.alert-notification {
    border-radius: 12px;
    border: none;
    box-shadow: var(--shadow-sm);
    padding: 1rem 1.5rem;
    margin-bottom: 2rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    transition: var(--transition);
    font-family: 'Calibri', 'Arial', sans-serif;
    font-size: 1.3rem; /* Augmenté de 1.1rem à 1.3rem */
}
.alert-notification i {
    font-size: 1.7rem; /* Augmenté de 1.5rem à 1.7rem */
}
.alert-warning {
    background-color: #fffbeb;
    color: #92400e;
}
.alert-success {
    background-color: #ecfdf5;
    color: #065f46;
}
body.dark-mode .alert-warning {
    background-color: #3a2a03;
    color: #fef3c7;
}
body.dark-mode .alert-success {
    background-color: #022c22;
    color: #a7f3d0;
}

/* Grille de statistiques */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
    margin-bottom: 3rem;
}

/* Cartes statistiques */
.stat-card {
    background: white;
    border-radius: 16px;
    padding: 1.5rem;
    box-shadow: var(--shadow-sm);
    transition: var(--transition);
    position: relative;
    overflow: hidden;
    border: 1px solid rgba(0, 0, 0, 0.05);
}
.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-md);
}
.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: var(--primary);
    transition: var(--transition);
}
.stat-card:nth-child(2)::before {
    background: var(--secondary);
}
.stat-card:nth-child(3)::before {
    background: var(--accent);
}
body.dark-mode .stat-card {
    background: var(--dark-card);
    border-color: rgba(255, 255, 255, 0.05);
}
.stat-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.7rem; /* Augmenté de 1.5rem à 1.7rem */
    margin-bottom: 1rem;
    color: white;
    background: linear-gradient(135deg, var(--primary), var(--primary-light));
}
.stat-card:nth-child(2) .stat-icon {
    background: linear-gradient(135deg, var(--secondary), #48cae4);
}
.stat-card:nth-child(3) .stat-icon {
    background: linear-gradient(135deg, var(--accent), #ffb700);
}
.stat-value {
    font-size: 2.5rem; /* Augmenté de 2.5rem à 3rem */
    font-weight: 700;
    font-family: 'Calibri', 'Arial', sans-serif;
    margin: 0.5rem 0;
    background: linear-gradient(135deg, var(--primary), var(--primary-light));
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
}
.stat-card:nth-child(2) .stat-value {
    background: linear-gradient(135deg, var(--secondary), #48cae4);
    -webkit-background-clip: text;
    background-clip: text;
}
.stat-card:nth-child(3) .stat-value {
    background: linear-gradient(135deg, var(--accent), #ffb700);
    -webkit-background-clip: text;
    background-clip: text;
}
.stat-label {
    font-size: 1.1rem; /* Augmenté de 1.1rem à 1.3rem */
    font-family: 'Calibri', 'Arial', sans-serif;
    color: #64748b;
    font-weight: 500;
}
body.dark-mode .stat-label {
    color: #94a3b8;
}

/* Graphique */
.chart-container {
    background: white;
    border-radius: 16px;
    padding: 1.5rem;
    box-shadow: var(--shadow-sm);
    margin-bottom: 2rem;
    transition: var(--transition);
}
body.dark-mode .chart-container {
    background: var(--dark-card);
}
.chart-header {
    margin-bottom: 1rem;
}
.chart-wrapper {
    position: relative;
    height: 200px;
    width: 100%;
}

/* Sections doubles */
.double-section {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

/* Cartes de liste */
.list-card {
    background: white;
    border-radius: 16px;
    box-shadow: var(--shadow-sm);
    padding: 1.5rem;
    transition: var(--transition);
    height: 100%;
}
.list-card:hover {
    box-shadow: var(--shadow-md);
}
body.dark-mode .list-card {
    background: var(--dark-card);
}
.section-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1.5rem;
}
.section-title {
    font-size: 1.6rem; /* Augmenté de 1.4rem à 1.6rem */
    font-weight: 600;
    font-family: 'Calibri', 'Arial', sans-serif;
    color: inherit;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}
.section-title i {
    color: var(--primary);
}
.view-all {
    font-size: 1.2rem; /* Augmenté de 1rem à 1.2rem */
    font-family: 'Calibri', 'Arial', sans-serif;
    color: var(--primary);
    font-weight: 500;
    text-decoration: none;
    transition: var(--transition);
}
.view-all:hover {
    color: var(--primary-light);
    text-decoration: underline;
}
.list-item {
    padding: 1rem;
    border-radius: 12px;
    margin-bottom: 0.75rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    transition: var(--transition);
    background: #f8fafc;
}
.list-item:last-child {
    margin-bottom: 0;
}
.list-item:hover {
    background: #f1f5f9;
    transform: translateX(5px);
}
.list-item-content {
    flex: 1;
}
.list-item-title {
    font-weight: 500;
    font-family: 'Calibri', 'Arial', sans-serif;
    font-size: 1.3rem; /* Augmenté de 1.1rem à 1.3rem */
    margin-bottom: 0.25rem;
}
.list-item-subtitle {
    font-size: 1.1rem; /* Augmenté de 0.95rem à 1.1rem */
    font-family: 'Calibri', 'Arial', sans-serif;
    color: #64748b;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.list-item-date {
    font-size: 1.1rem; /* Augmenté de 0.95rem à 1.1rem */
    font-family: 'Calibri', 'Arial', sans-serif;
    color: #64748b;
    background: #f1f5f9;
    padding: 0.25rem 0.5rem;
    border-radius: 8px;
    font-weight: 500;
}
body.dark-mode .list-item {
    background: #1e293b;
}
body.dark-mode .list-item:hover {
    background: #334155;
}
body.dark-mode .list-item-subtitle,
body.dark-mode .list-item-date {
    color: #94a3b8;
}
body.dark-mode .list-item-date {
    background: #334155;
}

/* Calendrier */
.calendar-container {
    background: white;
    border-radius: 16px;
    padding: 2rem;
    box-shadow: var(--shadow-sm);
    transition: var(--transition);
}
.calendar-container:hover {
    box-shadow: var(--shadow-md);
}
body.dark-mode .calendar-container {
    background: var(--dark-card);
}
.fc {
    border-radius: 12px;
    overflow: hidden;
    font-family: 'Calibri', 'Arial', sans-serif;
    font-size: 1.1rem; /* Ajouté pour augmenter la taille du calendrier */
}
.fc-header-toolbar {
    margin-bottom: 1rem !important;
}
.fc-button {
    background: var(--primary) !important;
    border: none !important;
    font-family: 'Calibri', 'Arial', sans-serif !important;
    font-size: 1.1rem !important; /* Ajouté pour les boutons du calendrier */
    transition: var(--transition) !important;
}
.fc-button:hover {
    background: var(--primary-light) !important;
}
.fc-daygrid-day-number, .fc-col-header-cell-cushion {
    color: inherit !important;
    font-family: 'Calibri', 'Arial', sans-serif !important;
    font-size: 1.1rem !important; /* Ajouté pour les dates du calendrier */
    text-decoration: none !important;
}
body.dark-mode .fc-theme-standard .fc-scrollgrid,
body.dark-mode .fc-theme-standard td, 
body.dark-mode .fc-theme-standard th {
    border-color: #334155 !important;
}
body.dark-mode .fc-daygrid-day.fc-day-today {
    background-color: rgba(0, 180, 216, 0.1) !important;
}

/* Animations */
.animate-delay-1 {
    animation-delay: 0.2s;
}
.animate-delay-2 {
    animation-delay: 0.4s;
}
.animate-delay-3 {
    animation-delay: 0.6s;
}
.animate-delay-4 {
    animation-delay: 0.8s;
}

/* Responsive */
@media (max-width: 768px) {
    .dashboard-container {
        padding: 1.5rem;
    }
    .stats-grid {
        grid-template-columns: 1fr;
    }
    .double-section {
        grid-template-columns: 1fr;
    }
    .welcome-content {
        flex-direction: column;
        text-align: center;
    }
    /* Ajustement mobile pour les polices */
    .dashboard-title {
        font-size: 2.5rem;
    }
    .welcome-text {
        font-size: 1.3rem;
    }
    .stat-value {
        font-size: 2.5rem;
    }
}
</style>

<div class="dashboard-container">
    <!-- Thème toggle -->
    <div class="theme-toggle animate__animated animate__fadeIn" onclick="toggleTheme()">
        <i class="bi bi-moon-stars"></i>
    </div>

    <!-- Titre -->
    <h1 class="dashboard-title animate__animated animate__fadeInDown">
        🏢 Tableau de bord Entreprise
    </h1>

    <!-- Bienvenue -->
    <div class="welcome-card animate__animated animate__fadeIn">
        <div class="welcome-content">
            <div class="welcome-icon">
                <i class="bi bi-emoji-smile"></i>
            </div>
            <div class="welcome-text">
                Bienvenue sur votre espace entreprise. Gérez vos offres, suivez vos candidatures et planifiez vos entretiens en toute simplicité.
            </div>
        </div>
    </div>

    <!-- Alertes -->
    @if($pendingOffersCount > 0)
        <div class="alert-notification alert-warning animate__animated animate__fadeIn">
            <i class="bi bi-exclamation-triangle"></i>
            <div>
                <strong>Action requise</strong> - Vous avez {{ $pendingOffersCount }} offre{{ $pendingOffersCount > 1 ? 's' : '' }} en attente de validation.
                <a href="{{ route('company.offers.index') }}" class="text-decoration-none fw-bold">Voir les offres</a>
            </div>
        </div>
    @endif

    @if(session('success'))
        <div class="alert-notification alert-success animate__animated animate__fadeIn">
            <i class="bi bi-check-circle"></i>
            <div>
                <strong>Succès !</strong> {{ session('success') }}
            </div>
        </div>
    @endif

    <!-- Statistiques -->
    <div class="stats-grid">
        <div class="stat-card animate__animated animate__fadeInLeft">
            <div class="stat-icon">
                <i class="bi bi-file-earmark-text"></i>
            </div>
            <div class="stat-value">{{ $offersCount }}</div>
            <div class="stat-label">Offres publiées</div>
        </div>
        
        <div class="stat-card animate__animated animate__fadeInLeft animate-delay-1">
            <div class="stat-icon">
                <i class="bi bi-envelope-paper"></i>
            </div>
            <div class="stat-value">{{ $applicationsCount }}</div>
            <div class="stat-label">Candidatures reçues</div>
        </div>
        
        <div class="stat-card animate__animated animate__fadeInLeft animate-delay-2">
            <div class="stat-icon">
                <i class="bi bi-hourglass-split"></i>
            </div>
            <div class="stat-value">{{ $pendingOffersCount }}</div>
            <div class="stat-label">Offres en attente</div>
        </div>
    </div>

    <!-- Graphique compact -->
    <div class="chart-container animate__animated animate__fadeIn">
        <div class="chart-header">
            <h3 class="section-title"><i class="bi bi-bar-chart"></i> Aperçu des statistiques</h3>
        </div>
        <div class="chart-wrapper">
            <canvas id="statsChart" height="200"></canvas>
        </div>
    </div>

    <!-- Listes -->
    <div class="double-section">
        <div class="list-card animate__animated animate__fadeInUp">
            <div class="section-header">
                <h3 class="section-title"><i class="bi bi-file-earmark-text"></i> Dernières offres</h3>
                <a href="{{ route('company.offers.index') }}" class="view-all">Voir tout</a>
            </div>
            
            <div class="list-items">
                @forelse($recentOffers as $offer)
                    <div class="list-item">
                        <div class="list-item-content">
                            <div class="list-item-title">{{ $offer->title }}</div>
                            <div class="list-item-subtitle">
                                <i class="bi bi-calendar"></i> Publiée le {{ $offer->created_at->format('d/m/Y') }}
                            </div>
                        </div>
                        <div class="list-item-date">
                            {{ $offer->applications_count }} candidat{{ $offer->applications_count > 1 ? 's' : '' }}
                        </div>
                    </div>
                @empty
                    <div class="text-center py-3 text-muted" style="font-size: 1.3rem;">
                        Aucune offre récente
                    </div>
                @endforelse
            </div>
        </div>
        
        <div class="list-card animate__animated animate__fadeInUp animate-delay-1">
            <div class="section-header">
                <h3 class="section-title"><i class="bi bi-people"></i> Dernières candidatures</h3>
                <a href="{{ route('company.applications.index') }}" class="view-all">Voir tout</a>
            </div>
            
            <div class="list-items">
                @forelse($recentApplications as $app)
                    <div class="list-item">
                        <div class="list-item-content">
                            <div class="list-item-title">{{ $app->offer->title ?? 'Offre supprimée' }}</div>
                            <div class="list-item-subtitle">
                                <i class="bi bi-person"></i> {{ $app->user->name ?? 'Nom inconnu' }} {{ $app->user->first_name ?? '' }}
                            </div>
                        </div>
                        <div class="list-item-date">
                            {{ $app->created_at->format('d/m/Y') }}
                        </div>
                    </div>
                @empty
                    <div class="text-center py-3 text-muted" style="font-size: 1.3rem;">
                        Aucune candidature récente
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Calendrier -->
    <div class="calendar-container animate__animated animate__fadeIn">
        <div class="chart-header">
            <h3 class="section-title"><i class="bi bi-calendar-date"></i> Calendrier des entretiens</h3>
        </div>
        <div id="calendar"></div>
    </div>
</div>

<!-- Script JS -->
<script>
// Chart configuration
const ctx = document.getElementById('statsChart').getContext('2d');
const statsChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Offres', 'Candidatures', 'En attente'],
        datasets: [{
            data: [{{ $offersCount }}, {{ $applicationsCount }}, {{ $pendingOffersCount }}],
            backgroundColor: [
                'rgba(78, 84, 200, 0.7)',
                'rgba(0, 180, 216, 0.7)',
                'rgba(255, 158, 0, 0.7)'
            ],
            borderColor: [
                'rgba(78, 84, 200, 1)',
                'rgba(0, 180, 216, 1)',
                'rgba(255, 158, 0, 1)'
            ],
            borderWidth: 1,
            borderRadius: 8
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { 
                display: false
            },
            tooltip: {
                titleFont: { family: 'Calibri', size: 14 }, /* Augmenté pour les tooltips */
                bodyFont: { family: 'Calibri', size: 13 }, /* Augmenté pour les tooltips */
                callbacks: {
                    label: function(context) {
                        return context.parsed.y + ' ' + context.label.toLowerCase();
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: { color: 'rgba(0, 0, 0, 0.05)' },
                ticks: { 
                    stepSize: 1,
                    font: { family: 'Calibri', size: 12 } /* Augmenté pour les ticks */
                }
            },
            x: {
                grid: { display: false },
                ticks: {
                    font: { family: 'Calibri', size: 12 } /* Augmenté pour les ticks */
                }
            }
        }
    }
});

// Calendar configuration
document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: 'auto',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: [], // À remplacer avec vos événements dynamiques
        eventColor: '#4e54c8',
        nowIndicator: true,
        locale: 'fr',
        buttonText: {
            today: 'Aujourd\'hui',
            month: 'Mois',
            week: 'Semaine',
            day: 'Jour'
        }
    });
    calendar.render();
});

// Theme toggle
function toggleTheme() {
    const body = document.body;
    body.classList.toggle('dark-mode');
    const icon = document.querySelector('.theme-toggle i');
    
    if (body.classList.contains('dark-mode')) {
        icon.classList.remove('bi-moon-stars');
        icon.classList.add('bi-sun');
        localStorage.setItem('theme', 'dark');
    } else {
        icon.classList.remove('bi-sun');
        icon.classList.add('bi-moon-stars');
        localStorage.setItem('theme', 'light');
    }
}

// Check for saved theme preference
document.addEventListener('DOMContentLoaded', () => {
    if (localStorage.getItem('theme') === 'dark') {
        document.body.classList.add('dark-mode');
        const icon = document.querySelector('.theme-toggle i');
        icon.classList.remove('bi-moon-stars');
        icon.classList.add('bi-sun');
    }
}); 

// Update chart on theme change
document.body.addEventListener('click', function(e) {
    if (e.target.closest('.theme-toggle')) {
        setTimeout(() => {
            statsChart.update();
        }, 300);
    }
});
</script>
@endsection