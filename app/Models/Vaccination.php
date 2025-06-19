<?php
// File: Vaccination.php
// Path: /app/Models/Vaccination.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccination extends Model
{
    use HasFactory;

    protected $fillable = [
        'pet_id',
        'vaccine_name',
        'vaccination_date',
        'next_due_date',
        'veterinarian',
        'notes',
    ];

    protected $casts = [
        'vaccination_date' => 'date',
        'next_due_date' => 'date',
    ];

    // Relationships
    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    // Scopes
    public function scopeDueSoon($query, $days = 30)
    {
        return $query->where('next_due_date', '<=', now()->addDays($days));
    }

    public function scopeOverdue($query)
    {
        return $query->where('next_due_date', '<', now());
    }
}