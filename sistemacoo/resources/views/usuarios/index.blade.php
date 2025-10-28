@extends('layouts.app')

@section('title', 'Lista de Usuarios')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h1>Lista de Usuarios</h1>
    <a href="{{ route('usuarios.create') }}" class="btn btn-primary">➕ Nuevo Usuario</a>
</div>

<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
           
            <th>Nombre Completo</th>
            <th>Nombre de Usuario</th>
            <th>Rol</th>
            <th>Estado</th>
            <th>Último Acceso</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse($usuarios as $usuario)
        <tr>
            
            <td>{{ $usuario->nombre_completo }}</td>
            <td>{{ $usuario->usuario }}</td>
            <td>{{ $usuario->rol }}</td>
            <td>
                @if($usuario->estado)
                    <span class="badge bg-success">Activo</span>
                @else
                    <span class="badge bg-danger">Inactivo</span>
                @endif
            </td>
            <td>{{ $usuario->ultimo_acceso ? $usuario->ultimo_acceso->format('d/m/Y H:i') : '-' }}</td>
            <td>
                <a href="{{ route('usuarios.show', $usuario) }}" class="btn btn-info btn-sm">👁️ Ver</a>
                <a href="{{ route('usuarios.edit', $usuario) }}" class="btn btn-warning btn-sm">✏️ Editar</a>
                <form action="{{ route('usuarios.destroy', $usuario) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Seguro que deseas eliminar este usuario?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">🗑️ Eliminar</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="text-center">No hay usuarios registrados</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
