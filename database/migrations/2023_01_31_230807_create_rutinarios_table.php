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
        Schema::create('rutinarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('programacion_de_tractor_id')->constrained();
            $table->unsignedBigInteger('operario');
            $table->foreign('operario')->references('id')->on('users');
            $table->foreignId('tarea_id')->constrained();
            $table->boolean('realizado')->default(false);
            $table->unsignedBigInteger('supervisor')->nullable();
            $table->foreign('supervisor')->references('id')->on('users');
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
        Schema::dropIfExists('rutinarios');
    }
};
