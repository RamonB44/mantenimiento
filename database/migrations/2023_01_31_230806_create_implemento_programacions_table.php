<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('implemento_programacions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('programacion_de_tractor_id')->constrained();
            $table->foreignId('implemento_id')->constrained();
            $table->unsignedBigInteger('operario');
            $table->foreign('operario')->references('id')->on('users');
            $table->unsignedBigInteger('supervisor');
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
        Schema::dropIfExists('implemento_programacions');
    }
};
