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
        Schema::create('epp_por_riesgos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('epp_id')->constrained();
            $table->foreignId('riesgo_id')->constrained();
            $table->timestamps();
            $table->unique(['epp_id', 'riesgo_id'],);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('epp_por_riesgos');
    }
};
