<x-app-layout>

@section('content')
<div class="container py-6">

    <div class="text-center my-5">
        <h1 class="fw-bold text-gradient display-3">
            💵 Registrar Nuevo Pago
        </h1>
        <p class="fs-5 text-muted mt-3">
            Selecciona un crédito y completa los datos para registrar el pago.
        </p>
    </div>

    <div class="card shadow-lg rounded-4 p-4">
        <form action="{{ route('pagos.store') }}" method="POST" class="row g-4">
            @csrf

            {{-- Selección de crédito --}}
            <div class="col-md-6">
                <label class="form-label fw-semibold">Crédito</label>
                <select name="id_credito" id="credito" class="form-select input-glass" required>
                    <option value="" selected disabled>Seleccione un crédito...</option>
                    @foreach($creditos as $credito)
                        <option value="{{ $credito->id }}"
                            data-cliente="{{ $credito->cliente->nombre_completo }}"
                            data-tipo="{{ $credito->tipo_credito }}"
                            data-monto="{{ $credito->monto_solicitado }}"
                            data-saldo="{{ $credito->monto_solicitado }}">
                            ID {{ $credito->id }} - {{ $credito->cliente->nombre_completo }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Cliente --}}
            <div class="col-md-6">
                <label class="form-label fw-semibold">Cliente</label>
                <input type="text" id="cliente" class="form-control input-glass" readonly>
            </div>

            {{-- Tipo de Crédito --}}
            <div class="col-md-6">
                <label class="form-label fw-semibold">Tipo de Crédito</label>
                <input type="text" id="tipo_credito" class="form-control input-glass" readonly>
            </div>

            {{-- Fecha de Pago --}}
            <div class="col-md-6">
                <label class="form-label fw-semibold">Fecha de Pago</label>
                <input type="date" name="fecha_pago" class="form-control input-glass" required>
            </div>

            {{-- Monto Pagado --}}
            <div class="col-md-6">
                <label class="form-label fw-semibold">Monto Pagado</label>
                <input type="number" step="0.01" name="monto_pagado" id="monto_pagado" class="form-control input-glass" required>
            </div>

            {{-- Saldo Restante --}}
            <div class="col-md-6">
                <label class="form-label fw-semibold">Saldo Restante</label>
                <input type="number" step="0.01" name="saldo_restante" id="saldo_restante" class="form-control input-glass" readonly>
            </div>

            {{-- Cajero Responsable --}}
            <div class="col-md-6">
                <label class="form-label fw-semibold">Cajero Responsable</label>
                <input type="text" name="cajero_responsable" class="form-control input-glass" required>
            </div>

            {{-- Número de Comprobante --}}
            <div class="col-md-6">
                <label class="form-label fw-semibold">Número de Comprobante</label>
                <input type="text" name="numero_comprobante" class="form-control input-glass" required>
            </div>

            {{-- Botón --}}
            <div class="col-12 text-end">
                <button type="submit" class="btn btn-gradient-lg text-white">
                    💾 Registrar Pago
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ====== ESTILOS ====== --}}
<style>
.input-glass {
    border-radius: 12px;
    padding: 0.65rem 1rem;
    font-size: 1rem;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    border: 1px solid #ccc;
    background-color: #f9f9ff;
}
.btn-gradient-lg {
    background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
    border: none;
    font-size: 1.1rem;
    padding: 0.7rem 1.5rem;
    border-radius: 12px;
    transition: transform 0.2s, box-shadow 0.3s;
}
.btn-gradient-lg:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.3);
}
.text-gradient {
    background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
</style>

{{-- ====== SCRIPT PARA AUTOCOMPLETAR CAMPOS ====== --}}
<script>
const creditoSelect = document.getElementById('credito');
const clienteInput = document.getElementById('cliente');
const tipoInput = document.getElementById('tipo_credito');
const montoInput = document.getElementById('monto_pagado');
const saldoInput = document.getElementById('saldo_restante');

creditoSelect.addEventListener('change', function() {
    const selected = this.selectedOptions[0];
    const cliente = selected.getAttribute('data-cliente');
    const tipo = selected.getAttribute('data-tipo');
    const monto = parseFloat(selected.getAttribute('data-monto')) || 0;
    const saldo = parseFloat(selected.getAttribute('data-saldo')) || 0;

    clienteInput.value = cliente;
    tipoInput.value = tipo;
    saldoInput.value = saldo;
    montoInput.value = '';
});

// Calcular saldo restante al escribir el monto pagado
montoInput.addEventListener('input', function() {
    const credito = creditoSelect.selectedOptions[0];
    if(!credito) return;

    const montoTotal = parseFloat(credito.getAttribute('data-monto')) || 0;
    const montoPagado = parseFloat(this.value) || 0;
    const saldo = montoTotal - montoPagado;

    saldoInput.value = saldo.toFixed(2);
});
</script>

</x-app-layout>
