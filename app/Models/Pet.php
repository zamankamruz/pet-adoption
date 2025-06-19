<?php
// File: Pet.php
// Path: /app/Models/Pet.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pet extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'species',
        'breed_id',
        'category_id',
        'age_years',
        'age_months',
        'gender',
        'size',
        'color',
        'weight',
        'description',
        'personality',
        'good_with_kids',
        'good_with_pets',
        'good_with_strangers',
        'energy_level',
        'training_level',
        'health_status',
        'special_needs',
        'adoption_fee',
        'status',
        'is_featured',
        'is_urgent',
        'owner_id',
        'location_id',
        'main_image',
        'arrival_date',
        'available_date',
        'microchip_id',
        'vaccination_status',
        'spayed_neutered',
        'house_trained',
    ];

    protected $casts = [
        'good_with_kids' => 'boolean',
        'good_with_pets' => 'boolean',
        'good_with_strangers' => 'boolean',
        'is_featured' => 'boolean',
        'is_urgent' => 'boolean',
        'spayed_neutered' => 'boolean',
        'house_trained' => 'boolean',
        'arrival_date' => 'date',
        'available_date' => 'date',
        'adoption_fee' => 'decimal:2',
        'weight' => 'decimal:2',
    ];

    protected $appends = ['age_display', 'main_image_url', 'is_new'];

    // Relationships
    public function breed()
    {
        return $this->belongsTo(Breed::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function images()
    {
        return $this->hasMany(PetImage::class)->orderBy('order');
    }

    public function vaccinations()
    {
        return $this->hasMany(Vaccination::class);
    }

    public function adoptionRequests()
    {
        return $this->hasMany(Adoption::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }

    // Accessors
    public function getAgeDisplayAttribute()
    {
        if ($this->age_years > 0 && $this->age_months > 0) {
            return $this->age_years . ' years, ' . $this->age_months . ' months';
        } elseif ($this->age_years > 0) {
            return $this->age_years . ' year' . ($this->age_years > 1 ? 's' : '');
        } else {
            return $this->age_months . ' month' . ($this->age_months > 1 ? 's' : '');
        }
    }

    public function getMainImageUrlAttribute()
    {
        if ($this->main_image) {
            return asset('storage/' . $this->main_image);
        }
        return $this->images()->first() ? 
            asset('storage/' . $this->images()->first()->image_path) : 
            asset('images/default-pet.jpg');
    }

    public function getIsNewAttribute()
    {
        return $this->created_at >= now()->subDays(7);
    }

    // Scopes
    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeUrgent($query)
    {
        return $query->where('is_urgent', true);
    }

    public function scopeBySpecies($query, $species)
    {
        return $query->where('species', $species);
    }

    public function scopeBySize($query, $size)
    {
        return $query->where('size', $size);
    }

    public function scopeByAge($query, $minAge, $maxAge)
    {
        return $query->whereBetween('age_years', [$minAge, $maxAge]);
    }

    public function scopeByLocation($query, $locationId)
    {
        return $query->where('location_id', $locationId);
    }

    public function scopeGoodWithKids($query)
    {
        return $query->where('good_with_kids', true);
    }

    public function scopeGoodWithPets($query)
    {
        return $query->where('good_with_pets', true);
    }

    // Methods
    public function getAllImages()
    {
        $images = collect();
        
        if ($this->main_image) {
            $images->push([
                'url' => asset('storage/' . $this->main_image),
                'is_main' => true
            ]);
        }
        
        foreach ($this->images as $image) {
            $images->push([
                'url' => asset('storage/' . $image->image_path),
                'is_main' => false
            ]);
        }
        
        return $images;
    }

    public function canBeAdoptedBy(User $user)
    {
        return $this->status === 'available' && 
               !$this->adoptionRequests()->where('user_id', $user->id)->where('status', 'pending')->exists();
    }
}