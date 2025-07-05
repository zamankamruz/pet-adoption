<?php
// File: 2024_01_01_000008_create_pet_images_table.php
// Path: /database/migrations/2024_01_01_000008_create_pet_images_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pet_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pet_id')->constrained()->onDelete('cascade');
            $table->string('image_path');
            $table->string('thumbnail_path')->nullable();
            $table->string('alt_text')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_primary')->default(false);
            $table->timestamps();
            
            $table->index(['pet_id', 'order']);
            $table->index(['pet_id', 'is_primary']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pet_images');
    }
};