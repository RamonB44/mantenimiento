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
        Schema::create('detalle_monto_cecos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('centro_de_costo_id')->constrained();
            $table->decimal('monto',8,2);
            $table->boolean('esta_asignado')->default(false);
            $table->date('fecha_de_asignacion');
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
        Schema::dropIfExists('detalle_monto_cecos');
    }
};
