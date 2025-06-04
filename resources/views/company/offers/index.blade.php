@extends('layouts.company')

@section('content')
<style>
    :root {
        --blue-gradient: linear-gradient(135deg, #1e3c72, #2a5298);
        --text-dark: #1c1c1c;
        --text-light: #ffffff;
        --bg-light: #f3f7fb;
        --card-bg: #ffffff;
        --shadow-strong: 0 12px 28px rgba(0, 0, 0, 0.12);
        --shadow-soft: 0 8px 20px rgba(0, 0, 0, 0.06);
        --transition-fast: all 0.25s ease-in-out;
        --radius-xl: 20px;
        --radius-md: 12px;
    }

    body {
        background: var(--bg-light);
        font-family: 'Segoe UI', sans-serif;
        color: var(--text-dark);
    }

    .fade-in {
        animation: fadeInUp 0.6s ease forwards;
        opacity: 0;
        transform: translateY(30px);
    }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .section-header {
        background: var(--blue-gradient);
        color: var(--text-light);
        padding: 40px 30px;
        border-radius: var(--radius-xl);
        font-size: 2rem;
        text-align: center;
        font-weight: 700;
        margin-bottom: 50px;
        box-shadow: var(--shadow-strong);
    }

    .stats-badge {
        background: var(--blue-gradient);
        color: white;
        padding: 10px 20px;
        border-radius: var(--radius-md);
        font-size: 1rem;
        font-weight: 600;
        box-shadow: var(--shadow-soft);
        transition: var(--transition-fast);
        margin: 0.5rem;
    }

    .stats-badge:hover {
        transform: translateY(-3px) scale(1.05);
    }

    .offer-card {
        background: var(--card-bg);
        border-radius: var(--radius-xl);
        padding: 25px;
        box-shadow: var(--shadow-soft);
        transition: var(--transition-fast);
    }

    .offer-card:hover {
        box-shadow: var(--shadow-strong);
        transform: translateY(-5px);
    }

    .badge-status {
        padding: 6px 15px;
        font-size: 0.85rem;
        border-radius: 50px;
        font-weight: 500;
        animation: pulseGlow 2s infinite;
    }

    @keyframes pulseGlow {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.9; transform: scale(1.05); }
    }

    .btn-action {
        transition: var(--transition-fast);
        border-radius: var(--radius-md);
        font-weight: 600;
        padding: 8px 16px;
    }

    .btn-action:hover {
        transform: scale(1.05);
        opacity: 0.95;
        box-shadow: var(--shadow-soft);
    }

    .form-select {
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-soft);
        transition: var(--transition-fast);
    }

    .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }

    .offer-row {
    background-color: #f8f9fa; /* gris très clair */
    transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .offer-row:hover {
        background-color: #e9ecef; /* gris un peu plus foncé au survol */
        transform: scale(1.01);
    }

</style>

<div class="container py-5 fade-in">

    <div class="section-header">
        📢 Mes Offres Publiées
    </div>

    <div class="d-flex flex-wrap justify-content-center mb-5">
        <div class="stats-badge">✅ Validées : {{ $offers->where('status', 'validée')->count() }}</div>
        <div class="stats-badge">⏳ En attente : {{ $offers->where('status', 'en_attente')->count() }}</div>
        <div class="stats-badge">📦 Total : {{ $offers->count() }}</div>
    </div>

    <div class="text-end mb-4">
        <a href="{{ route('company.offers.create') }}" class="btn btn-lg btn-primary shadow-sm fw-bold btn-action">
            ➕ Créer une Nouvelle Offre
        </a>
    </div>

    @if($offers->count() > 0)
    <div class="row g-4">
        @foreach($offers as $offer)
        <div class="col-lg-6">
            <div class="offer-card p-4 fade-in">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <h5 class="fw-bold mb-0">
                        <i class="bi bi-briefcase me-2 text-primary"></i>{{ $offer->title }}
                    </h5>
                    <span class="badge badge-status
                        @if($offer->status == 'validée') bg-success
                        @elseif($offer->status == 'refusée') bg-danger
                        @elseif($offer->status == 'en_attente') bg-warning text-dark
                        @else bg-secondary
                        @endif">
                        {{ ucfirst($offer->status) }}
                    </span>
                </div>

                <div class="mb-3">
                    <p class="mb-1"><strong>Domaine :</strong> {{ $offer->domain }}</p>
                    <p class="mb-1"><strong>Type :</strong> {{ $offer->type }}</p>
                    <p class="mb-1"><strong>Lieu :</strong> <i class="bi bi-geo-alt text-danger"></i> {{ $offer->location }}</p>
                    <p class="mb-0"><strong>Date Limite :</strong> {{ \Carbon\Carbon::parse($offer->deadline)->format('d/m/Y') }}</p>
                </div>

                <div class="d-flex action-buttons mt-3">
                    <a href="{{ route('company.offers.show', $offer->id) }}" class="btn btn-outline-info btn-sm btn-action">👁️ Voir</a>
                    <a href="{{ route('company.offers.edit', $offer->id) }}" class="btn btn-outline-primary btn-sm btn-action">✏️ Modifier</a>
                    <form action="{{ route('company.offers.destroy', $offer->id) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm btn-action">🗑️ Supprimer</button>
                    </form>
                    <form action="{{ route('company.offers.updateStatus', $offer->id) }}" method="POST" class="ms-auto">
                        @csrf
                        <select name="status" onchange="this.form.submit()" class="form-select form-select-sm shadow-sm">
                            <option value="en_attente" {{ $offer->status == 'en_attente' ? 'selected' : '' }}>⏳ En attente</option>
                            <option value="validée" {{ $offer->status == 'validée' ? 'selected' : '' }}>✅ Validée</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-5 d-flex justify-content-center">
        {{ $offers->links('pagination::bootstrap-5') }}
    </div>
    @else
    <div class="alert alert-info text-center mt-4 shadow fade-in">
        😕 Aucune offre disponible pour l’instant.
    </div>
    @endif

</div>
@endsection
