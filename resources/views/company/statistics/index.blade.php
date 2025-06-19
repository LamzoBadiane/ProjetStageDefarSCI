@extends('layouts.company')

@section('content')
<!-- Animate.css -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    .kpi-card {
        border-left-width: 5px;
        border-radius: 16px;
        transition: all 0.4s ease;
    }
    .kpi-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.1);
    }
    .kpi-icon {
        font-size: 2rem;
        opacity: 0.85;
        margin-bottom: 0.5rem;
    }
    .chart-card {
        border-radius: 16px;
        transition: transform 0.3s ease;
    }
    .chart-card:hover {
        transform: scale(1.02);
    }
    canvas {
        max-height: 320px;
    }
    .section-title {
        font-weight: 700;
        font-size: 1.75rem;
        margin-bottom: 1.5rem;
    }
</style>

@php
    $monthLabels = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'];
    $monthlyData = [];
    for ($i = 1; $i <= 12; $i++) {
        $monthlyData[] = $monthlyApplications->get($i, 0);
    }
@endphp

<div class="container py-4 animate__animated animate__fadeIn">
    <h2 class="section-title animate__animated animate__fadeInDown d-flex align-items-center">
        <i class="bi bi-bar-chart-fill me-2"></i> Statistiques de l'entreprise
    </h2>

    {{-- KPIs --}}
    <div class="row text-center g-4 mb-4 animate__animated animate__fadeInUp">
        @php
            $cards = [
                ['label' => 'Offres publiées', 'icon' => 'bi-megaphone', 'value' => $totalOffers, 'color' => 'primary'],
                ['label' => 'Candidatures', 'icon' => 'bi-envelope-paper-fill', 'value' => $totalApplications, 'color' => 'success'],
                ['label' => 'Entretiens', 'icon' => 'bi-bullseye', 'value' => $totalInterviews, 'color' => 'info'],
                ['label' => 'Vues Profil', 'icon' => 'bi-eye-fill', 'value' => $profileViews, 'color' => 'warning'],
            ];
        @endphp

        @foreach($cards as $card)
        <div class="col-sm-6 col-lg-3">
            <div class="card kpi-card border-start border-{{ $card['color'] }} shadow-sm p-3 h-100 bg-light dark:bg-dark">
                <div class="kpi-icon text-{{ $card['color'] }}">
                    <i class="bi {{ $card['icon'] }}"></i>
                </div>
                <h6 class="text-muted">{{ $card['label'] }}</h6>
                <div class="display-6 fw-bold text-{{ $card['color'] }}">{{ $card['value'] }}</div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Graphiques --}}
    <div class="row g-4">
        <div class="col-md-6 animate__animated animate__fadeInLeft">
            <div class="card chart-card shadow-sm p-3 bg-light dark:bg-dark">
                <h5 class="card-title text-center">📊 Candidatures par offre</h5>
                <canvas id="barChart"></canvas>
            </div>
        </div>

        <div class="col-md-6 animate__animated animate__fadeInRight">
            <div class="card chart-card shadow-sm p-3 bg-light dark:bg-dark">
                <h5 class="card-title text-center">🍩 Répartition des statuts</h5>
                <canvas id="doughnutChart"></canvas>
            </div>
        </div>

        <div class="col-md-6 animate__animated animate__fadeInUp">
            <div class="card chart-card shadow-sm p-3 bg-light dark:bg-dark">
                <h5 class="card-title text-center">📦 Répartition des types d’offres (Stage / CDD / CDI)</h5>
                <canvas id="typeChart"></canvas>
            </div>
        </div>

        <div class="col-md-6 animate__animated animate__fadeInUp">
            <div class="card chart-card shadow-sm p-3 bg-light dark:bg-dark">
                <h5 class="card-title text-center">📈 Candidatures par mois</h5>
                <canvas id="lineChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // 📊 Bar Chart
    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($applicationsByOffer->pluck('offer')) !!},
            datasets: [{
                label: 'Candidatures',
                data: {!! json_encode($applicationsByOffer->pluck('count')) !!},
                backgroundColor: '#0d6efd',
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                x: { title: { display: true, text: 'Offres' }},
                y: { beginAtZero: true, title: { display: true, text: 'Candidatures' }}
            }
        }
    });

    // 🍩 Doughnut Chart
    new Chart(document.getElementById('doughnutChart'), {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($statusDistribution->keys()) !!},
            datasets: [{
                data: {!! json_encode($statusDistribution->values()) !!},
                backgroundColor: ['#198754', '#dc3545', '#ffc107', '#0dcaf0']
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'bottom' } }
        }
    });

    // 📦 Offre Type Chart
    new Chart(document.getElementById('typeChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($offersByType->keys()) !!},
            datasets: [{
                label: 'Nombre d\'offres',
                data: {!! json_encode($offersByType->values()) !!},
                backgroundColor: ['#0dcaf0', '#ffc107', '#198754'],
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false }},
            scales: {
                x: { title: { display: true, text: 'Types' }},
                y: { beginAtZero: true, title: { display: true, text: 'Offres' }}
            }
        }
    });

    // 📈 Line Chart
    new Chart(document.getElementById('lineChart'), {
        type: 'line',
        data: {
            labels: {!! json_encode($monthLabels) !!},
            datasets: [{
                label: 'Candidatures',
                data: {!! json_encode($monthlyData) !!},
                borderColor: '#0d6efd',
                backgroundColor: 'rgba(13, 110, 253, 0.1)',
                fill: true,
                tension: 0.4,
                pointRadius: 5,
                pointHoverRadius: 7,
                pointBackgroundColor: '#0d6efd'
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false }},
            scales: {
                x: { ticks: { maxRotation: 45, minRotation: 0 }},
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endsection
