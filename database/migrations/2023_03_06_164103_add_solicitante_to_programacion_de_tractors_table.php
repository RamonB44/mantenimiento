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
        Schema::table('programacion_de_tractors', function (Blueprint $table) {
            $table->unsignedBigInteger('solicitante')->nullable()->after('supervisor');
            $table->foreign('solicitante')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('programacion_de_tractors', function (Blueprint $table) {
            //
        });
    }
};
