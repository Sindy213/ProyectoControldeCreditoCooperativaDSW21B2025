<x-app-layout>

@section('content')
<div class="container py-6">
    <div class="text-center my-5">
        <h1 class="fw-bold text-gradient display-3">✏️ Editar Pago #{{ $pago->id }}</h1>
    </div>

    <div class="card shadow-lg rounded-4 p-4">
        <form action="{{ route('pagos.update', $pago->id) }}" method="POST" class="row g-4">
            @csrf
            @method('PUT')

            <div class="col-md-6">
                <label class="form-label fw-semibold">Crédito</label>
                <select name="id_credito" id="credito" class="form-select input-glass" required>
                    @foreach($creditos as $credito)
                        <option value="{{ $credito->id }}"
                            data-cliente="{{ $credito->cliente->nombre_completo }}"
                            data-tipo="{{ $credito->tipo_credito }}"
                            data-monto="{{ $credito->monto_solicitado }}"
                            {{ $pago->id_credito == $credito->id ? 'selected' : '' }}>
                            ID {{ $credito->id }} - {{ $credito->cliente->nombre_completo }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Cliente</label>
                <input type="text" id="cliente" class="form-control input-glass" value="{{ $pago->credito->cliente->nombre_completo ?? '' }}" readonly>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Tipo de Crédito</label>
                <input type="text" id="tipo_credito" class="form-control input-glass" value="{{ $pago->credito->tipo_credito ?? '' }}" readonly>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Fecha de Pago</label>
                <input type="date" name="fecha_pago" class="form-control input-glass" value="{{ $pago->fecha_pago }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Monto Pagado</label>
                <input type="number" step="0.01" name="monto_pagado" id="monto_pagado" class="form-control input-glass" value="{{ $pago->monto_pagado }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Saldo Restante</label>
                <input type="number" step="0.01" name="saldo_restante" id="saldo_restante" class="form-control input-glass" value="{{ $pago->saldo_restante }}" readonly>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Cajero Responsable</label>
                <input type="text" name="cajero_responsable" class="form-control input-glass" value="{{ $pago->cajero_responsable }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Número de Comprobante</label>
                <input type="text" name="numero_comprobante" class="form-control input-glass" value="{{ $pago->numero_comprobante }}" required>
            </div>

            <div class="col-12 text-end">
                <button type="submit" class="btn btn-gradient-lg text-white">💾 Actualizar Pago</button>
            </div>
        </form>
    </div>
</div>

<script>
const creditoSelect = document.getElementById('credito');
const clienteInput = document.getElementById('cliente');
const tipoInput = document.getElementById('tipo_credito');
const montoInput = document.getElementById('monto_pagado');
const saldoInput = document.getElementById('saldo_restante');

creditoSelect.addEventListener('change', function() {
    const selected = this.selectedOptions[0];
    clienteInput.value = selected.getAttribute('data-cliente');
    tipoInput.value = selected.getAttribute('data-tipo');
    saldoInput.value = selected.getAttribute('data-monto');
    montoInput.value = '';
});

montoInput.addEventListener('input', function() {
    const credito = creditoSelect.selectedOptions[0];
    const montoTotal = parseFloat(credito.getAttribute('data-monto')) || 0;
    const montoPagado = parseFloat(this.value) || 0;
    saldoInput.value = (montoTotal - montoPagado).toFixed(2);
});
</script>

</x-app-layout>
