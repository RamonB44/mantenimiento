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
        Schema::create('tarea_orden_de_trabajos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('orden_de_trabajo_id')->constrained();
            $table->foreignId('tarea_id')->constrained();
            $table->foreignId('componente_por_implemento_id')->nullable()->constrained();
            $table->foreignId('pieza_por_componente_id')->nullable()->constrained();
            $table->text('observacion')->nullable();
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
        Schema::dropIfExists('tarea_orden_de_trabajos');
    }
};
