<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $fillable = [
        'id_credito',
        'fecha_pago',
        'monto_pagado',
        'saldo_restante',
        'cajero_responsable',
        'numero_comprobante'
    ];

    public function credito()
    {
        return $this->belongsTo(Credito::class, 'id_credito');
    }
}
