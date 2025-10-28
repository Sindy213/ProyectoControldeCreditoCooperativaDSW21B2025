<x-app-layout>
@section('title', 'Editar Cita')

@section('content')
<h2>Editar Cita #{{ $cita->id }}</h2>

<form action="{{ route('citas.update', $cita->id) }}" method="POST" class="row g-3">
    @csrf
    @method('PUT')

    <div class="col-md-6">
        <label class="form-label">Cliente</label>
        <select name="id_cliente" class="form-select" required>
            @foreach($clientes as $cliente)
                <option value="{{ $cliente->id }}" @if($cliente->id == $cita->id_cliente) selected @endif>
                    {{ $cliente->nombre_completo ?? 'Desconocido' }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <label class="form-label">Fecha de Cita</label>
        <input type="date" name="fecha_cita" value="{{ $cita->fecha_cita }}" class="form-control" required>
    </div>

    <div class="col-md-3">
        <label class="form-label">Hora</label>
        <input type="time" name="hora" value="{{ $cita->hora }}" class="form-control" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Asesor Asignado</label>
        <input type="text" name="asesor_asignado" value="{{ $cita->asesor_asignado }}" class="form-control" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Motivo</label>
        <input type="text" name="motivo" value="{{ $cita->motivo }}" class="form-control" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Estado</label>
        <select name="estado" class="form-select" required>
            <option value="pendiente" @if($cita->estado=='pendiente') selected @endif>Pendiente</option>
            <option value="confirmada" @if($cita->estado=='confirmada') selected @endif>Confirmada</option>
            <option value="cancelada" @if($cita->estado=='cancelada') selected @endif>Cancelada</option>
        </select>
    </div>

    <div class="col-12">
        <button type="submit" class="btn btn-success">💾 Guardar cambios</button>
        <a href="{{ route('citas.index') }}" class="btn btn-secondary">↩ Volver</a>
    </div>
</form>
</x-app-layout>