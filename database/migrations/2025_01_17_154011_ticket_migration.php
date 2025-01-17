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
        Schema::create('ticket', function (Blueprint $table) {
            $table->id('id_ticket');
            $table->bigInteger('id_seat')->unsigned();
            $table->foreign('id_seat')->references('id_seat')->on('seat');
            $table->bigInteger('id_user')->unsigned();
            $table->foreign('id_user')->references('id_user')->on('user');
            $table->float('final_price');
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
