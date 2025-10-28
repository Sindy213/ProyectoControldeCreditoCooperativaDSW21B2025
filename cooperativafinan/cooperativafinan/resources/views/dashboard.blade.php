@extends('layouts.app')

@section('title', 'Dashboard Ultra')

@section('content')

{{-- Resumen general --}}
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
    @can('clientes.view')
    <div class="bg-blue-500 text-white p-6 rounded-lg shadow-lg hover:scale-105 transition flex items-center justify-between">
        <div>
            <p class="font-bold text-lg">Clientes</p>
            <p class="text-3xl font-extrabold">{{ $totalClientes }}</p>
        </div>
        <div class="text-5xl">👥</div>
    </div>
    @endcan

    @can('creditos.view')
    <div class="bg-green-500 text-white p-6 rounded-lg shadow-lg hover:scale-105 transition flex items-center justify-between">
        <div>
            <p class="font-bold text-lg">Créditos Activos</p>
            <p class="text-3xl font-extrabold">{{ $creditosActivos }}</p>
        </div>
        <div class="text-5xl">💳</div>
    </div>
    @endcan

    @can('pagos.view')
    <div class="bg-yellow-500 text-white p-6 rounded-lg shadow-lg hover:scale-105 transition flex items-center justify-between">
        <div>
            <p class="font-bold text-lg">Pagos Recibidos</p>
            <p class="text-3xl font-extrabold">${{ number_format($pagosRecibidos,2) }}</p>
        </div>
        <div class="text-5xl">💰</div>
    </div>
    @endcan

    @can('solicitudes.review')
    <div class="bg-red-500 text-white p-6 rounded-lg shadow-lg hover:scale-105 transition flex items-center justify-between">
        <div>
            <p class="font-bold text-lg">Solicitudes Pendientes</p>
            <p class="text-3xl font-extrabold">{{ $solicitudesPendientes }}</p>
        </div>
        <div class="text-5xl">📝</div>
    </div>
    @endcan
</div>

{{-- Gráficas y timeline --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    {{-- Créditos por tipo --}}
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-gray-700 font-bold mb-4">Créditos por Tipo</h2>
        <canvas id="tipoCreditoChart"></canvas>
    </div>

    {{-- Pagos por mes --}}
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-gray-700 font-bold mb-4">Pagos por Mes</h2>
        <canvas id="pagosMesChart"></canvas>
    </div>

    {{-- Timeline últimas acciones --}}
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-gray-700 font-bold mb-4">Últimas Acciones</h2>
        <ul class="space-y-3">
            @foreach($ultimosCreditos as $credito)
            <li class="flex items-center justify-between bg-gray-100 p-3 rounded hover:bg-gray-200 transition">
                <span>Crédito #{{ $credito->id }} - {{ $credito->cliente->nombre }}</span>
                <span class="text-sm text-gray-500">{{ $credito->created_at->format('d/m/Y') }}</span>
            </li>
            @endforeach
        </ul>
    </div>
</div>

{{-- Charts --}}
<script>
    const tipoCreditoCtx = document.getElementById('tipoCreditoChart')?.getContext('2d');
    if(tipoCreditoCtx){
        new Chart(tipoCreditoCtx, {
            type: 'doughnut',
            data: {
                labels: @json($tiposCreditoLabels),
                datasets: [{
                    data: @json($tiposCreditoValues),
                    backgroundColor: ['#3B82F6','#10B981','#F59E0B','#EF4444','#8B5CF6','#F472B6']
                }]
            },
            options: { responsive: true }
        });
    }

    const pagosMesCtx = document.getElementById('pagosMesChart')?.getContext('2d');
    if(pagosMesCtx){
        new Chart(pagosMesCtx, {
            type: 'bar',
            data: {
                labels: @json($meses),
                datasets: [{
                    label: 'Pagos Recibidos',
                    data: @json($pagosPorMes),
                    backgroundColor: '#3B82F6'
                }]
            },
            options: {
                responsive: true,
                scales: { y: { beginAtZero: true } }
            }
        });
    }
</script>

@endsection
