@extends('layouts.company')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet"/>

<div class="container py-5 animate__animated animate__fadeIn">
    <h2 class="mb-4 text-center"><i class="bi bi-calendar-plus"></i> Programmer un entretien</h2>

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

    <form action="{{ route('company.interviews.store') }}" method="POST" class="bg-white p-4 rounded shadow-sm">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">👤 Candidat *</label>
                <select name="user_id" class="form-select" required>
                    <option value="">-- Sélectionner un candidat --</option>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}">
                            {{ $student->student->first_name ?? '' }} {{ $student->student->last_name ?? $student->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">🎯 Offre (facultatif)</label>
                <select name="offer_id" class="form-select">
                    <option value="">-- Lier à une offre --</option>
                    @foreach($offers as $offer)
                        <option value="{{ $offer->id }}">{{ $offer->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label">📅 Date *</label>
                <input type="date" name="date" class="form-control" required>
            </div>

            <div class="col-md-4">
                <label class="form-label">⏰ Heure *</label>
                <input type="time" name="time" class="form-control" required>
            </div>

            <div class="col-md-4">
                <label class="form-label">🎥 Mode *</label>
                <select name="mode" class="form-select" required>
                    <option value="">-- Sélectionner --</option>
                    <option value="en ligne">En ligne</option>
                    <option value="présentiel">Présentiel</option>
                </select>
            </div>

            <div class="col-md-12">
                <label class="form-label">📍 Lieu (si présentiel)</label>
                <input type="text" name="location" class="form-control" placeholder="Adresse ou lien de visio">
            </div>

            <div class="col-md-12">
                <label class="form-label">💬 Message optionnel</label>
                <textarea name="message" rows="3" class="form-control" placeholder="Un message pour le candidat..."></textarea>
            </div>
        </div>

        <div class="text-end mt-4">
            <a href="{{ route('company.interviews.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Retour
            </a>
            <button type="submit" class="btn btn-primary fw-bold">
                <i class="bi bi-check-circle"></i> Programmer l'entretien
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const modeSelect = document.querySelector('[name="mode"]');
        const locationField = document.querySelector('[name="location"]').closest('.col-md-12');

        function toggleLocation() {
            locationField.style.display = (modeSelect.value === 'en ligne') ? 'none' : 'block';
        }

        modeSelect.addEventListener('change', toggleLocation);
        toggleLocation();
    });
</script>
@endsection
