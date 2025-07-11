<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Job Platform - Espace Entreprises' }}</title>

    {{-- Bootstrap CSS & Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    {{-- Vite (si utilisé) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Custom Styles Entreprise --}}
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            background-color: #2c3e50 !important; /* Bleu foncé */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .navbar .nav-link {
            color: #ffffff !important;
            transition: 0.3s;
        }

        .navbar .nav-link:hover {
            color: #18bc9c !important; /* Turquoise */
            text-decoration: underline;
        }

        .navbar .nav-link.active {
            font-weight: bold;
            text-decoration: underline;
            color: #18bc9c !important;
        }

        footer {
            background-color: #2c3e50;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        .btn-entreprise {
            background-color: #18bc9c;
            border-color: #18bc9c;
            color: white;
        }

        .btn-entreprise:hover {
            background-color: #15a589;
            border-color: #15a589;
        }

        .card-header-entreprise {
            background-color: #2c3e50;
            color: white;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    {{-- NAVBAR ENTREPRISE --}}
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand text-white fw-bold" href="#">
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
            <a href="#" class="text-decoration-none text-white-50 me-3">Conditions</a>
            <a href="#" class="text-decoration-none text-white-50 me-3">Confidentialité</a>
            <a href="#" class="text-decoration-none text-white-50">Contact</a>
        </p>
        <small>&copy; {{ date('Y') }} JobPlatform - Espace Entreprises</small>
    </footer>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
