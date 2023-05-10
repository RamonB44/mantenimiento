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
        Schema::table('implementos', function (Blueprint $table) {
            $table->unsignedBigInteger('supervisor')->nullable()->after('sede_id');
            $table->foreign('supervisor')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('implementos', function (Blueprint $table) {
            //
        });
    }
};
