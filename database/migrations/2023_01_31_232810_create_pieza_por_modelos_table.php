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
            $table->foreign('pieza')->references('id')->on('componentes');
            $table->foreignId('componente_id')->constrained();
            $table->timestamps();
            $table->index(['pieza', 'componente_id']);
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
