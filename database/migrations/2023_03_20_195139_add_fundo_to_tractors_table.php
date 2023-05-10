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
        Schema::table('tractors', function (Blueprint $table) {
            $table->unsignedBigInteger('fundo_id')->nullable()->after('supervisor');
            $table->foreign('fundo_id')->references('id')->on('fundos');
            $table->unsignedBigInteger('cultivo_id')->nullable()->after('fundo_id');
            $table->foreign('cultivo_id')->references('id')->on('cultivos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tractors', function (Blueprint $table) {
            //
        });
    }
};
