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
        Schema::create('creditos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_cliente'); // Relación con clientes
            $table->decimal('monto_solicitado', 10, 2); // Monto solicitado
            $table->decimal('tasa_interes', 5, 2); // Tasa de interés (%)
            $table->integer('plazo_meses'); // Plazo en meses
            $table->date('fecha_aprobacion'); // Fecha de aprobación
            $table->string('estado', 20); // Estado (ej: Pendiente, Aprobado, Rechazado)
            $table->timestamps();

            // Clave foránea
            $table->foreign('id_cliente')->references('id')->on('clientes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('creditos');
    }
};
