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
            $table->unsignedBigInteger('tractorista');
            $table->foreign('tractorista')->references('id')->on('users');
            $table->foreignId('labor_id')->constrained();
            $table->foreignId('tractor_id')->nullable()->constrained();
            $table->date('fecha');
            $table->enum('turno',['MAÑANA','NOCHE']);
            $table->foreignId('lote_id')->constrained();
            $table->foreignId('sede_id')->constrained();
            $table->unsignedBigInteger('supervisor');
            $table->foreign('supervisor')->references('id')->on('users');
            $table->boolean('esta_anulado')->default(false);
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
