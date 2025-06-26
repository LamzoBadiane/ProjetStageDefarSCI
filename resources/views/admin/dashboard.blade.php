@extends('admin.layouts.master')

@section('title', 'Tableau de bord')

@section('content')
<div class="dashboard-container">
    <!-- Header Premium avec animation -->
    <div class="dashboard-header mb-5">
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
    <div class="stats-grid mb-5">
        <div class="row g-4">
            <!-- Carte Étudiants -->
            <div class="col-xl-4 col-lg-6">
                <div class="stat-card students-card">
                    <div class="card-background">
                        <div class="floating-icon">
                            <i class="bi bi-mortarboard-fill"></i>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="stat-icon students-icon">
                                <i class="bi bi-mortarboard-fill"></i>
                            </div>
                            <div class="trend-indicator positive">
                                <i class="bi bi-arrow-up"></i>
                                <span>+12%</span>
                            </div>
                        </div>
                        <h3 class="stat-number mb-1" data-count="{{ $students ?? 156 }}">0</h3>
                        <h6 class="stat-label mb-2">Étudiants Inscrits</h6>
                        <div class="progress stat-progress mb-2">
                            <div class="progress-bar bg-primary" style="width: 75%"></div>
                        </div>
                        <small class="text-muted">
                            <i class="bi bi-calendar-week me-1"></i>
                            +23 cette semaine
                        </small>
                    </div>
                </div>
            </div>

            <!-- Carte Entreprises -->
            <div class="col-xl-4 col-lg-6">
                <div class="stat-card companies-card">
                    <div class="card-background">
                        <div class="floating-icon">
                            <i class="bi bi-buildings"></i>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="stat-icon companies-icon">
                                <i class="bi bi-buildings"></i>
                            </div>
                            <div class="trend-indicator positive">
                                <i class="bi bi-arrow-up"></i>
                                <span>+8%</span>
                            </div>
                        </div>
                        <h3 class="stat-number mb-1" data-count="{{ $companies ?? 87 }}">0</h3>
                        <h6 class="stat-label mb-2">Entreprises Partenaires</h6>
                        <div class="progress stat-progress mb-2">
                            <div class="progress-bar bg-info" style="width: 60%"></div>
                        </div>
                        <small class="text-muted">
                            <i class="bi bi-building-add me-1"></i>
                            +5 ce mois-ci
                        </small>
                    </div>
                </div>
            </div>

            <!-- Carte Offres -->
            <div class="col-xl-4 col-lg-6">
                <div class="stat-card offers-card">
                    <div class="card-background">
                        <div class="floating-icon">
                            <i class="bi bi-briefcase-fill"></i>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="stat-icon offers-icon">
                                <i class="bi bi-briefcase-fill"></i>
                            </div>
                            <div class="trend-indicator positive">
                                <i class="bi bi-arrow-up"></i>
                                <span>+15%</span>
                            </div>
                        </div>
                        <h3 class="stat-number mb-1" data-count="{{ $offers ?? 234 }}">0</h3>
                        <h6 class="stat-label mb-2">Offres de Stage</h6>
                        <div class="progress stat-progress mb-2">
                            <div class="progress-bar bg-warning" style="width: 85%"></div>
                        </div>
                        <small class="text-muted">
                            <i class="bi bi-briefcase-fill me-1"></i>
                            +12 aujourd'hui
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section graphiques et activités -->
    <div class="row g-4 mb-5">
        <!-- Graphique d'activité -->
        <div class="col-xl-8">
            <div class="analytics-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="bi bi-graph-up me-2"></i>
                        Activité des 7 derniers jours
                    </h5>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-three-dots"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-download me-2"></i>Exporter</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-printer me-2"></i>Imprimer</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="activityChart" height="100"></canvas>
                </div>
            </div>
        </div>

        <!-- Activités récentes -->
        <div class="col-xl-4">
            <div class="activity-card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-clock-history me-2"></i>
                        Activités Récentes
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
                                <p class="mb-1">TechCorp a rejoint la plateforme</p>
                                <small class="text-muted">Il y a 4h</small>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon bg-warning">
                                <i class="bi bi-briefcase-fill"></i>
                            </div>
                            <div class="activity-content">
                                <h6 class="mb-1">Nouvelle offre</h6>
                                <p class="mb-1">Stage développeur web publié</p>
                                <small class="text-muted">Il y a 6h</small>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon bg-primary">
                                <i class="bi bi-check-circle"></i>
                            </div>
                            <div class="activity-content">
                                <h6 class="mb-1">Candidature validée</h6>
                                <p class="mb-1">Jean Martin accepté chez StartupX</p>
                                <small class="text-muted">Il y a 1j</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions rapides -->
    <div class="quick-actions-section">
        <h5 class="section-title mb-4">
            <i class="bi bi-lightning-fill me-2"></i>
            Actions Rapides
        </h5>
        <div class="row g-3">
            <div class="col-lg-3 col-md-6">
                <div class="quick-action-card" onclick="window.location.href='#'">
                    <div class="action-icon bg-primary">
                        <i class="bi bi-person-plus-fill"></i>
                    </div>
                    <h6>Ajouter Étudiant</h6>
                    <p>Inscrire un nouvel étudiant</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="quick-action-card" onclick="window.location.href='#'">
                    <div class="action-icon bg-info">
                        <i class="bi bi-building-fill-add"></i>
                    </div>
                    <h6>Nouvelle Entreprise</h6>
                    <p>Ajouter une entreprise partenaire</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="quick-action-card" onclick="window.location.href='#'">
                    <div class="action-icon bg-warning">
                        <i class="bi bi-briefcase-fill"></i>
                    </div>
                    <h6>Publier Offre</h6>
                    <p>Créer une nouvelle offre de stage</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="quick-action-card" onclick="window.location.href='#'">
                    <div class="action-icon bg-success">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>
                    <h6>Voir Rapports</h6>
                    <p>Consulter les statistiques détaillées</p>
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
    --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    --hover-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

