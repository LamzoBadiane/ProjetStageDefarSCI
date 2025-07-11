@extends('layouts.sidebar')

@section('content')
<style>
    :root {
        --primary: #4361ee;
        --secondary: #3f37c9;
        --accent: #4895ef;
        --light: #f8f9fa;
        --dark: #212529;
        --success: #4cc9f0;
        --text-muted: #6c757d;
        --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        --card-shadow-hover: 0 15px 45px rgba(73, 149, 239, 0.15);
        --transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.1);
    }

    body {
        background-color: #f5f7ff;
    }

    .glass-card {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border-radius: 16px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: var(--card-shadow);
        transition: var(--transition);
        overflow: hidden;
    }

    .glass-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--card-shadow-hover);
        border-color: rgba(67, 97, 238, 0.2);
    }

    .page-header {
        position: relative;
        padding-bottom: 1rem;
        margin-bottom: 2.5rem;
    }

    .page-header:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 80px;
        height: 4px;
        background: linear-gradient(90deg, var(--primary), var(--success));
        border-radius: 2px;
    }

    .search-box {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
    }

    .search-box input {
        padding-left: 3rem;
        background: rgba(255, 255, 255, 0.9);
        border: none;
    }

    .search-box:before {
        content: '\F52A';
        font-family: 'bootstrap-icons';
        position: absolute;
        left: 1.25rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
        z-index: 10;
    }

    .filter-tag {
        display: inline-flex;
        align-items: center;
        background: rgba(67, 97, 238, 0.1);
        color: var(--primary);
        padding: 0.35rem 1rem;
        border-radius: 50px;
        margin-right: 0.5rem;
        margin-bottom: 0.5rem;
        font-size: 0.85rem;
    }

    .filter-tag i {
        margin-right: 0.35rem;
    }

    .offer-card {
        height: 100%;
        border: none;
    }

    .offer-badge {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: var(--primary);
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .company-logo {
        width: 50px;
        height: 50px;
        object-fit: contain;
        border-radius: 12px;
        margin-right: 1rem;
        background: white;
        padding: 0.5rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .offer-title {
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 0.5rem;
        line-height: 1.4;
    }

    .offer-company {
        font-weight: 600;
        color: var(--primary);
        margin-bottom: 0.5rem;
    }

    .offer-meta {
        display: flex;
        align-items: center;
        color: var(--text-muted);
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }

    .offer-meta i {
        width: 20px;
        color: var(--accent);
        margin-right: 0.25rem;
    }

    .offer-description {
        color: var(--text-muted);
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        margin-bottom: 1.5rem;
        line-height: 1.6;
    }

    .empty-state {
        padding: 4rem 2rem;
        text-align: center;
        background: rgba(255, 255, 255, 0.7);
        border-radius: 16px;
        backdrop-filter: blur(5px);
    }

    .empty-state i {
        font-size: 4rem;
        color: var(--accent);
        margin-bottom: 1.5rem;
        opacity: 0.7;
    }

    .empty-state h4 {
        color: var(--dark);
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .empty-state p {
        color: var(--text-muted);
        max-width: 500px;
        margin: 0 auto 1.5rem;
    }

    .btn-apply {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: white;
        border: none;
        border-radius: 8px;
        padding: 0.5rem 1.5rem;
        font-weight: 500;
        transition: var(--transition);
    }

    .btn-apply:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(67, 97, 238, 0.2);
        color: white;
    }

    .custom-select {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%236c757d' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
        background-position: right 1rem center;
        background-size: 16px 12px;
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        padding: 0.5rem 1.5rem 0.5rem 1rem;
        appearance: none;
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border-color: transparent;
    }

    .pagination .page-link {
        color: var(--primary);
        border: 1px solid rgba(0, 0, 0, 0.05);
        margin: 0 0.25rem;
        border-radius: 8px !important;
    }

    .fade-in {
        animation: fadeIn 0.8s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.2s; }
    .delay-3 { animation-delay: 0.3s; }
</style>

<div class="container-fluid py-5">

    <!-- Header -->
    <div class="page-header fade-in">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 mb-0">Opportunités Professionnelles</h1>
            <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2">
                {{ $offers->total() }} offres disponibles
            </span>
        </div>
        <p class="text-muted mb-0">Trouvez la mission qui correspond à votre profil</p>
    </div>

    <!-- Search and Filters -->
    <div class="row mb-5 fade-in delay-1">
        <div class="col-lg-8 mb-3 mb-lg-0">
            <form method="GET" action="{{ route('offers.index') }}">
                <div class="search-box shadow-sm">
                    <input type="text" name="search" class="form-control form-control-lg"
                           placeholder="Rechercher par mots-clés, compétences..."
                           value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary btn-lg position-absolute"
                            style="right: 0; top: 0; height: 100%; border-top-left-radius: 0; border-bottom-left-radius: 0;">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>
        </div>
        <div class="col-lg-4">
            <a href="#filtersCollapse" class="btn btn-outline-primary btn-lg w-100"
               data-bs-toggle="collapse" role="button" aria-expanded="false">
               <i class="bi bi-sliders"></i> Filtres avancés
            </a>
        </div>
    </div>

    <!-- Active Filters -->
    @if(request()->hasAny(['search', 'domain', 'type', 'location', 'deadline']))
    <div class="mb-4 fade-in delay-1">
        <div class="d-flex flex-wrap align-items-center">
            <span class="me-2 text-muted">Filtres actifs :</span>
            @if(request('search'))
                <span class="filter-tag">
                    <i class="bi bi-search"></i> {{ request('search') }}
                    <a href="{{ route('offers.index', Arr::except(request()->query(), ['search'])) }}"
                       class="ms-2 text-danger"><i class="bi bi-x"></i></a>
                </span>
            @endif
            @if(request('domain'))
                <span class="filter-tag">
                    <i class="bi bi-grid"></i> {{ request('domain') }}
                    <a href="{{ route('offers.index', Arr::except(request()->query(), ['domain'])) }}"
                       class="ms-2 text-danger"><i class="bi bi-x"></i></a>
                </span>
            @endif
            @if(request('type'))
                <span class="filter-tag">
                    <i class="bi bi-briefcase"></i> {{ request('type') }}
                    <a href="{{ route('offers.index', Arr::except(request()->query(), ['type'])) }}"
                       class="ms-2 text-danger"><i class="bi bi-x"></i></a>
                </span>
            @endif
            @if(request('location'))
                <span class="filter-tag">
                    <i class="bi bi-geo-alt"></i> {{ request('location') }}
                    <a href="{{ route('offers.index', Arr::except(request()->query(), ['location'])) }}"
                       class="ms-2 text-danger"><i class="bi bi-x"></i></a>
                </span>
            @endif
            @if(request('deadline'))
                <span class="filter-tag">
                    <i class="bi bi-calendar"></i> {{ \Carbon\Carbon::parse(request('deadline'))->format('d/m/Y') }}
                    <a href="{{ route('offers.index', Arr::except(request()->query(), ['deadline'])) }}"
                       class="ms-2 text-danger"><i class="bi bi-x"></i></a>
                </span>
            @endif
        </div>
    </div>
    @endif

    <!-- Advanced Filters -->
    <div class="collapse mb-5 fade-in delay-2" id="filtersCollapse">
        <form method="GET" action="{{ route('offers.index') }}">
            <div class="glass-card p-4">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label text-muted small mb-1">Domaine</label>
                        <select name="domain" class="form-select custom-select">
                            <option value="">Tous domaines</option>
                            @foreach(['Informatique', 'Santé', 'Commerce', 'Énergie', 'Marketing', 'Communication', 'Ressources Humaines', 'Finance', 'Tourisme'] as $domain)
                                <option value="{{ $domain }}" {{ request('domain') == $domain ? 'selected' : '' }}>{{ $domain }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label text-muted small mb-1">Type de contrat</label>
                        <select name="type" class="form-select custom-select">
                            <option value="">Tous types</option>
                            @foreach(['Stage', 'CDI', 'CDD'] as $type)
                                <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label text-muted small mb-1">Localisation</label>
                        <input type="text" name="location" class="form-control"
                               placeholder="Ville ou région" value="{{ request('location') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label text-muted small mb-1">Date limite</label>
                        <input type="date" name="deadline" class="form-control"
                               value="{{ request('deadline') }}">
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('offers.index') }}" class="btn btn-outline-secondary me-3">
                                <i class="bi bi-arrow-counterclockwise"></i> Réinitialiser
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-funnel"></i> Appliquer les filtres
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Offers Grid -->
    @if($offers->count() > 0)
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach($offers as $offer)
                <div class="col fade-in delay-{{ min(3, $loop->iteration) }}">
                    <div class="glass-card offer-card h-100">
                        @if($offer->type === 'Stage')
                            <span class="offer-badge">Stage</span>
                        @elseif($offer->type === 'CDI')
                            <span class="offer-badge bg-success">CDI</span>
                        @endif

                        <div class="card-body p-4">
                            <div class="d-flex align-items-start mb-4">
                                @if($offer->company && $offer->company->logo)
                                    <img src="{{ asset('storage/'.$offer->company->logo) }}" alt="{{ $offer->company->name }}" class="company-logo">
                                @else
                                    <div class="company-logo d-flex align-items-center justify-content-center bg-light">
                                        <i class="bi bi-building text-muted"></i>
                                    </div>
                                @endif
                                <div>
                                    <h3 class="offer-title">{{ $offer->title }}</h3>
                                    <div class="offer-company">{{ $offer->company->name ?? 'Entreprise confidentielle' }}</div>
                                </div>
                            </div>

                            <div class="offer-meta">
                                <i class="bi bi-geo-alt-fill"></i>
                                <span>{{ $offer->location }}</span>
                            </div>

                            <div class="offer-meta">
                                <i class="bi bi-calendar2-week-fill"></i>
                                <span>Début : {{ \Carbon\Carbon::parse($offer->start_date)->format('d/m/Y') }}</span>
                            </div>

                            <div class="offer-meta mb-3">
                                <i class="bi bi-hourglass-split"></i>
                                <span>Limite : {{ \Carbon\Carbon::parse($offer->deadline)->format('d/m/Y') }}</span>
                            </div>

                            <p class="offer-description">
                                {{ \Illuminate\Support\Str::limit($offer->description, 150) }}
                            </p>

                            <div class="d-flex justify-content-between align-items-center pt-3 mt-auto">
                                <a href="{{ route('offers.show', $offer->id) }}" class="btn btn-apply">
                                    <i class="bi bi-eye me-1"></i> Voir l'offre
                                </a>

                                {{-- <button class="btn btn-outline-secondary btn-sm rounded-circle" title="Sauvegarder">
                                    <i class="bi bi-bookmark"></i>
                                </button> --}}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="glass-card empty-state fade-in delay-2">
            <i class="bi bi-inboxes"></i>
            <h4>Aucune offre correspondante</h4>
            <p>Nous n'avons trouvé aucune offre correspondant à vos critères de recherche. Essayez d'élargir vos filtres.</p>
            <a href="{{ route('offers.index') }}" class="btn btn-primary px-4">
                <i class="bi bi-arrow-left me-2"></i>Réinitialiser la recherche
            </a>
        </div>
    @endif

    <!-- Pagination -->
    @if($offers->hasPages())
        <div class="mt-5 fade-in delay-3">
            {{ $offers->withQueryString()->onEachSide(1)->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
@endsection
