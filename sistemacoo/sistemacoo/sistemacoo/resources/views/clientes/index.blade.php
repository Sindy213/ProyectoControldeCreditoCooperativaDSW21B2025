<x-app-layout>
@section('title', 'Listado de Clientes')

@section('content')
<div class="container my-5 d-flex flex-column align-items-center">

    <!-- Encabezado -->
    <div class="d-flex justify-content-between align-items-center mb-4 w-100" style="max-width: 1400px;">
        <h2 class="fw-bold text-gradient display-4">Listado de Clientes</h2>
        <a href="{{ route('clientes.create') }}" class="btn btn-gradient btn-lg shadow-lg">➕ Nuevo Cliente</a>
    </div>

    <!-- Tabla centrada y responsiva -->
    <div class="table-responsive shadow-lg rounded-5 w-100" style="max-width: 1400px;">
        <table class="table table-hover align-middle text-center mb-0 table-glass table-bordered border-visible">
            <thead class="table-custom-head">
                <tr>
                    <th>Nombre Completo</th>
                    <th>DUI</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Correo Electrónico</th>
                    <th>Género</th>
                    <th>Estado Civil</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($clientes as $cliente)
                <tr class="table-row-glass">
                    <td>{{ $cliente->nombre_completo }}</td>
                    <td>{{ $cliente->dui }}</td>
                    <td>{{ $cliente->direccion ?? '-' }}</td>
                    <td>{{ $cliente->telefono ?? '-' }}</td>
                    <td>{{ $cliente->email ?? '-' }}</td>
                    <td>{{ $cliente->genero ?? '-' }}</td>
                    <td>{{ $cliente->estado_civil ?? '-' }}</td>
                    <td>{{ $cliente->fecha_nacimiento ?? '-' }}</td>
                    <td class="d-flex justify-content-center gap-2">
                        <a href="{{ route('clientes.show', $cliente->id) }}" class="btn btn-info btn-sm btn-action">👁 Ver</a>
                        <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-warning btn-sm btn-action">✏ Editar</a>
                        <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm btn-action" onclick="return confirm('¿Eliminar este cliente?')">🗑 Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center text-muted fw-semibold py-4 fs-5">No hay clientes registrados.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<style>
/* Encabezado degradado */
.text-gradient {
    background: linear-gradient(90deg, #3b82f6, #06b6d4, #22c55e);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* Tabla estilo vidrio */
.table-glass {
    backdrop-filter: blur(8px) saturate(180%);
    background-color: rgba(255,255,255,0.3);
    border-radius: 20px;
}

/* Encabezado de tabla */
.table-custom-head {
    background: linear-gradient(90deg, #0d6efd, #3b82f6);
    color: #fff;
    font-weight: 700;
    text-transform: uppercase;
    font-size: 1.2rem;
    border: 2px solid #fff;
}

/* Bordes visibles para toda la tabla */
.border-visible th,
.border-visible td {
    border: 2px solid rgba(0,0,0,0.2) !important;
}

/* Hover en filas */
.table-row-glass {
    transition: transform 0.25s ease, background 0.25s ease, box-shadow 0.25s ease;
    cursor: default;
}
.table-row-glass:hover {
    transform: translateY(-5px);
    background: rgba(255,255,255,0.5);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

/* Botones modernos */
.btn-action {
    transition: all 0.25s ease;
    font-weight: 600;
}
.btn-action:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
}
.btn-gradient {
    background: linear-gradient(90deg, #3b82f6, #06b6d4, #22c55e);
    color: #fff;
    font-weight: 700;
    border: none;
    transition: all 0.25s ease;
}
.btn-gradient:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.3);
}

/* Tabla responsiva */
.table-responsive {
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}

/* Tipografía grande */
h2 { font-size: 3rem; }
table { font-size: 1.3rem; }
</style>
</x-app-layout>
