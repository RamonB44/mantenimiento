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
        Schema::create('pieza_por_modelos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pieza');
            $table->foreign('pieza')->references('id')->on('articulos');
            $table->foreignId('articulo_id')->constrained();
            $table->timestamps();
            $table->index(['pieza', 'articulo_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pieza_por_modelos');
    }
};
