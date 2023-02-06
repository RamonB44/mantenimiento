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
        Schema::create('reporte_de_tractors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tractorista');
            $table->foreign('tractorista')->references('id')->on('users');
            $table->foreignId('tractor_id')->constrained();
            $table->foreignId('labor_id')->constrained();
            $table->string('correlativo',30)->unique();
            $table->date('fecha');
            $table->enum('turno',['MAÑANA','NOCHE']);
            $table->foreignId('implemento_id')->constrained();
            $table->decimal('horometro_inicial',8,2);
            $table->decimal('horometro_final',8,2);
            $table->decimal('horas',8,2);
            $table->foreignId('lote_id')->constrained();
            $table->foreignId('sede_id')->constrained();
            $table->unsignedBigInteger('validado_por');
            $table->foreign('validado_por')->references('id')->on('users');
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
        Schema::dropIfExists('reporte_de_tractors');
    }
};
