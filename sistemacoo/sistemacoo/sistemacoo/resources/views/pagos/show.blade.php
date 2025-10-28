<x-app-layout>

@section('title', 'Detalle de Pago')

@section('content')
<h2>Detalle del Pago</h2>

<div class="card p-4 shadow-sm">
    <p><strong>ID:</strong> {{ $pago->id }}</p>
    <p><strong>Crédito ID:</strong> {{ $pago->credito->id ?? '-' }}</p>
    <p><strong>Fecha de Pago:</strong> {{ $pago->fecha_pago }}</p>
    <p><strong>Monto Pagado:</strong> {{ $pago->monto_pagado }}</p>
    <p><strong>Saldo Restante:</strong> {{ $pago->saldo_restante }}</p>
    <p><strong>Cajero Responsable:</strong> {{ $pago->cajero_responsable }}</p>
    <p><strong>Número de Comprobante:</strong> {{ $pago->numero_comprobante }}</p>
</div>

<a href="{{ route('pagos.index') }}" class="btn btn-secondary mt-3 btn-custom">↩ Volver</a>
</x-app-layout>
