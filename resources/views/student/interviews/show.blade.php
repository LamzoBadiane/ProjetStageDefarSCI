@extends('layouts.company')

@section('content')
<div class="container py-5">
    <h2 class="mb-4"><i class="bi bi-eye"></i> Détails & modification de l'entretien</h2>

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
            <!-- Étudiant -->
            <div class="col-md-6">
                <label class="form-label">👤 Étudiant</label>
                <input type="text" class="form-control" disabled
                    value="{{ $interview->user->student->first_name }} {{ $interview->user->student->last_name }}">
            </div>

            <!-- Offre -->
            <div class="col-md-6">
                <label class="form-label">🎯 Poste</label>
                <input type="text" class="form-control" disabled
                    value="{{ $interview->offer->title ?? 'Non spécifié' }}">
            </div>

            <!-- Date -->
            <div class="col-md-4">
                <label class="form-label">📅 Date *</label>
                <input type="date" name="date" class="form-control" required value="{{ $interview->date }}">
            </div>

            <!-- Heure -->
            <div class="col-md-4">
                <label class="form-label">⏰ Heure *</label>
                <input type="time" name="time" class="form-control" required value="{{ $interview->time }}">
            </div>

            <!-- Mode -->
            <div class="col-md-4">
                <label class="form-label">🎥 Mode *</label>
                <select name="mode" class="form-select" required>
                    <option value="en ligne" {{ $interview->mode === 'en ligne' ? 'selected' : '' }}>En ligne</option>
                    <option value="présentiel" {{ $interview->mode === 'présentiel' ? 'selected' : '' }}>Présentiel</option>
                </select>
            </div>

            <!-- Lieu -->
            @if($interview->mode === 'présentiel')
                <div class="col-md-12">
                    <label class="form-label">📍 Lieu</label>
                    <input type="text" name="location" class="form-control" value="{{ $interview->location }}">
                </div>
            @endif

            <!-- Statut -->
            <div class="col-md-6">
                <label class="form-label">📌 Statut *</label>
                <select name="status" class="form-select" required>
                    <option value="prévu" {{ $interview->status === 'prévu' ? 'selected' : '' }}>Prévu</option>
                    <option value="annulé" {{ $interview->status === 'annulé' ? 'selected' : '' }}>Annulé</option>
                    <option value="terminé" {{ $interview->status === 'terminé' ? 'selected' : '' }}>Terminé</option>
                </select>
            </div>

            <!-- Lien visio -->
            @if($interview->mode === 'en ligne')
                <div class="col-md-6">
                    <label class="form-label">🔗 Lien Visio</label>
                    <input type="text" class="form-control" readonly value="{{ $interview->location }}">
                </div>
            @endif

            <!-- Message -->
            <div class="col-md-12">
                <label class="form-label">💬 Message</label>
                <textarea class="form-control" rows="3" readonly>{{ $interview->message }}</textarea>
            </div>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('company.interviews.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Retour
            </a>
            <div>
                <button type="submit" class="btn btn-primary me-2">
                    <i class="bi bi-save"></i> Enregistrer les modifications
                </button>

                <form method="POST" action="{{ route('company.interviews.destroy', $interview->id) }}" class="d-inline"
                      onsubmit="return confirm('Voulez-vous vraiment supprimer cet entretien ?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="bi bi-trash"></i> Supprimer
                    </button>
                </form>
            </div>
        </div>
    </form>
</div>
@endsection
