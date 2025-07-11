@extends('layouts.bootstrap2')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10 col-lg-8">
        <div class="card shadow-lg border-0">
            <div class="card-header text-center text-white" style="background-color: #343a40;">
                <h3 class="mb-0">🏢 Créer un compte Entreprise</h3>
                <small>Rejoignez notre plateforme et publiez vos offres</small>
            </div>

            <div class="card-body bg-light">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <strong>Erreurs :</strong>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate>
                    @csrf

                    <div class="mb-4 text-center">
                        <img src="https://img.icons8.com/external-flat-juicy-fish/60/000000/external-company-business-and-finance-flat-flat-juicy-fish.png"
                             alt="Entreprise"
                             class="mb-2"
                             style="width: 60px;">
                        <h5 class="text-dark">Informations sur l'entreprise</h5>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Nom de l'entreprise *</label>
                            <input type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   name="name"
                                   id="name"
                                   value="{{ old('name') }}"
                                   required>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="sector" class="form-label">Secteur d'activité *</label>
                            <input type="text"
                                   class="form-control @error('sector') is-invalid @enderror"
                                   name="sector"
                                   id="sector"
                                   value="{{ old('sector') }}"
                                   required>
                            @error('sector')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description de l'entreprise</label>
                        <textarea name="description"
                                  id="description"
                                  rows="3"
                                  class="form-control">{{ old('description') }}</textarea>
                    </div>

                    <hr>

                    <div class="mb-4 text-center">
                        <h5 class="text-dark">Contact RH</h5>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="first_name" class="form-label">Prénom *</label>
                            <input type="text"
                                   class="form-control @error('first_name') is-invalid @enderror"
                                   name="first_name"
                                   id="first_name"
                                   value="{{ old('first_name') }}"
                                   required>
                            @error('first_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="contact_email" class="form-label">Email professionnel *</label>
                            <input type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   name="email"
                                   id="email"
                                   value="{{ old('email') }}"
                                   required>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <hr>

                    <div class="mb-4 text-center">
                        <h5 class="text-dark">Informations de connexion</h5>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Mot de passe *</label>
                            <input type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   name="password"
                                   id="password"
                                   required>
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="password_confirmation" class="form-label">Confirmation *</label>
                            <input type="password"
                                   class="form-control"
                                   name="password_confirmation"
                                   id="password_confirmation"
                                   required>
                        </div>
                    </div>

                    <input type="hidden" name="role" value="company">

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn text-white py-2 fw-bold" style="background-color: #343a40;">
                            Créer mon compte entreprise
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="text-center mt-3">
            <a href="{{ route('login') }}" class="text-decoration-none text-dark">
                Déjà inscrit ? Se connecter
            </a>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 10px;
        overflow: hidden;
    }

    .card-header {
        border-bottom: none;
    }

    hr {
        margin: 2rem 0;
        opacity: 0.2;
    }

    .form-control:focus {
        border-color: #343a40;
        box-shadow: 0 0 0 0.2rem rgba(52, 58, 64, 0.25);
    }
</style>
@endsection
