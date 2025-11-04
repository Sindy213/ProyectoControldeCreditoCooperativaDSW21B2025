<x-app-layout>

@section('content')
<div class="d-flex flex-column align-items-center my-5">
    <h2 class="fw-bold text-gradient display-1">Detalles del Crédito</h2>
</div>

<div class="d-flex justify-content-center">
    <div class="bg-white shadow-lg rounded-4 p-5 w-100" style="max-width: 800px;">
        <div class="row mb-4">
            <div class="col-md-6 mb-3">
                <label class="fw-semibold text-secondary">👤 Cliente</label>
                <div class="border rounded p-2">{{ $credito->cliente->nombre_completo ?? '—' }}</div>
            </div>
            <div class="col-md-6 mb-3">
                <label class="fw-semibold text-secondary">💳 Tipo de Crédito</label>
                <div class="border rounded p-2">{{ $credito->tipo_credito }}</div>
            </div>
            <div class="col-md-6 mb-3">
                <label class="fw-semibold text-secondary">💰 Monto Solicitado</label>
                <div class="border rounded p-2">${{ number_format($credito->monto_solicitado, 2) }}</div>
            </div>
            <div class="col-md-6 mb-3">
                <label class="fw-semibold text-secondary">📈 Tasa de Interés</label>
                <div class="border rounded p-2">{{ $credito->tasa_interes * 100 }}%</div>
            </div>
            <div class="col-md-6 mb-3">
                <label class="fw-semibold text-secondary">📅 Plazo</label>
                <div class="border rounded p-2">{{ $credito->plazo_meses }} meses</div>
            </div>
            <div class="col-md-6 mb-3">
                <label class="fw-semibold text-secondary">🗓️ Fecha de Aprobación</label>
                <div class="border rounded p-2">{{ \Carbon\Carbon::parse($credito->fecha_aprobacion)->format('d/m/Y') }}</div>
            </div>
            <div class="col-md-6 mb-3">
                <label class="fw-semibold text-secondary">📊 Estado</label>
                <div class="border rounded p-2">
                    <span class="badge 
                        @if($credito->estado == 'Aprobado') bg-success 
                        @elseif($credito->estado == 'Pendiente') bg-warning text-dark
                        @else bg-danger @endif">
                        {{ $credito->estado }}
                    </span>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-3 mt-4">
            <a href="{{ route('creditos.edit', $credito->id) }}" class="btn btn-warning text-white">
                ✏️ Editar
            </a>
            <a href="{{ route('creditos.index') }}" class="btn btn-secondary">
                ↩ Volver
            </a>
        </div>
    </div>
</div>

<style>
.text-gradient {
    background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
    background-clip: text;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
</style>

</x-app-layout>
