<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',150);
            $table->string('apellido',150)->nullable();
            $table->string('identificacion',50)->unique();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('telefono',50)->nullable();
            $table->string('email')->nullable();
            $table->string('direccion')->nullable();
            $table->string('ocupacion')->nullable();
            $table->decimal('ingreso_mensual', 15, 2)->default(0);
            $table->enum('estado',['activo','inactivo'])->default('activo');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
