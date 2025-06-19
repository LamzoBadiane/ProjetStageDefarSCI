<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>🏢 JobPlatform – Entreprise</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet" />
    <style>
        html, body {
            height: 100%;
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: #f8f9fa;
        }

        .container-fluid > .row {
            min-height: 100vh;
        }

        .sidebar {
            background-color: #343a40;
            color: white;
            padding: 25px 15px;
            border-right: 1px solid rgba(255,255,255,0.1);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: sticky;
            top: 0;
            min-height: 100vh;
        }

        .sidebar h4 {
            text-align: center;
            font-weight: bold;
            margin-bottom: 2rem;
            font-size: 1.5rem;
            animation: fadeInDown 1s ease;
        }

        .sidebar .nav-links {
            flex-grow: 1;
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 12px 18px;
            text-decoration: none;
            font-weight: 500;
            border-radius: 8px;
            margin-bottom: 10px;
            transition: all 0.3s ease;
        }

        .sidebar a:hover {
            background-color: #495057;
            transform: translateX(5px);
        }

        .sidebar .active {
            background-color: #0d6efd;
            font-weight: bold;
        }

        .logout-btn {
            margin-top: 10px;
        }

        .logout-btn button {
            background-color: transparent;
            border: 2px solid white;
            color: white;
            font-weight: bold;
            width: 100%;
            transition: all 0.3s ease;
        }

        .logout-btn button:hover {
            background-color: white;
            color: #343a40;
        }

        footer {
            font-size: 0.875rem;
            color: #ccc;
            text-align: center;
            margin-top: 20px;
            border-top: 1px solid rgba(255,255,255,0.15);
            padding-top: 15px;
        }

        footer a {
            color: #adb5bd;
            text-decoration: none;
            margin-right: 15px;
            transition: color 0.3s ease;
        }

        footer a:hover {
            color: white;
        }

        main {
            animation: fadeInUp 0.7s ease;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-15px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <!-- Barre latérale entreprise -->
        <nav class="col-md-3 col-lg-2 sidebar d-flex flex-column">
            <div>
                <h4>🏢 JobPlatform</h4>
                <div class="nav-links">
                    <a href="{{ route('company.dashboard') }}"
                        class="{{ request()->routeIs('company.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-house-door"></i> Tableau de bord
                    </a>

                    <a href="{{ route('company.offers.index') }}"
                        class="{{ request()->routeIs('company.offers.*') ? 'active' : '' }}">
                        <i class="bi bi-briefcase"></i> Mes offres
                    </a>

                    <a href="{{ route('company.applications.index') }}"
                        class="{{ request()->routeIs('company.applications.*') ? 'active' : '' }}">
                        <i class="bi bi-envelope"></i> Candidatures reçues
                    </a>

                    <a href="{{ route('company.interviews.index') }}" class="{{ request()->routeIs('company.interviews.*') ? 'active' : '' }}">
                        <i class="bi bi-people"></i> Entretiens
                    </a>

                    @php
                        $companyId = Auth::guard('company')->check() ? Auth::guard('company')->id() : null;
                    @endphp

                    @if ($companyId)
                        <a href="{{ route('company.profile.show') }}"
                            class="{{ request()->routeIs('company.profile.show') ? 'active' : '' }}">
                            <i class="bi bi-person-badge"></i> Profil Entreprise
                        </a>
                    @endif
                    <a href="{{ route('company.history.index') }}" class="{{ request()->routeIs('company.history.index') ? 'active' : '' }}">
                        <i class="bi bi-clock-history"></i> Historique
                    </a>
                    <a href="{{ route('company.statistics.index') }}" class="{{ request()->routeIs('company.statistics.index') ? 'active' : '' }}">
                        <i class="bi bi-bar-chart">
                        </i> Statistiques
                    </a>

                    <a href="{{ route('company.account.edit') }}" class="{{ request()->routeIs('company.account.*') ? 'active' : '' }}">
                        <i class="bi bi-person-circle"></i> Mon compte
                    </a>

                    <form method="POST" action="{{ route('company.logout') }}" class="logout-btn text-center">
                        @csrf
                        <button type="submit" class="btn">
                            <i class="bi bi-box-arrow-right"></i> Déconnexion
                        </button>
                    </form>
                </div>
            </div>
            <footer>
                <p>
                    <a href="#">Conditions</a><a href="#">Confidentialité</a><a href="#">Contact</a>
                </p>
                &copy; {{ date('Y') }} JobPlatform - Tous droits réservés
            </footer>
        </nav>

        <!-- Contenu principal -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
            @yield('content')
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
