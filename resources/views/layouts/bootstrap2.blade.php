<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Job Platform - Espace Entreprises' }}</title>

    {{-- Bootstrap CSS & Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Vite (si utilisé) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Custom Styles Entreprise --}}
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f8f9fa;
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

        .navbar {
            background-color: #2c3e50 !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .navbar .nav-link {
            color: #ffffff !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 8px;
            margin: 0 4px;
        }

        .navbar .nav-link:hover {
            color: #4fc3f7 !important;
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }

        .navbar .nav-link.active {
            background-color: #4fc3f7 !important;
            color: #212529 !important;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(79, 195, 247, 0.3);
        }

        .navbar .nav-link i {
            margin-right: 8px;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: #4fc3f7 !important;
            text-shadow: 0 2px 10px rgba(79, 195, 247, 0.3);
        }

        .navbar-toggler {
            border: none;
            padding: 8px;
        }

        .navbar-toggler:focus {
            box-shadow: 0 0 0 2px rgba(79, 195, 247, 0.5);
        }

        footer {
            background-color: #2c3e50;
            color: #fff;
            text-align: center;
            padding: 12px;
            border-radius: 12px 12px 0 0;
            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: auto;
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

        .btn-entreprise {
            background-color: #4fc3f7;
            border-color: #4fc3f7;
            color: #212529;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-entreprise:hover {
            background-color: #3da8d8;
            border-color: #3da8d8;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(79, 195, 247, 0.3);
        }

        .card-header-entreprise {
            background-color: #2c3e50;
            color: white;
            border-radius: 12px 12px 0 0 !important;
        }

        .main-content {
            padding: 2rem;
            min-height: 100vh;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .navbar {
            animation: fadeIn 0.5s ease forwards;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    {{-- NAVBAR ENTREPRISE --}}
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('welcome') }}">
                🏢 JobPlatform
            </a>

            <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('company.login') ? 'active' : '' }}"
                           href="{{ route('company.login') }}">
                            <i class="bi bi-box-arrow-in-right"></i> Connexion
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('company.register') ? 'active' : '' }}"
                           href="{{ route('company.register') }}">
                            <i class="bi bi-person-plus"></i> Inscription
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- CONTENU PRINCIPAL --}}
    <main class="container my-5 flex-grow-1">
        @yield('content')
    </main>

    {{-- PIED DE PAGE --}}
    <footer>
        <p class="mb-1">
            <a href="#" class="me-3">Conditions</a>
            <a href="#" class="me-3">Confidentialité</a>
            <a href="#">Contact</a>
        </p>
        <small>&copy; {{ date('Y') }} JobPlatform - Espace Entreprises</small>
    </footer>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>