<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">✏️ Editar Crédito</h2>
    </x-slot>

    <div class="py-8 max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow rounded-lg">
            <form action="{{ route('creditos.update', $credito->id) }}" method="POST">
                @csrf @method('PUT')
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block">Monto capital</label>
                        <input type="number" step="0.01" name="monto_capital" value="{{ $credito->monto_capital }}" class="w-full border-gray-300 rounded-lg">
                    </div>
                    <div>
                        <label class="block">Tasa anual</label>
                        <input type="number" step="0.01" name="tasa_anual" value="{{ $credito->tasa_anual }}" class="w-full border-gray-300 rounded-lg">
                    </div>
                    <div>
                        <label class="block">Plazo (meses)</label>
                        <input type="number" name="plazo_meses" value="{{ $credito->plazo_meses }}" class="w-full border-gray-300 rounded-lg">
                    </div>
                    <div>
                        <label class="block">Estado</label>
                        <select name="estado" class="w-full border-gray-300 rounded-lg">
                            <option value="activo" {{ $credito->estado=='activo'?'selected':'' }}>Activo</option>
                            <option value="finalizado" {{ $credito->estado=='finalizado'?'selected':'' }}>Finalizado</option>
                            <option value="cancelado" {{ $credito->estado=='cancelado'?'selected':'' }}>Cancelado</option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-end mt-6">
                    <a href="{{ route('creditos.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg mr-2">Volver</a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
