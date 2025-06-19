@extends('admin.layouts.master')

@section('title', 'Connexion')

@push('styles')
    <style>
        .login-box {
            max-width: 400px;
            margin: 80px auto;
        }
    </style>
@endpush

@section('content')
<div class="login-box shadow rounded bg-white p-4">
    <h2 class="text-center mb-4 text-primary"><i class="bi bi-shield-lock"></i> Connexion administrateur</h2>

    @if(session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.login') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Adresse email</label>
            <input type="email" name="email" class="form-control" required autofocus>
        </div>

        <div class="mb-3">
            <label class="form-label">Mot de passe</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary"><i class="bi bi-box-arrow-in-right"></i> Se connecter</button>
        </div>
    </form>
</div>
@endsection