/* Container principal */
.dashboard-container {
    padding: 2rem;
    background: linear-gradient(135deg, #f8f9ff 0%, #ffffff 100%);
    min-height: 100vh;
}

/* Header du dashboard */
.dashboard-header {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: var(--card-shadow);
    margin-bottom: 2rem;
    position: relative;
    overflow: hidden;
}

.dashboard-header::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 200px;
    height: 200px;
    background: var(--primary-gradient);
    opacity: 0.1;
    border-radius: 50%;
    transform: translate(50px, -50px);
}

.dashboard-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2d3748;
    margin: 0;
}

.dashboard-subtitle {
    color: #718096;
    font-size: 1.1rem;
}

.user-welcome-card {
    background: rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    padding: 1rem;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.user-avatar .avatar-circle {
    width: 50px;
    height: 50px;
    background: var(--primary-gradient);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
}

/* Cartes statistiques */
.stat-card {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: var(--card-shadow);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    height: 200px;
    cursor: pointer;
}

.stat-card:hover {
    transform: translateY(-10px);
    box-shadow: var(--hover-shadow);
}

.card-background {
    position: absolute;
    top: 0;
    right: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
}

.floating-icon {
    position: absolute;
    top: -20px;
    right: -20px;
    width: 100px;
    height: 100px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    opacity: 0.1;
    color: #667eea;
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
    color: white;
}

.students-icon { background: var(--primary-gradient); }
.companies-icon { background: var(--info-gradient); }
.offers-icon { background: var(--warning-gradient); }

.stat-number {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2d3748;
}

.stat-label {
    color: #4a5568;
    font-weight: 600;
    font-size: 1rem;
}

.trend-indicator {
    background: rgba(72, 187, 120, 0.1);
    color: #48bb78;
    padding: 0.3rem 0.8rem;
    border-radius: 50px;
    font-size: 0.8rem;
    font-weight: 600;
}

.trend-indicator.positive {
    background: rgba(72, 187, 120, 0.1);
    color: #48bb78;
}

.stat-progress {
    height: 6px;
    background: rgba(0, 0, 0, 0.1);
    border-radius: 3px;
    overflow: hidden;
}

.stat-progress .progress-bar {
    border-radius: 3px;
    transition: width 1.5s ease;
}

/* Cartes analytiques */
.analytics-card, .activity-card {
    background: white;
    border-radius: 20px;
    box-shadow: var(--card-shadow);
    border: none;
}

.analytics-card .card-header, .activity-card .card-header {
    background: transparent;
    border-bottom: 1px solid #e2e8f0;
    padding: 1.5rem;
}

/* Timeline d'activités */
.activity-timeline {
    padding: 1rem;
}

.activity-item {
    display: flex;
    align-items: flex-start;
    padding: 1rem 0;
    border-bottom: 1px solid #f1f3f4;
}

.activity-item:last-child {
    border-bottom: none;
}

.activity-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    margin-right: 1rem;
    flex-shrink: 0;
}

