<?php
namespace App\Helpers;

class FinanceHelper
{
    // Retorna array con pago_mensual, total_pagado, interes_total y tabla
    public static function calcularAmortizacion($principal, $tasa_anual, $plazo_meses, $fecha_inicio=null) {
        $i = ($tasa_anual / 100) / 12;
        $n = (int)$plazo_meses;
        if ($n <= 0) return null;

        if ($i == 0) {
            $pago = $principal / $n;
        } else {
            $pago = $principal * ($i * pow(1 + $i, $n)) / (pow(1 + $i, $n) - 1);
        }

        $saldo = $principal;
        $tabla = [];
        $fecha = $fecha_inicio ? new \DateTime($fecha_inicio) : new \DateTime();

        for ($mes = 1; $mes <= $n; $mes++) {
            $interes = $saldo * $i;
            $principal_pagado = $pago - $interes;
            if ($mes == $n) {
                $principal_pagado = $saldo;
                $pago = $interes + $principal_pagado;
            }
            $saldo -= $principal_pagado;
            $tabla[] = [
                'mes' => $mes,
                'fecha' => $fecha->format('Y-m-d'),
                'pago' => round($pago,2),
                'interes' => round($interes,2),
                'principal' => round($principal_pagado,2),
                'saldo' => round(max($saldo,0),2),
            ];
            $fecha->modify('+1 month');
        }

        return [
            'pago_mensual' => round($pago,2),
            'total_pagado' => round(array_sum(array_column($tabla,'pago')),2),
            'interes_total' => round(array_sum(array_column($tabla,'interes')),2),
            'tabla' => $tabla
        ];
    }
}
