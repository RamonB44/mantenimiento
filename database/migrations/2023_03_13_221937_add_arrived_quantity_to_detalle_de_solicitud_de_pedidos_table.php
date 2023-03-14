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
        Schema::table('detalle_de_solicitud_de_pedidos', function (Blueprint $table) {
            $table->decimal('cantidad_llegada',8,2)->after('observacion')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detalle_de_solicitud_de_pedidos', function (Blueprint $table) {
            //
        });
    }
};
