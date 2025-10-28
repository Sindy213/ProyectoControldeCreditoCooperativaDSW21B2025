<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credito extends Model
{
    use HasFactory;
    protected $fillable = [
        'cliente_id','tipo_credito_id','numero_credito','monto_capital','tasa_anual','plazo_meses',
        'fecha_desembolso','fecha_finalizacion','saldo','cuota_mensual','interes_total','estado','pagos_realizados','amortization_json'
    ];

    protected $casts = [
        'amortization_json' => 'array',
        'fecha_desembolso' => 'date',
        'fecha_finalizacion' => 'date'
    ];

    public function cliente(){ return $this->belongsTo(Cliente::class); }
    public function tipo(){ return $this->belongsTo(TipoCredito::class,'tipo_credito_id'); }
    public function pagos(){ return $this->hasMany(Pago::class); }
}
