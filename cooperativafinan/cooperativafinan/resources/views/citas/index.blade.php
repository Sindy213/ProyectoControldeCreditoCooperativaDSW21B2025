<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">📅 Gestión de Citas</h2>
    </x-slot>

    <div class="py-8 px-6">
        <div class="mb-3 d-flex justify-content-between">
            <a href="{{ route('citas.create') }}" class="btn btn-success btn-sm">➕ Nueva Cita</a>
            <a href="{{ route('citas.exportPdf') }}" class="btn btn-danger btn-sm">📄 Exportar PDF</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Usuario</th>
                        <th>Fecha y Hora</th>
                        <th>Tipo</th>
                        <th>Estado</th>
                        <th>Notas</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($citas as $cita)
                        <tr>
                            <td>{{ $cita->id }}</td>
                            <td>{{ $cita->cliente->nombre ?? 'N/A' }}</td>
                            <td>{{ $cita->user->name ?? 'N/A' }}</td>
                            <td>{{ $cita->fecha_hora->format('d/m/Y H:i') }}</td>
                            <td>{{ ucfirst($cita->tipo) }}</td>
                            <td>
                                <span class="badge bg-{{ $cita->estado == 'programada' ? 'info' : ($cita->estado == 'realizada' ? 'success' : 'danger') }}">
                                    {{ ucfirst($cita->estado) }}
                                </span>
                            </td>
                            <td>{{ $cita->notas ?? '-' }}</td>
                            <td class="text-center">
                                <a href="{{ route('citas.edit', $cita->id) }}" class="btn btn-warning btn-sm">✏️</a>
                                <form action="{{ route('citas.destroy', $cita->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar esta cita?')">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
