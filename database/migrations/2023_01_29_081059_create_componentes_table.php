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
        Schema::create('componentes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('articulo_id')->constrained();
            $table->string('componente')->unique();
            $table->enum('sistema',['HIDRAÚLICO','MECÁNICO','NEUMÁTICO','OLEO HIDRAÚLICO','ELECTRÓNICO']);
            $table->boolean('es_pieza')->default(false);
            $table->decimal('tiempo_de_vida',8,2);
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
        Schema::dropIfExists('componentes');
    }
};
