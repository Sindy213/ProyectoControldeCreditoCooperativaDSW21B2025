<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;
    protected $fillable = ['credito_id','user_id','fecha_pago','monto_pagado','tipo_pago','saldo_despues','nota'];
    protected $casts = ['fecha_pago'=>'datetime'];
    public function credito(){ return $this->belongsTo(Credito::class); }
    public function user(){ return $this->belongsTo(\App\Models\User::class); }
}
