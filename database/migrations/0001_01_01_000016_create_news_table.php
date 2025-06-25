<?php
// File: create_news_table.php
// Path: /database/migrations/2024_01_01_000025_create_news_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('content');
            $table->string('featured_image')->nullable();
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade');
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->string('category')->default('general');
            $table->json('tags')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->integer('views_count')->default(0);
            $table->timestamps();
            
            $table->index(['status', 'published_at']);
            $table->index('author_id');
            $table->index('slug');
            $table->index('category');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};