<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Clientes</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; margin-bottom: 10px; }
    </style>
</head>
<body>
    <h2>📋 Reporte de Clientes</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre completo</th>
                <th>Identificación</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Dirección</th>
                <th>Ocupación</th>
                <th>Ingreso mensual</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->id }}</td>
                    <td>{{ $cliente->nombre }} {{ $cliente->apellido }}</td>
                    <td>{{ $cliente->identificacion }}</td>
                    <td>{{ $cliente->telefono }}</td>
                    <td>{{ $cliente->email }}</td>
                    <td>{{ $cliente->direccion }}</td>
                    <td>{{ $cliente->ocupacion }}</td>
                    <td>${{ number_format($cliente->ingreso_mensual, 2) }}</td>
                    <td>{{ ucfirst($cliente->estado) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p style="text-align:right; margin-top:20px;">Generado el {{ date('d/m/Y H:i') }}</p>
</body>
</html>
