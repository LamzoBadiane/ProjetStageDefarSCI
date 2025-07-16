@extends('layouts.bootstrap2')

@section('content')
<style>
    body {
        background-color: #f4f6f9;
    }

    .main-content {
        background-color: #f8f9fa;
        padding: 2rem;
        min-height: 100vh;
    }

    .login-card {
        border: none;
        border-radius: 1rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        background-color: #ffffff;
    }

    .login-card .card-header {
        background-color: #2c3e50;
        color: white;
        text-align: center;
        padding: 1.5rem;
        border-top-left-radius: 1rem;
        border-top-right-radius: 1rem;
    }

    .login-card .card-body {
        padding: 2rem;
    }

    .form-control:focus {
        border-color: #2c3e50;
        box-shadow: 0 0 0 0.2rem rgba(44, 62, 80, 0.25);
    }

    .btn-dark {
        background-color: #2c3e50;
        border-color: #2c3e50;
    }

    .btn-dark:hover {
        background-color: #1a252f;
        border-color: #161e26;
    }

    .card-footer a {
        color: #2c3e50;
        text-decoration: none;
        font-weight: 500;
    }

    .card-footer a:hover {
        text-decoration: underline;
    }
</style>

<div class="row justify-content-center mt-5">
    <div class="col-md-6 col-lg-5">
        <div class="card login-card">
            <div class="card-header">
                <h3>🏢 Entreprise</h3>
                <p class="mb-0">Connexion à votre espace professionnel</p>
            </div>

            <div class="card-body">
                {{-- Message de statut --}}
                @if (session('status'))
                    <div class="alert alert-info">
                        {{ session('status') }}
                    </div>
                @endif

                {{-- Erreurs --}}
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @if($errors->any()))
                    <div class="alert alert-danger">
                        <strong>Erreur :</strong>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('company.login.submit') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Adresse email professionnelle</label>
                        <input type="email"
                               name="email"
                               id="email"
                               value="{{ old('email') }}"
                               required
                               autofocus
                               class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password"
                               name="password"
                               id="password"
                               required
                               class="form-control @error('password') is-invalid @enderror">
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3 form-check">
                        <input class="form-check-input"
                               type="checkbox"
                               name="remember"
                               id="remember"
                               {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            Se souvenir de moi
                        </label>
                    </div>

                    <button type="submit" class="btn btn-dark w-100">
                        Se connecter
                    </button>
                </form>
            </div>

            <div class="card-footer text-center py-3 bg-light">
                <a href="{{ route('password.request') }}">Mot de passe oublié ?</a>
            </div>
        </div>
    </div>
</div>
@endsection