@extends('layouts.app')

@section('content')
<h2>Detalles del Cliente</h2>

<div class="card">
    <div class="card-body">
        <p><strong>ID:</strong> {{ $cliente->id }}</p>
        <p><strong>Nombre Completo:</strong> {{ $cliente->nombre_completo }}</p>
        <p><strong>DUI:</strong> {{ $cliente->dui }}</p>
        <p><strong>Dirección:</strong> {{ $cliente->direccion }}</p>
        <p><strong>Teléfono:</strong> {{ $cliente->telefono }}</p>
        <p><strong>Correo Electrónico:</strong> {{ $cliente->correo_electronico }}</p>
        <p><strong>Género:</strong> {{ $cliente->genero }}</p>
        <p><strong>Estado Civil:</strong> {{ $cliente->estado_civil }}</p>
        <p><strong>Fecha de Nacimiento:</strong> {{ $cliente->fecha_nacimiento }}</p>
    </div>
</div>

<a href="{{ route('clientes.index') }}" class="btn btn-secondary mt-3">↩ Volver</a>
@endsection
