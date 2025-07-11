@extends('layouts.company')

@section('content')
<style>
    :root {
        --blue-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --purple-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --green-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        --text-dark: #2d3748;
        --text-light: #ffffff;
        --bg-light: #f7fafc;
        --card-bg: #ffffff;
        --shadow-strong: 0 20px 40px rgba(0, 0, 0, 0.15);
        --shadow-soft: 0 10px 25px rgba(0, 0, 0, 0.08);
        --shadow-hover: 0 25px 50px rgba(0, 0, 0, 0.2);
        --transition-fast: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        --transition-smooth: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        --radius-xl: 24px;
        --radius-md: 16px;
        --radius-sm: 12px;
    }

    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        font-family: 'Inter', 'Segoe UI', sans-serif;
        color: var(--text-dark);
        min-height: 100vh;
    }

    .fade-in {
        animation: fadeInUp 0.8s ease forwards;
        opacity: 0;
        transform: translateY(40px);
    }

    .fade-in:nth-child(2) { animation-delay: 0.1s; }
    .fade-in:nth-child(3) { animation-delay: 0.2s; }
    .fade-in:nth-child(4) { animation-delay: 0.3s; }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes floatAnimation {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }

    .section-header {
        background: var(--blue-gradient);
        color: var(--text-light);
        padding: 50px 40px;
        border-radius: var(--radius-xl);
        font-size: 2.5rem;
        text-align: center;
        font-weight: 800;
        margin-bottom: 60px;
        box-shadow: var(--shadow-strong);
        position: relative;
        overflow: hidden;
    }

    .section-header::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
        animation: shimmer 3s infinite;
    }

    @keyframes shimmer {
        0% { transform: translateX(-100%) translateY(-100%) rotate(30deg); }
        100% { transform: translateX(100%) translateY(100%) rotate(30deg); }
    }

    .stats-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
        margin-bottom: 50px;
    }

    .stats-badge {
        background: var(--card-bg);
        color: var(--text-dark);
        padding: 20px 30px;
        border-radius: var(--radius-md);
        font-size: 1.1rem;
        font-weight: 700;
        box-shadow: var(--shadow-soft);
        transition: var(--transition-smooth);
        position: relative;
        overflow: hidden;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.3);
    }

    .stats-badge::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--blue-gradient);
    }

    .stats-badge:hover {
        transform: translateY(-8px) scale(1.05);
        box-shadow: var(--shadow-hover);
        animation: floatAnimation 2s ease-in-out infinite;
    }

    .create-btn {
        background: var(--purple-gradient);
        border: none;
        padding: 15px 35px;
        border-radius: var(--radius-md);
        font-weight: 700;
        font-size: 1.1rem;
        color: white;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: var(--transition-smooth);
        box-shadow: var(--shadow-soft);
        position: relative;
        overflow: hidden;
    }

    .create-btn::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(255,255,255,0.2);
        border-radius: 50%;
        transition: var(--transition-fast);
        transform: translate(-50%, -50%);
    }

    .create-btn:hover::before {
        width: 300px;
        height: 300px;
    }

    .create-btn:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-hover);
        color: white;
    }

    .offer-card {
        background: var(--card-bg);
        border-radius: var(--radius-xl);
        padding: 30px;
        box-shadow: var(--shadow-soft);
        transition: var(--transition-smooth);
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(255,255,255,0.3);
        backdrop-filter: blur(10px);
    }

    .offer-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: var(--green-gradient);
        transform: scaleX(0);
        transition: var(--transition-fast);
    }

    .offer-card:hover::before {
        transform: scaleX(1);
    }

    .offer-card:hover {
        box-shadow: var(--shadow-hover);
        transform: translateY(-10px);
    }

    .badge-status {
        padding: 8px 20px;
        font-size: 0.9rem;
        border-radius: 50px;
        font-weight: 600;
        animation: pulseGlow 3s infinite ease-in-out;
        position: relative;
        overflow: hidden;
    }

    @keyframes pulseGlow {
        0%, 100% {
            opacity: 1;
            transform: scale(1);
            box-shadow: 0 0 0 0 rgba(255,255,255,0.4);
        }
        50% {
            opacity: 0.9;
            transform: scale(1.05);
            box-shadow: 0 0 0 10px rgba(255,255,255,0);
        }
    }

    .action-buttons {
        display: flex;
        gap: 10px;
        align-items: center;
        flex-wrap: wrap;
    }

    .btn-action {
        transition: var(--transition-fast);
        border-radius: var(--radius-sm);
        font-weight: 600;
        padding: 10px 18px;
        font-size: 0.9rem;
        position: relative;
        overflow: hidden;
    }

    .btn-action::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(255,255,255,0.2);
        border-radius: 50%;
        transition: var(--transition-fast);
        transform: translate(-50%, -50%);
    }

    .btn-action:hover::before {
        width: 200px;
        height: 200px;
    }

    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-soft);
    }

    .form-select {
        border-radius: var(--radius-sm);
        box-shadow: var(--shadow-soft);
        transition: var(--transition-fast);
        border: 2px solid transparent;
        background: white;
        font-weight: 600;
    }

    .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        transform: scale(1.02);
    }

    .offer-row {
        background-color: rgba(248, 249, 250, 0.8);
        transition: var(--transition-smooth);
        border-radius: var(--radius-md);
        backdrop-filter: blur(10px);
    }

    .offer-row:hover {
        background-color: rgba(233, 236, 239, 0.9);
        transform: scale(1.02);
    }

    .alert-info {
        background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
        border: none;
        border-radius: var(--radius-xl);
        padding: 40px;
        font-size: 1.2rem;
        font-weight: 600;
        box-shadow: var(--shadow-soft);
        position: relative;
        overflow: hidden;
    }

    .offer-title {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 800;
    }

    .info-text {
        position: relative;
        padding-left: 25px;
    }

    .info-text::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        width: 4px;
        height: 20px;
        background: var(--blue-gradient);
        border-radius: 2px;
        transform: translateY(-50%);
    }

    .pagination {
        margin-top: 50px;
    }

    .pagination .page-link {
        border-radius: var(--radius-sm);
        margin: 0 5px;
        border: none;
        background: white;
        color: var(--text-dark);
        font-weight: 600;
        transition: var(--transition-fast);
        box-shadow: var(--shadow-soft);
    }

    .pagination .page-link:hover {
        background: var(--blue-gradient);
        color: white;
        transform: translateY(-2px);
    }

    .pagination .page-item.active .page-link {
        background: var(--blue-gradient);
        border: none;
        box-shadow: var(--shadow-soft);
    }

    /* Responsive améliorations */
    @media (max-width: 768px) {
        .section-header {
            font-size: 2rem;
            padding: 30px 20px;
        }

        .stats-container {
            flex-direction: column;
            align-items: center;
        }

        .stats-badge {
            width: 100%;
            max-width: 300px;
            text-align: center;
        }

        .action-buttons {
            flex-direction: column;
            gap: 8px;
        }

        .btn-action {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="container py-5 fade-in">

    <div class="section-header">
        📢 Mes Offres Publiées
    </div>

    <div class="stats-container">
        <div class="stats-badge">✅ Validées : {{ $offers->where('status', 'validée')->count() }}</div>
        <div class="stats-badge">⏳ En attente : {{ $offers->where('status', 'en_attente')->count() }}</div>
        <div class="stats-badge">📦 Total : {{ $offers->count() }}</div>
    </div>

    <div class="text-end mb-4">
        <a href="{{ route('company.offers.create') }}" class="create-btn">
            ➕ Créer une Nouvelle Offre
        </a>
    </div>

    @if($offers->count() > 0)
    <div class="row g-4">
        @foreach($offers as $offer)
        <div class="col-lg-6">
            <div class="offer-card fade-in">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h5 class="offer-title mb-0">
                        <i class="bi bi-briefcase me-2"></i>{{ $offer->title }}
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

                <div class="mb-4">
                    <p class="mb-2 info-text"><strong>Domaine :</strong> {{ $offer->domain }}</p>
                    <p class="mb-2 info-text"><strong>Type :</strong> {{ $offer->type }}</p>
                    <p class="mb-2 info-text"><strong>Lieu :</strong> <i class="bi bi-geo-alt text-danger"></i> {{ $offer->location }}</p>
                    <p class="mb-0 info-text"><strong>Date Limite :</strong> {{ \Carbon\Carbon::parse($offer->deadline)->format('d/m/Y') }}</p>
                </div>

                <div class="action-buttons">
                    <a href="{{ route('company.offers.show', $offer->id) }}" class="btn btn-outline-info btn-sm btn-action">👁️ Voir</a>
                    <a href="{{ route('company.offers.edit', $offer->id) }}" class="btn btn-outline-primary btn-sm btn-action">✏️ Modifier</a>
                    <form action="{{ route('company.offers.destroy', $offer->id) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm btn-action">🗑️ Supprimer</button>
                    </form>
                    <form action="{{ route('company.offers.updateStatus', $offer->id) }}" method="POST" class="ms-auto">
                        @csrf
                        <select name="status" onchange="this.form.submit()" class="form-select form-select-sm">
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
    <div class="alert alert-info text-center mt-4 fade-in">
        😕 Aucune offre disponible pour l'instant.
    </div>
    @endif

</div>
@endsection
