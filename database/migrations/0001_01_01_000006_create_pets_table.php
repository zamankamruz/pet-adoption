<?php
// File: 2024_01_01_000007_create_pets_table.php
// Path: /database/migrations/2024_01_01_000007_create_pets_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('species'); // dog, cat, bird, etc.
            $table->foreignId('breed_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->integer('age_years')->default(0);
            $table->integer('age_months')->default(0);
            $table->enum('gender', ['male', 'female']);
            $table->enum('size', ['small', 'medium', 'large', 'extra_large']);
            $table->string('color')->nullable();
            $table->decimal('weight', 5, 2)->nullable();
            $table->text('description');
            $table->text('personality')->nullable();
            $table->boolean('good_with_kids')->default(false);
            $table->boolean('good_with_pets')->default(false);
            $table->boolean('good_with_strangers')->default(false);
            $table->enum('energy_level', ['low', 'moderate', 'high']);
            $table->enum('training_level', ['none', 'basic', 'intermediate', 'advanced']);
            $table->string('health_status')->default('healthy');
            $table->text('special_needs')->nullable();
            $table->decimal('adoption_fee', 8, 2)->default(0);
            $table->enum('status', ['available', 'pending', 'adopted', 'on_hold', 'not_available'])->default('available');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_urgent')->default(false);
            $table->foreignId('owner_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('location_id')->constrained()->onDelete('cascade');
            $table->string('main_image')->nullable();
            $table->date('arrival_date')->nullable();
            $table->date('available_date')->nullable();
            $table->string('microchip_id')->nullable();
            $table->enum('vaccination_status', ['up_to_date', 'partial', 'none', 'unknown'])->default('unknown');
            $table->boolean('spayed_neutered')->default(false);
            $table->boolean('house_trained')->default(false);
            $table->integer('views_count')->default(0);
            $table->timestamp('last_viewed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['status', 'is_featured']);
            $table->index(['species', 'breed_id']);
            $table->index(['location_id', 'status']);
            $table->index('owner_id');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};