@extends('layouts.app')

@section('title', 'Listado de Pagos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Listado de Pagos</h2>
    <a href="{{ route('pagos.create') }}" class="btn btn-primary btn-custom">➕ Nuevo Pago</a>
</div>

<table class="table table-striped table-bordered shadow-sm table-hover">
    <thead class="table-dark">
        <tr>
            
            <th>Cliente</th>
            <th>Fecha de Pago</th>
            <th>Monto Pagado</th>
            <th>Saldo Restante</th>
            <th>Cajero Responsable</th>
            <th>Número Comprobante</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse($pagos as $pago)
        <tr>
           
            <td>{{ $pago->credito->cliente->nombre_completo ?? '-' }}</td>
            <td>{{ $pago->fecha_pago }}</td>
            <td>{{ number_format($pago->monto_pagado, 2) }}</td>
            <td>{{ number_format($pago->saldo_restante, 2) }}</td>
            <td>{{ $pago->cajero_responsable }}</td>
            <td>{{ $pago->numero_comprobante }}</td>
            <td>
                <a href="{{ route('pagos.show', $pago->id) }}" class="btn btn-info btn-sm">👁 Ver</a>
                <a href="{{ route('pagos.edit', $pago->id) }}" class="btn btn-warning btn-sm">✏ Editar</a>
                <form action="{{ route('pagos.destroy', $pago->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este pago?')">🗑 Eliminar</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="9" class="text-center">No hay pagos registrados.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
