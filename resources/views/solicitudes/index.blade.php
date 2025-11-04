@extends('layouts.app')

@section('title', 'Listado de Solicitudes')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Listado de Solicitudes</h2>
    <a href="{{ route('solicitudes.create') }}" class="btn btn-primary btn-custom">➕ Nueva Solicitud</a>
</div>

<table class="table table-striped table-bordered shadow-sm table-hover">
    <thead class="table-dark">
        <tr>
            
            <th>Cliente</th>
            <th>Fecha de Solicitud</th>
            <th>Monto Solicitado</th>
            <th>Estado</th>
            <th>Observaciones</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse($solicitudes as $solicitud)
        <tr>
           
            <td>{{ $solicitud->cliente->nombre_completo ?? '-' }}</td>
            <td>{{ $solicitud->fecha_solicitud }}</td>
            <td>{{ number_format($solicitud->monto_solicitado, 2) }}</td>
            <td>{{ $solicitud->estado }}</td>
            <td>{{ $solicitud->observaciones }}</td>
            <td>
                <a href="{{ route('solicitudes.show', $solicitud->id) }}" class="btn btn-info btn-sm">👁 Ver</a>
                <a href="{{ route('solicitudes.edit', $solicitud->id) }}" class="btn btn-warning btn-sm">✏ Editar</a>
                <form action="{{ route('solicitudes.destroy', $solicitud->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar esta solicitud?')">🗑 Eliminar</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="text-center">No hay solicitudes registradas.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
