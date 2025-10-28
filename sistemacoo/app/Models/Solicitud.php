<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    // Nombre correcto de la tabla si no sigue la convención plural
    protected $table = 'solicitudes';

    // Campos que se pueden llenar masivamente
    protected $fillable = [
        'id_cliente',
        'fecha_solicitud',
        'monto_solicitado',
        'estado',
        'observaciones',
    ];

    // Relación con Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }
}
