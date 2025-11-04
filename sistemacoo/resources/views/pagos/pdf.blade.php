<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Reporte de Pagos</title>
<style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
    table { width: 100%; border-collapse: collapse; }
    th, td { border: 1px solid #000; padding: 5px; text-align: left; }
    th { background-color: #f2f2f2; }
    h2 { text-align: center; }
</style>
</head>
<body>
    <h2>📋 Reporte de Pagos</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Crédito</th>
                <th>Usuario</th>
                <th>Fecha de Pago</th>
                <th>Monto</th>
                <th>Tipo</th>
                <th>Nota</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pagos as $pago)
            <tr>
                <td>{{ $pago->id }}</td>
                <td>{{ $pago->credito->numero_credito }}</td>
                <td>{{ $pago->usuario->name }}</td>
                <td>{{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') }}</td>
                <td>${{ number_format($pago->monto_pagado,2) }}</td>
                <td>{{ $pago->tipo_pago }}</td>
                <td>{{ $pago->nota ?? '—' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p style="text-align:right; margin-top:20px;">Generado el {{ date('d/m/Y H:i') }}</p>
</body>
</html>
