<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Job Platform - Entreprise' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f4f6f9;
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="20" height="20" patternUnits="userSpaceOnUse"><path d="M 20 0 L 0 0 0 20" fill="none" stroke="rgba(79,195,247,0.03)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
            z-index: -1;
        }

        .sidebar {
            height: 100vh;
            background-color: #343a40;
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            width: 270px;
            padding: 1.5rem 0 0 0;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            z-index: 1000;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }

        .sidebar h4 {
            text-align: center;
            margin-bottom: 2rem;
            font-weight: 700;
            font-size: 1.5rem;
            color: #4fc3f7;
            text-shadow: 0 2px 10px rgba(79, 195, 247, 0.3);
            padding: 0 1rem;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            padding: 16px 24px;
            display: flex;
            align-items: center;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 0;
            margin: 2px 12px;
            position: relative;
            overflow: hidden;
        }

        .sidebar a::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.5s;
        }

        .sidebar a:hover::before {
            left: 100%;
        }

        .sidebar a:hover {
            background-color: #495057;
            color: #fff;
            transform: translateX(5px);
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(73, 80, 87, 0.3);
        }

        .sidebar a.active {
            background-color: #4fc3f7 !important;
            color: #212529 !important;
            font-weight: 600;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(79, 195, 247, 0.4);
            transform: translateX(5px);
            position: relative;
            border: 2px solid #ffffff;
        }

        .sidebar a.active::after {
            content: '';
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 20px;
            background: #212529;
            border-radius: 2px;
        }

        .sidebar a i {
            margin-right: 12px;
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }

        .main-content {
            margin-left: 270px;
            padding: 2rem;
            min-height: 100vh;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px 0 0 20px;
            box-shadow: -4px 0 30px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .main-content::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #4fc3f7, #495057, #343a40);
            border-radius: 20px 0 0 0;
        }

        .sidebar-content {
            flex: 1;
            padding: 0 1.5rem;
        }

        .sidebar-bottom {
            margin-top: auto;
            padding: 0 1.5rem 1.5rem;
        }

        .logout-section form {
            margin: 0;
            padding: 0;
        }

        .logout-section .btn {
            background: transparent;
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: #4fc3f7;
            font-weight: 600;
            padding: 12px 20px;
            border-radius: 12px;
            transition: all 0.3s ease;
            width: 100%;
            backdrop-filter: blur(10px);
            margin-bottom: 1rem;
        }

        .logout-section .btn:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.5);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        }

        .settings-link {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 1rem;
            padding-bottom: 1rem;
        }

        footer {
            background-color: #343a40;
            color: #fff;
            text-align: center;
            padding: 12px;
            border-radius: 12px;
            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        footer p {
            margin-bottom: 0.25rem;
            font-size: 0.8rem;
        }

        footer a {
            color: #4fc3f7;
            text-decoration: none;
            transition: color 0.3s ease;
            font-weight: 500;
        }

        footer a:hover {
            color: #fff;
        }

        /* Animations */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .sidebar a {
            animation: slideIn 0.3s ease forwards;
        }

        .sidebar a:nth-child(2) { animation-delay: 0.1s; }
        .sidebar a:nth-child(3) { animation-delay: 0.2s; }
        .sidebar a:nth-child(4) { animation-delay: 0.3s; }
        .sidebar a:nth-child(5) { animation-delay: 0.4s; }
        .sidebar a:nth-child(6) { animation-delay: 0.5s; }
        .sidebar a:nth-child(7) { animation-delay: 0.6s; }
        .sidebar a:nth-child(8) { animation-delay: 0.7s; }
        .sidebar a:nth-child(9) { animation-delay: 0.8s; }

        /* Responsive design */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main-content {
                margin-left: 0;
                border-radius: 0;
            }

            footer {
                background-color: #343a40;
                color: #fff;
                text-align: center;
                padding: 24px;
                margin-left: 0;
                border-radius: 0;
                position: relative;
                left: auto;
                right: auto;
                bottom: auto;
            }
        }

        /* Smooth scrollbar */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: #495057;
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: #6c757d;
        }

        /* Effet de profondeur pour les cards */
        .card {
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border: none;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        }

        /* Améliorations des boutons */
        .btn {
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        /* Améliorations des formulaires */
        .form-control {
            border-radius: 8px;
            border: 1px solid #e9ecef;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #4fc3f7;
            box-shadow: 0 0 0 0.2rem rgba(79, 195, 247, 0.25);
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Barre latérale entreprise -->
    <nav class="sidebar">
        <div class="sidebar-content">
            <h4>🏢 JobPlatform</h4>

            <a href="{{ route('company.dashboard') }}"
               class="{{ request()->routeIs('company.dashboard') ? 'active' : '' }}">
                <i class="bi bi-house-door me-2"></i> Tableau de bord
            </a>

            <a href="{{ route('company.offers.index') }}"
               class="{{ request()->routeIs('company.offers.*') ? 'active' : '' }}">
                <i class="bi bi-briefcase me-2"></i> Mes offres
            </a>

            <a href="{{ route('company.applications.index') }}"
               class="{{ request()->routeIs('company.applications.*') ? 'active' : '' }}">
                <i class="bi bi-envelope me-2"></i> Candidatures reçues
            </a>

            <a href="{{ route('company.interviews.index') }}" 
               class="{{ request()->routeIs('company.interviews.*') ? 'active' : '' }}">
                <i class="bi bi-people me-2"></i> Entretiens
            </a>

            @php
                $companyId = Auth::guard('company')->check() ? Auth::guard('company')->id() : null;
            @endphp

            @if ($companyId)
                <a href="{{ route('company.profile.show') }}"
                   class="{{ request()->routeIs('company.profile.show') ? 'active' : '' }}">
                    <i class="bi bi-person-badge me-2"></i> Profil Entreprise
                </a>
            @endif

            <a href="{{ route('company.history.index') }}" 
               class="{{ request()->routeIs('company.history.index') ? 'active' : '' }}">
                <i class="bi bi-clock-history me-2"></i> Historique
            </a>

            <a href="{{ route('company.statistics.index') }}" 
               class="{{ request()->routeIs('company.statistics.index') ? 'active' : '' }}">
                <i class="bi bi-bar-chart me-2"></i> Statistiques
            </a>

            <a href="{{ route('company.account.edit') }}" 
               class="{{ request()->routeIs('company.account.*') ? 'active' : '' }}">
                <i class="bi bi-person-circle me-2"></i> Mon compte
            </a>
        </div>

        <div class="sidebar-bottom">
            <div class="logout-section">
                <form method="POST" action="{{ route('company.logout') }}">
                    @csrf
                    <button class="btn">
                        <i class="bi bi-box-arrow-right me-2"></i> Déconnexion
                    </button>
                </form>
            </div>

            <!-- Pied de page dans la sidebar -->
            <footer class="mt-auto">
                <p>
                    <a href="#" class="text-decoration-none me-2">Conditions</a>
                    <a href="#" class="text-decoration-none me-2">Confidentialité</a>
                    <a href="#" class="text-decoration-none">Contact</a>
                </p>
                &copy; {{ date('Y') }} JobPlatform - Tous droits réservés
            </footer>
        </div>
    </nav>

    <!-- Contenu principal -->
    <main class="main-content flex-grow-1">
        @yield('content')
    </main>

</body>
</html>