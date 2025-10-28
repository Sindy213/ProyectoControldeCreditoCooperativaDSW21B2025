<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ➕ Registrar Crédito
        </h2>
    </x-slot>

    <div class="py-8 max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow rounded-lg">
            <form action="{{ route('creditos.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block">Cliente</label>
                        <select name="cliente_id" class="w-full border-gray-300 rounded-lg" required>
                            <option value="">Seleccione un cliente</option>
                            @foreach($clientes as $c)
                                <option value="{{ $c->id }}">{{ $c->nombre }} {{ $c->apellido }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block">Tipo de crédito</label>
                        <select name="tipo_credito_id" class="w-full border-gray-300 rounded-lg" required>
                            @foreach($tipos as $t)
                                <option value="{{ $t->id }}">{{ $t->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block">Monto capital</label>
                        <input type="number" name="monto_capital" step="0.01" class="w-full border-gray-300 rounded-lg" required>
                    </div>

                    <div>
                        <label class="block">Tasa anual (%)</label>
                        <input type="number" name="tasa_anual" step="0.01" class="w-full border-gray-300 rounded-lg" required>
                    </div>

                    <div>
                        <label class="block">Plazo (meses)</label>
                        <input type="number" name="plazo_meses" class="w-full border-gray-300 rounded-lg" required>
                    </div>

                    <div>
                        <label class="block">Fecha de desembolso</label>
                        <input type="date" name="fecha_desembolso" class="w-full border-gray-300 rounded-lg" required>
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <a href="{{ route('creditos.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg mr-2">Cancelar</a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
