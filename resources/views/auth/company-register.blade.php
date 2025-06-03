@extends('layouts.auth')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10 col-lg-8">
        <div class="card shadow-lg border-0">
            <div class="card-header text-center text-white" style="background-color: #343a40;">
                <h3 class="mb-0">👔 Créer un compte Entreprise</h3>
                <small>Rejoignez notre plateforme et publiez vos offres</small>
            </div>

            <div class="card-body bg-light">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <strong>Erreurs :</strong>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>📌 {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('company.register.store') }}" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf

                    <div class="mb-4 text-center">
                        <img src="https://img.icons8.com/external-flat-juicy-fish/60/000000/external-company-business-and-finance-flat-flat-juicy-fish.png" alt="Entreprise" class="mb-2" style="width: 60px;">
                        <h5 class="text-dark">Informations sur l'entreprise</h5>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Nom de l'entreprise *</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="sector" class="form-label">Secteur d'activité *</label>
                            <input type="text" class="form-control" name="sector" id="sector" value="{{ old('sector') }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description de l'entreprise</label>
                        <textarea name="description" id="description" rows="3" class="form-control">{{ old('description') }}</textarea>
                    </div>

                    <hr>

                    <div class="mb-4 text-center">
                        <h5 class="text-dark">Contact RH</h5>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="contact_name" class="form-label">Nom du contact *</label>
                            <input type="text" class="form-control" name="contact_name" id="contact_name" value="{{ old('contact_name') }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="contact_email" class="form-label">Email du contact *</label>
                            <input type="email" class="form-control" name="contact_email" id="contact_email" value="{{ old('contact_email') }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="contact_phone" class="form-label">Téléphone *</label>
                        <input type="text" class="form-control" name="contact_phone" id="contact_phone" value="{{ old('contact_phone') }}" required>
                    </div>

                    <hr>

                    <div class="mb-4 text-center">
                        <h5 class="text-dark">Adresse</h5>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Adresse complète *</label>
                        <input type="text" class="form-control" name="address" id="address" value="{{ old('address') }}" required>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="city" class="form-label">Ville *</label>
                            <input type="text" class="form-control" name="city" id="city" value="{{ old('city') }}" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="postal_code" class="form-label">Code postal *</label>
                            <input type="text" class="form-control" name="postal_code" id="postal_code" value="{{ old('postal_code') }}" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="country" class="form-label">Pays *</label>
                            <input type="text" class="form-control" name="country" id="country" value="{{ old('country') }}" required>
                        </div>
                    </div>

                    <hr>

                    <div class="mb-4 text-center">
                        <h5 class="text-dark">Informations de connexion</h5>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email de connexion *</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Mot de passe *</label>
                            <input type="password" class="form-control" name="password" id="password" required>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="password_confirmation" class="form-label">Confirmation *</label>
                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn text-white py-2 fw-bold" style="background-color: #343a40;">
                            ✅ Créer mon compte entreprise
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="text-center mt-3">
            <a href="{{ route('login') }}" class="text-decoration-none text-dark">
                <i class="bi bi-arrow-left-circle"></i> Déjà inscrit ? Se connecter
            </a>
        </div>
    </div>
</div>
@endsection
