<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('credito_id')->constrained('creditos')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users');
            $table->dateTime('fecha_pago');
            $table->decimal('monto_pagado',15,2);
            $table->enum('tipo_pago',['efectivo','transferencia','cheque','otro'])->default('efectivo');
            $table->decimal('saldo_despues',15,2)->nullable();
            $table->string('nota')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pagos');
    }
}
