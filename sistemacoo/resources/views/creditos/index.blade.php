<x-app-layout>

@section('content')
<div class="container-fluid py-6">

    {{-- Título principal mejorado --}}
    <div class="text-center my-4">
        <h6 class="fw-bold text-gradient display-3" style="letter-spacing: 1px;">
            💳 Listado de Créditos Registrados
        </h6>
    </div>

    {{-- Mensaje de éxito --}}
    @if (session('success'))
        <div class="alert alert-success text-center fw-semibold shadow-sm rounded-4 mx-auto" style="max-width: 800px;">
            {{ session('success') }}
        </div>
    @endif

    {{-- Botón de nuevo crédito --}}
    <div class="text-end mb-4 pe-4">
        <a href="{{ route('creditos.create') }}" class="btn btn-lg btn-gradient text-white shadow-sm">
            ➕ Registrar Nuevo Crédito
        </a>
    </div>

    {{-- Tabla principal --}}
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden mx-3">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center credit-table w-100 m-0">
                    <thead>
                        <tr class="text-uppercase table-header">
                            
                            <th>Cliente</th>
                            <th>Tipo de Crédito</th>
                            <th>Monto ($)</th>
                            <th>Tasa (%)</th>
                            <th>Plazo (meses)</th>
                            <th>Fecha Aprobación</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($creditos as $credito)
                        <tr>
                
                            <td class="fw-semibold">{{ $credito->cliente->nombre_completo ?? '—' }}</td>
                            <td>{{ $credito->tipo_credito }}</td>
                            <td>${{ number_format($credito->monto_solicitado, 2) }}</td>
                            <td>{{ $credito->tasa_interes * 100 }}%</td>
                            <td>{{ $credito->plazo_meses }}</td>
                            <td>{{ \Carbon\Carbon::parse($credito->fecha_aprobacion)->format('d/m/Y') }}</td>
                            <td>
                                <span class="badge estado-{{ strtolower($credito->estado) }}">
                                    {{ $credito->estado }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('creditos.show', $credito->id) }}" 
                                       class="btn btn-sm btn-outline-primary rounded-circle" title="Ver">
                                        👁️
                                    </a>
                                    <a href="{{ route('creditos.edit', $credito->id) }}" 
                                       class="btn btn-sm btn-outline-warning rounded-circle" title="Editar">
                                        ✏️
                                    </a>
                                    <form action="{{ route('creditos.destroy', $credito->id) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('¿Seguro que desea eliminar este crédito?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle" title="Eliminar">
                                            🗑️
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
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
    text-shadow: 0 3px 8px rgba(37,117,252,0.25);
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
.credit-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 10px;
}

.credit-table thead th {
    background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
    color: #fff;
    border: none;
    padding: 1rem;
    font-size: 1rem;
    letter-spacing: 0.5px;
}

.credit-table tbody tr {
    background-color: #ffffff;
    border: 1px solid #dee2e6;
    border-radius: 12px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    transition: all 0.2s ease;
}

.credit-table tbody tr:hover {
    background-color: #f5f7ff;
    transform: scale(1.01);
    box-shadow: 0 6px 15px rgba(37, 117, 252, 0.25);
}

/* === Celdas === */
.credit-table td {
    vertical-align: middle;
    padding: 1rem;
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
    width: 38px;
    height: 38px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: 0.2s ease;
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
