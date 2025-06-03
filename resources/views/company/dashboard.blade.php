@extends('layouts.company')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
    body {
        background: linear-gradient(to right, #f0f4ff, #e0f7fa);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        transition: background 0.5s, color 0.5s;
    }

    body.dark-mode {
        background: #1e1e2f;
        color: #f0f0f0;
    }

    .title {
        background: linear-gradient(135deg, #2B2ED6FF, #8f94fb);
        padding: 20px;
        border-radius: 15px;
        color: white;
        font-weight: 700;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .toggle-theme {
        position: absolute;
        top: 20px;
        right: 20px;
        cursor: pointer;
        font-size: 1.4rem;
    }

    .card-stat {
        border: none;
        border-radius: 20px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background: white;
        position: relative;
        overflow: hidden;
    }

    body.dark-mode .card-stat, body.dark-mode .list-group-item, body.dark-mode .chart-card {
        background: #2c2c3e;
        color: #f0f0f0;
    }

    .card-stat:hover {
        transform: translateY(-8px);
        box-shadow: 0 16px 40px rgba(0,0,0,0.12);
    }

    .list-group-item {
        border: none;
        border-radius: 12px !important;
        margin-bottom: 10px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        background: #ffffff;
        transition: all 0.3s ease;
    }

    .section-title {
        font-weight: 700;
        font-size: 1.4rem;
        color: #333;
        border-left: 6px solid #4e54c8;
        padding-left: 12px;
        margin-bottom: 20px;
    }

    .chart-card {
        background: #fff;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.1);
    }

    .welcome-box {
        background: linear-gradient(90deg, #4e54c8, #8f94fb);
        padding: 20px;
        border-radius: 16px;
        color: white;
        font-size: 1.1rem;
        margin-bottom: 30px;
        animation: fadeInDown 1s ease both;
    }

    .calendar-box {
        background: white;
        padding: 20px;
        border-radius: 20px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        margin-top: 40px;
    }

    .quick-actions {
        margin-top: 50px;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
    }

    .quick-action-card {
        background: linear-gradient(135deg, #4e54c8, #8f94fb);
        color: white;
        padding: 20px;
        border-radius: 16px;
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        font-size: 1.1rem;
        cursor: pointer;
    }

    .quick-action-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }

    .quick-action-card i {
        font-size: 1.6rem;
        display: block;
        margin-bottom: 10px;
    }
</style>

<div class="container py-5">
    <div class="toggle-theme" onclick="toggleTheme()">
        <i class="bi bi-circle-half"></i>
    </div>

    <h2 class="text-center title mb-5 animate__animated animate__fadeInDown">
        🏢 Tableau de bord Entreprise
    </h2>

    <div class="welcome-box animate__animated animate__fadeIn">
        👋 Gérez vos offres et suivez vos recrutements en toute simplicité.
    </div>

    @if(session('success'))
        <div class="alert alert-success text-center animate__animated animate__fadeIn" style="font-size:1.1rem;">
            {{ session('success') }}
        </div>
    @endif

    <div class="row g-4 mb-4">
        <div class="col-md-4 animate__animated animate__zoomIn">
            <div class="card card-stat text-center">
                <div class="card-body">
                    <h5 class="card-title text-primary">📄 Offres publiées</h5>
                    <p class="stat-value text-primary">{{ $offersCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 animate__animated animate__zoomIn animate__delay-1s">
            <div class="card card-stat text-center">
                <div class="card-body">
                    <h5 class="card-title text-success">📨 Candidatures reçues</h5>
                    <p class="stat-value text-success">{{ $applicationsCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 animate__animated animate__zoomIn animate__delay-2s">
            <div class="card card-stat text-center">
                <div class="card-body">
                    <h5 class="card-title text-warning">⏳ Offres en attente</h5>
                    <p class="stat-value text-warning">{{ $pendingOffersCount }}</p>
                </div>
            </div>
        </div>
    </div>

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
                    <li class="list-group-item d-flex justify-content-between align-items-start flex-column">
                        <div class="d-flex justify-content-between w-100">
                            <strong>{{ $app->offer->title ?? 'Offre supprimée' }}</strong>
                            <span class="badge bg-success">{{ $app->created_at->format('d/m/Y') }}</span>
                        </div>
                        <small class="text-muted">👤 {{ $app->user->name ?? 'Nom Inconnu' }} {{ $app->user->prenom ?? '' }}</small>
                    </li>
                @empty
                    <li class="list-group-item text-muted">Aucune candidature récente.</li>
                @endforelse
            </ul>
        </div>

    </div>

    <div class="chart-card mt-5 animate__animated animate__fadeInUp">
        <h4 class="section-title">📊 Statistiques Visuelles</h4>
        <canvas id="statsChart" height="120"></canvas>
    </div>

    <div class="calendar-box mt-5">
        <h4 class="section-title">📅 Calendrier</h4>
        <div id="calendar"></div>
    </div>

    <div class="quick-actions">
        <div class="quick-action-card">
            <i class="bi bi-plus-circle"></i>
            ✍️ Créer une nouvelle offre
        </div>
        <div class="quick-action-card">
            <i class="bi bi-search"></i>
            🔍 Voir les candidatures
        </div>
        <div class="quick-action-card">
            <i class="bi bi-folder"></i>
            📂 Gérer mes offres
        </div>
        <div class="quick-action-card">
            <i class="bi bi-person-circle"></i>
            👤 Mon profil entreprise
        </div>
    </div>
</div>

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
                borderRadius: 8
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
        events: []
    });
    calendar.render();

    function toggleTheme() {
        document.body.classList.toggle('dark-mode');
        localStorage.setItem('theme', document.body.classList.contains('dark-mode') ? 'dark' : 'light');
    }

    document.addEventListener('DOMContentLoaded', function() {
        if (localStorage.getItem('theme') === 'dark') {
            document.body.classList.add('dark-mode');
        }
    });
</script>
@endsection
