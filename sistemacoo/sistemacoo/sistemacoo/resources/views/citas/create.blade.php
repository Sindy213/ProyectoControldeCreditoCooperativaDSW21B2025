<x-app-layout>
@section('title', 'Registrar Cita')

@section('content')
<h2>Registrar Nueva Cita</h2>

<form action="{{ route('citas.store') }}" method="POST" class="row g-3">
    @csrf

    <div class="col-md-6">
        <label class="form-label">Cliente</label>
        <select name="id_cliente" class="form-select" required>
            <option value="" disabled selected>Seleccione...</option>
            @foreach($clientes as $cliente)
                <option value="{{ $cliente->id }}">
                    {{ $cliente->nombre_completo ?? 'Desconocido' }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <label class="form-label">Fecha de Cita</label>
        <input type="date" name="fecha_cita" class="form-control" required>
    </div>

    <div class="col-md-3">
        <label class="form-label">Hora</label>
        <input type="time" name="hora" class="form-control" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Asesor Asignado</label>
        <input type="text" name="asesor_asignado" class="form-control" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Motivo</label>
        <input type="text" name="motivo" class="form-control" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Estado</label>
        <select name="estado" class="form-select" required>
            <option value="pendiente">Pendiente</option>
            <option value="confirmada">Confirmada</option>
            <option value="cancelada">Cancelada</option>
        </select>
    </div>

    <div class="col-12">
        <button type="submit" class="btn btn-success">💾 Guardar</button>
        <a href="{{ route('citas.index') }}" class="btn btn-secondary">↩ Volver</a>
    </div>
</form>
</x-app-layout>