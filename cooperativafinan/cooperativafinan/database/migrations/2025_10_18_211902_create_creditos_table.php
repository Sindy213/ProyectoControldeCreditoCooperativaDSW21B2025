<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditosTable extends Migration
{
    public function up()
    {
        Schema::create('creditos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->foreignId('tipo_credito_id')->constrained('tipos_creditos');
            $table->string('numero_credito')->unique();
            $table->decimal('monto_capital',15,2);
            $table->decimal('tasa_anual',5,2);
            $table->integer('plazo_meses');
            $table->date('fecha_desembolso')->nullable();
            $table->date('fecha_finalizacion')->nullable();
            $table->decimal('saldo',15,2);
            $table->decimal('cuota_mensual',15,2)->nullable();
            $table->decimal('interes_total',15,2)->nullable();
            $table->enum('estado',['activo','cerrado','moroso','castigado'])->default('activo');
            $table->unsignedInteger('pagos_realizados')->default(0);
            $table->json('amortization_json')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('creditos');
    }
}
