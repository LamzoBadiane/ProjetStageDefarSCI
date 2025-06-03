@extends('layouts.auth')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-lg">
            <div class="card-header text-center">
                <h4 class="mb-0">🔐 Connexion Entreprise</h4>
            </div>

            <div class="card-body bg-light">

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <strong>Erreur :</strong>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>📌 {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('company.login.submit') }}" method="POST" class="mt-3">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">📧 Email professionnel</label>
                        <input type="email" name="email" id="email" class="form-control" required autofocus value="{{ old('email') }}">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">🔑 Mot de passe</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" name="remember" id="remember" class="form-check-input" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember" class="form-check-label">Se souvenir de moi</label>
                    </div>

                    <button type="submit" class="btn btn-dark w-100">
                        ✅ Connexion
                    </button>
                </form>

                <div class="text-center mt-3">
                    <a href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
