<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">✏️ Editar Solicitud #{{ $solicitud->id }}</h2>
    </x-slot>

    <div class="py-8 max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow rounded-lg">
            <form action="{{ route('solicitudes.update', $solicitud->id) }}" method="POST">
                @csrf @method('PUT')

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label>Monto Solicitado</label>
                        <input type="number" step="0.01" name="monto_solicitado" value="{{ $solicitud->monto_solicitado }}" class="w-full border-gray-300 rounded-lg">
                    </div>

                    <div>
                        <label>Plazo (meses)</label>
                        <input type="number" name="plazo_meses" value="{{ $solicitud->plazo_meses }}" class="w-full border-gray-300 rounded-lg">
                    </div>

                    <div>
                        <label>Ingresos Declarados</label>
                        <input type="number" step="0.01" name="ingresos_declared" value="{{ $solicitud->ingresos_declared }}" class="w-full border-gray-300 rounded-lg">
                    </div>

                    <div>
                        <label>Estado</label>
                        <select name="estado" class="w-full border-gray-300 rounded-lg">
                            <option value="pendiente" {{ $solicitud->estado=='pendiente'?'selected':'' }}>Pendiente</option>
                            <option value="aprobado" {{ $solicitud->estado=='aprobado'?'selected':'' }}>Aprobado</option>
                            <option value="rechazado" {{ $solicitud->estado=='rechazado'?'selected':'' }}>Rechazado</option>
                        </select>
                    </div>

                    <div class="col-span-2">
                        <label>Observaciones</label>
                        <textarea name="observaciones" class="w-full border-gray-300 rounded-lg" rows="3">{{ $solicitud->observaciones }}</textarea>
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <a href="{{ route('solicitudes.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg mr-2">Volver</a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
