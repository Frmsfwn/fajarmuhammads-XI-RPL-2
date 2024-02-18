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
        Schema::enableForeignKeyConstraints();
        Schema::create('comment', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('product_id')->constrained()->cascadeOnDelete();
            $table->integer('user_id')->constrained()->cascadeOnDelete();
            $table->string('comment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment');
    }
};