<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tipos de Créditos</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f0f0f0; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>🏦 Tipos de Créditos</h2>
    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Tasa Anual (%)</th>
                <th>Plazo (meses)</th>
                <th>Montos ($)</th>
                <th>Condiciones (JSON)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tipos as $tipo)
            <tr>
                <td>{{ $tipo->codigo }}</td>
                <td>{{ $tipo->nombre }}</td>
                <td>{{ $tipo->tasa_anual }}</td>
                <td>{{ $tipo->plazo_min_meses }} - {{ $tipo->plazo_max_meses }}</td>
                <td>${{ number_format($tipo->monto_min,2) }} - ${{ number_format($tipo->monto_max,2) }}</td>
                <td>{{ $tipo->condiciones_json }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
