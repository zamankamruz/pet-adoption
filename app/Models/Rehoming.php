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
        'age_years',
        'gender',
        'size',
        'color',
        'description',
        'reason_for_rehoming',
        'how_long_keep',
        'good_with_kids',
        'good_with_pets',
        'good_with_dogs',
        'good_with_cats',
        'spayed_neutered',
        'shots_up_to_date',
        'microchipped',
        'house_trained',
        'purebred',
        'has_special_needs',
        'has_behavioral_issues',
        'postcode',
        'address_line_1',
        'address_line_2',
        'city',
        'images',
        'documents',
        'status',
        'step_completed',
        'submitted_at',
        'approved_at',
        'published_at',
        'admin_notes',
    ];

    protected $casts = [
        'good_with_kids' => 'boolean',
        'good_with_pets' => 'boolean', 
        'good_with_dogs' => 'boolean',
        'good_with_cats' => 'boolean',
        'spayed_neutered' => 'boolean',
        'house_trained' => 'boolean',
        'purebred' => 'boolean',
        'has_special_needs' => 'boolean',
        'has_behavioral_issues' => 'boolean',
        'microchipped' => 'boolean',
        'images' => 'array',
        'documents' => 'array',
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
        return $this->step_completed >= 9;
    }

    public function canSubmit()
    {
        return $this->isComplete() && $this->status === 'draft';
    }

    public function getProgressPercentage()
    {
        return ($this->step_completed / 9) * 100;
    }
}