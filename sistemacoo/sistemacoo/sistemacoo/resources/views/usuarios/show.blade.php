<x-app-layout>

@section('title', 'Detalle Usuario')

@section('content')
<h1>Detalle de Usuario</h1>

<div class="card p-4 shadow">
    <p><strong>ID:</strong> {{ $usuario->id }}</p>
    <p><strong>Nombre Completo:</strong> {{ $usuario->nombre_completo }}</p>
    <p><strong>Usuario:</strong> {{ $usuario->usuario }}</p>
    <p><strong>Rol:</strong> {{ $usuario->rol }}</p>
    <p><strong>Estado:</strong>
        @if($usuario->estado)
            <span class="badge bg-success">Activo</span>
        @else
            <span class="badge bg-danger">Inactivo</span>
        @endif
    </p>
    <p><strong>Último Acceso:</strong> {{ $usuario->ultimo_acceso ? $usuario->ultimo_acceso->format('d/m/Y H:i') : '-' }}</p>
</div>

<a href="{{ route('usuarios.index') }}" class="btn btn-secondary mt-3">⬅️ Volver</a>
</x-app-layout>
