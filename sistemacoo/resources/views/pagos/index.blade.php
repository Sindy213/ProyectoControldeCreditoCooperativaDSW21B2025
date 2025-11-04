<x-app-layout>

@section('content')
<div class="container-fluid py-5">

    {{-- Título principal --}}
    <div class="text-center mb-5">
        <h1 class="fw-bold text-gradient display-3">💳 Pagos Registrados</h1>

    </div>

    {{-- Botón de nuevo pago --}}
    <div class="text-end mb-4">
        <a href="{{ route('pagos.create') }}" class="btn btn-lg btn-gradient text-white shadow-sm">
            ➕ Registrar Nuevo Pago
        </a>
    </div>

    {{-- Tabla de pagos --}}
    <div class="card shadow-lg rounded-4 overflow-hidden">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center w-100 credit-table">
                    <thead>
                        <tr class="text-uppercase table-header">
                            <th>Cliente</th>
                            <th>Tipo de Crédito</th>
                            <th>Monto Pagado</th>
                            <th>Saldo Restante</th>
                            <th>Fecha</th>
                            <th>Cajero</th>
                            <th>Comprobante</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pagos as $pago)
                        <tr>
                            <td class="fw-semibold">{{ $pago->credito->cliente->nombre_completo ?? '—' }}</td>
                            <td>{{ $pago->credito->tipo_credito ?? '—' }}</td>
                            <td>${{ number_format($pago->monto_pagado, 2) }}</td>
                            <td>${{ number_format($pago->saldo_restante, 2) }}</td>
                            <td>{{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') }}</td>
                            <td>{{ $pago->cajero_responsable }}</td>

                            {{-- Botón Comprobante --}}
                            <td>
                                <a href="{{ route('pagos.comprobante', $pago->id) }}" target="_blank" class="btn btn-sm btn-outline-info rounded-circle" title="Ver Comprobante">🧾</a>
                            </td>

                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('pagos.show', $pago->id) }}" class="btn btn-sm btn-outline-primary rounded-circle" title="Ver">👁️</a>
                                    <a href="{{ route('pagos.edit', $pago->id) }}" class="btn btn-sm btn-outline-warning rounded-circle" title="Editar">✏️</a>
                                    <form action="{{ route('pagos.destroy', $pago->id) }}" method="POST" onsubmit="return confirm('¿Seguro que desea eliminar este pago?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle" title="Eliminar">🗑️</button>
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

{{-- ===== ESTILOS PERSONALIZADOS ===== --}}
<style>
.text-gradient {
    background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.btn-gradient {
    background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
    border-radius: 12px;
    padding: 0.7rem 1.5rem;
    font-weight: 600;
    border: none;
    transition: 0.3s ease-in-out;
}
.btn-gradient:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(37,117,252,0.35);
}

.credit-table {
    border: 1px solid #e0e0e0;
    border-radius: 15px;
    background: #fff;
    overflow: hidden;
    width: 100%;
}

.credit-table thead th {
    background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
    color: #fff;
    padding: 1rem;
    font-size: 0.95rem;
    letter-spacing: 0.5px;
}

.credit-table tbody tr {
    background-color: #fafaff;
    border: 1px solid #dee2e6;
    border-radius: 10px;
    transition: all 0.2s ease;
}

.credit-table tbody tr:hover {
    background-color: #f1f3ff;
    transform: scale(1.01);
    box-shadow: 0 4px 12px rgba(37,117,252,0.2);
}

.credit-table td {
    vertical-align: middle;
    padding: 0.8rem;
    font-size: 0.95rem;
}

.btn-outline-primary, .btn-outline-warning, .btn-outline-danger, .btn-outline-info {
    width: 35px;
    height: 35px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-width: 2px;
}

.btn-outline-primary:hover { background-color: #2575fc; color: white; }
.btn-outline-warning:hover { background-color: #ffc107; color: black; }
.btn-outline-danger:hover { background-color: #dc3545; color: white; }
.btn-outline-info:hover { background-color: #17a2b8; color: white; }

.card {
    border-radius: 20px;
    background: #fff;
}
</style>

</x-app-layout>
