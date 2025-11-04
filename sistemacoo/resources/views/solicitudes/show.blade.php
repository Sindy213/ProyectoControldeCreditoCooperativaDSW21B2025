@<x-app-layout>

@section('title', 'Detalle de Solicitud')

@section('content')
<h2>Detalle de Solicitud</h2>

<div class="card shadow-sm p-3">
    <ul class="list-group list-group-flush">
        <li class="list-group-item"><strong>ID:</strong> {{ $solicitud->id }}</li>
        <li class="list-group-item"><strong>Cliente:</strong> {{ $solicitud->cliente->nombre_completo ?? '-' }}</li>
        <li class="list-group-item"><strong>Fecha de Solicitud:</strong> {{ $solicitud->fecha_solicitud }}</li>
        <li class="list-group-item"><strong>Monto Solicitado:</strong> {{ number_format($solicitud->monto_solicitado, 2) }}</li>
        <li class="list-group-item"><strong>Estado:</strong> {{ $solicitud->estado }}</li>
        <li class="list-group-item"><strong>Observaciones:</strong> {{ $solicitud->observaciones }}</li>
    </ul>
    <a href="{{ route('solicitudes.index') }}" class="btn btn-secondary btn-custom mt-3">↩ Volver</a>
</div>
</x-app-layout>
