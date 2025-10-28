<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">➕ Crear Nueva Cita</h2>
    </x-slot>

    <div class="py-8 px-6">
        <form action="{{ route('citas.store') }}" method="POST" class="card p-4 shadow-lg">
            @csrf

            <div class="mb-3">
                <label class="form-label">Cliente:</label>
                <select name="cliente_id" class="form-select" required>
                    <option value="">-- Selecciona un cliente --</option>
                    @foreach ($clientes as $cliente)
                        <option value="{{ $cliente->id }}">{{ $cliente->nombre }} {{ $cliente->apellido }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Usuario asignado:</label>
                <select name="user_id" class="form-select" required>
                    <option value="">-- Selecciona un usuario --</option>
                    @foreach ($usuarios as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Fecha y Hora:</label>
                <input type="datetime-local" name="fecha_hora" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Tipo:</label>
                <input type="text" name="tipo" class="form-control" placeholder="Ej. Evaluación de crédito" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Estado:</label>
                <select name="estado" class="form-select" required>
                    <option value="programada">Programada</option>
                    <option value="realizada">Realizada</option>
                    <option value="cancelada">Cancelada</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Notas:</label>
                <textarea name="notas" class="form-control" rows="3"></textarea>
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('citas.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</x-app-layout>
