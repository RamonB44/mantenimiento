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
        Schema::create('fecha_de_pedidos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_de_apertura'); //Fecha que se abre el pedido
            $table->date('fecha_de_cierre'); //Fecha que se cierra el pedido
            $table->date('fecha_de_pedido'); //Fecha que se hace el pedido
            $table->date('fecha_de_llegada'); //Fecha de llegada máxima
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
        Schema::dropIfExists('fecha_de_pedidos');
    }
};
