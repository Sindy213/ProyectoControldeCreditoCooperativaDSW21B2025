<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipocreditosTable extends Migration
{
    public function up()
    {
        Schema::create('tipos_creditos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo',50)->unique();
            $table->string('nombre',150);
            $table->text('descripcion')->nullable();
            $table->decimal('tasa_anual',5,2)->default(0.0);
            $table->integer('plazo_min_meses')->default(1);
            $table->integer('plazo_max_meses')->default(60);
            $table->decimal('monto_min',15,2)->default(0);
            $table->decimal('monto_max',15,2)->default(0);
            $table->json('condiciones_json')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipocreditos');
    }
}
