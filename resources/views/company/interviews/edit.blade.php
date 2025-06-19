@extends('layouts.company')

@section('content')
<div class="container py-5 animate__animated animate__fadeIn">
    <h2 class="mb-4 text-center"><i class="bi bi-pencil-square"></i> Modifier un entretien</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Erreurs :</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>⚠️ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('company.interviews.update', $interview->id) }}" method="POST" class="bg-white p-4 rounded shadow-sm">
        @csrf
        @method('PUT')
        <div class="row g-3">
            <!-- Date -->
            <div class="col-md-4">
                <label class="form-label">📅 Date *</label>
                <input type="date" name="date" class="form-control" value="{{ old('date', $interview->date) }}" required>
            </div>

            <!-- Heure -->
            <div class="col-md-4">
                <label class="form-label">⏰ Heure *</label>
                <input type="time" name="time" class="form-control" value="{{ old('time', $interview->time) }}" required>
            </div>

            <!-- Mode -->
            <div class="col-md-4">
                <label class="form-label">🎥 Mode *</label>
                <select name="mode" class="form-select" required>
                    <option value="">-- Sélectionner --</option>
                    <option value="en ligne" {{ old('mode', $interview->mode) == 'en ligne' ? 'selected' : '' }}>En ligne</option>
                    <option value="présentiel" {{ old('mode', $interview->mode) == 'présentiel' ? 'selected' : '' }}>Présentiel</option>
                </select>
            </div>

            <!-- Lieu -->
            <div class="col-md-12">
                <label class="form-label">📍 Lieu (ou lien visio)</label>
                <input type="text" name="location" class="form-control" value="{{ old('location', $interview->location) }}">
            </div>

            <!-- Message -->
            <div class="col-md-12">
                <label class="form-label">💬 Message optionnel</label>
                <textarea name="message" rows="3" class="form-control">{{ old('message', $interview->message) }}</textarea>
            </div>

            <!-- Statut -->
            <div class="col-md-4">
                <label class="form-label">📌 Statut</label>
                <select name="status" class="form-select">
                    <option value="prévu" {{ old('status', $interview->status) == 'prévu' ? 'selected' : '' }}>Prévu</option>
                    <option value="annulé" {{ old('status', $interview->status) == 'annulé' ? 'selected' : '' }}>Annulé</option>
                    <option value="terminé" {{ old('status', $interview->status) == 'terminé' ? 'selected' : '' }}>Terminé</option>
                </select>
            </div>
        </div>

        <div class="text-end mt-4">
            <a href="{{ route('company.interviews.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Retour
            </a>
            <button type="submit" class="btn btn-primary fw-bold">
                <i class="bi bi-check-circle"></i> Mettre à jour
            </button>
        </div>
    </form>
</div>
@endsection
