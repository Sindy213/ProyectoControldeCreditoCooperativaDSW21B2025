<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    // Nombre real de la tabla
    protected $table = 'solicitudes';

    protected $fillable = [
        'cliente_id',
        'tipo_credito_id',
        'monto_solicitado',
        'plazo_meses',
        'ingresos_declared',
        'estado',
        'observaciones',
        'revisado_por'
    ];

    public function cliente() {
        return $this->belongsTo(Cliente::class);
    }

    public function tipo() {
        return $this->belongsTo(TipoCredito::class,'tipo_credito_id');
    }

    public function revisor() {
        return $this->belongsTo(\App\Models\User::class,'revisado_por');
    }
}
