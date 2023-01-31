<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rules\Unique;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('implementos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('modelo_del_implemento_id')->constrained();
            $table->integer('numero_del_implemento');
            $table->decimal('horas_de_uso',8,2);
            $table->unsignedBigInteger('responsable');
            $table->foreign('responsable')->references('id')->on('users');
            $table->foreignId('sede_id')->constrained();
            $table->foreignId('centro_de_costo_id')->constrained();
            $table->timestamps();
            $table->index(['modelo_del_implemento_id','numero_del_implemento']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('implementos');
    }
};
