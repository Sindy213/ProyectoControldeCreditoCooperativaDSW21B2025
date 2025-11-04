<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credito extends Model
{
    use HasFactory;

    // Campos que se pueden llenar masivamente
    protected $fillable = [
    'id_cliente',
    'tipo_credito',  // 👈 Agregado
    'monto_solicitado',
    'tasa_interes',
    'plazo_meses',
    'fecha_aprobacion',
    'estado',
     ];


    // Relación con Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
        return $this->belongsTo(Cliente::class);
    }
    
}
