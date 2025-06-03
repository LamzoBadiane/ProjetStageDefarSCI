@extends('layouts.company')

@section('content')
<div class="container py-5">
    <h2 class="text-center text-white mb-5 animate__animated animate__fadeInDown shadow-lg"
        style="background: linear-gradient(to right, #0056b3, #66d9ff); padding: 25px; border-radius: 16px; font-weight: 700;">
        ➕ Créer une Nouvelle Offre
    </h2>

    @if($errors->any())
        <div class="alert alert-danger shadow-sm animate__animated animate__fadeIn">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>📌 {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success shadow-sm animate__animated animate__fadeIn">
            ✅ {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('company.offers.store') }}" method="POST"
        class="p-5 rounded-4 shadow-lg bg-light animate__animated animate__fadeInUp big-form">
        @csrf

        <div class="row g-4">
            <div class="col-md-6">
                <label for="title" class="form-label">📌 Titre de l'offre *</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}"
                    class="form-control form-control-lg fancy-input" required>
            </div>
            <div class="col-md-6">
                <label for="domain" class="form-label">🌐 Domaine *</label>
                <input type="text" name="domain" id="domain" value="{{ old('domain') }}"
                    class="form-control form-control-lg fancy-input" required>
            </div>
        </div>

        <div class="mb-4 mt-4">
            <label for="description" class="form-label">📝 Description *</label>
            <textarea name="description" id="description" rows="5"
                class="form-control form-control-lg fancy-input"
                placeholder="Détaillez les missions, compétences attendues, etc..." required>{{ old('description') }}</textarea>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <label for="type" class="form-label">📂 Type *</label>
                <select name="type" id="type" class="form-select form-select-lg fancy-input" required>
                    <option value="">-- Sélectionner --</option>
                    <option value="Stage" {{ old('type') == 'Stage' ? 'selected' : '' }}>Stage</option>
                    <option value="CDI" {{ old('type') == 'CDI' ? 'selected' : '' }}>CDI</option>
                    <option value="CDD" {{ old('type') == 'CDD' ? 'selected' : '' }}>CDD</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="location" class="form-label">📍 Lieu *</label>
                <input type="text" name="location" id="location" value="{{ old('location') }}"
                    class="form-control form-control-lg fancy-input" required>
            </div>
            <div class="col-md-4">
                <label for="deadline" class="form-label">📅 Date limite *</label>
                <input type="date" name="deadline" id="deadline" value="{{ old('deadline') }}"
                    class="form-control form-control-lg fancy-input" required>
            </div>
        </div>

        <button type="submit" class="btn btn-gradient-blue w-100 mt-5 py-3 animate__animated animate__pulse shadow"
            style="font-weight: 600; font-size: 1.2rem;">
            ✅ Enregistrer l'Offre
        </button>
    </form>
</div>

{{-- 🎨 STYLE PERSONNALISÉ --}}
<style>
    .form-label {
        font-weight: 600;
        color: #003366;
    }

    .fancy-input {
        transition: 0.3s ease;
        border-radius: 12px;
        background-color: #f8f9fa;
    }

    .fancy-input:focus {
        border-color: #3399ff;
        box-shadow: 0 0 12px rgba(51, 153, 255, 0.4);
    }

    .btn-gradient-blue {
        background: linear-gradient(to right, #007bff, #66d9ff);
        color: white;
        border: none;
        transition: all 0.3s ease-in-out;
        border-radius: 12px;
    }

    .btn-gradient-blue:hover {
        background: linear-gradient(to right, #0056b3, #3399ff);
        transform: scale(1.02);
    }

    .big-form:hover {
        transform: scale(1.005);
        transition: transform 0.3s ease-in-out;
    }

    @media (max-width: 768px) {
        .form-label {
            font-size: 1rem;
        }

        .fancy-input {
            font-size: 1rem;
        }
    }
</style>
@endsection
