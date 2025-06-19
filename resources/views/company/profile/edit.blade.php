@extends('layouts.company')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">🏢 Modifier le profil de l'entreprise</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Erreurs détectées :</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>⚠️ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('company.profile.update') }}" method="POST" enctype="multipart/form-data" class="bg-light p-4 rounded shadow-sm">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Nom de l'entreprise *</label>
                <input type="text" name="name" value="{{ old('name', $company->name) }}" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Secteur d'activité *</label>
                <input type="text" name="sector" value="{{ old('sector', $company->sector) }}" class="form-control" required>
            </div>
            <div class="col-md-12">
                <label class="form-label">Description</label>
                <textarea name="description" rows="4" class="form-control">{{ old('description', $company->description) }}</textarea>
            </div>

            <div class="col-md-6">
                <label class="form-label">Nom du contact RH *</label>
                <input type="text" name="contact_name" value="{{ old('contact_name', $company->contact_name) }}" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Email du contact RH *</label>
                <input type="email" name="contact_email" value="{{ old('contact_email', $company->contact_email) }}" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Téléphone *</label>
                <input type="text" name="contact_phone" value="{{ old('contact_phone', $company->contact_phone) }}" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Adresse *</label>
                <input type="text" name="address" value="{{ old('address', $company->address) }}" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Ville *</label>
                <input type="text" name="city" value="{{ old('city', $company->city) }}" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Code postal *</label>
                <input type="text" name="postal_code" value="{{ old('postal_code', $company->postal_code) }}" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Pays *</label>
                <input type="text" name="country" value="{{ old('country', $company->country) }}" class="form-control" required>
            </div>

            <div class="col-12">
                <label class="form-label">Logo</label><br>
                <img id="logo-preview"
                    src="{{ $company->logo ? asset('storage/' . $company->logo) : 'https://via.placeholder.com/120' }}"
                    alt="Logo" class="img-thumbnail mb-2" style="max-height: 100px;">

                <input type="file" name="logo" class="form-control" accept="image/*" onchange="previewLogo(event)">
            </div>
        </div>

        <div class="text-end mt-4">
            <button type="submit" class="btn btn-primary fw-bold">💾 Enregistrer</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
    <script>
        function previewLogo(event) {
            const reader = new FileReader();
            reader.onload = function() {
                document.getElementById('logo-preview').src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endpush
