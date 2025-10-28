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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id(); // ID autoincremental
            $table->string('nombre_completo', 150);
            $table->string('usuario', 50)->unique(); // único
            $table->string('password'); // contraseña hasheada
            $table->string('rol', 50); // admin, usuario, etc.
            $table->boolean('estado')->default(true); // true = activo, false = inactivo
            $table->timestamp('ultimo_acceso')->nullable(); // puede quedar vacío
            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
