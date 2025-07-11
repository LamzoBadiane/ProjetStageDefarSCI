@extends('layouts.company')

@section('content')
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

    @keyframes floatAnimation {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-8px); }
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

    .alert-info {
        background: var(--info-gradient);
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

    .table-container {
        background: var(--card-bg);
        border-radius: var(--radius-xl);
        padding: 40px;
        box-shadow: var(--shadow-strong);
        position: relative;
        overflow: hidden;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.3);
    }

    .table-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 8px;
        background: var(--primary-gradient);
    }

    .table {
        margin-bottom: 0;
        border-radius: var(--radius-md);
        overflow: hidden;
        box-shadow: var(--shadow-soft);
    }

    .table thead th {
        background: var(--primary-gradient);
        color: var(--text-light);
        font-weight: 700;
        font-size: 1.1rem;
        padding: 20px 15px;
        border: none;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        position: relative;
    }

    .table thead th::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 2px;
        background: rgba(255,255,255,0.3);
    }

    .table tbody tr {
        background: var(--card-bg);
        transition: var(--transition-fast);
        border: none;
    }

    .table tbody tr:hover {
        background: linear-gradient(135deg, #f8f9ff 0%, #e3f2fd 100%);
        transform: scale(1.01);
        box-shadow: var(--shadow-soft);
    }

    .table tbody td {
        padding: 20px 15px;
        border: none;
        vertical-align: middle;
        font-weight: 600;
        position: relative;
    }

    .table tbody tr:not(:last-child) td {
        border-bottom: 1px solid rgba(0,0,0,0.05);
    }

    .badge {
        padding: 10px 20px;
        font-size: 0.9rem;
        font-weight: 700;
        border-radius: 50px;
        position: relative;
        overflow: hidden;
        animation: pulseGlow 3s infinite ease-in-out;
    }

    @keyframes pulseGlow {
        0%, 100% {
            opacity: 1;
            transform: scale(1);
            box-shadow: 0 0 0 0 rgba(255,255,255,0.4);
        }
        50% {
            opacity: 0.9;
            transform: scale(1.05);
            box-shadow: 0 0 0 10px rgba(255,255,255,0);
        }
    }

    .badge.bg-success {
        background: var(--success-gradient) !important;
        color: white;
    }

    .badge.bg-danger {
        background: var(--danger-gradient) !important;
        color: white;
    }

    .badge.bg-warning {
        background: var(--warning-gradient) !important;
        color: white;
    }

    .btn {
        border-radius: var(--radius-sm);
        font-weight: 600;
        padding: 10px 20px;
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

    .btn-outline-info {
        border: 2px solid #17a2b8;
        color: #17a2b8;
        background: white;
    }

    .btn-outline-info:hover {
        background: var(--info-gradient);
        color: white;
        border-color: transparent;
    }

    .btn-info {
        background: var(--info-gradient);
        color: white;
    }

    .btn-outline-secondary {
        border: 2px solid #6c757d;
        color: #6c757d;
        background: white;
    }

    .btn-outline-secondary:hover {
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
        color: white;
        border-color: transparent;
    }

    .btn-sm {
        padding: 8px 16px;
        font-size: 0.875rem;
    }

    .form-select {
        border-radius: var(--radius-sm);
        border: 2px solid #e2e8f0;
        background: white;
        font-weight: 600;
        padding: 12px 16px;
        transition: var(--transition-fast);
        box-shadow: var(--shadow-soft);
    }

    .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        transform: scale(1.02);
    }

    .form-select-sm {
        padding: 8px 12px;
        font-size: 0.875rem;
    }

    .collapse {
        background: rgba(248, 249, 250, 0.8);
        border-radius: var(--radius-sm);
        padding: 15px;
        margin-top: 10px;
        border-left: 4px solid var(--primary-gradient);
        backdrop-filter: blur(10px);
    }

    .pagination {
        margin-top: 40px;
    }

    .pagination .page-link {
        border-radius: var(--radius-sm);
        margin: 0 5px;
        border: none;
        background: white;
        color: var(--text-dark);
        font-weight: 600;
        padding: 12px 18px;
        transition: var(--transition-fast);
        box-shadow: var(--shadow-soft);
    }

    .pagination .page-link:hover {
        background: var(--primary-gradient);
        color: white;
        transform: translateY(-2px);
        box-shadow: var(--shadow-hover);
    }

    .pagination .page-item.active .page-link {
        background: var(--primary-gradient);
        border: none;
        box-shadow: var(--shadow-soft);
    }

    .text-muted {
        color: #a0aec0 !important;
        font-style: italic;
    }

    .candidate-name {
        font-weight: 800;
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .offer-title {
        font-weight: 700;
        color: var(--text-dark);
        position: relative;
    }

    .offer-title::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background: var(--primary-gradient);
        transition: var(--transition-fast);
    }

    .offer-title:hover::after {
        width: 100%;
    }

    .actions-cell {
        min-width: 200px;
    }

    /* Responsive améliorations */
    @media (max-width: 768px) {
        .section-header {
            font-size: 2rem;
            padding: 30px 20px;
        }

        .table-container {
            padding: 20px;
        }

        .table {
            font-size: 0.875rem;
        }

        .table thead th,
        .table tbody td {
            padding: 12px 8px;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 0.8rem;
        }
    }

    @media (max-width: 576px) {
        .table-responsive {
            border-radius: var(--radius-md);
        }

        .pagination .page-link {
            padding: 8px 12px;
            font-size: 0.875rem;
        }
    }
</style>

<div class="container py-5">
    <div class="section-header fade-in">
        📨 Candidatures Reçues
    </div>

    @if(session('success'))
        <div class="alert alert-success text-center fade-in">{{ session('success') }}</div>
    @endif

    @if($applications->count() > 0)
    <div class="table-container fade-in">
        <div class="table-responsive">
            <table class="table table-hover align-middle text-center">
                <thead>
                    <tr>
                        <th>👤 Candidat</th>
                        <th>💼 Offre</th>
                        <th>📝 Motivation</th>
                        <th>📄 CV</th>
                        <th>🏷️ Statut</th>
                        <th class="actions-cell">⚙️ Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applications as $app)
                    <tr class="fade-in">
                        <td>
                            <div class="candidate-name">
                                {{ $app->user->first_name ?? '' }} {{ $app->user->name ?? 'Nom inconnu' }}
                            </div>
                        </td>
                        <td>
                            <div class="offer-title">
                                {{ $app->offer->title ?? 'Offre supprimée' }}
                            </div>
                        </td>
                        <td>
                            @if($app->motivation_file)
                                <a href="{{ asset('storage/' . $app->motivation_file) }}" target="_blank" class="btn btn-sm btn-outline-info">
                                    📄 Fichier
                                </a>
                            @elseif($app->motivation)
                                <button class="btn btn-sm btn-info" data-bs-toggle="collapse" data-bs-target="#motivation-{{ $app->id }}">
                                    📜 Voir
                                </button>
                                <div id="motivation-{{ $app->id }}" class="collapse mt-2 text-start">
                                    {{ $app->motivation }}
                                </div>
                            @else
                                <span class="text-muted">Aucune</span>
                            @endif
                        </td>
                        <td>
                            @if($app->user)
                                <a href="{{ route('company.students.profile', $app->user->id) }}" class="btn btn-sm btn-outline-secondary">
                                    👤 Voir Profil
                                </a>
                            @else
                                <span class="text-muted">Profil introuvable</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge
                                @if($app->status == 'acceptée') bg-success
                                @elseif($app->status == 'refusée') bg-danger
                                @else bg-warning text-dark
                                @endif">
                                {{ ucfirst($app->status) }}
                            </span>
                        </td>
                        <td class="actions-cell">
                            <form action="{{ route('company.applications.updateStatus', $app->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                    <option value="en attente" {{ $app->status == 'en attente' ? 'selected' : '' }}>⏳ En attente</option>
                                    <option value="acceptée" {{ $app->status == 'acceptée' ? 'selected' : '' }}>✅ Acceptée</option>
                                    <option value="refusée" {{ $app->status == 'refusée' ? 'selected' : '' }}>❌ Refusée</option>
                                    <option value="embauchée" {{ $app->status == 'embauchée' ? 'selected' : '' }}>🎉 Embauchée</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-center fade-in">
        {{ $applications->links('pagination::bootstrap-5') }}
    </div>
    @else
        <div class="alert alert-info text-center fade-in">
            😕 Aucune candidature reçue pour l'instant.
        </div>
    @endif
</div>
@endsection
