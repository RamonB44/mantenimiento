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
        Schema::create('montos_para_asignar_al_centro_de_costos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('centro_de_costo_id')->constrained();
            $table->decimal('monto_para_asignado',8,2);
            $table->boolean('esta_asignado')->default(false);
            $table->date('fecha_para_asignar');
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
        Schema::dropIfExists('montos_para_asignar_al_centro_de_costos');
    }
};
