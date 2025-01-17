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
        Schema::create('user', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('username');
            $table->string('password');
            $table->string('email');
            $table->binary('permissions',3); # gerir corridas, gerir bancadas, ver analytics
            $table->string('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('user');
    }
};
