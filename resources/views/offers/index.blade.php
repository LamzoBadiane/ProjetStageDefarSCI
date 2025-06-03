@extends('layouts.sidebar')

@section('content')
<style>
    .fade-in {
        animation: fadeIn 0.6s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .card-offer {
        border-radius: 1rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card-offer:hover {
        transform: scale(1.03);
        box-shadow: 0 6px 25px rgba(0, 0, 0, 0.12);
    }

    .offer-title {
        font-weight: bold;
        font-size: 1.2rem;
        color: #0d6efd;
    }

    .offer-meta {
        font-size: 0.9rem;
        color: #6c757d;
    }

    .filters-box {
        border-left: 4px solid #198754;
        background: #f1fdf4;
    }

    .btn-fav:hover {
        transform: scale(1.15);
        transition: 0.2s ease;
    }
</style>

<div class="container-fluid py-4 fade-in">

    <!-- 🔵 Titre principal -->
    <h2 class="text-primary mb-4 animate__animated animate__fadeInDown">📄 Offres disponibles</h2>

    <!-- 🔍 Barre de recherche -->
    <form method="GET" action="{{ route('offers.index') }}" class="mb-4">
        <div class="input-group shadow-sm">
            <input type="text" name="search" class="form-control" placeholder="🔎 Rechercher par titre, description, mots-clés..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </div>
    </form>

    <!-- 🎯 Filtres dynamiques -->
    <form method="GET" action="{{ route('offers.index') }}" class="row g-3 mb-4 p-3 rounded filters-box shadow-sm">
        <div class="col-md-3">
            <select name="domain" class="form-select">
                <option value="">🌐 Domaine</option>
                @foreach(['Informatique', 'Santé', 'Commerce', 'Énergie', 'Marketing', 'Communication', 'Ressources Humaines', 'Finance', 'Tourisme'] as $domain)
                    <option value="{{ $domain }}" {{ request('domain') == $domain ? 'selected' : '' }}>{{ $domain }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select name="type" class="form-select">
                <option value="">📌 Type</option>
                @foreach(['Stage', 'CDI', 'CDD'] as $type)
                    <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <input type="text" name="location" class="form-control" placeholder="📍 Lieu" value="{{ request('location') }}">
        </div>
        <div class="col-md-3">
            <input type="date" name="deadline" class="form-control" value="{{ request('deadline') }}">
        </div>
        <div class="col-md-12 text-end">
            <button type="submit" class="btn btn-success">✅ Filtrer</button>
            <a href="{{ route('offers.index') }}" class="btn btn-secondary">↩ Réinitialiser</a>
        </div>
    </form>

    <!-- 🗂 Cartes des offres -->
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @forelse($offers as $offer)
            <div class="col">
                <div class="card h-100 card-offer animate__animated animate__fadeInUp">
                    <div class="card-body d-flex flex-column">
                        <h5 class="offer-title mb-2">{{ $offer->title }}</h5>
                        <p class="card-text">{{ \Illuminate\Support\Str::limit($offer->description, 100) }}</p>
                        <p class="offer-meta">
                            <i class="bi bi-geo-alt-fill"></i> {{ $offer->location }} |
                            <i class="bi bi-briefcase-fill"></i> {{ $offer->type }}<br>
                            <i class="bi bi-calendar-event-fill"></i> Limite : {{ \Carbon\Carbon::parse($offer->deadline)->format('d/m/Y') }}
                        </p>

                        <div class="mt-auto d-flex justify-content-between align-items-center pt-3">
                            <a href="{{ route('offers.show', $offer->id) }}" class="btn btn-primary btn-sm">
                                📘 Voir détails
                            </a>

                            {{-- <form action="{{ route('offers.toggleFavorite', $offer->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-warning btn-sm btn-fav" title="Ajouter aux favoris">
                                    <i class="bi bi-star{{ in_array($offer->id, $favorites) ? '-fill' : '' }}"></i>
                                </button>
                            </form> --}}
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center shadow-sm animate__animated animate__fadeIn">
                    😞 Aucune offre ne correspond à vos critères.
                </div>
            </div>
        @endforelse
    </div>

    <!-- 📜 Pagination Bootstrap -->
    <div class="mt-4 d-flex justify-content-center">
        {{ $offers->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
