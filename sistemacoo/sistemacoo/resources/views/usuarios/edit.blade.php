<x-app-layout>

@section('title', 'Editar Usuario')

@section('content')
<h1>Editar Usuario</h1>

<form action="{{ route('usuarios.update', $usuario) }}" method="POST" class="card p-4 shadow">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Nombre Completo</label>
        <input type="text" name="nombre_completo" class="form-control" value="{{ old('nombre_completo', $usuario->nombre_completo) }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Usuario</label>
        <input type="text" name="usuario" class="form-control" value="{{ old('usuario', $usuario->usuario) }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Contraseña (dejar vacío si no deseas cambiarla)</label>
        <input type="password" name="password" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Rol</label>
        <input type="text" name="rol" class="form-control" value="{{ old('rol', $usuario->rol) }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Estado</label>
        <select name="estado" class="form-control">
            <option value="1" {{ $usuario->estado ? 'selected' : '' }}>Activo</option>
            <option value="0" {{ !$usuario->estado ? 'selected' : '' }}>Inactivo</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Último Acceso</label>
        <input type="datetime-local" name="ultimo_acceso" class="form-control" value="{{ $usuario->ultimo_acceso ? $usuario->ultimo_acceso->format('Y-m-d\TH:i') : '' }}">
    </div>

    <button type="submit" class="btn btn-warning">✏️ Actualizar</button>
    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">⬅️ Volver</a>
</form>
</x-app-layout>
