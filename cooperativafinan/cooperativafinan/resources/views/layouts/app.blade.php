<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cooperativa SF - Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex min-h-screen bg-gray-100 font-sans">

    {{-- Sidebar --}}
    <aside class="bg-gray-900 text-white w-64 flex flex-col min-h-screen fixed md:relative z-50">
        <div class="p-4 text-center font-bold text-xl border-b border-gray-700">🏦 Cooperativa SF</div>
        <nav class="flex-1 px-2 py-4 space-y-1 overflow-y-auto">
            @can('dashboard.view')
            <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-700 transition">📊 Dashboard</a>
            @endcan
            @can('clientes.view')
            <a href="{{ route('clientes.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700 transition">👥 Clientes</a>
            @endcan
            @can('creditos.view')
            <a href="{{ route('creditos.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700 transition">💳 Créditos</a>
            @endcan
            @can('pagos.view')
            <a href="{{ route('pagos.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700 transition">💰 Pagos</a>
            @endcan
            @can('solicitudes.review')
            <a href="{{ route('solicitudes.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700 transition">📝 Solicitudes</a>
            @endcan
            @can('citas.manage')
            <a href="{{ route('citas.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700 transition">📅 Citas</a>
            @endcan
            @can('reports.view')
            <a href="{{ route('reportes.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700 transition">📄 Reportes</a>
            @endcan
            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 mt-4 rounded hover:bg-gray-700 transition">⚙️ Perfil</a>
            <form method="POST" action="{{ route('logout') }}" class="px-4 py-2">
                @csrf
                <button type="submit" class="w-full text-left hover:bg-gray-700 rounded px-2 py-1">🔓 Cerrar sesión</button>
            </form>
        </nav>
    </aside>

    {{-- Contenido principal --}}
    <div class="flex-1 flex flex-col md:ml-64">
        {{-- Topbar --}}
        <header class="bg-white shadow p-4 flex justify-between items-center sticky top-0 z-40">
            <h1 class="text-2xl font-bold text-gray-800">@yield('title', 'Dashboard')</h1>
            <div class="text-gray-700">Bienvenido, {{ auth()->user()->name }}</div>
        </header>

        {{-- Contenido --}}
        <main class="p-6 flex-1 overflow-auto">
            @yield('content')
        </main>
    </div>

    {{-- Toast Notificaciones --}}
    <script>
        @if(!empty($notificaciones))
            @foreach($notificaciones as $n)
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: '{{ $n['icon'] }}',
                    title: '{{ $n['title'] }}',
                    text: '{{ $n['text'] }}',
                    showConfirmButton: false,
                    timer: 5000,
                    timerProgressBar: true
                });
            @endforeach
        @endif
    </script>

</body>
</html>