.activity-content h6 {
    font-size: 0.9rem;
    font-weight: 600;
    color: #2d3748;
}

.activity-content p {
    font-size: 0.8rem;
    color: #718096;
}

/* Actions rapides */
.quick-actions-section {
    margin-top: 3rem;
}

.section-title {
    font-size: 1.3rem;
    font-weight: 600;
    color: #2d3748;
}

.quick-action-card {
    background: white;
    border-radius: 15px;
    padding: 1.5rem;
    text-align: center;
    box-shadow: var(--card-shadow);
    transition: all 0.3s ease;
    cursor: pointer;
    border: 2px solid transparent;
}

.quick-action-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--hover-shadow);
    border-color: #667eea;
}

.action-icon {
    width: 60px;
    height: 60px;
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
    margin: 0 auto 1rem;
}

.quick-action-card h6 {
    font-size: 1rem;
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 0.5rem;
}

.quick-action-card p {
    font-size: 0.9rem;
    color: #718096;
    margin: 0;
}

/* Gradient de succès */
.bg-gradient-success {
    background: var(--success-gradient) !important;
}

/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.stat-card {
    animation: fadeInUp 0.6s ease forwards;
}

.stat-card:nth-child(1) { animation-delay: 0.1s; }
.stat-card:nth-child(2) { animation-delay: 0.2s; }
.stat-card:nth-child(3) { animation-delay: 0.3s; }

/* Responsive */
@media (max-width: 768px) {
    .dashboard-container {
        padding: 1rem;
    }
    
    .dashboard-title {
        font-size: 2rem;
    }
    
    .stat-card {
        margin-bottom: 1.5rem;
    }
    
    .user-welcome-card {
        margin-top: 1rem;
        text-align: center;
    }
}
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation des compteurs
    function animateCounter(element) {
        const target = parseInt(element.getAttribute('data-count'));
        const duration = 2000;
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
    
    // Démarrer l'animation des compteurs avec un délai
    setTimeout(() => {
        document.querySelectorAll('.stat-number').forEach(animateCounter);
    }, 500);
    
    // Graphique d'activité
    const ctx = document.getElementById('activityChart');
    if (ctx) {
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
                datasets: [{
                    label: 'Nouvelles inscriptions',
                    data: [12, 19, 15, 25, 22, 18, 24],
                    borderColor: '#667eea',
                    backgroundColor: 'rgba(102, 126, 234, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#667eea',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 6
                }, {
                    label: 'Nouvelles offres',
                    data: [8, 12, 10, 15, 18, 14, 16],
                    borderColor: '#fa709a',
                    backgroundColor: 'rgba(250, 112, 154, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#fa709a',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 20
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
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
                        hoverRadius: 8
                    }
                }
            }
        });
    }
    
    // Animation des barres de progression
    setTimeout(() => {
        document.querySelectorAll('.progress-bar').forEach(bar => {
            const width = bar.style.width;
            bar.style.width = '0%';
            setTimeout(() => {
                bar.style.width = width;
            }, 100);
        });
    }, 1000);
});
</script>

@endsection