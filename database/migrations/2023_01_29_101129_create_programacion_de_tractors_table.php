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
        Schema::create('programacion_de_tractors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('labor_id')->constrained();
            $table->foreignId('tractor_id')->constrained();
            $table->foreignId('implemento_id')->constrained();
            $table->date('fecha');
            $table->enum('turno',['MAÑANA','NOCHE']);
            $table->foreignId('lote_id')->constrained();
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
        Schema::dropIfExists('programacion_de_tractors');
    }
};
