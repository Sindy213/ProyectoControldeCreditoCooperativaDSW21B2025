<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_credito'); // Relación con créditos
            $table->date('fecha_pago');
            $table->decimal('monto_pagado', 12, 2);
            $table->decimal('saldo_restante', 12, 2);
            $table->string('cajero_responsable');
            $table->string('numero_comprobante')->unique();
            $table->timestamps();

            // Definir clave foránea si deseas relacionarla con créditos
            $table->foreign('id_credito')->references('id')->on('creditos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
