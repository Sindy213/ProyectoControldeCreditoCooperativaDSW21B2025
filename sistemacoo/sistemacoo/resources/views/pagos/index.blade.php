<x-app-layout>
@section('title', 'Listado de Pagos')

@section('content')
<div class="container my-5 d-flex flex-column align-items-center">

    <!-- Encabezado impresionante -->
    <div class="d-flex justify-content-between align-items-center mb-5 w-100" style="max-width: 1300px;">
        <h2 class="fw-bold text-gradient display-4">Listado de Pagos</h2>
        <a href="{{ route('pagos.create') }}" class="btn btn-gradient btn-lg shadow-lg">➕ Nuevo Pago</a>
    </div>

    <!-- Tabla centrada y responsiva -->
    <div class="table-responsive shadow-lg rounded-5 w-100" style="max-width: 1300px;">
        <table class="table table-hover align-middle text-center mb-0 table-glass">
            <thead class="table-custom-head">
                <tr>
                    <th class="fs-5">Cliente</th>
                    <th class="fs-5">Fecha de Pago</th>
                    <th class="fs-5">Monto Pagado</th>
                    <th class="fs-5">Saldo Restante</th>
                    <th class="fs-5">Cajero Responsable</th>
                    <th class="fs-5">Número Comprobante</th>
                    <th class="fs-5">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pagos as $pago)
                <tr class="table-row-glass fs-5">
                    <td>{{ $pago->credito->cliente->nombre_completo ?? '-' }}</td>
                    <td>{{ $pago->fecha_pago }}</td>
                    <td>${{ number_format($pago->monto_pagado, 2) }}</td>
                    <td>
                        <span class="badge badge-state saldo {{ $pago->saldo_restante > 0 ? 'pendiente' : 'aprobado' }}">
                            ${{ number_format($pago->saldo_restante, 2) }}
                        </span>
                    </td>
                    <td>{{ $pago->cajero_responsable }}</td>
                    <td>{{ $pago->numero_comprobante }}</td>
                    <td class="d-flex justify-content-center gap-2">
                        <a href="{{ route('pagos.show', $pago->id) }}" class="btn btn-info btn-sm btn-action">👁 Ver</a>
                        <a href="{{ route('pagos.edit', $pago->id) }}" class="btn btn-warning btn-sm btn-action"> ✏ Editar</a>
                        <form action="{{ route('pagos.destroy', $pago->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm btn-action" onclick="return confirm('¿Eliminar este pago?')">🗑 Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted fw-semibold py-4 fs-5">No hay pagos registrados.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<style>
/* Encabezado con degradado impresionante */
.text-gradient {
    background: linear-gradient(90deg, #3b82f6, #06b6d4, #22c55e);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* Tabla estilo vidrio ("glass") */
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
}

/* Filas con hover y animación */
.table-row-glass {
    transition: transform 0.25s ease, background 0.25s ease, box-shadow 0.25s ease;
    cursor: default;
}
.table-row-glass:hover {
    transform: translateY(-5px);
    background: rgba(255,255,255,0.5);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

/* Badges con degradado según saldo */
.badge-state {
    font-weight: 600;
    padding: 0.55em 0.8em;
    border-radius: 0.75rem;
    color: #fff;
    display: inline-block;
    font-size: 1rem;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.badge-state:hover {
    transform: scale(1.1);
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}
.badge-state.aprobado {
    background: linear-gradient(90deg, #4ade80, #16a34a);
}
.badge-state.pendiente {
    background: linear-gradient(90deg, #facc15, #ca8a04);
    color: #000;
}

/* Botones modernos con sombra y transición */
.btn-action {
    transition: all 0.25s ease;
    font-weight: 600;
}
.btn-action:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
}

/* Botón principal con degradado y sombra */
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

/* Tabla responsiva con bordes redondeados y sombra */
.table-responsive {
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
}

/* Tipografía grande */
h2 {
    font-size: 3rem;
}
table {
    font-size: 1.3rem;
}
</style>
</x-app-layout>
