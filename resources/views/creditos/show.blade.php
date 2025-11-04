@extends('layouts.app')

@section('content')
<h2>Detalles del Crédito</h2>

<div class="card shadow-sm">
    <div class="card-body">
        <p><strong>ID:</strong> {{ $credito->id }}</p>
        <p><strong>Cliente:</strong> {{ $credito->cliente->nombre_completo ?? 'N/A' }}</p>
        <p><strong>Monto Solicitado:</strong> ${{ number_format($credito->monto_solicitado, 2) }}</p>
        <p><strong>Tasa de Interés:</strong> {{ $credito->tasa_interes }}%</p>
        <p><strong>Plazo:</strong> {{ $credito->plazo_meses }} meses</p>
        <p><strong>Fecha de Aprobación:</strong> {{ $credito->fecha_aprobacion }}</p>
        <p><strong>Estado:</strong> {{ $credito->estado }}</p>
    </div>
</div>

<a href="{{ route('creditos.index') }}" class="btn btn-secondary mt-3">↩ Volver</a>
@endsection
