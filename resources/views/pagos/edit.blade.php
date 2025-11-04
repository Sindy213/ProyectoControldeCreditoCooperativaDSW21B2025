@extends('layouts.app')

@section('title', 'Editar Pago')

@section('content')
<h2>Editar Pago</h2>

<form action="{{ route('pagos.update', $pago->id) }}" method="POST" class="row g-3">
    @csrf
    @method('PUT')

    <div class="col-md-6">
        <label class="form-label">Crédito</label>
        <select name="id_credito" class="form-select" required>
            @foreach($creditos as $credito)
                <option value="{{ $credito->id }}" 
                    {{ $pago->id_credito == $credito->id ? 'selected' : '' }}>
                    ID {{ $credito->id }} - Cliente {{ $credito->cliente->nombre_completo ?? 'Desconocido' }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label">Fecha de Pago</label>
        <input type="date" name="fecha_pago" class="form-control" value="{{ $pago->fecha_pago }}" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Monto Pagado</label>
        <input type="number" step="0.01" name="monto_pagado" class="form-control" value="{{ $pago->monto_pagado }}" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Saldo Restante</label>
        <input type="number" step="0.01" name="saldo_restante" class="form-control" value="{{ $pago->saldo_restante }}" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Cajero Responsable</label>
        <input type="text" name="cajero_responsable" class="form-control" value="{{ $pago->cajero_responsable }}" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Número de Comprobante</label>
        <input type="text" name="numero_comprobante" class="form-control" value="{{ $pago->numero_comprobante }}" required>
    </div>

    <div class="col-12">
        <button type="submit" class="btn btn-warning btn-custom">✏ Actualizar</button>
        <a href="{{ route('pagos.index') }}" class="btn btn-secondary btn-custom">↩ Volver</a>
    </div>
</form>
@endsection
