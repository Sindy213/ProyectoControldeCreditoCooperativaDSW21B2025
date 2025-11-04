<x-app-layout>
@section('title', 'Listado de Solicitudes')

@section('content')
<div class="container-fluid py-6 px-5">

    {{-- Título principal full-width --}}
    <div class="text-center my-5">
        <h1 class="fw-bold text-gradient display-3" style="letter-spacing: 1px;">
            📄 Listado de Solicitudes
        </h1>
    </div>

    {{-- Botón para nueva solicitud --}}
    <div class="d-flex justify-content-end mb-4">
        <a href="{{ route('solicitudes.create') }}" class="btn btn-lg btn-gradient text-white shadow-sm">
            ➕ Nueva Solicitud
        </a>
    </div>

    {{-- Mensaje de éxito --}}
    @if(session('success'))
        <div class="alert alert-success text-center fw-semibold shadow-sm rounded-4 mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabla full-width --}}
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center solicitud-table mb-0">
                    <thead>
                        <tr class="text-white table-header">
                            <th>Cliente</th>
                            <th>Fecha de Solicitud</th>
                            <th>Monto Solicitado</th>
                            <th>Estado</th>
                            <th>Observaciones</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($solicitudes as $solicitud)
                        <tr>
                            <td class="fw-semibold">{{ $solicitud->cliente->nombre_completo ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($solicitud->fecha_solicitud)->format('d/m/Y') }}</td>
                            <td>${{ number_format($solicitud->monto_solicitado, 2) }}</td>
                            <td>
                                <span class="badge estado-{{ strtolower($solicitud->estado) }}">
                                    {{ ucfirst($solicitud->estado) }}
                                </span>
                            </td>
                            <td>{{ $solicitud->observaciones ?? '-' }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('solicitudes.show', $solicitud->id) }}" 
                                       class="btn btn-sm btn-outline-primary rounded-circle" title="Ver">
                                        👁️
                                    </a>
                                    <a href="{{ route('solicitudes.edit', $solicitud->id) }}" 
                                       class="btn btn-sm btn-outline-warning rounded-circle" title="Editar">
                                        ✏️
                                    </a>
                                    <form action="{{ route('solicitudes.destroy', $solicitud->id) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('¿Seguro que desea eliminar esta solicitud?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle" title="Eliminar">
                                            🗑️
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted fw-semibold py-4 fs-5">
                                No hay solicitudes registradas.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- ====== ESTILOS PERSONALIZADOS ====== --}}
<style>
/* === Título con gradiente === */
.text-gradient {
    background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* === Botón principal === */
.btn-gradient {
    background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
    border: none;
    border-radius: 1rem;
    padding: 0.7rem 1.5rem;
    font-weight: 600;
    transition: 0.3s ease-in-out;
}
.btn-gradient:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(37, 117, 252, 0.35);
}

/* === Tabla moderna con bordes === */
.solicitud-table {
    border: 1px solid #e0e0e0;
    border-radius: 15px;
    background: #fff;
    overflow: hidden;
    width: 100%;
}

.solicitud-table thead th {
    background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
    color: #fff;
    border: none;
    padding: 1rem;
    font-size: 0.95rem;
    letter-spacing: 0.5px;
}

.solicitud-table tbody tr {
    background-color: #fafaff;
    border: 1px solid #dee2e6;
    border-radius: 10px;
    transition: all 0.2s ease;
}

.solicitud-table tbody tr:hover {
    background-color: #f1f3ff;
    transform: scale(1.01);
    box-shadow: 0 4px 12px rgba(37, 117, 252, 0.2);
}

/* === Celdas === */
.solicitud-table td {
    vertical-align: middle;
    padding: 0.8rem;
    font-size: 0.95rem;
}

/* === Estados === */
.badge {
    font-size: 0.85rem;
    padding: 0.5rem 0.9rem;
    border-radius: 20px;
    font-weight: 600;
}
.estado-aprobado { background-color: #28a745; color: white; }
.estado-pendiente { background-color: #ffc107; color: #212529; }
.estado-rechazado { background-color: #dc3545; color: white; }

/* === Botones de acción === */
.btn-outline-primary, .btn-outline-warning, .btn-outline-danger {
    border-width: 2px;
    width: 35px;
    height: 35px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.btn-outline-primary:hover { background-color: #2575fc; color: white; }
.btn-outline-warning:hover { background-color: #ffc107; color: black; }
.btn-outline-danger:hover { background-color: #dc3545; color: white; }

/* === Efecto general === */
.card {
    border-radius: 20px;
    background: #fff;
}
</style>
</x-app-layout>
