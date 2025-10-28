<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tipos de Créditos</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        th { background-color: #f2f2f2; }
        h1 { text-align: center; }
        td { vertical-align: top; }
    </style>
</head>
<body>
    <h1>Lista de Tipos de Créditos</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Código</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Tasa Anual (%)</th>
                <th>Plazo Mínimo (meses)</th>
                <th>Plazo Máximo (meses)</th>
                <th>Monto Mínimo</th>
                <th>Monto Máximo</th>
                <th>Condiciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tipos as $t)
            <tr>
                <td>{{ $t->id }}</td>
                <td>{{ $t->codigo }}</td>
                <td>{{ $t->nombre }}</td>
                <td>{{ $t->descripcion }}</td>
                <td>{{ $t->tasa_anual }}%</td>
                <td>{{ $t->plazo_min_meses }}</td>
                <td>{{ $t->plazo_max_meses }}</td>
                <td>${{ number_format($t->monto_min,2) }}</td>
                <td>${{ number_format($t->monto_max,2) }}</td>
                <td>
                    @if($t->condiciones_json)
                        @foreach(json_decode($t->condiciones_json,true) as $key=>$val)
                            <strong>{{ $key }}:</strong> {{ $val }}<br>
                        @endforeach
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
