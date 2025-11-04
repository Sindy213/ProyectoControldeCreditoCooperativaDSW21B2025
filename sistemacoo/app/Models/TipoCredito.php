<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoCredito extends Model
{
    use HasFactory;

    protected $table = 'tiposcreditos';

    protected $fillable = [
        'codigo', 'nombre', 'descripcion', 'tasa_anual', 
        'plazo_min_meses', 'plazo_max_meses', 'monto_min', 
        'monto_max', 'condiciones_json'
    ];

    public function creditos() {
        return $this->hasMany(Credito::class, 'tiposcreditos_id');
    }

    public function solicitudes() {
        return $this->hasMany(Solicitud::class, 'tiposcreditos_id');
    }

    // Opciones de nombres de tipos de préstamos para el datalist
    public static function opcionesNombre() {
        return [
            'Personal',
            'Vivienda',
            'Vehicular',
            'Educativo',
            'Empresarial'
        ];
    }
}
