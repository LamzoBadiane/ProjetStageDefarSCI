<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Administration')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Styles --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <!-- Hover.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.3.1/css/hover-min.css"/>

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f8f9fa;
        }
        .admin-sidebar {
            width: 250px;
            height: 100vh;
            background-color: #212529;
            color: white;
            position: fixed;
        }
        .admin-sidebar .nav-link {
            color: white;
            padding: 12px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        .admin-sidebar .nav-link.active,
        .admin-sidebar .nav-link:hover {
            background-color: #0d6efd;
            color: white;
        }
        .admin-header {
            padding: 15px 30px;
            background: white;
            border-bottom: 1px solid #dee2e6;
            margin-left: 250px;
        }
        .admin-content {
            margin-left: 250px;
            padding: 30px;
        }
    </style>
</head>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.counter').forEach(counter => {
            const updateCount = () => {
                const target = +counter.getAttribute('data-target');
                const count = +counter.innerText;
                const speed = 100; // + rapide = valeur plus petite
                const increment = Math.ceil(target / speed);

                if (count < target) {
                    counter.innerText = count + increment;
                    setTimeout(updateCount, 20);
                } else {
                    counter.innerText = target.toLocaleString(); // ajoute formatage
                }
            };

            updateCount();
        });
    });
</script>

<body>

    <!-- Sidebar -->
    <div class="admin-sidebar d-flex flex-column p-3">
        <h4 class="text-center mb-4"><i class="bi bi-shield-lock"></i> Admin-JobPlatform</h4>
        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Tableau de bord
        </a>
        <a href="{{ route('admin.students.index') }}" class="nav-link {{ request()->routeIs('admin.students.*') ? 'active' : '' }}">
            <i class="bi bi-mortarboard"></i> Étudiants
        </a>
        <a href="{{ route('admin.companies.index') }}" class="nav-link {{ request()->routeIs('admin.companies.*') ? 'active' : '' }}">
            <i class="bi bi-building"></i> Entreprises
        </a>
        <a href="#" class="nav-link {{ request()->routeIs('admin.offers.*') ? 'active' : '' }}">
            <i class="bi bi-briefcase"></i> Offres
        </a>
        <a href="#" class="nav-link {{ request()->routeIs('admin.applications.*') ? 'active' : '' }}">
            <i class="bi bi-send-check"></i> Candidatures
        </a>
        <a href="#" class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
            <i class="bi bi-gear"></i> Paramètres
        </a>
        <a href="{{ route('admin.logout') }}" class="nav-link text-danger mt-auto">
            <i class="bi bi-box-arrow-right"></i> Déconnexion
        </a>
    </div>

    <!-- Header -->
    <div class="admin-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">@yield('title', 'Tableau de bord')</h5>
        <div>
            <span class="text-muted small">Connecté en tant que <strong>{{ Auth::guard('admin')->user()->first_name }} {{ Auth::guard('admin')->user()->name }}</strong></span>
        </div>
    </div>

    <!-- Content -->
    <main class="admin-content">
        @yield('content')
    </main>

    {{-- Scripts --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.counter').forEach(counter => {
                const target = +counter.dataset.target;
                const speed = 100;
                let count = 0;

                const update = () => {
                    const increment = Math.ceil(target / speed);
                    if (count < target) {
                        count += increment;
                        counter.innerText = count;
                        setTimeout(update, 20);
                    } else {
                        counter.innerText = target.toLocaleString();
                    }
                };

                update();
            });
        });
    </script>
    </body>
</html>
