<?php
// File: Rehoming.php
// Path: /app/Models/Rehoming.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rehoming extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pet_name',
        'species',
        'breed',
        'age',
        'gender',
        'size',
        'description',
        'reason_for_rehoming',
        'good_with_kids',
        'good_with_pets',
        'vaccination_status',
        'spayed_neutered',
        'house_trained',
        'special_needs',
        'contact_preferences',
        'status',
        'admin_notes',
        'step_completed',
        'submitted_at',
        'approved_at',
        'published_at',
    ];

    protected $casts = [
        'good_with_kids' => 'boolean',
        'good_with_pets' => 'boolean',
        'spayed_neutered' => 'boolean',
        'house_trained' => 'boolean',
        'contact_preferences' => 'array',
        'submitted_at' => 'datetime',
        'approved_at' => 'datetime',
        'published_at' => 'datetime',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    // Methods
    public function isComplete()
    {
        return $this->step_completed >= 3;
    }

    public function canSubmit()
    {
        return $this->isComplete() && $this->status === 'draft';
    }
}