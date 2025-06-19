@extends('layouts.company')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-primary"><i class="bi bi-building"></i> Modifier mon profil entreprise</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('company.profile.update') }}" method="POST" enctype="multipart/form-data" class="row g-4 shadow-sm p-4 bg-white rounded">
        @csrf
        @method('PUT')

        {{-- Logo + Aperçu --}}
        <div class="col-md-12 text-center">
            <img src="{{ $company->logo ? asset('storage/'.$company->logo) : 'https://via.placeholder.com/150' }}" class="rounded-circle shadow mb-3" width="120" height="120" id="logoPreview">
            <input type="file" name="logo" class="form-control" accept="image/*" onchange="previewLogo(this)">
        </div>

        {{-- Nom et Secteur --}}
        <div class="col-md-6">
            <label class="form-label">Nom de l'entreprise *</label>
            <input type="text" name="name" value="{{ old('name', $company->name) }}" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">Secteur d'activité *</label>
            <input type="text" name="sector" value="{{ old('sector', $company->sector) }}" class="form-control" required>
        </div>

        {{-- Contact --}}
        <div class="col-md-6">
            <label class="form-label">Nom du contact *</label>
            <input type="text" name="contact_name" value="{{ old('contact_name', $company->contact_name) }}" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">Email de contact *</label>
            <input type="email" name="contact_email" value="{{ old('contact_email', $company->contact_email) }}" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">Téléphone de contact *</label>
            <input type="text" name="contact_phone" value="{{ old('contact_phone', $company->contact_phone) }}" class="form-control" required>
        </div>

        {{-- Coordonnées --}}
        <div class="col-md-6">
            <label class="form-label">Adresse</label>
            <input type="text" name="address" value="{{ old('address', $company->address) }}" class="form-control">
        </div>

        {{-- Données légales --}}
        <div class="col-md-6">
            <label class="form-label">NINEA</label>
            <input type="text" name="ninea" value="{{ old('ninea', $company->ninea) }}" class="form-control">
        </div>

        <div class="col-md-6">
            <label class="form-label">RCCM</label>
            <input type="text" name="rccm" value="{{ old('rccm', $company->rccm) }}" class="form-control">
        </div>

        {{-- Description / Histoire --}}
        <div class="col-md-12">
            <label class="form-label">Présentation de l’entreprise</label>
            <textarea name="company_story" class="form-control" rows="4">{{ old('company_story', $company->company_story) }}</textarea>
        </div>

        {{-- Document justificatif --}}
        <div class="col-md-12">
            <label class="form-label">Document justificatif (PDF ou image)</label>
            @if($company->document)
                <p class="small text-muted">Déjà téléversé : <a href="{{ asset('storage/'.$company->document) }}" target="_blank">Voir le document</a></p>
            @endif
            <input type="file" name="document" class="form-control" accept=".pdf,image/*">
        </div>

        {{-- Bouton --}}
        <div class="col-md-12 text-end">
            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Enregistrer</button>
        </div>
    </form>
</div>

<script>
function previewLogo(input) {
    const reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('logoPreview').src = e.target.result;
    };
    if (input.files[0]) reader.readAsDataURL(input.files[0]);
}
</script>
@endsection
