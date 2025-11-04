@extends('layouts.app')

@section('content')
<h2>Editar Cliente</h2>

<form action="{{ route('clientes.update', $cliente->id) }}" method="POST" class="row g-3">
    @csrf
    @method('PUT')

    <div class="col-md-12">
        <label class="form-label">Nombre Completo</label>
        <input type="text" name="nombre_completo" class="form-control" value="{{ $cliente->nombre_completo }}" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">DUI</label>
        <input type="text" name="dui" class="form-control" value="{{ $cliente->dui }}" required>
    </div>

    <div class="col-md-12">
        <label class="form-label">Dirección</label>
        <input type="text" name="direccion" class="form-control" value="{{ $cliente->direccion }}">
    </div>

    <div class="col-md-6">
        <label class="form-label">Teléfono</label>
        <input type="text" name="telefono" class="form-control" value="{{ $cliente->telefono }}">
    </div>

    <div class="col-md-6">
        <label class="form-label">Correo Electrónico</label>
        <input type="email" name="correo_electronico" class="form-control" value="{{ $cliente->correo_electronico }}" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Género</label>
        <select id="genero" name="genero" class="form-select" required>
            <option value="" disabled>Seleccione...</option>
            <option value="Masculino" {{ $cliente->genero == 'Masculino' ? 'selected' : '' }}>Masculino</option>
            <option value="Femenino" {{ $cliente->genero == 'Femenino' ? 'selected' : '' }}>Femenino</option>
            <option value="LGBT" {{ $cliente->genero == 'LGBT' ? 'selected' : '' }}>LGBT</option>
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label">Estado Civil</label>
        <select id="estado_civil" name="estado_civil" class="form-select" required>
            <option value="" disabled>Seleccione...</option>
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label">Fecha de Nacimiento</label>
        <input type="date" name="fecha_nacimiento" class="form-control" value="{{ $cliente->fecha_nacimiento }}">
    </div>

    <div class="col-12">
        <button type="submit" class="btn btn-warning">✏ Actualizar</button>
        <a href="{{ route('clientes.index') }}" class="btn btn-secondary">↩ Volver</a>
    </div>
</form>

<script>
    const generoSelect = document.getElementById('genero');
    const estadoCivilSelect = document.getElementById('estado_civil');

    const opcionesEstadoCivil = {
        'Masculino': ['Soltero', 'Casado'],
        'Femenino': ['Soltera', 'Casada'],
        'LGBT': ['Soltero/a', 'Casado/a']
    };

    function actualizarEstadoCivil() {
        const genero = generoSelect.value;

        estadoCivilSelect.innerHTML = '<option value="" disabled>Seleccione...</option>';

        opcionesEstadoCivil[genero]?.forEach(function(estado) {
            const option = document.createElement('option');
            option.value = estado;
            option.text = estado;

            // Mantener seleccionado el valor actual del cliente
            if (estado === "{{ $cliente->estado_civil }}") {
                option.selected = true;
            }

            estadoCivilSelect.appendChild(option);
        });
    }

    // Inicializar al cargar la página
    actualizarEstadoCivil();

    // Actualizar cuando cambie el género
    generoSelect.addEventListener('change', actualizarEstadoCivil);
</script>
@endsection
