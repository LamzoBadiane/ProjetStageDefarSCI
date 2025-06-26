@extends('layouts.bootstrap')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-sm border-0">
            <div class="card-header text-white text-center" style="background-color: #343a40;">
                <h4>🎓 JobPlatform</h4>
                <small>Créer un compte</small>
            </div>

            <div class="card-body">

                {{-- Message d’erreurs générales --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        Veuillez vérifier les champs du formulaire.
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    {{-- Prénom --}}
                    <div class="mb-3">
                        <label for="first_name" class="form-label">Prénom</label>
                        <input
                            type="text"
                            name="first_name"
                            id="first_name"
                            value="{{ old('first_name') }}"
                            class="form-control @error('first_name') is-invalid @enderror"
                            required
                            autofocus
                        >
                        @error('first_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Nom --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom</label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid @enderror"
                            required
                        >
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label">Adresse email</label>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror"
                            required
                        >
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Mot de passe --}}
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-control @error('password') is-invalid @enderror"
                            required
                        >
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Confirmation mot de passe --}}
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                        <input
                            type="password"
                            name="password_confirmation"
                            id="password_confirmation"
                            class="form-control"
                            required
                        >
                    </div>

                    {{-- Rôle --}}
                    <div class="mb-3">
                        <label for="role" class="form-label">Rôle</label>
                        <select
                            name="role"
                            id="role"
                            class="form-select @error('role') is-invalid @enderror"
                            required
                        >
                            <option value="">-- Sélectionnez un rôle --</option>

                            @if($settings['registration_students_enabled'] === 'yes')
                                <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Étudiant</option>
                            @endif

                            @if($settings['registration_companies_enabled'] === 'yes')
                                <option value="company" {{ old('role') == 'company' ? 'selected' : '' }}>Entreprise</option>
                            @endif

                            @if($settings['registration_admins_enabled'] === 'yes')
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrateur</option>
                            @endif
                        </select>
                        @error('role')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    {{-- Bouton --}}
                    <button type="submit" class="btn w-100 text-white" style="background-color: #343a40;">
                        S'inscrire
                    </button>
                </form>
            </div>

            <div class="card-footer text-center">
                <a href="{{ route('login') }}">Déjà inscrit ? Se connecter</a>
            </div>
        </div>
    </div>
</div>
@endsection
