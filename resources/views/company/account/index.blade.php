@extends('layouts.company')

@section('content')
<!-- Assets -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --success-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        --warning-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --danger-gradient: linear-gradient(135deg, #fc466b 0%, #3f5efb 100%);
        --info-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        --text-dark: #2d3748;
        --text-light: #ffffff;
        --bg-light: #f8fafc;
        --card-bg: #ffffff;
        --shadow-strong: 0 20px 40px rgba(0, 0, 0, 0.15);
        --shadow-soft: 0 10px 25px rgba(0, 0, 0, 0.08);
        --shadow-hover: 0 25px 50px rgba(0, 0, 0, 0.2);
        --transition-fast: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        --transition-smooth: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        --radius-xl: 24px;
        --radius-lg: 20px;
        --radius-md: 16px;
        --radius-sm: 12px;
    }

    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        font-family: 'Inter', 'Segoe UI', sans-serif;
        color: var(--text-dark);
        min-height: 100vh;
    }

    body.dark-mode {
        background: linear-gradient(135deg, #121212 0%, #1e1e1e 100%);
        color: var(--text-light);
    }

    .fade-in {
        animation: fadeInUp 0.8s ease forwards;
        opacity: 0;
        transform: translateY(40px);
    }

    .fade-in:nth-child(2) { animation-delay: 0.1s; }
    .fade-in:nth-child(3) { animation-delay: 0.2s; }
    .fade-in:nth-child(4) { animation-delay: 0.3s; }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes shimmer {
        0% { transform: translateX(-100%) translateY(-100%) rotate(30deg); }
        100% { transform: translateX(100%) translateY(100%) rotate(30deg); }
    }

    .section-header {
        background: var(--primary-gradient);
        color: var(--text-light);
        padding: 50px 40px;
        border-radius: var(--radius-xl);
        font-size: 2.5rem;
        text-align: center;
        font-weight: 800;
        margin-bottom: 50px;
        box-shadow: var(--shadow-strong);
        position: relative;
        overflow: hidden;
    }

    .section-header::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
        animation: shimmer 3s infinite;
    }

    .alert {
        border: none;
        border-radius: var(--radius-lg);
        padding: 20px 30px;
        font-weight: 600;
        font-size: 1.1rem;
        box-shadow: var(--shadow-soft);
        position: relative;
        overflow: hidden;
    }

    .alert-success {
        background: var(--success-gradient);
        color: white;
    }

    .alert::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: rgba(255,255,255,0.3);
    }

    .card-container {
        background: var(--card-bg);
        border-radius: var(--radius-xl);
        padding: 40px;
        box-shadow: var(--shadow-strong);
        position: relative;
        overflow: hidden;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.3);
        margin-bottom: 40px;
        transition: var(--transition-smooth);
    }

    body.dark-mode .card-container {
        background: rgba(40, 40, 40, 0.8);
        color: var(--text-light);
    }

    .card-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 8px;
        background: var(--primary-gradient);
    }

    .card-container:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-hover);
    }

    .form-control {
        border-radius: var(--radius-sm);
        padding: 12px 16px;
        font-weight: 500;
        transition: var(--transition-fast);
        border: 2px solid #e2e8f0;
    }

    body.dark-mode .form-control {
        background-color: #1e1e1e;
        color: #fff;
        border-color: #444;
    }

    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.25);
        transform: scale(1.02);
    }

    .btn {
        border-radius: var(--radius-sm);
        font-weight: 600;
        padding: 12px 24px;
        transition: var(--transition-fast);
        position: relative;
        overflow: hidden;
        border: none;
    }

    .btn::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(255,255,255,0.2);
        border-radius: 50%;
        transition: var(--transition-fast);
        transform: translate(-50%, -50%);
    }

    .btn:hover::before {
        width: 200px;
        height: 200px;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-soft);
    }

    .btn-primary {
        background: var(--primary-gradient);
        color: white;
    }

    .btn-warning {
        background: var(--warning-gradient);
        color: white;
    }

    .btn-outline-danger {
        border: 2px solid #fc466b;
        color: #fc466b;
        background: transparent;
    }

    .btn-outline-danger:hover {
        background: var(--danger-gradient);
        color: white;
        border-color: transparent;
    }

    .theme-switcher {
        position: fixed;
        top: 20px;
        right: 20px;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: var(--shadow-md);
        cursor: pointer;
        z-index: 999;
        transition: var(--transition);
    }

    .theme-switcher i {
        font-size: 1.4rem;
        color: var(--primary);
        transition: var(--transition);
    }

    body.dark-mode .theme-switcher {
        background: #333;
    }

    body.dark-mode .theme-switcher i {
        color: #ffc107;
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .section-title i {
        color: var(--primary);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .section-header {
            font-size: 2rem;
            padding: 30px 20px;
        }

        .card-container {
            padding: 30px;
        }
    }

    @media (max-width: 576px) {
        .section-header {
            font-size: 1.8rem;
            padding: 25px 15px;
        }

        .card-container {
            padding: 20px 15px;
        }
    }
</style>

<div class="theme-switcher" onclick="toggleTheme()">
    <i id="theme-icon" class="bi bi-moon-fill"></i>
</div>

<div class="container py-5">
    <div class="section-header fade-in">
        <i class="bi bi-briefcase-fill"></i> Mon compte entreprise
    </div>

    @if(session('success'))
        <div class="alert alert-success text-center fade-in">{{ session('success') }}</div>
    @endif

    <div class="row g-4">
        <!-- Informations générales -->
        <div class="col-md-6 fade-in">
            <div class="card-container">
                <h3 class="section-title">
                    <i class="bi bi-building"></i> Informations générales
                </h3>
                <form action="{{ route('company.account.update') }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-4">
                        <label class="form-label fw-bold">🏢 Nom de l'entreprise</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $company->name) }}" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">📧 Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $company->email) }}" required>
                    </div>
                    <div class="text-end">
                        <button class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sécurité & Mot de passe -->
        <div class="col-md-6 fade-in">
            <div class="card-container">
                <h3 class="section-title">
                    <i class="bi bi-shield-lock"></i> Sécurité & Mot de passe
                </h3>
                <form action="{{ route('company.account.password') }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-4">
                        <label class="form-label fw-bold">🔒 Mot de passe actuel</label>
                        <input type="password" name="current_password" class="form-control" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">🆕 Nouveau mot de passe</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">🔁 Confirmation</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                    <div class="text-end">
                        <button class="btn btn-warning">
                            <i class="bi bi-lock-fill me-1"></i> Mettre à jour
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Zone dangereuse -->
        <div class="col-md-12 fade-in">
            <div class="card-container" style="border-left: 4px solid var(--danger-gradient);">
                <h3 class="section-title text-danger">
                    <i class="bi bi-exclamation-octagon-fill"></i> Zone dangereuse
                </h3>
                <p class="fw-bold text-danger mb-4">⚠️ Supprimer votre compte effacera définitivement toutes vos données.</p>
                <form method="POST" action="{{ route('company.account.delete') }}" onsubmit="return confirm('Êtes-vous sûr ? Cette action est irréversible.')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="bi bi-trash3-fill me-1"></i> Bloquer mon compte
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
