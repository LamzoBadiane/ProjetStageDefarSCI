<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin | @yield('title', 'Tableau de bord')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body { background: #f8f9fa; }
        .sidebar { height: 100vh; background: #343a40; color: white; }
        .sidebar a { color: white; display: block; padding: 10px; }
        .sidebar a:hover { background-color: #495057; text-decoration: none; }
    </style>

    @stack('styles')
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <aside class="col-md-2 sidebar d-none d-md-block p-0">
                <h4 class="text-center py-3 border-bottom">Admin</h4>
                <a href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
                <form action="{{ route('admin.logout') }}" method="POST" class="mt-4 text-center">
                    @csrf
                    <button class="btn btn-danger btn-sm"><i class="bi bi-box-arrow-right"></i> Déconnexion</button>
                </form>
            </aside>

            <!-- Main -->
            <main class="col-md-10 p-4">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
