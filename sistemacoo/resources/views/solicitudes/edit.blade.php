<x-app-layout>

@section('title', 'Editar Solicitud')

@section('content')
<h2>Editar Solicitud</h2>

<form action="{{ route('solicitudes.update', $solicitud->id) }}" method="POST" class="row g-3">
    @csrf
    @method('PUT')

    <div class="col-md-6">
        <label class="form-label">Cliente</label>
        <select name="id_cliente" class="form-select" required>
            @foreach($clientes as $cliente)
            <option value="{{ $cliente->id }}" {{ $solicitud->id_cliente == $cliente->id ? 'selected' : '' }}>{{ $cliente->nombre_completo }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label">Fecha de Solicitud</label>
        <input type="date" name="fecha_solicitud" class="form-control" value="{{ $solicitud->fecha_solicitud }}" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Monto Solicitado</label>
        <input type="number" step="0.01" name="monto_solicitado" class="form-control" value="{{ $solicitud->monto_solicitado }}" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Estado</label>
        <select name="estado" class="form-select" required>
            <option value="Pendiente" {{ $solicitud->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
            <option value="Aprobada" {{ $solicitud->estado == 'Aprobada' ? 'selected' : '' }}>Aprobada</option>
            <option value="Rechazada" {{ $solicitud->estado == 'Rechazada' ? 'selected' : '' }}>Rechazada</option>
        </select>
    </div>

    <div class="col-12">
        <label class="form-label">Observaciones</label>
        <textarea name="observaciones" class="form-control" rows="3">{{ $solicitud->observaciones }}</textarea>
    </div>

    <div class="col-12">
        <button type="submit" class="btn btn-warning btn-custom">✏ Actualizar</button>
        <a href="{{ route('solicitudes.index') }}" class="btn btn-secondary btn-custom">↩ Volver</a>
    </div>
</form>
</x-app-layout>
