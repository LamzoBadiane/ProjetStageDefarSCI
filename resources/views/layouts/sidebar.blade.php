<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Job Platform' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .sidebar {
            height: 100vh;
            background-color: #343a40;
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            padding-top: 1rem;
        }

        .sidebar h4 {
            text-align: center;
            margin-bottom: 1rem;
            font-weight: bold;
            color: #ffc107;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            padding: 12px 20px;
            display: block;
            font-weight: 500;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .sidebar a:hover {
            background-color: #495057;
            border-radius: 5px;
        }

        .sidebar a.active {
            background-color: #9AA4B1FF !important;
            color: #212529 !important;
            font-weight: bold;
            border-left: 5px solid #0d6efd;
        }

        .main-content {
            margin-left: 250px;
            padding: 2rem;
            min-height: 100vh;
            background-color: #fff;
        }

        footer {
            background-color: #343a40;
            color: #fff;
            text-align: center;
            padding: 10px;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        footer a {
            color: #0d6efd;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Barre latérale -->
    <nav class="sidebar">
        <h4>🎓 JobPlatform</h4>

        <a href="{{ route('student.dashboard') }}"
           class="{{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
            <i class="bi bi-house-door me-2"></i> Dashboard
        </a>

        <a href="{{ route('offers.index') }}"
           class="{{ request()->routeIs('offers.*') ? 'active' : '' }}">
            <i class="bi bi-briefcase me-2"></i> Offres
        </a>

        <a href="{{ route('applications.index') }}"
           class="{{ request()->routeIs('applications.*') ? 'active' : '' }}">
            <i class="bi bi-bar-chart me-2"></i> Candidatures
        </a>

        <a href="{{ route('student.profile.edit') }}"
           class="{{ request()->routeIs('student.profile.*') ? 'active' : '' }}">
            <i class="bi bi-person me-2"></i> Profil
        </a>

        <a href="{{ route('student.interviews.index') }}" 
            class="{{ request()->routeIs('student.interviews.index') ? 'active' : '' }}">
            <i class="bi bi-calendar-event"></i> Mes entretiens
        </a>
        <a href="{{ route('student.account.edit') }}" 
            class="{{ request()->routeIs('student.account.*') ? 'active' : '' }}">
            <i class="bi bi-person-circle"></i> Mon compte
        </a>
        <a href="#"><i class="bi bi-gear"></i> Paramètres</a>


        <form method="POST" action="{{ route('logout') }}" class="mt-4 px-3">
            @csrf
            <button class="btn btn-outline-light w-100">
                <i class="bi bi-box-arrow-right me-2"></i> Déconnexion
            </button>
        </form>
    </nav>

    <!-- Contenu principal -->
    <main class="main-content flex-grow-1">
        @yield('content')
    </main>

    <!-- Pied de page -->
    <footer class="mt-auto">
        <p>
            <a href="#" class="text-decoration-none me-3">Conditions</a>
            <a href="#" class="text-decoration-none me-3">Confidentialité</a>
            <a href="#" class="text-decoration-none">Contact</a>
        </p>
        &copy; {{ date('Y') }} JobPlatform - Tous droits réservés
    </footer>
</body>
</html>
