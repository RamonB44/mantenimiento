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
            $table->foreignId('user_id')->constrained();
            $table->foreignId('tractor_id')->constrained();
            $table->foreignId('labor_id')->constrained();
            $table->string('correlativo',30)->unique();
            $table->date('fecha');
            $table->enum('shift',['MAÑANA','NOCHE']);
            $table->foreignId('implemento_id')->constrained();
            $table->decimal('horometro_inicial',8,2);
            $table->decimal('horometro_final',8,2);
            $table->decimal('horas',8,2);
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
        Schema::dropIfExists('reporte_de_tractors');
    }
};
