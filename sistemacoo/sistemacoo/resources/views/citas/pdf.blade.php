<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Citas</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #eee; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>📅 Listado de Citas</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Usuario</th>
                <th>Fecha y Hora</th>
                <th>Tipo</th>
                <th>Estado</th>
                <th>Notas</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($citas as $cita)
                <tr>
                    <td>{{ $cita->id }}</td>
                    <td>{{ $cita->cliente->nombre ?? 'N/A' }}</td>
                    <td>{{ $cita->user->name ?? 'N/A' }}</td>
                    <td>{{ $cita->fecha_hora->format('d/m/Y H:i') }}</td>
                    <td>{{ $cita->tipo }}</td>
                    <td>{{ ucfirst($cita->estado) }}</td>
                    <td>{{ $cita->notas ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
