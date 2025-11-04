<x-app-layout>

@section('title', 'Crear Usuario')

@section('content')
<h1>Crear Usuario</h1>

<form action="{{ route('usuarios.store') }}" method="POST" class="card p-4 shadow">
    @csrf

    <div class="mb-3">
        <label class="form-label">Nombre Completo</label>
        <input type="text" name="nombre_completo" class="form-control" value="{{ old('nombre_completo') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Usuario</label>
        <input type="text" name="usuario" class="form-control" value="{{ old('usuario') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Contraseña</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Rol</label>
        <input type="text" name="rol" class="form-control" value="{{ old('rol') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Estado</label>
        <select name="estado" class="form-control">
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Último Acceso</label>
        <input type="datetime-local" name="ultimo_acceso" class="form-control" value="{{ old('ultimo_acceso') }}">
    </div>

    <button type="submit" class="btn btn-success">💾 Guardar</button>
    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">⬅️ Volver</a>
</form>
</x-app-layout>
