<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administrativo | @yield('title')</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 flex h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-white flex-shrink-0">
        <div class="p-6 text-center font-bold text-xl border-b border-gray-700">
            Cooperativa
        </div>
        <nav class="mt-6">
            <a href="{{ route('admin.dashboard') }}" class="block px-6 py-2 hover:bg-gray-700 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700' : '' }}">Dashboard</a>

            @can('users.manage')
                <a href="{{ route('users.index') }}" class="block px-6 py-2 hover:bg-gray-700 {{ request()->routeIs('users.*') ? 'bg-gray-700' : '' }}">Usuarios</a>
            @endcan

            @can('roles.manage')
                <a href="{{ route('roles.index') }}" class="block px-6 py-2 hover:bg-gray-700 {{ request()->routeIs('roles.*') ? 'bg-gray-700' : '' }}">Roles</a>
            @endcan

            @can('permissions.manage')
                <a href="{{ route('permissions.index') }}" class="block px-6 py-2 hover:bg-gray-700 {{ request()->routeIs('permissions.*') ? 'bg-gray-700' : '' }}">Permisos</a>
            @endcan

            @can('clientes.view')
                <a href="{{ route('clientes.index') }}" class="block px-6 py-2 hover:bg-gray-700 {{ request()->routeIs('clientes.*') ? 'bg-gray-700' : '' }}">Clientes</a>
            @endcan

            @can('creditos.view')
                <a href="{{ route('creditos.index') }}" class="block px-6 py-2 hover:bg-gray-700 {{ request()->routeIs('creditos.*') ? 'bg-gray-700' : '' }}">Créditos</a>
            @endcan

            @can('pagos.view')
                <a href="{{ route('pagos.index') }}" class="block px-6 py-2 hover:bg-gray-700 {{ request()->routeIs('pagos.*') ? 'bg-gray-700' : '' }}">Pagos</a>
            @endcan

            @can('solicitudes.review')
                <a href="{{ route('solicitudes.index') }}" class="block px-6 py-2 hover:bg-gray-700 {{ request()->routeIs('solicitudes.*') ? 'bg-gray-700' : '' }}">Solicitudes</a>
            @endcan

            @can('citas.manage')
                <a href="{{ route('citas.index') }}" class="block px-6 py-2 hover:bg-gray-700 {{ request()->routeIs('citas.*') ? 'bg-gray-700' : '' }}">Citas</a>
            @endcan
        </nav>
    </aside>

    <!-- Main content -->
    <div class="flex-1 flex flex-col">
        <!-- Header -->
        <header class="bg-white shadow p-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold">@yield('header')</h1>
            <div>
                <span class="mr-4">{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded">Salir</button>
                </form>
            </div>
        </header>

        <!-- Content -->
        <main class="p-6 flex-1 overflow-auto bg-gray-100">
            @yield('content')
        </main>
    </div>

</body>
</html>
