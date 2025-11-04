<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comprobante de Pago</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            color: #333;
            margin: 40px;
            font-size: 14px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #2575fc;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header img {
            width: 80px;
            height: auto;
            margin-bottom: 10px;
        }
        .header h2 {
            color: #2575fc;
            margin: 5px 0;
        }
        .header p {
            color: #555;
            font-size: 13px;
            margin: 0;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .info-table th, .info-table td {
            padding: 10px;
            text-align: left;
        }
        .info-table th {
            background-color: #2575fc;
            color: white;
            width: 180px;
        }
        .info-table td {
            background-color: #f5f5f5;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #777;
        }
        hr {
            border: 1px dashed #ccc;
            margin: 20px 0;
        }
    </style>
</head>
<body>

    {{-- Header --}}
    <div class="header">
        <img src="{{ public_path('img/CooperativaOriginal.jpeg') }}" alt="Logo Cooperativa">
        <h2>Comprobante de Pago</h2>
        <p>Fecha: {{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') }}</p>
    </div>

    <hr>

    {{-- Información del Pago --}}
    <table class="info-table">
        <tr>
            <th>Cliente:</th>
            <td>{{ $pago->credito->cliente->nombre_completo ?? '—' }}</td>
        </tr>
        <tr>
            <th>Tipo de Crédito:</th>
            <td>{{ $pago->credito->tipo_credito ?? '—' }}</td>
        </tr>
        
        <tr>
            <th>Monto Pagado:</th>
            <td>${{ number_format($pago->monto_pagado, 2) }}</td>
        </tr>
        <tr>
            <th>Saldo Restante:</th>
            <td>${{ number_format($pago->saldo_restante, 2) }}</td>
        </tr>
        <tr>
            <th>Cajero Responsable:</th>
            <td>{{ $pago->cajero_responsable ?? '—' }}</td>
        </tr>
        <tr>
            <th>Número Comprobante:</th>
            <td>{{ $pago->numero_comprobante ?? '—' }}</td>
        </tr>
    </table>

    <div class="footer">
        Gracias por su pago. Este comprobante es generado automáticamente por el sistema.<br>
        Cooperativa Financiera - Todos los derechos reservados
    </div>

</body>
</html>
