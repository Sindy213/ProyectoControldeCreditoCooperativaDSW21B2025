<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Reporte de Solicitudes</title>
<style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
    table { width: 100%; border-collapse: collapse; }
    th, td { border: 1px solid #000; padding: 5px; text-align: left; }
    th { background-color: #f2f2f2; }
    h2 { text-align: center; }
</style>
</head>
<body>
    <h2>📋 Reporte de Solicitudes de Crédito</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Tipo Crédito</th>
                <th>Monto Solicitado</th>
                <th>Plazo</th>
                <th>Ingresos</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($solicitudes as $s)
            <tr>
                <td>{{ $s->id }}</td>
                <td>{{ $s->cliente->nombre }} {{ $s->cliente->apellido }}</td>
                <td>{{ $s->tipo->nombre }}</td>
                <td>${{ number_format($s->monto_solicitado,2) }}</td>
                <td>{{ $s->plazo_meses }}</td>
                <td>${{ number_format($s->ingresos_declared,2) }}</td>
                <td>{{ ucfirst($s->estado) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p style="text-align:right; margin-top:20px;">Generado el {{ date('d/m/Y H:i') }}</p>
</body>
</html>
