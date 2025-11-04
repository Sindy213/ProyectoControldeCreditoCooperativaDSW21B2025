<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    protected $fillable = [
        'nombre_completo',
        'dui',
        'direccion',
        'telefono',
        'email',
        'genero',
        'estado_civil',
        'fecha_nacimiento',
    ];
}
