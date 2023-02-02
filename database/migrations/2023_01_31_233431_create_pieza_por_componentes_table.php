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
        Schema::create('pieza_por_componentes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pieza');
            $table->foreign('pieza')->references('id')->on('articulos');
            $table->foreignId('componente_por_implemento_id')->constrained();
            $table->decimal('horas',8,2)->default(0);
            $table->enum('estado',['EN USO','PARA CAMBIO','CAMBIO ORDENADO','CAMBIADO'])->default('EN USO');
            $table->timestamps();
            $table->unique(['pieza','componente_por_implemento_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pieza_por_componentes');
    }
};
