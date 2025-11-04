<x-app-layout>

@section('title', 'Listado de Citas')

@section('content')
<div class="d-flex justify-content-center mb-4">
    <h2 class="fw-bold text-primary display-1">📋 Listado de Citas</h2>
</div>

<div class="d-flex justify-content-center mb-4">
    <a href="{{ route('citas.create') }}" class="btn btn-gradient-lg shadow-lg text-white">
        + Nueva Cita
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success shadow-lg rounded text-center display-7">{{ session('success') }}</div>
@endif

<div class="d-flex justify-content-center">
    <div class="table-responsive shadow-lg rounded" style="width: 90%; max-width: 1300px;">
        <table class="table table-hover align-middle text-center mb-0">
            <thead class="table-gradient text-white display-7">
                <tr>
                    
                    <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Asesor Asignado</th>
                    <th>Motivo</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($citas as $cita)
                <tr>
                    <td class="fw-bold">{{ $cita->cliente->nombre_completo ?? 'Desconocido' }}</td>
                    <td class="fw-bold">{{ \Carbon\Carbon::parse($cita->fecha_cita)->format('d/m/Y') }}</td>
                    <td class="fw-bold">{{ $cita->hora }}</td>
                    <td class="fw-bold">{{ $cita->asesor_asignado }}</td>
                    <td class="fw-bold">{{ $cita->motivo }}</td>
                    <td>
                        <span class="badge {{ $cita->estado == 'pendiente' ? 'bg-warning text-dark' : ($cita->estado == 'confirmada' ? 'bg-success' : 'bg-danger') }}">
                            {{ ucfirst($cita->estado) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('citas.show', $cita->id) }}" class="btn btn-info btn-lg shadow-sm me-1">
                            <i class="fa-solid fa-eye"></i> Ver
                        </a>
                        <a href="{{ route('citas.edit', $cita->id) }}" class="btn btn-warning btn-lg shadow-sm me-1">
                            <i class="fa-solid fa-pen-to-square"></i> Editar
                        </a>
                        <form action="{{ route('citas.destroy', $cita->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-lg shadow-sm" onclick="return confirm('¿Eliminar esta cita?')">
                                <i class="fa-solid fa-trash"></i> Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<style>
/* Gradiente en botón principal grande */
.btn-gradient-lg {
    background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
    border: none;
    font-size: 1.2rem;
    padding: 0.8rem 1.5rem;
    border-radius: 12px;
    transition: transform 0.2s, box-shadow 0.3s;
}
.btn-gradient-lg:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.3);
}

/* Tabla centrada y profesional */
.table th, .table td {
    padding: 15px 18px;
    vertical-align: middle;
    font-size: 1.1rem;
}
.table-hover tbody tr:hover {
    background-color: rgba(37, 117, 252, 0.1);
}

/* Encabezado con gradiente */
.table-gradient {
    background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
    font-size: 1.2rem;
}

/* Badges profesionales */
.badge {
    font-size: 1rem;
    padding: 0.5em 0.8em;
    border-radius: 12px;
}

/* Botones grandes de acción */
.btn-lg {
    font-size: 1rem;
    padding: 0.55rem 0.85rem;
    border-radius: 8px;
    transition: transform 0.2s, box-shadow 0.2s;
}
.btn-lg:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}
</style>

<!-- FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</x-app-layout>
