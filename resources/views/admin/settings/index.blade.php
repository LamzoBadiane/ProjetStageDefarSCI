@extends('layouts.admin')

@section('title', 'Paramètres plateforme')

@section('content')
<div class="container py-4">
    <h2 class="mb-4"><i class="bi bi-gear"></i> Paramètres généraux</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.settings.update') }}">
        @csrf

        <div class="mb-3">
            <label>Nom de la plateforme</label>
            <input type="text" name="platform_name" class="form-control" value="{{ $settings['platform_name'] }}">
        </div>

        <div class="mb-3">
            <label>Email de support</label>
            <input type="email" name="support_email" class="form-control" value="{{ $settings['support_email'] }}">
        </div>

        <div class="mb-3">
            <label>Suppression automatique après refus (heures)</label>
            <input type="number" name="company_auto_delete_delay" class="form-control" value="{{ $settings['company_auto_delete_delay'] }}">
        </div>

        <div class="mb-3">
            <label>Nombre max d’offres affichées</label>
            <input type="number" name="max_offers_display" class="form-control" value="{{ $settings['max_offers_display'] }}">
        </div>

        <div class="mb-3">
            <label>Nombre max de candidatures affichées</label>
            <input type="number" name="max_applications_display" class="form-control" value="{{ $settings['max_applications_display'] }}">
        </div>

        <div class="mb-3">
            <label>Inscriptions entreprises activées ?</label>
            <select name="registration_companies_enabled" class="form-select">
                <option value="yes" {{ $settings['registration_companies_enabled'] === 'yes' ? 'selected' : '' }}>Oui</option>
                <option value="no" {{ $settings['registration_companies_enabled'] === 'no' ? 'selected' : '' }}>Non</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Inscriptions étudiants activées ?</label>
            <select name="registration_students_enabled" class="form-select">
                <option value="yes" {{ $settings['registration_students_enabled'] === 'yes' ? 'selected' : '' }}>Oui</option>
                <option value="no" {{ $settings['registration_students_enabled'] === 'no' ? 'selected' : '' }}>Non</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Inscriptions administrateurs activées ?</label>
            <select name="registration_admins_enabled" class="form-select">
                <option value="yes" {{ ($settings['registration_admins_enabled'] ?? 'no') === 'yes' ? 'selected' : '' }}>Oui</option>
                <option value="no" {{ ($settings['registration_admins_enabled'] ?? 'no') === 'no' ? 'selected' : '' }}>Non</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">💾 Enregistrer</button>
    </form>
</div>
@endsection
