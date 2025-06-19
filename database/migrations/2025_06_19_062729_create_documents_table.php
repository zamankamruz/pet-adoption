<?php
// File: 2024_01_01_000022_create_documents_table.php
// Path: /database/migrations/2024_01_01_000022_create_documents_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->morphs('documentable'); // Can be attached to adoptions, pets, etc.
            $table->string('title');
            $table->string('file_path');
            $table->string('file_name');
            $table->string('file_type');
            $table->integer('file_size');
            $table->enum('type', ['vaccination_record', 'medical_record', 'adoption_form', 'id_document', 'other']);
            $table->text('description')->nullable();
            $table->timestamps();
            
            $table->index(['documentable_type', 'documentable_id']);
            $table->index('type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};