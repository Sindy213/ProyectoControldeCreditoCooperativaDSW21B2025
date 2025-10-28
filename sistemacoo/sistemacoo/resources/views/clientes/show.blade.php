<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">📋 Detalles del Cliente</h2>
    </x-slot>

    <div class="py-8 px-6">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <table class="table table-bordered">
                <tr><th>ID</th><td>{{ $cliente->id }}</td></tr>
                <tr><th>Nombre</th><td>{{ $cliente->nombre }}</td></tr>
                <tr><th>Apellido</th><td>{{ $cliente->apellido }}</td></tr>
                <tr><th>Identificación</th><td>{{ $cliente->identificacion }}</td></tr>
                <tr><th>Teléfono</th><td>{{ $cliente->telefono }}</td></tr>
                <tr><th>Email</th><td>{{ $cliente->email }}</td></tr>
                <tr><th>Dirección</th><td>{{ $cliente->direccion }}</td></tr>
                <tr><th>Ocupación</th><td>{{ $cliente->ocupacion }}</td></tr>
                <tr><th>Ingreso mensual</th><td>${{ number_format($cliente->ingreso_mensual, 2) }}</td></tr>
                <tr><th>Estado</th><td>{{ ucfirst($cliente->estado) }}</td></tr>
            </table>

            <div class="text-end mt-4">
                <a href="{{ route('clientes.index') }}" class="btn btn-secondary">⬅️ Volver</a>
                <a href="{{ route('clientes.exportOnePdf', $cliente->id) }}" class="btn btn-danger">📄 Exportar a PDF</a>
            </div>
        </div>
    </div>
</x-app-layout>
