@extends('admin.layouts.master')

@section('title', 'Connexion')

@push('styles')
<style>
    :root {
        --primary-color: #2c3e50;
        --secondary-color: #34495e;
        --accent-color: #e74c3c;
        --text-light: #ecf0f1;
        --text-dark: #2c3e50;
        --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }
    
    body {
        background: url('https://images.unsplash.com/photo-1497366754035-f200968a6e72?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') no-repeat center center fixed;
        background-size: cover;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Montserrat', sans-serif;
        position: relative;
    }
    
    body::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.6);
        z-index: 0;
    }
    
    .auth-container {
        position: relative;
        z-index: 1;
        width: 100%;
        max-width: 400px;
        margin: 2rem;
    }
    
    .auth-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 0;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        transition: var(--transition);
    }
    
    .auth-header {
        background: var(--primary-color);
        color: var(--text-light);
        padding: 2rem;
        text-align: center;
        position: relative;
    }
    
    .auth-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 50px;
        height: 3px;
        background: var(--accent-color);
    }
    
    .auth-icon {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        color: var(--accent-color);
    }
    
    .auth-title {
        font-weight: 300;
        letter-spacing: 1px;
        margin: 0;
    }
    
    .auth-body {
        padding: 2.5rem;
    }
    
    .form-group {
        margin-bottom: 1.5rem;
        position: relative;
    }
    
    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        color: var(--secondary-color);
        font-size: 0.9rem;
        font-weight: 500;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }
    
    .form-control {
        width: 100%;
        padding: 0.75rem 0;
        border: none;
        border-bottom: 1px solid #ddd;
        background: transparent;
        font-size: 1rem;
        transition: var(--transition);
    }
    
    .form-control:focus {
        border-bottom-color: var(--accent-color);
        outline: none;
    }
    
    .btn-auth {
        width: 100%;
        padding: 1rem;
        background: var(--primary-color);
        color: white;
        border: none;
        font-size: 1rem;
        font-weight: 500;
        letter-spacing: 1px;
        text-transform: uppercase;
        cursor: pointer;
        transition: var(--transition);
        margin-top: 1rem;
    }
    
    .btn-auth:hover {
        background: var(--secondary-color);
    }
    
    .alert {
        padding: 1rem;
        margin-bottom: 1.5rem;
        border-left: 4px solid var(--accent-color);
        background: rgba(231, 76, 60, 0.1);
        color: var(--text-dark);
    }
    
    .footer-note {
        text-align: center;
        margin-top: 2rem;
        color: #7f8c8d;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
    }
</style>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
@endpush

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <div class="auth-icon">
                <i class="bi bi-shield-lock"></i>
            </div>
            <h1 class="auth-title">Espace Administrateur</h1>
        </div>
        
        <div class="auth-body">
            @if(session('error'))
                <div class="alert">{{ session('error') }}</div>
            @endif

            <form method="POST" action="{{ route('admin.login') }}">
                @csrf

                <div class="form-group">
                    <label class="form-label">Identifiant</label>
                    <input type="email" name="email" class="form-control" required autofocus>
                </div>

                <div class="form-group">
                    <label class="form-label">Mot de passe</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button type="submit" class="btn-auth">
                    <i class="bi bi-box-arrow-in-right"></i> Connexion
                </button>
            </form>
            
            <p class="footer-note">
                Système sécurisé &copy; {{ date('Y') }}
            </p>
        </div>
    </div>
</div>
@endsection