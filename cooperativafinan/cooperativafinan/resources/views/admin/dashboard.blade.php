@extends('layouts.admin')

@section('title', 'Dashboard')
@section('header', 'Panel Administrativo')

@section('content')
    <!-- Cards métricas -->
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <div class="bg-blue-600 text-white rounded-lg shadow p-4">
            <h3 class="text-lg font-bold">Usuarios</h3>
            <p class="text-2xl">{{ $totalUsuarios }}</p>
        </div>
        <div class="bg-green-600 text-white rounded-lg shadow p-4">
            <h3 class="text-lg font-bold">Roles</h3>
            <p class="text-2xl">{{ $totalRoles }}</p>
        </div>
        <div class="bg-purple-600 text-white rounded-lg shadow p-4">
            <h3 class="text-lg font-bold">Permisos</h3>
            <p class="text-2xl">{{ $totalPermisos }}</p>
        </div>
        <div class="bg-yellow-500 text-white rounded-lg shadow p-4">
            <h3 class="text-lg font-bold">Clientes</h3>
            <p class="text-2xl">{{ $totalClientes }}</p>
        </div>
    </div>

    <!-- Segunda fila -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-6">
        <div class="bg-red-600 text-white rounded-lg shadow p-4">
            <h3 class="text-lg font-bold">Créditos Activos</h3>
            <p class="text-2xl">{{ $creditosActivos }}</p>
        </div>
        <div class="bg-indigo-600 text-white rounded-lg shadow p-4">
            <h3 class="text-lg font-bold">Pagos Hoy</h3>
            <p class="text-2xl">${{ number_format($pagosHoy,2) }}</p>
        </div>
        <div class="bg-pink-600 text-white rounded-lg shadow p-4">
            <h3 class="text-lg font-bold">Solicitudes Pendientes</h3>
            <p class="text-2xl">{{ $solicitudesPendientes }}</p>
        </div>
        <div class="bg-teal-600 text-white rounded-lg shadow p-4">
            <h3 class="text-lg font-bold">Citas Hoy</h3>
            <p class="text-2xl">{{ $citasHoy }}</p>
        </div>
    </div>

    <!-- Gráfico de Créditos por Tipo -->
    <div class="mt-6 bg-white rounded-lg shadow p-6">
        <h3 class="text-xl font-bold mb-4">Créditos por Tipo</h3>
        <canvas id="creditosChart" height="100"></canvas>
    </div>

    <script>
        const ctx = document.getElementById('creditosChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($tiposCredito->keys()) !!},
                datasets: [{
                    label: 'Cantidad de Créditos',
                    data: {!! json_encode($tiposCredito->values()) !!},
                    backgroundColor: 'rgba(59, 130, 246, 0.7)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 1
                }]
            },
            options: { scales: { y: { beginAtZero: true } } }
        });
    </script>
@endsection
