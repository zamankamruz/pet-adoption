<?php
// File: 2024_01_01_000005_create_breeds_table.php
// Path: /database/migrations/2024_01_01_000005_create_breeds_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('breeds', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->text('description')->nullable();
            $table->json('characteristics')->nullable();
            $table->string('average_size')->nullable();
            $table->string('life_expectancy')->nullable();
            $table->string('temperament')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index(['category_id', 'is_active']);
            $table->index('name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('breeds');
    }
};