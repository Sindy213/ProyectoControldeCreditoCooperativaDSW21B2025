<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">🆕 Registrar Cliente</h2>
    </x-slot>

    <div class="py-8 px-6">
        <div class="bg-white p-6 shadow rounded-lg">
            <form action="{{ route('clientes.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label>Nombre</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>
                    <div>
                        <label>Apellido</label>
                        <input type="text" name="apellido" class="form-control" required>
                    </div>
                    <div>
                        <label>Identificación</label>
                        <input type="text" name="identificacion" class="form-control" required>
                    </div>
                    <div>
                        <label>Teléfono</label>
                        <input type="text" name="telefono" class="form-control" required>
                    </div>
                    <div>
                        <label>Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div>
                        <label>Dirección</label>
                        <input type="text" name="direccion" class="form-control">
                    </div>
                    <div>
                        <label>Ocupación</label>
                        <input type="text" name="ocupacion" class="form-control">
                    </div>
                    <div>
                        <label>Ingreso mensual</label>
                        <input type="number" name="ingreso_mensual" class="form-control" step="0.01">
                    </div>
                    <div>
                        <label>Estado</label>
                        <select name="estado" class="form-control">
                            <option value="activo">Activo</option>
                            <option value="inactivo">Inactivo</option>
                        </select>
                    </div>
                </div>

                <div class="mt-6 text-end">
                    <a href="{{ route('clientes.index') }}" class="btn btn-secondary">⬅️ Volver</a>
                    <button type="submit" class="btn btn-primary">💾 Guardar</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
