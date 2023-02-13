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
        Schema::create('solicitud_de_pedidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('solicitante');
            $table->foreign('solicitante')->references('id')->on('users');
            $table->foreignId('sede_id')->constrained();
            $table->foreignId('implemento_id')->constrained();
            $table->enum('estado',['PENDIENTE', 'CERRADO', 'VALIDADO', 'RECHAZADO', 'CONCLUIDO'])->default('PENDIENTE');
            $table->unsignedBigInteger('validado_por')->nullable();
            $table->foreign('validado_por')->references('id')->on('users');
            $table->foreignId('fecha_de_pedido_id')->constrained();
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
        Schema::dropIfExists('solicitud_de_pedidos');
    }
};
