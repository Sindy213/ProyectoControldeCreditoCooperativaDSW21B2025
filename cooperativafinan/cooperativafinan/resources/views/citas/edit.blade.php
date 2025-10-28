<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">✏️ Editar Cita</h2>
    </x-slot>

    <div class="py-8 px-6">
        <form action="{{ route('citas.update', $cita->id) }}" method="POST" class="card p-4 shadow-lg">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Cliente:</label>
                <select name="cliente_id" class="form-select" required>
                    @foreach ($clientes as $cliente)
                        <option value="{{ $cliente->id }}" {{ $cliente->id == $cita->cliente_id ? 'selected' : '' }}>
                            {{ $cliente->nombre }} {{ $cliente->apellido }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Usuario asignado:</label>
                <select name="user_id" class="form-select" required>
                    @foreach ($usuarios as $user)
                        <option value="{{ $user->id }}" {{ $user->id == $cita->user_id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Fecha y Hora:</label>
                <input type="datetime-local" name="fecha_hora" class="form-control"
                       value="{{ $cita->fecha_hora->format('Y-m-d\TH:i') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Tipo:</label>
                <input type="text" name="tipo" class="form-control" value="{{ $cita->tipo }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Estado:</label>
                <select name="estado" class="form-select" required>
                    <option value="programada" {{ $cita->estado == 'programada' ? 'selected' : '' }}>Programada</option>
                    <option value="realizada" {{ $cita->estado == 'realizada' ? 'selected' : '' }}>Realizada</option>
                    <option value="cancelada" {{ $cita->estado == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Notas:</label>
                <textarea name="notas" class="form-control" rows="3">{{ $cita->notas }}</textarea>
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('citas.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>
    </div>
</x-app-layout>
