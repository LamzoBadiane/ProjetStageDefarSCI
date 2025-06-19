@extends('layouts.admin')

@section('title', 'Tableau de bord')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js/dist/Chart.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="container py-4 animate__animated animate__fadeIn">
    <h2 class="mb-4 fw-bold text-primary"><i class="bi bi-speedometer2 me-2"></i> Tableau de bord</h2>

    <!-- Cartes statistiques -->
    <div class="row g-4 mb-5">
        <x-admin.card title="Étudiants" :value="$totalStudents" icon="bi-person"/>
        <x-admin.card title="Entreprises" :value="$totalCompanies" icon="bi-building"/>
        <x-admin.card title="Entreprises à valider" :value="$pendingCompanies" icon="bi-hourglass-split" color="warning"/>
        <x-admin.card title="Offres publiées" :value="$totalOffers" icon="bi-briefcase"/>
        <x-admin.card title="Offres en attente" :value="$offersPending" icon="bi-clock-history" color="danger"/>
        <x-admin.card title="Candidatures" :value="$totalApplications" icon="bi-send"/>
        <x-admin.card title="Entretiens" :value="$totalInterviews" icon="bi-camera-video"/>
    </div>

    <!-- Graphique mensuel -->
    <div class="card shadow-sm border-0 mb-4 animate__animated animate__fadeInUp">
        <div class="card-header bg-light fw-semibold">
            <i class="bi bi-bar-chart-fill text-primary"></i> Candidatures par mois ({{ now()->year }})
        </div>
        <div class="card-body">
            <canvas id="monthlyChart" height="120"></canvas>
        </div>
    </div>

    <!-- Graphique de répartition des statuts -->
    <div class="card shadow-sm border-0 mb-5 animate__animated animate__fadeInUp">
        <div class="card-header bg-light fw-semibold">
            <i class="bi bi-pie-chart text-success"></i> Répartition des statuts de candidatures
        </div>
        <div class="card-body">
            <canvas id="statusChart" height="140"></canvas>
        </div>
    </div>
</div>

<!-- JS -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Bar Chart - Candidatures mensuelles
        const ctx = document.getElementById('monthlyChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    @for($i=1; $i<=12; $i++)
                        '{{ \Carbon\Carbon::create()->month($i)->locale("fr_FR")->translatedFormat("F") }}',
                    @endfor
                ],
                datasets: [{
                    label: 'Candidatures',
                    data: [
                        @for($i = 1; $i <= 12; $i++)
                            {{ $monthlyApplications[$i] ?? 0 }},
                        @endfor
                    ],
                    backgroundColor: '#0d6efd',
                    borderRadius: 8
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 }
                    }
                },
                plugins: {
                    legend: { display: false }
                },
                animation: {
                    duration: 1000,
                    easing: 'easeOutBounce'
                }
            }
        });

        // Doughnut Chart - Répartition des statuts
        const statusCtx = document.getElementById('statusChart').getContext('2d');
        new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($statusDistribution->keys()) !!},
                datasets: [{
                    data: {!! json_encode($statusDistribution->values()) !!},
                    backgroundColor: [
                        '#ffc107', // en attente
                        '#198754', // accepté
                        '#dc3545', // refusé
                        '#0dcaf0', // embauché
                        '#6c757d'  // autre
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: { size: 14 }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                return `${label} : ${value}`;
                            }
                        }
                    }
                },
                animation: {
                    animateScale: true
                }
            }
        });

        // Compteur animé
        document.querySelectorAll('.counter').forEach(counter => {
            const updateCount = () => {
                const target = +counter.dataset.target;
                const count = +counter.innerText;
                const increment = Math.ceil(target / 40);

                if (count < target) {
                    counter.innerText = count + increment;
                    setTimeout(updateCount, 20);
                } else {
                    counter.innerText = target.toLocaleString();
                }
            };
            updateCount();
        });
    });
</script>
@endsection
