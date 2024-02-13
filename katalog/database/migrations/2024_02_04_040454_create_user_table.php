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
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id')->unique();
			$table->string('username', 20);
            $table->string('email', 30)->unique();
            $table->string('password', 20);
			$table->string('nama', 50);
			$table->string('jk');
			$table->string('notelp');
            $table->string('role', 10);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
