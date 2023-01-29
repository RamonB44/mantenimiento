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
        Schema::create('tractors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('modelo_de_tractor_id')->constrained();
            $table->integer('numero_de_tractor');
            $table->decimal('horometro',8,2);
            $table->foreignId('sede_id')->constrained();
            $table->timestamps();
            $table->index(['modelo_de_tractor_id','numero_de_tractor']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tractors');
    }
};
