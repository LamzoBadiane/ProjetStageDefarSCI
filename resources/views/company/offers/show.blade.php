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

    .offer-details {
        background: var(--card-bg);
        border-radius: var(--radius-xl);
        padding: 30px;
        box-shadow: var(--shadow-soft);
        transition: var(--transition-fast);
    }

    .offer-details:hover {
        box-shadow: var(--shadow-strong);
        transform: translateY(-3px);
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
        50% { opacity: 0.95; transform: scale(1.05); }
    }

    .btn-action {
        transition: var(--transition-fast);
        border-radius: var(--radius-md);
        font-weight: 600;
        padding: 8px 16px;
        margin: 0 5px;
    }

    .btn-action:hover {
        transform: scale(1.05);
        box-shadow: var(--shadow-soft);
    }
</style>

<div class="container py-5 fade-in">

    <div class="section-header">
        📄 Détail de l'Offre
    </div>

    <div class="offer-details">
        <h3 class="text-primary fw-bold mb-3">
            <i class="bi bi-briefcase-fill me-2"></i>{{ $offer->title }}
        </h3>

        <p><strong>Description :</strong><br>{{ $offer->description }}</p>
        <p><strong>Domaine :</strong> {{ $offer->domain }}</p>
        <p><strong>Type :</strong> {{ $offer->type }}</p>
        <p><strong>Lieu :</strong> {{ $offer->location }}</p>
        <p><strong>Date limite :</strong> {{ \Carbon\Carbon::parse($offer->deadline)->format('d/m/Y') }}</p>
        <p><strong>Statut :</strong>
            <span class="badge badge-status
                @if($offer->status == 'validée') bg-success
                @elseif($offer->status == 'refusée') bg-danger
                @elseif($offer->status == 'expirée') bg-secondary
                @else bg-warning text-dark
                @endif">
                {{ ucfirst($offer->status) }}
            </span>
        </p>

        <div class="d-flex flex-wrap justify-content-between mt-4">
            <a href="{{ route('company.offers.edit', $offer->id) }}" class="btn btn-outline-primary btn-action">
                ✏️ Modifier l'Offre
            </a>

            <form action="{{ route('company.offers.destroy', $offer->id) }}" method="POST"
                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette offre ?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger btn-action">
                    🗑️ Supprimer l'Offre
                </button>
            </form>

            <a href="{{ route('company.offers.index') }}" class="btn btn-secondary btn-action">
                ⬅️ Retour aux Offres
            </a>
        </div>
    </div>
</div>
@endsection
