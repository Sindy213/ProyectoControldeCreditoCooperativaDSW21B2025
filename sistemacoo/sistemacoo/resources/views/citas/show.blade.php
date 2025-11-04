<x-app-layout>
@section('title', 'Detalle de Cita')

@section('content')
<h2>Detalle de Cita #{{ $cita->id }}</h2>

<ul class="list-group mb-3">
    <li class="list-group-item"><strong>Cliente:</strong> {{ $cita->cliente->nombre_completo ?? 'Desconocido' }}</li>
    <li class="list-group-item"><strong>Fecha:</strong> {{ $cita->fecha_cita }}</li>
    <li class="list-group-item"><strong>Hora:</strong> {{ $cita->hora }}</li>
    <li class="list-group-item"><strong>Asesor Asignado:</strong> {{ $cita->asesor_asignado }}</li>
    <li class="list-group-item"><strong>Motivo:</strong> {{ $cita->motivo }}</li>
    <li class="list-group-item"><strong>Estado:</strong> {{ ucfirst($cita->estado) }}</li>
</ul>

<a href="{{ route('citas.index') }}" class="btn btn-secondary">↩ Volver</a>
</x-app-layout>
