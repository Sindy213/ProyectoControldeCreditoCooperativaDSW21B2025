<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;
    protected $fillable = ['cliente_id','user_id','fecha_hora','tipo','estado','notas'];
    protected $casts = ['fecha_hora'=>'datetime'];
    public function cliente(){ return $this->belongsTo(Cliente::class); }
    public function user(){ return $this->belongsTo(\App\Models\User::class); }
}
