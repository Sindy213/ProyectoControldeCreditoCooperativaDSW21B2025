<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoCredito extends Model
{
    use HasFactory;
    protected $table = 'tipos_creditos';
    protected $fillable = ['codigo','nombre','descripcion','tasa_anual','plazo_min_meses','plazo_max_meses','monto_min','monto_max','condiciones_json'];

    public function creditos(){ return $this->hasMany(Credito::class,'tipocredito_id'); }
    public function solicitudes(){ return $this->hasMany(Solicitud::class,'tipocredito_id'); }
}
