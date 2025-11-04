<x-app-layout>

@section('title', 'Registrar Pago')

@section('content')
<h2>Registrar Pago</h2>

<form action="{{ route('pagos.store') }}" method="POST" class="row g-3">
    @csrf

    <div class="col-md-6">
        <label class="form-label">Crédito</label>
        <select name="id_credito" class="form-select" required>
            <option value="" disabled selected>Seleccione...</option>
            @foreach($creditos as $credito)
                <option value="{{ $credito->id }}">
                    ID {{ $credito->id }} - Cliente {{ $credito->cliente->nombre_completo ?? 'Desconocido' }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label">Fecha de Pago</label>
        <input type="date" name="fecha_pago" class="form-control" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Monto Pagado</label>
        <input type="number" step="0.01" name="monto_pagado" class="form-control" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Saldo Restante</label>
        <input type="number" step="0.01" name="saldo_restante" class="form-control" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Cajero Responsable</label>
        <input type="text" name="cajero_responsable" class="form-control" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Número de Comprobante</label>
        <input type="text" name="numero_comprobante" class="form-control" required>
    </div>

    <div class="col-12">
        <button type="submit" class="btn btn-success btn-custom">💾 Guardar</button>
        <a href="{{ route('pagos.index') }}" class="btn btn-secondary btn-custom">↩ Volver</a>
    </div>
</form>
</x-app-layout>
