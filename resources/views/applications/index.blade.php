@extends('layouts.sidebar')

@section('content')
<style>
    /* Améliorations Bootstrap avec CSS personnalisé */
    .gradient-primary {
        background: linear-gradient(135deg, #007bff 0%, #6f42c1 100%);
    }

    .gradient-success {
        background: linear-mode(135deg, #28a745 0%, #20c997 100%);
    }

    .gradient-danger {
        background: linear-gradient(135deg, #dc3545 0%, #e83e8c 100%);
    }

    .gradient-warning {
        background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
    }

    .gradient-info {
        background: linear-gradient(135deg, #17a2b8 0%, #6f42c1 100%);
    }

    /* Carte principale avec style Bootstrap amélioré */
    .main-card {
        border: none;
        border-radius: 1rem;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        transition: all 0.3s ease;
    }

    .main-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.2);
    }

    /* Titre avec style Bootstrap amélioré */
    .title-section {
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
        border-radius: 0.5rem;
        padding: 1rem;
        margin-bottom: 2rem;
        text-align: center;
    }

    .title-text {
        color: white;
        font-size: 2rem;
        font-weight: 700;
        margin: 0;
    }

    /* Tableau avec style Bootstrap amélioré */
    .table-modern {
        border-radius: 0.5rem;
        overflow: hidden;
        box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 2, 0.1);
    }

    .table-modern thead {
        background: linear-gradient(135deg, #007bff 0%, #6f42c1 100%);
    }

    .table-modern thead th {
        color: black;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: none;
        padding: 1rem;
    }

    .table-modern tbody tr {
        transition: all 0.3s ease;
    }

    .table-modern tbody tr:hover {
        background-color: #f8f9fa;
        transform: scale(1.02);
        box-shadow: 0 0.5rem 1rem rgba(0, 123, 255, 0.15);
    }

    .table-modern tbody td {
        padding: 1rem;
        vertical-align: middle;
        border-top: 1px solid #dee2e6;
    }

    /* Badges avec style Bootstrap amélioré */
    .badge-modern {
        font-size: 0.875rem;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .badge-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.5s;
    }

    .badge-modern:hover::before {
        left: 100%;
    }

    .badge-modern:hover {
        transform: scale(1.1);
        box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.2);
    }

    /* Boutons avec style Bootstrap amélioré */
    .btn-modern {
        border-radius: 50px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 0.5rem 1.5rem;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        border: none;
    }

    .btn-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.5s;
    }

    .btn-modern:hover::before {
        left: 100%;
    }

    .btn-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.2);
    }

    /* Alertes avec style Bootstrap amélioré */
    .alert-modern {
        border: none;
        border-radius: 0.5rem;
        padding: 1rem 1.5rem;
        font-weight: 500;
        box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.1);
        position: relative;
        overflow: hidden;
    }

    .alert-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(to bottom, transparent, rgba(255,255,255,0.7), transparent);
        animation: pulse-border 2s infinite;
    }

    @keyframes pulse-border {
        0%, 100% { opacity: 0.5; }
        50% { opacity: 1; }
    }

    /* Animations */
    .fade-in {
        animation: fadeIn 0.8s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .slide-in {
        animation: slideIn 0.5s ease-out;
    }

    @keyframes slideIn {
        from {
            transform: translateX(-50px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    /* Pagination avec style Bootstrap amélioré */
    .pagination-modern .page-link {
        border: none;
        border-radius: 50px;
        margin: 0 0.25rem;
        padding: 0.5rem 1rem;
        font-weight: 500;
        transition: all 0.3s ease;
        color: #007bff;
    }

    .pagination-modern .page-link:hover {
        background: linear-gradient(135deg, #007bff 0%, #6f42c1 100%);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 0.25rem 0.5rem rgba(0, 123, 255, 0.5);
    }

    .pagination-modern .page-item.active .page-link {
        background: linear-gradient(135deg, #007bff 0%, #6f42c1 100%);
        border: none;
        color: white;
        box-shadow: 0 0.25rem 0.5rem rgba(0, 123, 255, 0.5);
    }

    /* État vide amélioré */
    .empty-state {
        text-align: center;
        padding: 3rem;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 1rem;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
    }

    .empty-icon {
        font-size: 4rem;
        opacity: 0.3;
        margin-bottom: 1rem;
    }

    /* Responsive amélioré */
    @media (max-width: 768px) {
        .title-text {
            font-size: 1.5rem;
        }

        .table-responsive-stack {
            border: none;
        }

        .table-responsive-stack thead {
            display: none;
        }

        .table-responsive-stack tbody,
        .table-responsive-stack tr,
        .table-responsive-stack td {
            display: block;
        }

        .table-responsive-stack tr {
            border: 1px solid #dee2e6;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            padding: 0.5rem;
            background: white;
            box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.1);
        }

        .table-responsive-stack td {
            text-align: right;
            padding: 0.5rem;
            border: none;
            border-bottom: 1px solid #dee2e6;
        }

        .table-responsive-stack td:last-child {
            border-bottom: none;
        }

        .table-responsive-stack td:before {
            content: attr(data-label);
            float: left;
            font-weight: bold;
            color: #495057;
        }
    }
</style>

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card main-card fade-in">
                <div class="card-body">
                    <!-- Titre -->
                    <div class="title-section slide-in">
                        <h2 class="title-text">📋 Mes candidatures</h2>
                    </div>

                    <!-- Alertes -->
                    @if(session('success'))
                        <div class="alert alert-success alert-modern fade-in">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('warning'))
                        <div class="alert alert-warning alert-modern fade-in">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            {{ session('warning') }}
                        </div>
                    @endif

                    @if($applications->count() > 0)
                        <!-- Tableau -->
                        <div class="table-responsive fade-in">
                            <table class="table table-hover table-modern">
                                <thead>
                                    <tr>
                                        <th scope="col">📄 Offre</th>
                                        <th scope="col">📌 Statut</th>
                                        <th scope="col">📎 Lettre de Motivation</th>
                                        <th scope="col">📅 Date</th>
                                        <th scope="col">🔍 Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($applications as $app)
                                    <tr class="slide-in">
                                        <td data-label="Offre">
                                            <strong>{{ $app->offer->title }}</strong>
                                        </td>
                                        <td data-label="Statut">
                                            @if($app->status == 'acceptée')
                                                <span class="badge badge-modern bg-success">
                                                    <i class="fas fa-check me-1"></i>
                                                    {{ ucfirst($app->status) }}
                                                </span>
                                            @elseif($app->status == 'refusée')
                                                <span class="badge badge-modern bg-danger">
                                                    <i class="fas fa-times me-1"></i>
                                                    {{ ucfirst($app->status) }}
                                                </span>
                                            @else
                                                <span class="badge badge-modern bg-warning text-dark">
                                                    <i class="fas fa-clock me-1"></i>
                                                    {{ ucfirst($app->status) }}
                                                </span>
                                            @endif
                                        </td>
                                        <td data-label="Lettre de Motivation">
                                            @if($app->motivation_file)
                                                <a href="{{ asset('storage/' . $app->motivation_file) }}"
                                                   target="_blank"
                                                   class="btn btn-outline-primary btn-sm btn-modern">
                                                    <i class="fas fa-download me-1"></i>
                                                    Télécharger
                                                </a>
                                            @else
                                                <span class="text-muted">
                                                    <i class="fas fa-times me-1"></i>
                                                    Aucun
                                                </span>
                                            @endif
                                        </td>
                                        <td data-label="Date">
                                            <i class="fas fa-calendar-alt me-2 text-muted"></i>
                                            {{ $app->created_at->format('d/m/Y') }}
                                        </td>
                                        <td data-label="Action">
                                            <a href="{{ route('applications.show', $app->id) }}"
                                               class="btn btn-info btn-sm btn-modern">
                                                <i class="fas fa-eye me-1"></i>
                                                Détails
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4 fade-in">
                            <nav aria-label="Navigation des candidatures">
                                <div class="pagination-modern">
                                    {{ $applications->links('pagination::bootstrap-5') }}
                                </div>
                            </nav>
                        </div>
                    @else
                        <!-- État vide -->
                        <div class="empty-state fade-in">
                            <div class="empty-icon">📋</div>
                            <div class="alert alert-info alert-modern">
                                <i class="fas fa-info-circle me-2"></i>
                                Vous n'avez pas encore de candidatures.
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection</aner>
