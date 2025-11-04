<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gestión de Clientes')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #f8f9fa, #e9ecef);
        }
        .navbar {
            background: linear-gradient(90deg, #0d6efd, #6610f2);
        }
        .navbar-brand {
            font-weight: bold;
            letter-spacing: 1px;
        }
        .nav-link {
            color: #fff !important;
            font-weight: 500;
            margin-right: 10px;
            transition: all 0.3s ease-in-out;
        }
        .nav-link:hover {
            color: #ffc107 !important;
            transform: translateY(-2px);
        }
        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0px 4px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        .card:hover {
            transform: scale(1.01);
            box-shadow: 0px 6px 20px rgba(0,0,0,0.15);
        }
        .btn-custom {
            border-radius: 30px;
            padding: 10px 20px;
            font-weight: 500;
        }
        table.table-hover tbody tr:hover {
            background-color: rgba(13, 110, 253, 0.1);
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('clientes.index') }}">📊 Panel de Gestión</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('clientes*') ? 'active' : '' }}" href="{{ route('clientes.index') }}">👥 Clientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('usuarios*') ? 'active' : '' }}" href="{{ route('usuarios.index') }}">🧑‍💻 Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('creditos*') ? 'active' : '' }}" href="{{ route('creditos.index') }}">💳 Créditos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('pagos*') ? 'active' : '' }}" href="{{ route('pagos.index') }}">💰 Pagos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('solicitudes*') ? 'active' : '' }}" href="{{ route('solicitudes.index') }}">📄 Solicitudes</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenedor Principal -->
    <div class="container my-4">
        @if(session('success'))
            <div class="alert alert-success shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="text-center text-muted py-3 mt-4">
        <small>© {{ date('Y') }} Gestión de Créditos de una Cooperativa Financiera | Desarrollado con ❤️ en Laravel</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
