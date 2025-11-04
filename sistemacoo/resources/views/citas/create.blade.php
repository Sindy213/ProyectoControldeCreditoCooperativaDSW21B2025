<x-app-layout>
@section('title', 'Registrar Cita')

@section('content')
<div class="d-flex flex-column align-items-center my-5">
    <h2 class="fw-bold text-gradient display-1">Registrar Nueva Cita</h2>
</div>

<div class="d-flex justify-content-center">
    <div class="bg-white shadow-lg rounded-4 p-5 w-100" style="max-width: 800px;">
        <form action="{{ route('citas.store') }}" method="POST" class="d-grid gap-4">
            @csrf

            <div class="form-group">
                <label class="form-label fw-semibold">👤 Cliente</label>
                <select name="id_cliente" class="form-select input-glass" required>
                    <option value="" disabled selected>Seleccione...</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}">
                            {{ $cliente->nombre_completo ?? 'Desconocido' }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label fw-semibold">🗓 Fecha de Cita</label>
                <input type="date" name="fecha_cita" class="form-control input-glass" required>
            </div>

            <div class="form-group">
                <label class="form-label fw-semibold">⏰ Hora</label>
                <input type="time" name="hora" class="form-control input-glass" required>
            </div>

            <div class="form-group">
                <label class="form-label fw-semibold">🧑‍💼 Asesor Asignado</label>
                <input type="text" name="asesor_asignado" class="form-control input-glass" required>
            </div>

            <div class="form-group">
                <label class="form-label fw-semibold">📋 Motivo</label>
                <input type="text" name="motivo" class="form-control input-glass" required>
            </div>

            <div class="form-group">
                <label class="form-label fw-semibold">📌 Estado</label>
                <select name="estado" class="form-select input-glass" required>
                    <option value="pendiente">Pendiente</option>
                    <option value="confirmada">Confirmada</option>
                    <option value="cancelada">Cancelada</option>
                </select>
            </div>

            <div class="d-flex justify-content-end gap-3 mt-4">
                <button type="submit" class="btn btn-gradient-lg shadow-lg text-white">
                    💾 Guardar
                </button>
                <a href="{{ route('citas.index') }}" class="btn btn-secondary btn-lg shadow-sm">
                    ↩ Volver
                </a>
            </div>
        </form>
    </div>
</div>

<style>
.text-gradient {
    background: linear-gradient(135deg, #3b82f6, #06b6d4, #22c55e);
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
    background: linear-gradient(135deg, #3b82f6, #06b6d4, #22c55e);
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

</x-app-layout>