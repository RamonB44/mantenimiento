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
        Schema::create('componente_por_implementos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('articulo_id')->constrained();
            $table->foreignId('implemento_id')->constrained();
            $table->decimal('horas',8,2)->default(0);
            $table->enum('estado',['EN USO','PARA CAMBIO','CAMBIO ORDENADO','CAMBIADO'])->default('EN USO');
            $table->timestamps();
            $table->index(['articulo_id','implemento_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('componente_por_implementos');
    }
};
