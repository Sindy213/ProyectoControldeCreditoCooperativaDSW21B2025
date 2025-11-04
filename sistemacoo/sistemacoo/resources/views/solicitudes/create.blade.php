<x-app-layout>

@section('title', 'Registrar Solicitud')

@section('content')
<h2>Registrar Solicitud</h2>

<form action="{{ route('solicitudes.store') }}" method="POST" class="row g-3">
    @csrf

    <div class="col-md-6">
        <label class="form-label">Cliente</label>
        <select name="id_cliente" class="form-select" required>
            <option value="" disabled selected>Seleccione...</option>
            @foreach($clientes as $cliente)
            <option value="{{ $cliente->id }}">{{ $cliente->nombre_completo }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label">Fecha de Solicitud</label>
        <input type="date" name="fecha_solicitud" class="form-control" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Monto Solicitado</label>
        <input type="number" step="0.01" name="monto_solicitado" class="form-control" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Estado</label>
        <select name="estado" class="form-select" required>
            <option value="" disabled selected>Seleccione...</option>
            <option value="Pendiente">Pendiente</option>
            <option value="Aprobada">Aprobada</option>
            <option value="Rechazada">Rechazada</option>
        </select>
    </div>

    <div class="col-12">
        <label class="form-label">Observaciones</label>
        <textarea name="observaciones" class="form-control" rows="3"></textarea>
    </div>

    <div class="col-12">
        <button type="submit" class="btn btn-success btn-custom">💾 Guardar</button>
        <a href="{{ route('solicitudes.index') }}" class="btn btn-secondary btn-custom">↩ Volver</a>
    </div>
</form>
</x-app-layout>
