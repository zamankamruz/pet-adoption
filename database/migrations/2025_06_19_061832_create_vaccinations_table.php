<?php
// File: 2024_01_01_000013_create_vaccinations_table.php
// Path: /database/migrations/2024_01_01_000013_create_vaccinations_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vaccinations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pet_id')->constrained()->onDelete('cascade');
            $table->string('vaccine_name');
            $table->date('vaccination_date');
            $table->date('next_due_date')->nullable();
            $table->string('veterinarian')->nullable();
            $table->text('notes')->nullable();
            $table->string('batch_number')->nullable();
            $table->timestamps();
            
            $table->index(['pet_id', 'vaccination_date']);
            $table->index('next_due_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vaccinations');
    }
};