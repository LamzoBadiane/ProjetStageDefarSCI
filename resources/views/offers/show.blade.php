@extends('layouts.sidebar')

@section('content')
<style>
    .offer-header {
        background: linear-gradient(90deg, #e0f7fa, #f1f8e9);
        padding: 1.5rem;
        border-radius: 1rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        margin-bottom: 2rem;
    }

    .offer-meta {
        font-size: 1rem;
        color: #495057;
        margin-bottom: 0.5rem;
    }

    .label-strong {
        font-weight: 600;
        color: #0d6efd;
    }

    .apply-box {
        border-left: 5px solid #198754;
        background: #f9fdfb;
        padding: 2rem;
        border-radius: 1rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
        margin-top: 2rem;
    }

    .btn-apply {
        font-weight: 600;
        padding: 0.6rem 1.5rem;
        font-size: 1rem;
    }
</style>

<div class="container py-4 animate__animated animate__fadeIn">

    <!-- 🎯 Titre et résumé -->
    <div class="offer-header">
        <h2 class="text-primary mb-3">🎯 {{ $offer->title }}</h2>
        <p class="offer-meta"><span class="label-strong">Entreprise :</span> {{ $offer->company->name  }}
            @if($offer->company)
                <div class="mt-3">
                    <a href="{{ route('public.company.profile', $offer->company->id) }}" class="btn btn-outline-secondary btn-sm mt-2">
                        👁️ Voir le profil entreprise
                    </a>
                </div>
            @endif
        </p>
        <p class="offer-meta"><span class="label-strong">Domaine :</span> {{ $offer->domain }}</p>
        <p class="offer-meta"><span class="label-strong">Type :</span> {{ $offer->type }}</p>
        <p class="offer-meta"><span class="label-strong">Lieu :</span> {{ $offer->location }}</p>
        <p class="offer-meta"><span class="label-strong">Date limite :</span> {{ \Carbon\Carbon::parse($offer->deadline)->format('d/m/Y') }}</p>
    </div>

    <!-- 📝 Description -->
    <div class="mb-4">
        <h5 class="text-dark">📝 Description de l'offre</h5>
        <p class="text-muted">{{ $offer->description }}</p>
    </div>

    <!-- 📤 Formulaire de candidature -->
    <div class="apply-box">

        <h4 class="text-success mb-4"><i class="bi bi-send-check-fill"></i> Postuler à cette offre</h4>

        @if(session('success'))
            <div class="alert alert-success animate__animated animate__fadeInDown">
                <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            </div>
        @endif

        @if(session('warning'))
            <div class="alert alert-warning animate__animated animate__fadeInDown">
                <i class="bi bi-exclamation-triangle-fill"></i> {{ session('warning') }}
            </div>
        @endif

        <form action="{{ route('applications.store', $offer->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="motivation_file" class="form-label">📎 Lettre de motivation (fichier PDF/DOC)</label>
                <input type="file" name="motivation_file" id="motivation_file" class="form-control" accept=".pdf,.doc,.docx">
                <small class="text-muted">Optionnel – max 2 Mo</small>
            </div>

            <button type="submit" class="btn btn-success btn-apply">
                <i class="bi bi-upload"></i> Envoyer ma candidature
            </button>
        </form>
    </div>

</div>
@endsection
