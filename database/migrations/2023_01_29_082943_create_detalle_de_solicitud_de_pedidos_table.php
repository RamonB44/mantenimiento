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
        Schema::create('detalle_de_solicitud_de_pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('solicitud_de_pedido_id')->constrained();
            $table->foreignId('articulo_id')->constrained();
            $table->decimal('cantidad_solicitada',8,2);
            $table->decimal('cantidad_validada',8,2);
            $table->decimal('estimated_price',8,2);
            $table->enum('estado',['PENDIENTE','ACEPTADO','MODIFICADO','RECHAZADO','VALIDADO','CONCLUIDO'])->default('PENDIENTE');
            $table->text('observacion')->nullable();
            $table->decimal('cantidad_usada',8,2)->default(0);
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
        Schema::dropIfExists('detalle_de_solicitud_de_pedidos');
    }
};
