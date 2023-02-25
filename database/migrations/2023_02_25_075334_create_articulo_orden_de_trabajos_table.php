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
        Schema::create('articulo_orden_de_trabajos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('orden_de_trabajo_id')->constrained();
            $table->foreignId('articulo_id')->constrained();
            $table->decimal('cantidad',8,2);
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
        Schema::dropIfExists('articulo_orden_de_trabajos');
    }
};
