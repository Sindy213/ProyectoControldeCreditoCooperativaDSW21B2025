<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_completo',
        'dui',
        'direccion',
        'telefono',
        'correo_electronico',
        'genero',          // <-- agregado
        'estado_civil',
        'fecha_nacimiento',
    ];
}
