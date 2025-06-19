@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4 text-primary animate__animated animate__fadeInDown">
        📄 Soumettre une Nouvelle Candidature
    </h2>

    @if($errors->any())
        <div class="alert alert-danger animate__animated animate__fadeIn">
            <strong>Veuillez corriger les erreurs :</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>📌 {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('applications.store') }}" method="POST" enctype="multipart/form-data" class="shadow p-4 bg-white rounded">
        @csrf

        <div class="mb-3">
            <label for="offer_id" class="form-label">Sélectionner l'offre *</label>
            <select name="offer_id" id="offer_id" class="form-select" required>
                <option value="">-- Choisissez une offre --</option>
                @foreach($offers as $offer)
                    <option value="{{ $offer->id }}" {{ old('offer_id') == $offer->id ? 'selected' : '' }}>
                        {{ $offer->title }} ({{ $offer->company->name }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="motivation_file" class="form-label">Lettre de motivation (fichier PDF/DOC)</label>
            <input type="file" name="motivation_file" id="motivation_file" class="form-control" accept=".pdf,.doc,.docx">
        </div>

        <div class="mb-3">
            <label for="cv_file" class="form-label">CV (fichier PDF/DOC) *</label>
            <input type="file" name="cv_file" id="cv_file" class="form-control" accept=".pdf,.doc,.docx" required>
        </div>

        <button type="submit" class="btn btn-primary w-100 fw-bold shadow-sm">
            ✅ Soumettre la Candidature
        </button>
    </form>
</div>
@endsection
