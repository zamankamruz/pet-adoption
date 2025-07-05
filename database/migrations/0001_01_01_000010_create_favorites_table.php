<?php
// File: 2024_01_01_000011_create_favorites_table.php
// Path: /database/migrations/2024_01_01_000011_create_favorites_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('pet_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['user_id', 'pet_id']);
            $table->index('user_id');
            $table->index('pet_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};