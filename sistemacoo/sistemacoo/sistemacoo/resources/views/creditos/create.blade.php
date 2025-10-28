<x-app-layout>

@section('content')
<h2>Registrar Crédito</h2>

<form action="{{ route('creditos.store') }}" method="POST" class="row g-3">
    @csrf

    <div class="col-md-6">
        <label class="form-label">Cliente</label>
        <select name="id_cliente" class="form-select" required>
            <option value="" disabled selected>Seleccione un cliente...</option>
            @foreach($clientes as $cliente)
                <option value="{{ $cliente->id }}">{{ $cliente->nombre_completo }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label">Monto Solicitado</label>
        <input type="number" step="0.01" name="monto_solicitado" class="form-control" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Tasa de Interés (%)</label>
        <input type="number" step="0.01" name="tasa_interes" class="form-control" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Plazo (meses)</label>
        <input type="number" name="plazo_meses" class="form-control" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Fecha de Aprobación</label>
        <input type="date" name="fecha_aprobacion" class="form-control" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Estado</label>
        <select name="estado" class="form-select" required>
            <option value="" disabled selected>Seleccione...</option>
            <option value="Aprobado">Aprobado</option>
            <option value="Pendiente">Pendiente</option>
            <option value="Rechazado">Rechazado</option>
        </select>
    </div>

    <div class="col-12">
        <button type="submit" class="btn btn-success">💾 Guardar</button>
        <a href="{{ route('creditos.index') }}" class="btn btn-secondary">↩ Volver</a>
    </div>
</form>
</x-app-layout>
