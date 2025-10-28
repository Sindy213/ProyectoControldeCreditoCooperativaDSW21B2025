<x-app-layout>

@section('content')
<h2>Editar Crédito</h2>

<form action="{{ route('creditos.update', $credito->id) }}" method="POST" class="row g-3">
    @csrf
    @method('PUT')

    <div class="col-md-6">
        <label class="form-label">Cliente</label>
        <select name="id_cliente" class="form-select" required>
            @foreach($clientes as $cliente)
                <option value="{{ $cliente->id }}" {{ $credito->id_cliente == $cliente->id ? 'selected' : '' }}>
                    {{ $cliente->nombre_completo }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label">Monto Solicitado</label>
        <input type="number" step="0.01" name="monto_solicitado" class="form-control" value="{{ $credito->monto_solicitado }}" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Tasa de Interés (%)</label>
        <input type="number" step="0.01" name="tasa_interes" class="form-control" value="{{ $credito->tasa_interes }}" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Plazo (meses)</label>
        <input type="number" name="plazo_meses" class="form-control" value="{{ $credito->plazo_meses }}" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Fecha de Aprobación</label>
        <input type="date" name="fecha_aprobacion" class="form-control" value="{{ $credito->fecha_aprobacion }}" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Estado</label>
        <select name="estado" class="form-select" required>
            <option value="Aprobado" {{ $credito->estado == 'Aprobado' ? 'selected' : '' }}>Aprobado</option>
            <option value="Pendiente" {{ $credito->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
            <option value="Rechazado" {{ $credito->estado == 'Rechazado' ? 'selected' : '' }}>Rechazado</option>
        </select>
    </div>

    <div class="col-12">
        <button type="submit" class="btn btn-warning">✏ Actualizar</button>
        <a href="{{ route('creditos.index') }}" class="btn btn-secondary">↩ Volver</a>
    </div>
</form>
</x-app-layout>
