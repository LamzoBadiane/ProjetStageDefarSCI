@extends('admin.layouts.master')

@section('title', 'Tableau de bord')

@section('content')
<div class="dashboard-container">
    <!-- Header Premium avec animation -->
    <div class="dashboard-header mb-4">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="welcome-section">
                    <h1 class="dashboard-title mb-2">
                        <i class="bi bi-speedometer2 me-3 text-primary"></i>
                        Tableau de Bord
                    </h1>
                    <p class="dashboard-subtitle mb-0">Vue d'ensemble de votre plateforme de stage</p>
                </div>
            </div>
            <div class="col-lg-4 text-lg-end">
                <div class="user-welcome-card">
                    <div class="d-flex align-items-center justify-content-lg-end">
                        <div class="user-avatar me-3">
                            <div class="avatar-circle">
                                <i class="bi bi-person-check-fill"></i>
                            </div>
                        </div>
                        <div class="user-info">
                            <h6 class="mb-1 fw-bold">Bienvenue !</h6>
                            <span class="badge bg-gradient-success px-3 py-2 rounded-pill">
                                <i class="bi bi-shield-check me-1"></i>
                                {{ auth()->user()->first_name ?? 'Admin' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques principales avec animations -->
    <div class="stats-grid mb-4">
        <div class="row g-3">
            <!-- Carte Étudiants -->
            <div class="col-xl-3 col-md-6">
                <div class="stat-card students-card">
                    <div class="card-content">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div class="stat-icon students-icon">
                                <i class="bi bi-mortarboard-fill"></i>
                            </div>
                            <div class="trend-indicator positive">
                                <i class="bi bi-arrow-up"></i>
                                <span>+12%</span>
                            </div>
                        </div>
                        <h3 class="stat-number mb-1" data-count="{{ $students ?? 156 }}">0</h3>
                        <h6 class="stat-label mb-2">Étudiants</h6>
                        <small class="text-muted">
                            <i class="bi bi-calendar-week me-1"></i>
                            +23 cette semaine
                        </small>
                    </div>
                </div>
            </div>

            <!-- Carte Entreprises -->
            <div class="col-xl-3 col-md-6">
                <div class="stat-card companies-card">
                    <div class="card-content">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div class="stat-icon companies-icon">
                                <i class="bi bi-buildings"></i>
                            </div>
                            <div class="trend-indicator positive">
                                <i class="bi bi-arrow-up"></i>
                                <span>+8%</span>
                            </div>
                        </div>
                        <h3 class="stat-number mb-1" data-count="{{ $companies ?? 87 }}">0</h3>
                        <h6 class="stat-label mb-2">Entreprises</h6>
                        <small class="text-muted">
                            <i class="bi bi-building-add me-1"></i>
                            +5 ce mois-ci
                        </small>
                    </div>
                </div>
            </div>

            <!-- Carte Offres -->
            <div class="col-xl-3 col-md-6">
                <div class="stat-card offers-card">
                    <div class="card-content">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div class="stat-icon offers-icon">
                                <i class="bi bi-briefcase-fill"></i>
                            </div>
                            <div class="trend-indicator positive">
                                <i class="bi bi-arrow-up"></i>
                                <span>+15%</span>
                            </div>
                        </div>
                        <h3 class="stat-number mb-1" data-count="{{ $offers ?? 234 }}">0</h3>
                        <h6 class="stat-label mb-2">Offres</h6>
                        <small class="text-muted">
                            <i class="bi bi-briefcase-fill me-1"></i>
                            +12 aujourd'hui
                        </small>
                    </div>
                </div>
            </div>

            <!-- Nouvelle carte pour Candidatures -->
            <div class="col-xl-3 col-md-6">
                <div class="stat-card applications-card">
                    <div class="card-content">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div class="stat-icon applications-icon">
                                <i class="bi bi-file-earmark-text"></i>
                            </div>
                            <div class="trend-indicator positive">
                                <i class="bi bi-arrow-up"></i>
                                <span>+20%</span>
                            </div>
                        </div>
                        <h3 class="stat-number mb-1" data-count="{{ $applications ?? 189 }}">0</h3>
                        <h6 class="stat-label mb-2">Candidatures</h6>
                        <small class="text-muted">
                            <i class="bi bi-file-earmark-plus me-1"></i>
                            +15 cette semaine
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section graphiques et activités -->
    <div class="row g-3 mb-4">
        <!-- Graphique d'activité compact -->
        <div class="col-lg-6">
            <div class="analytics-card compact">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="bi bi-graph-up me-2"></i>
                        Activité récente
                    </h5>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-three-dots"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-download me-2"></i>Exporter</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body p-3">
                    <canvas id="activityChart" height="150"></canvas>
                </div>
            </div>
        </div>

        <!-- Activités récentes compact -->
        <div class="col-lg-6">
            <div class="activity-card compact">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-clock-history me-2"></i>
                        Dernières activités
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="activity-timeline">
                        <div class="activity-item">
                            <div class="activity-icon bg-success">
                                <i class="bi bi-person-plus"></i>
                            </div>
                            <div class="activity-content">
                                <h6 class="mb-1">Nouvel étudiant</h6>
                                <p class="mb-1">Marie Dupont s'est inscrite</p>
                                <small class="text-muted">Il y a 2h</small>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon bg-info">
                                <i class="bi bi-building-add"></i>
                            </div>
                            <div class="activity-content">
                                <h6 class="mb-1">Nouvelle entreprise</h6>
                                <p class="mb-1">TechCorp a rejoint</p>
                                <small class="text-muted">Il y a 4h</small>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon bg-warning">
                                <i class="bi bi-briefcase-fill"></i>
                            </div>
                            <div class="activity-content">
                                <h6 class="mb-1">Nouvelle offre</h6>
                                <p class="mb-1">Stage développeur web</p>
                                <small class="text-muted">Il y a 6h</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions rapides compact -->
    <div class="quick-actions-section">
        <h5 class="section-title mb-3">
            <i class="bi bi-lightning-fill me-2"></i>
            Actions Rapides
        </h5>
        <div class="row g-2">
            <div class="col-lg-3 col-md-6">
                <div class="quick-action-card compact" onclick="window.location.href='#'">
                    <div class="action-icon bg-primary">
                        <i class="bi bi-person-plus-fill"></i>
                    </div>
                    <h6>Ajouter Étudiant</h6>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="quick-action-card compact" onclick="window.location.href='#'">
                    <div class="action-icon bg-info">
                        <i class="bi bi-building-fill-add"></i>
                    </div>
                    <h6>Nouvelle Entreprise</h6>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="quick-action-card compact" onclick="window.location.href='#'">
                    <div class="action-icon bg-warning">
                        <i class="bi bi-briefcase-fill"></i>
                    </div>
                    <h6>Publier Offre</h6>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="quick-action-card compact" onclick="window.location.href='#'">
                    <div class="action-icon bg-success">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>
                    <h6>Voir Rapports</h6>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Variables CSS pour les couleurs */
:root {
    --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    --info-gradient: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
    --warning-gradient: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
    --danger-gradient: linear-gradient(135deg, #ff758c 0%, #ff7eb3 100%);
    --card-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    --hover-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
}

/* Container principal */
.dashboard-container {
    padding: 1.5rem;
    background-color: #f8fafc;
    min-height: 100vh;
}

/* Header du dashboard */
.dashboard-header {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: var(--card-shadow);
    margin-bottom: 1.5rem;
}

.dashboard-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: #2d3748;
    margin: 0;
}

.dashboard-subtitle {
    color: #718096;
    font-size: 1rem;
}

.user-welcome-card {
    background: white;
    border-radius: 10px;
    padding: 0.8rem;
    box-shadow: var(--card-shadow);
}

.user-avatar .avatar-circle {
    width: 40px;
    height: 40px;
    background: var(--primary-gradient);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
}

/* Cartes statistiques compactes */
.stat-card {
    background: white;
    border-radius: 12px;
    padding: 1.2rem;
    box-shadow: var(--card-shadow);
    transition: all 0.3s ease;
    height: auto;
    cursor: pointer;
    border-left: 4px solid;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--hover-shadow);
}

.students-card { border-left-color: #667eea; }
.companies-card { border-left-color: #43e97b; }
.offers-card { border-left-color: #fa709a; }
.applications-card { border-left-color: #ff758c; }

.stat-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    color: white;
}

.students-icon { background: var(--primary-gradient); }
.companies-icon { background: var(--info-gradient); }
.offers-icon { background: var(--warning-gradient); }
.applications-icon { background: var(--danger-gradient); }

.stat-number {
    font-size: 1.8rem;
    font-weight: 700;
    color: #2d3748;
    margin: 0.5rem 0;
}

.stat-label {
    color: #4a5568;
    font-weight: 600;
    font-size: 0.9rem;
}

.trend-indicator {
    background: rgba(72, 187, 120, 0.1);
    color: #48bb78;
    padding: 0.2rem 0.6rem;
    border-radius: 50px;
    font-size: 0.7rem;
    font-weight: 600;
}

/* Cartes analytiques compactes */
.analytics-card, .activity-card {
    background: white;
    border-radius: 12px;
    box-shadow: var(--card-shadow);
    border: none;
    height: 100%;
}

.analytics-card.compact .card-body {
    padding: 0.5rem;
}

.activity-card.compact .activity-item {
    padding: 0.8rem 0;
}

.compact .card-header {
    padding: 1rem;
    border-bottom: 1px solid #e2e8f0;
}

/* Actions rapides compactes */
.quick-actions-section {
    margin-top: 1.5rem;
}

.section-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #2d3748;
}

.quick-action-card.compact {
    padding: 1rem;
    text-align: center;
    border-radius: 10px;
    transition: all 0.3s ease;
    cursor: pointer;
    height: 100%;
}

.quick-action-card.compact:hover {
    transform: translateY(-3px);
    box-shadow: var(--hover-shadow);
}

.quick-action-card.compact .action-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    font-size: 1.2rem;
    margin: 0 auto 0.5rem;
}

.quick-action-card.compact h6 {
    font-size: 0.9rem;
    margin-bottom: 0;
}

/* Timeline d'activités compacte */
.activity-timeline {
    padding: 0.5rem;
}

.activity-item {
    display: flex;
    align-items: flex-start;
    padding: 0.8rem 1rem;
    border-bottom: 1px solid #f1f3f4;
}

.activity-item:last-child {
    border-bottom: none;
}

.activity-icon {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    font-size: 0.9rem;
    margin-right: 0.8rem;
    flex-shrink: 0;
}

.activity-content h6 {
    font-size: 0.85rem;
    margin-bottom: 0.2rem;
}

.activity-content p {
    font-size: 0.75rem;
    margin-bottom: 0.2rem;
}

/* Responsive */
@media (max-width: 768px) {
    .dashboard-container {
        padding: 1rem;
    }

    .dashboard-title {
        font-size: 1.5rem;
    }

    .stat-card {
        margin-bottom: 1rem;
    }

    .user-welcome-card {
        margin-top: 1rem;
    }

    .quick-action-card.compact {
        margin-bottom: 0.5rem;
    }
}
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation des compteurs
    function animateCounter(element) {
        const target = parseInt(element.getAttribute('data-count'));
        const duration = 1500;
        const step = target / (duration / 16);
        let current = 0;

        const timer = setInterval(() => {
            current += step;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            element.textContent = Math.floor(current);
        }, 16);
    }

    // Démarrer l'animation des compteurs
    document.querySelectorAll('.stat-number').forEach(animateCounter);

    // Graphique d'activité compact
    const ctx = document.getElementById('activityChart');
    if (ctx) {
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
                datasets: [{
                    label: 'Inscriptions',
                    data: [12, 19, 15, 25, 22, 18, 24],
                    borderColor: '#667eea',
                    backgroundColor: 'rgba(102, 126, 234, 0.05)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.3,
                    pointBackgroundColor: '#667eea',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 1,
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            stepSize: 5
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                elements: {
                    point: {
                        hoverRadius: 5
                    }
                }
            }
        });
    }
});
</script>

@endsection
