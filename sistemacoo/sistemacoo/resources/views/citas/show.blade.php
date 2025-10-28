<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">📋 Detalles de la Cita</h2>
    </x-slot>

    <div class="py-8 px-6">
        <div class="card shadow-lg p-4">
            <h4 class="card-title mb-4">Información general</h4>

            <table class="table table-bordered">
                <tr>
                    <th>ID:</th>
                    <td>{{ $cita->id }}</td>
                </tr>
                <tr>
                    <th>Cliente:</th>
                    <td>{{ $cita->cliente->nombre ?? 'N/A' }} {{ $cita->cliente->apellido ?? '' }}</td>
                </tr>
                <tr>
                    <th>Usuario asignado:</th>
                    <td>{{ $cita->user->name ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Fecha y Hora:</th>
                    <td>{{ $cita->fecha_hora->format('d/m/Y H:i') }}</td>
                </tr>
                <tr>
                    <th>Tipo:</th>
                    <td>{{ ucfirst($cita->tipo) }}</td>
                </tr>
                <tr>
                    <th>Estado:</th>
                    <td>
                        <span class="badge bg-{{ $cita->estado == 'programada' ? 'info' : ($cita->estado == 'realizada' ? 'success' : 'danger') }}">
                            {{ ucfirst($cita->estado) }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th>Notas:</th>
                    <td>{{ $cita->notas ?? 'Sin observaciones' }}</td>
                </tr>
            </table>

            <div class="d-flex justify-content-end mt-4">
                <a href="{{ route('citas.index') }}" class="btn btn-secondary me-2">⬅️ Volver</a>
                <a href="{{ route('citas.exportPdf') }}" class="btn btn-danger">📄 Exportar Todas a PDF</a>
            </div>
        </div>
    </div>
</x-app-layout>
