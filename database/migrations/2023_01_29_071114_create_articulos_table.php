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
        Schema::create('articulos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('articulo')->unique();
            $table->foreignId('unidad_de_medida_id')->constrained();
            $table->decimal('precio_estimado',8,2);
            $table->enum('tipo',['FUNGIBLE','COMPONENTE','PIEZA','HERRAMIENTA']);
            $table->boolean('esta_activo')->default(true);
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
        Schema::dropIfExists('articulos');
    }
};
