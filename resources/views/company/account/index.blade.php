@extends('layouts.company')

@section('content')

{{-- Assets --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />

<style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        background: linear-gradient(to bottom right, #e3f2fd, #f3e5f5);
        transition: background 0.5s ease, color 0.5s ease;
        font-family: 'Segoe UI', sans-serif;
    }

    .dark-mode {
        background: linear-gradient(to bottom right, #121212, #1e1e1e) !important;
        color: #e0e0e0 !important;
    }

    .container {
        z-index: 2;
    }

    .glass-card {
        background: rgba(255, 255, 255, 0.15);
        border-radius: 1.25rem;
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.25);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .glass-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 32px rgba(0, 0, 0, 0.2);
    }

    .btn-animated {
        transition: all 0.3s ease;
        transform: translateY(0);
    }

    .btn-animated:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
    }

    .form-control, .btn {
        border-radius: 0.6rem;
    }

    .form-control:focus {
        border-color: #7e57c2;
        box-shadow: 0 0 0 0.25rem rgba(126, 87, 194, 0.25);
    }

    .theme-switcher {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1000;
        background: #fff;
        border-radius: 50px;
        padding: 10px 16px;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.15);
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .theme-switcher:hover {
        background: #f0f0f0;
    }

    .dark-mode .glass-card {
        background: rgba(40, 40, 40, 0.3);
        color: #eee;
    }

    .dark-mode .form-control,
    .dark-mode .btn {
        background-color: #1e1e1e;
        color: #fff;
        border-color: #444;
    }

    .dark-mode .form-control:focus {
        border-color: #9c27b0;
        box-shadow: 0 0 0 0.25rem rgba(156, 39, 176, 0.25);
    }

</style>

<div class="theme-switcher" onclick="toggleTheme()">
    <i id="theme-icon" class="bi bi-moon-fill fs-5"></i>
</div>

<div class="container py-5 animate__animated animate__fadeIn">
    <h2 class="text-center fw-bold mb-5"><i class="bi bi-briefcase-fill me-2"></i> Mon compte entreprise</h2>

    @if(session('success'))
        <div class="alert alert-success fw-bold text-center animate__animated animate__fadeInDown">
            {{ session('success') }}
        </div>
    @endif

    <div class="row g-4">
        <div class="col-md-6">
            <div class="glass-card p-4">
                <h5 class="mb-3"><i class="bi bi-building"></i> Informations générales</h5>
                <form action="{{ route('company.account.update') }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">🏢 Nom de l'entreprise</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $company->name) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">📧 Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $company->email) }}" required>
                    </div>
                    <div class="text-end">
                        <button class="btn btn-primary btn-animated fw-bold">
                            <i class="bi bi-save me-1"></i> Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-6">
            <div class="glass-card p-4">
                <h5 class="mb-3"><i class="bi bi-shield-lock"></i> Sécurité & Mot de passe</h5>
                <form action="{{ route('company.account.password') }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">🔒 Mot de passe actuel</label>
                        <input type="password" name="current_password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">🆕 Nouveau mot de passe</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">🔁 Confirmation</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                    <div class="text-end">
                        <button class="btn btn-warning btn-animated fw-bold">
                            <i class="bi bi-lock-fill me-1"></i> Mettre à jour
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-12">
            <div class="glass-card p-4 border border-danger">
                <h5 class="text-danger mb-3"><i class="bi bi-exclamation-octagon-fill"></i> Zone dangereuse</h5>
                <p class="text-danger fw-bold">⚠️ Supprimer votre compte effacera définitivement toutes vos données.</p>
                <form method="POST" action="{{ route('company.account.delete') }}" onsubmit="return confirm('Êtes-vous sûr ? Cette action est irréversible.')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-animated fw-bold">
                        <i class="bi bi-trash3-fill"></i> Supprimer définitivement mon compte
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleTheme() {
        const body = document.body;
        const icon = document.getElementById('theme-icon');
        body.classList.toggle('dark-mode');

        if (body.classList.contains('dark-mode')) {
            icon.classList.replace('bi-moon-fill', 'bi-sun-fill');
        } else {
            icon.classList.replace('bi-sun-fill', 'bi-moon-fill');
        }

        localStorage.setItem('theme', body.classList.contains('dark-mode') ? 'dark' : 'light');
    }

    document.addEventListener('DOMContentLoaded', () => {
        if (localStorage.getItem('theme') === 'dark') {
            document.body.classList.add('dark-mode');
            document.getElementById('theme-icon').classList.replace('bi-moon-fill', 'bi-sun-fill');
        }
    });
</script>

@endsection
