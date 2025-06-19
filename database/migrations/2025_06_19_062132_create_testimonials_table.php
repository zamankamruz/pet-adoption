<?php
// File: 2024_01_01_000017_create_testimonials_table.php
// Path: /database/migrations/2024_01_01_000017_create_testimonials_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->text('testimonial');
            $table->integer('rating')->default(5);
            $table->string('avatar')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('pet_id')->nullable()->constrained()->onDelete('set null');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_approved')->default(false);
            $table->timestamps();
            
            $table->index(['is_approved', 'is_featured']);
            $table->index('user_id');
            $table->index('pet_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};