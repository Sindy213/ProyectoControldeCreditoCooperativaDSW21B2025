<x-app-layout>

@section('content')
<div class="container my-5">
    <div class="d-flex flex-column align-items-center mb-4">
        <h1 class="fw-bold text-gradient display-4"></h1>
        <a href="{{ route('clientes.create') }}" class="btn btn-gradient-lg shadow mt-3">
            ➕ Registrar Nuevo Cliente
        </a>
    </div>

    <div class="table-responsive bg-white rounded-4 shadow-lg p-4">
        <table class="table table-hover align-middle text-center">
            <thead class="table-gradient text-white">
                <tr>
                    
                    <th>Nombre Completo</th>
                    <th>DUI</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Género</th>
                    <th>Estado Civil</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($clientes as $cliente)
                <tr class="table-row">
                    
                    <td class="fw-semibold">{{ $cliente->nombre_completo }}</td>
                    <td>{{ $cliente->dui }}</td>
                    <td>{{ $cliente->direccion }}</td>
                    <td>{{ $cliente->telefono }}</td>
                    <td>{{ $cliente->email }}</td>
                    <td>{{ $cliente->genero }}</td>
                    <td>{{ $cliente->estado_civil }}</td>
                    <td>{{ $cliente->fecha_nacimiento }}</td>
                    <td>
                        <div class="d-flex justify-content-center gap-2 flex-wrap">
                            <a href="{{ route('clientes.show', $cliente->id) }}" 
                               class="btn btn-sm btn-info text-white shadow-sm px-3">
                               👁️ Ver
                            </a>
                            <a href="{{ route('clientes.edit', $cliente->id) }}" 
                               class="btn btn-sm btn-warning text-white shadow-sm px-3">
                               ✏️ Editar
                            </a>
                            <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este cliente?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger text-white shadow-sm px-3">
                                    🗑️ Eliminar
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-muted py-4">No hay clientes registrados aún.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<style>
.text-gradient {
    background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
    background-clip: text;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.table-gradient {
    background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
}

.btn-gradient-lg {
    background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
    color: white;
    font-weight: 600;
    border: none;
    padding: 0.7rem 1.5rem;
    border-radius: 12px;
    transition: all 0.3s ease-in-out;
}
.btn-gradient-lg:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
}

.table {
    border-collapse: separate;
    border-spacing: 0 0.7rem;
}

.table-row {
    background-color: #c8c8eeff;
    transition: transform 0.2s, box-shadow 0.2s;
}
.table-row:hover {
    transform: scale(1.01);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.table th {
    padding: 1rem;
    font-size: 1rem;
    letter-spacing: 0.5px;
}

.table td {
    padding: 0.8rem;
    vertical-align: middle;
    font-size: 0.95rem;
}

.btn-sm {
    border-radius: 10px;
    font-weight: 600;
    transition: all 0.2s ease-in-out;
}
.btn-sm:hover {
    transform: translateY(-2px);
}

.shadow-lg {
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}
</style>
</x-app-layout>
