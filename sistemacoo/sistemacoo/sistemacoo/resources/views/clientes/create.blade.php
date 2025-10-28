<x-app-layout>

@section('content')
<h2>Registrar Cliente</h2>

<form action="{{ route('clientes.store') }}" method="POST" class="row g-3">
    @csrf

    <div class="col-md-6">
        <label class="form-label">Nombre Completo</label>
        <input type="text" name="nombre_completo" class="form-control" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">DUI</label>
        <input type="text" name="dui" class="form-control" required>
    </div>

    <div class="col-md-12">
        <label class="form-label">Dirección</label>
        <input type="text" name="direccion" class="form-control">
    </div>

    <div class="col-md-6">
        <label class="form-label">Teléfono</label>
        <input type="text" name="telefono" class="form-control">
    </div>

    <div class="col-md-6">
        <label class="form-label">Correo Electrónico</label>
        <input type="email" name="email" class="form-control" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Género</label>
        <select id="genero" name="genero" class="form-select" required>
            <option value="" selected disabled>Seleccione...</option>
            <option value="Masculino">Masculino</option>
            <option value="Femenino">Femenino</option>
            <option value="LGBT">LGBT</option>
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label">Estado Civil</label>
        <select id="estado_civil" name="estado_civil" class="form-select" required>
            <option value="" selected disabled>Seleccione...</option>
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label">Fecha de Nacimiento</label>
        <input type="date" name="fecha_nacimiento" class="form-control">
    </div>

    <div class="col-12">
        <button type="submit" class="btn btn-success">💾 Guardar</button>
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

    generoSelect.addEventListener('change', function() {
        const genero = this.value;

        // Limpiar las opciones actuales
        estadoCivilSelect.innerHTML = '<option value="" selected disabled>Seleccione...</option>';

        // Agregar opciones según el género
        opcionesEstadoCivil[genero].forEach(function(estado) {
            const option = document.createElement('option');
            option.value = estado;
            option.text = estado;
            estadoCivilSelect.appendChild(option);
        });
    });
</script>
</x-app-layout>
