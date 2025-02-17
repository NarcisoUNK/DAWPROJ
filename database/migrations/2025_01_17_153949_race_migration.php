<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('race', function (Blueprint $table) {
            $table->id('id_race');
            $table->bigInteger('id_user')->unsigned();
            $table->foreign('id_user')->references('id_user')->on('user');
            $table->string('race_name');
            $table->integer('year');
            $table->string('country');
            $table->string('city');
            $table->longText('image');
            $table->longText('circuit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('race');
    }
};
