@extends('layouts.sidebar')

@section('content')
<style>
    body {
        background: linear-gradient(to right, #f1f4f9, #dff3f1);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    h2, h4 {
        font-weight: 700;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
    }

    .dashboard-card {
        border-radius: 20px;
        transition: transform 0.4s ease, box-shadow 0.4s ease;
        overflow: hidden;
    }

    .dashboard-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 20px 35px rgba(0, 0, 0, 0.15);
    }

    .dashboard-icon {
        font-size: 40px;
        color: white;
        position: absolute;
        top: -20px;
        right: -20px;
        padding: 15px;
        border-radius: 50%;
    }

    .dashboard-card.offres {
        background: linear-gradient(135deg, #e6f0ff, #f0f6ff);
        border: 2px solid #cfe2ff;
    }

    .dashboard-card.offres .dashboard-icon {
        background-color: #0d6efd;
    }

    .dashboard-card.candidatures {
        background: linear-gradient(135deg, #e8f7f0, #f3fbf7);
        border: 2px solid #d1e7dd;
    }

    .dashboard-card.candidatures .dashboard-icon {
        background-color: #198754;
    }

    .dashboard-card.profil {
        background: linear-gradient(135deg, #fffbe6, #fffdf2);
        border: 2px solid #ffe69c;
    }

    .dashboard-card.profil .dashboard-icon {
        background-color: #ffc107;
    }

    .card-body {
        padding: 2rem;
    }

    .fade-in {
        animation: fadeInSlideUp 1.2s ease-out both;
    }

    .fade-in-career {
        animation: fadeInSlideUp 1.2s ease-out both;
    }

    @keyframes fadeInSlideUp {
        from {
            opacity: 0;
            transform: translateY(50px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .career-card {
        border-radius: 16px;
        background: linear-gradient(145deg, #fdfdfd, #f4f6fa);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .career-card:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 15px 25px rgba(0, 0, 0, 0.1);
    }

    .career-card h5 {
        font-weight: 600;
        margin-bottom: 10px;
    }

    .career-card p {
        color: #555;
    }

    .stat-card {
        background: #F0EDEDFF;
        padding: 1.5rem;
        border-radius: 16px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
        text-align: center;
        transition: transform 0.4s ease, box-shadow 0.4s ease;
        animation: zoomInUp 0.8s ease-out both;
    }

    .stat-card:hover {
        transform: translateY(-8px) scale(1.03);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }

    @keyframes zoomInUp {
        0% {
            opacity: 0;
            transform: scale(0.8) translateY(40px);
        }
        100% {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    .list-group-item {
        background: #ffffff;
        transition: background-color 0.3s ease;
    }

    .list-group-item:hover {
        background-color: #eef3f8;
    }
</style>

<div class="container py-5">
    <h2 class="text-center text-primary mb-5 fade-in">🎓 Bienvenue sur votre tableau de bord étudiant</h2>

    <div class="row g-5 mb-5">
        <div class="col-md-4 fade-in pulse">
            <div class="card dashboard-card offres position-relative">
                <div class="dashboard-icon"><i class="bi bi-briefcase-fill"></i></div>
                <div class="card-body text-center">
                    <h5 class="card-title">Offres d'emploi</h5>
                    <p class="card-text">Explorez les dernières opportunités professionnelles.</p>
                    <a href="{{ route('offers.index') }}" class="btn btn-outline-primary">Voir les offres</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 fade-in pulse">
            <div class="card dashboard-card candidatures position-relative">
                <div class="dashboard-icon"><i class="bi bi-check-circle-fill"></i></div>
                <div class="card-body text-center">
                    <h5 class="card-title">Mes candidatures</h5>
                    <p class="card-text">Suivez l’état de vos candidatures en un clic.</p>
                    <a href="{{ route('applications.index') }}" class="btn btn-outline-success">Voir mes candidatures</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 fade-in pulse">
            <div class="card dashboard-card profil position-relative">
                <div class="dashboard-icon"><i class="bi bi-person-circle"></i></div>
                <div class="card-body text-center">
                    <h5 class="card-title">Mon profil</h5>
                    <p class="card-text">Mettez à jour vos informations personnelles et votre CV.</p>
                    <a href="{{ route('student.profile.edit') }}" class="btn btn-outline-warning">Accéder au profil</a>
                </div>
            </div>
        </div>
    </div>

    <h4 class="text-secondary mb-3">📊 Statistiques rapides</h4>
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="stat-card" style="animation-delay: 0.1s;">
                <h5 class="text-primary">Candidatures</h5>
                <h3>12</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card" style="animation-delay: 0.2s;">
                <h5 class="text-success">Offres vues</h5>
                <h3>58</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card" style="animation-delay: 0.3s;">
                <h5 class="text-warning">Entretiens</h5>
                <h3>3</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card" style="animation-delay: 0.4s;">
                <h5 class="text-danger">Refus</h5>
                <h3>2</h3>
            </div>
        </div>
    </div>

    <h4 class="text-secondary mb-3">🔔 Notifications récentes</h4>
    <ul class="list-group mb-5 fade-in">
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Entretien prévu avec SONATEL
            <span class="badge bg-success rounded-pill">Nouveau</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Votre profil a été mis à jour
            <span class="badge bg-info rounded-pill">Info</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Offre expirée chez PETROSEN
            <span class="badge bg-danger rounded-pill">Expirée</span>
        </li>
    </ul>

    <h4 class="text-secondary mb-3">💡 Conseils carrière</h4>
    <div class="row g-4 justify-content-center">
        <div class="col-md-4">
            <div class="card career-card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-pencil-square text-primary me-2"></i>Personnalisez votre CV</h5>
                    <p class="card-text">Adaptez votre CV à chaque offre pour maximiser vos chances d'être retenu.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card career-card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-envelope-check text-success me-2"></i>Relancez les recruteurs</h5>
                    <p class="card-text">Une relance polie après une semaine peut faire la différence pour décrocher un entretien.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card career-card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title"><i class="bi bi-person-lines-fill text-warning me-2"></i>Préparez vos entretiens</h5>
                    <p class="card-text">Entraînez-vous avec des questions types et des mises en situation concrètes.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
@endsection
