<x-app-layout>

@section('content')
<div class="container py-6">

    <div class="text-center mb-5">
        <h1 class="fw-bold text-gradient display-3">👁️ Pago #{{ $pago->id }}</h1>
    </div>

    <div class="card shadow-lg rounded-4 p-4">
        <div class="row g-4">
            <div class="col-md-6">
                <strong>Cliente:</strong> {{ $pago->credito->cliente->nombre_completo ?? '—' }}
            </div>
            <div class="col-md-6">
                <strong>Tipo de Crédito:</strong> {{ $pago->credito->tipo_credito ?? '—' }}
            </div>
            <div class="col-md-6">
                <strong>Monto Pagado:</strong> ${{ number_format($pago->monto_pagado, 2) }}
            </div>
            <div class="col-md-6">
                <strong>Saldo Restante:</strong> ${{ number_format($pago->saldo_restante, 2) }}
            </div>
            <div class="col-md-6">
                <strong>Fecha de Pago:</strong> {{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') }}
            </div>
            <div class="col-md-6">
                <strong>Cajero:</strong> {{ $pago->cajero_responsable }}
            </div>
            <div class="col-md-6">
                <strong>Comprobante:</strong> {{ $pago->numero_comprobante }}
            </div>
            <div class="col-12 text-end mt-4">
                <a href="{{ route('pagos.index') }}" class="btn btn-secondary">↩ Volver</a>
            </div>
        </div>
    </div>
</div>

</x-app-layout>
