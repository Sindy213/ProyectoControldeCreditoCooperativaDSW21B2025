@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Listado de Créditos</h2>
    <a href="{{ route('creditos.create') }}" class="btn btn-primary">➕ Nuevo Crédito</a>
</div>

<table class="table table-striped table-hover">
    <thead class="table-dark">
        <tr>
            
            <th>Cliente</th>
            <th>Monto Solicitado</th>
            <th>Tasa de Interés (%)</th>
            <th>Plazo (meses)</th>
            <th>Fecha Aprobación</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse($creditos as $credito)
        <tr>
           
            <td>{{ $credito->cliente->nombre_completo ?? 'N/A' }}</td>
            <td>${{ number_format($credito->monto_solicitado, 2) }}</td>
            <td>{{ $credito->tasa_interes }}%</td>
            <td>{{ $credito->plazo_meses }}</td>
            <td>{{ $credito->fecha_aprobacion }}</td>
            <td>{{ $credito->estado }}</td>
            <td>
                <a href="{{ route('creditos.show', $credito->id) }}" class="btn btn-info btn-sm">👁 Ver</a>
                <a href="{{ route('creditos.edit', $credito->id) }}" class="btn btn-warning btn-sm">✏ Editar</a>
                <form action="{{ route('creditos.destroy', $credito->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este crédito?')">🗑 Eliminar</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="8" class="text-center">No hay créditos registrados.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
