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
        Schema::create('orden_de_trabajos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('implemento_id')->constrained();
            $table->unsignedBigInteger('operario');
            $table->foreign('operario')->references('id')->on('users');
            $table->enum('estado',['PENDIENTE','CONCLUIDO'])->default('PENDIENTE');
            $table->unsignedBigInteger('planificador');
            $table->foreign('planificador')->references('id')->on('users');
            $table->foreignId('ceco_id')->constrained();
            $table->dateTime('hora_de_inicio');
            $table->dateTime('hora_de_finalizacion')->nullable();
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
        Schema::dropIfExists('orden_de_trabajos');
    }
};
