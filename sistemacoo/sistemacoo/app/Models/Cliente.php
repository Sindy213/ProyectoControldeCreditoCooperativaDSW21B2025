<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre','apellido','identificacion','fecha_nacimiento','telefono',
        'email','direccion','ocupacion','ingreso_mensual','estado'
    ];

    public function solicitudes() { return $this->hasMany(Solicitud::class); }
    public function creditos() { return $this->hasMany(Credito::class); }
    public function citas() { return $this->hasMany(Cita::class); }
}
