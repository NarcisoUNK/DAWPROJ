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
        Schema::create('seat', function (Blueprint $table) {
            $table->id('id_seat');
            $table->bigInteger('id_grandstand')->unsigned();
            $table->foreign('id_grandstand')->references('id_grandstand')->on('grandstand');
            $table->integer('n_seat_grandstand');
            $table->float('price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('seat');
    }
};
