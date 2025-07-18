<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('book', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->references('id')->on('user')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('title');
            $table->string('description');
            $table->string('book_color');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('book');
    }
};
