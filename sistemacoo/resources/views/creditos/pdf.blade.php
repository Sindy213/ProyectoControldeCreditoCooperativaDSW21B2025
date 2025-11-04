<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte General de Créditos</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 30px;
            color: #333;
        }

        header {
            border-bottom: 3px solid #0a4a9e;
            padding-bottom: 10px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
        }

        header img {
            height: 60px;
            margin-right: 15px;
        }

        header div {
            flex-grow: 1;
        }

        header h1 {
            font-size: 18px;
            margin: 0;
            color: #0a4a9e;
        }

        header p {
            font-size: 12px;
            color: #555;
            margin: 0;
        }

        h2 {
            text-align: center;
            background-color: #0a4a9e;
            color: white;
            padding: 8px;
            border-radius: 4px;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 6px;
            text-align: center;
        }

        th {
            background-color: #e6efff;
            color: #0a4a9e;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10px;
            border-top: 1px solid #ccc;
            padding-top: 5px;
        }

        .firma {
            margin-top: 40px;
            text-align: center;
        }

        .firma .linea {
            width: 200px;
            border-top: 1px solid #000;
            margin: 0 auto;
        }

        .firma p {
            margin-top: 5px;
            font-size: 12px;
        }

        .sello {
            position: absolute;
            bottom: 100px;
            right: 80px;
            opacity: 0.1;
        }
    </style>
</head>
<body>

    <header>
        <img src="{{ public_path('images/logo.png') }}" alt="Logo">
        <div>
            <h1>Cooperativa Financiera Santa Teresa</h1>
            <p>Departamento de Créditos y Cobros</p>
            <p>Zacatecoluca, La Paz, El Salvador</p>
        </div>
    </header>

    <h2>📊 Reporte General de Créditos</h2>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Cliente</th>
                <th>Tipo</th>
                <th>Monto</th>
                <th>Tasa Anual</th>
                <th>Plazo (meses)</th>
                <th>Cuota Mensual</th>
                <th>Saldo Actual</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($creditos as $credito)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $credito->cliente->nombre }} {{ $credito->cliente->apellido }}</td>
                <td>{{ $credito->tiposcreditos->nombre }}</td>
                <td>${{ number_format($credito->monto_capital, 2) }}</td>
                <td>{{ $credito->tasa_anual }}%</td>
                <td>{{ $credito->plazo_meses }}</td>
                <td>${{ number_format($credito->cuota_mensual, 2) }}</td>
                <td>${{ number_format($credito->saldo, 2) }}</td>
                <td>
                    @if($credito->estado == 'activo')
                        🟢 Activo
                    @elseif($credito->estado == 'finalizado')
                        🔵 Finalizado
                    @else
                        🔴 Mora
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="firma">
        <div class="linea"></div>
        <p><strong>Firma del Gerente de Créditos</strong></p>
        <p>Cooperativa Financiera Santa Teresa</p>
    
        <p>Generado automáticamente por el Sistema de Control de Créditos | {{ date('d/m/Y H:i') }}</p>
    </footer>

</body>
</html>
