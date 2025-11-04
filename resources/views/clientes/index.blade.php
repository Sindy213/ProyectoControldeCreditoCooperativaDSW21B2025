@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Listado de Clientes</h2>
    <a href="{{ route('clientes.create') }}" class="btn btn-primary">➕ Nuevo Cliente</a>
</div>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>Nombre Completo</th>
            <th>DUI</th>
            <th>Dirección</th>
            <th>Teléfono</th>
            <th>Correo Electrónico</th>
            <th>Género</th> <!-- nuevo -->
            <th>Estado Civil</th>
            <th>Fecha de Nacimiento</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($clientes as $cliente)
        <tr>
            <td>{{ $cliente->nombre_completo }}</td>
            <td>{{ $cliente->dui }}</td>
            <td>{{ $cliente->direccion }}</td>
            <td>{{ $cliente->telefono }}</td>
            <td>{{ $cliente->correo_electronico }}</td>
             <td>{{ $cliente->genero }}</td> <!-- nuevo -->
            <td>{{ $cliente->estado_civil }}</td>
            <td>{{ $cliente->fecha_nacimiento }}</td>
            <td>
                <a href="{{ route('clientes.show', $cliente->id) }}" class="btn btn-info btn-sm">👁 Ver</a>
                <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-warning btn-sm">✏ Editar</a>
                <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este cliente?')">🗑 Eliminar</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="10" class="text-center">No hay clientes registrados.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
