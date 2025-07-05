<?php
// File: 2025_06_19_061518_create_rehomings_table.php (updated)
// Path: /database/migrations/2025_06_19_061518_create_rehomings_table.php

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
            $table->string('pet_name')->nullable();
            $table->string('species')->nullable();
            $table->string('breed')->nullable();
            $table->integer('age_years')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->enum('size', ['small', 'medium', 'large', 'extra_large'])->nullable();
            $table->string('color')->nullable();
            $table->text('description')->nullable();
            $table->string('reason_for_rehoming')->nullable();
            $table->string('how_long_keep')->nullable();
            $table->string('good_with_kids')->nullable();
            $table->string('good_with_pets')->nullable();
            $table->string('good_with_dogs')->nullable();
            $table->string('good_with_cats')->nullable();
            $table->string('spayed_neutered')->nullable();
            $table->string('shots_up_to_date')->nullable();
            $table->string('microchipped')->nullable();
            $table->string('house_trained')->nullable();
            $table->string('purebred')->nullable();
            $table->string('has_special_needs')->nullable();
            $table->string('has_behavioral_issues')->nullable();
            $table->string('postcode')->nullable();
            $table->string('address_line_1')->nullable();
            $table->string('address_line_2')->nullable();
            $table->string('city')->nullable();
            $table->json('images')->nullable();
            $table->json('documents')->nullable();
            $table->enum('status', ['draft', 'pending', 'approved', 'rejected', 'published', 'completed'])->default('draft');
            $table->integer('step_completed')->default(0);
            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->text('admin_notes')->nullable();
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