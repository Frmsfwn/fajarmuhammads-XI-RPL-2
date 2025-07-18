<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('note', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->json('content');
            $table->integer('page');
            $table->foreignUuid('book_id')->references('id')->on('book')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('note');
    }
};
