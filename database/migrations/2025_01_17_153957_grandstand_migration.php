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
        Schema::create('grandstand', function (Blueprint $table) {
            $table->id('id_grandstand');
            $table->bigInteger('id_race')->unsigned();
            $table->foreign('id_race')->references('id_race')->on('race');
            $table->string('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('grandstand');
    }
};
