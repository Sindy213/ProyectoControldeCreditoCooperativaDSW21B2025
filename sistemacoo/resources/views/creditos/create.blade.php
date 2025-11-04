<x-app-layout>
@section('content')
<div class="d-flex flex-column align-items-center my-5">
    <h2 class="fw-bold text-gradient display-1">Registrar Crédito</h2>
</div>

<div class="d-flex justify-content-center">
    <div class="bg-white shadow-lg rounded-4 p-5 w-100" style="max-width: 900px;">

        {{-- Mensajes de validación --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>⚠️ Ocurrieron algunos errores:</strong>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Mensaje de éxito --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Formulario --}}
        <form action="{{ route('creditos.store') }}" method="POST" class="d-grid gap-4">
            @csrf

            {{-- Cliente --}}
            <div class="form-group">
                <label class="form-label fw-semibold">👤 Cliente</label>
                <select name="id_cliente" class="form-select input-glass" required>
                    <option value="" disabled selected>Seleccione un cliente...</option>
                    @foreach ($clientes as $cliente)
                        <option value="{{ $cliente->id }}">{{ $cliente->nombre_completo }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Tipo de Crédito --}}
            <div class="form-group">
                <label class="form-label fw-semibold">💳 Tipo de Crédito</label>
                <select name="tipo_credito" class="form-select input-glass" required>
                    <option value="" disabled selected>Seleccione tipo...</option>
                    <option value="Personal">Personal</option>
                    <option value="Hipotecario">Hipotecario</option>
                    <option value="Educativo">Educativo</option>
                    <option value="Automotriz">Automotriz</option>
                    <option value="Comercial">Comercial</option>
                </select>
            </div>

            {{-- Monto solicitado --}}
            <div class="form-group">
                <label class="form-label fw-semibold">💰 Monto Solicitado ($)</label>
                <input type="number" step="0.01" min="0" id="monto" name="monto_solicitado" class="form-control input-glass" required>
            </div>

            {{-- Tasa de interés --}}
            <div class="form-group">
                <label class="form-label fw-semibold">📈 Tasa de Interés (%)</label>
                <div class="input-group">
                    <input type="number" id="tasa_interes" name="tasa_interes" class="form-control input-glass" step="0.01" readonly required>
                    <span class="input-group-text">%</span>
                </div>
            </div>

            {{-- Plazo en meses --}}
            <div class="form-group">
                <label class="form-label fw-semibold">📅 Plazo (meses)</label>
                <input type="number" name="plazo_meses" min="1" class="form-control input-glass" required>
            </div>

            {{-- Fecha de aprobación --}}
            <div class="form-group">
                <label class="form-label fw-semibold">🗓️ Fecha de Aprobación</label>
                <input type="date" name="fecha_aprobacion" class="form-control input-glass" required>
            </div>

            {{-- Estado --}}
            <div class="form-group">
                <label class="form-label fw-semibold">📊 Estado</label>
                <select name="estado" class="form-select input-glass" required>
                    <option value="" disabled selected>Seleccione...</option>
                    <option value="Pendiente">Pendiente</option>
                    <option value="Aprobado">Aprobado</option>
                    <option value="Rechazado">Rechazado</option>
                </select>
            </div>

            {{-- Botones --}}
            <div class="d-flex justify-content-end gap-3 mt-4">
                <button type="submit" class="btn btn-gradient-lg shadow-lg text-white">
                    💾 Guardar Crédito
                </button>
                <a href="{{ route('creditos.index') }}" class="btn btn-secondary btn-lg shadow-sm">
                    ↩ Volver
                </a>
            </div>
        </form>
    </div>
</div>

{{-- ====== ESTILOS ====== --}}
<style>
.text-gradient {
    background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
    background-clip: text;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
.input-glass {
    border-radius: 12px;
    padding: 0.65rem 1rem;
    font-size: 1.05rem;
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
</style>

{{-- ====== SCRIPT PARA CALCULAR TASA ====== --}}
<script>
    const montoInput = document.getElementById('monto');
    const tasaInput = document.getElementById('tasa_interes');

    montoInput.addEventListener('input', function() {
        const monto = parseFloat(this.value);
        let tasa = 0;

        if (isNaN(monto)) {
            tasaInput.value = '';
            return;
        }

        if (monto <= 500) {
            tasa = 5;
        } else if (monto <= 1000) {
            tasa = 10;
        } else if (monto <= 5000) {
            tasa = 15;
        } else {
            tasa = 20;
        }

        tasaInput.value = tasa;
    });
</script>

</x-app-layout>
