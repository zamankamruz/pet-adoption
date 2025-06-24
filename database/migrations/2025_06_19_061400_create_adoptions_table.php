<?php
// File: 2024_01_01_000008_create_adoptions_table.php
// Path: /database/migrations/2024_01_01_000008_create_adoptions_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('adoptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('pet_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['draft', 'pending', 'approved', 'rejected', 'completed', 'cancelled'])->default('draft');
            $table->json('application_data'); // Store all form data
            $table->text('admin_notes')->nullable();
            $table->text('user_notes')->nullable();
            $table->timestamp('requested_at')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('rejected_at')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->decimal('final_fee', 8, 2)->nullable();
            $table->string('reference_number')->unique()->nullable();
            $table->integer('current_step')->default(0);
            $table->boolean('terms_accepted')->default(false);
            $table->boolean('mobile_verified')->default(false);
            $table->string('verification_code')->nullable();
            $table->timestamp('verification_sent_at')->nullable();
            $table->timestamps();
            
            $table->index(['user_id', 'status']);
            $table->index(['pet_id', 'status']);
            $table->index('status');
            $table->index('requested_at');
            $table->index('reference_number');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('adoptions');
    }
};