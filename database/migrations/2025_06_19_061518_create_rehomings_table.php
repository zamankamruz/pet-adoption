<?php
// File: 2024_01_01_000010_create_rehomings_table.php
// Path: /database/migrations/2024_01_01_000010_create_rehomings_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rehomings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('pet_name');
            $table->string('species');
            $table->string('breed');
            $table->string('age');
            $table->enum('gender', ['male', 'female']);
            $table->enum('size', ['small', 'medium', 'large', 'extra_large']);
            $table->text('description');
            $table->text('reason_for_rehoming');
            $table->boolean('good_with_kids')->default(false);
            $table->boolean('good_with_pets')->default(false);
            $table->enum('vaccination_status', ['up_to_date', 'partial', 'none', 'unknown'])->default('unknown');
            $table->boolean('spayed_neutered')->default(false);
            $table->boolean('house_trained')->default(false);
            $table->text('special_needs')->nullable();
            $table->json('contact_preferences')->nullable();
            $table->enum('status', ['draft', 'pending', 'approved', 'rejected', 'published', 'completed'])->default('draft');
            $table->text('admin_notes')->nullable();
            $table->integer('step_completed')->default(0);
            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            
            $table->index(['user_id', 'status']);
            $table->index('status');
            $table->index('step_completed');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rehomings');
    }
};