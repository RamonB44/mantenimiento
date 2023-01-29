<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitud_de_nuevo_articulos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('solicitud_de_pedido_id')->constrained();
            $table->string('nuevo_articulo');
            $table->decimal('cantidad','8,2');
            $table->foreignId('unidad_de_medida_id')->constrained();
            $table->text('ficha_tecnica');
            $table->string('imagen',2048)->nullable();
            $table->enum('estado',['PENDIENTE','CREADO','RECHAZADO'])->default('PENDIENTE');
            $table->foreignId('articulo_id')->nullable()->constrained();
            $table->text('observation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitud_de_nuevo_articulos');
    }
};
