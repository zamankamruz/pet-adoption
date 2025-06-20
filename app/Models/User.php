<?php
// File: User.php
// Path: /app/Models/User.php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable 

{
    use  HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'city',
        'state',
        'zip_code',
        'avatar',
        'bio',
        'is_admin',
        'is_verified',
        'email_verified_at',
        'preferences',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'preferences' => 'array',
        'is_admin' => 'boolean',
        'is_verified' => 'boolean',
    ];

    // Relationships
    public function pets()
    {
        return $this->hasMany(Pet::class, 'owner_id');
    }

    public function adoptionRequests()
    {
        return $this->hasMany(Adoption::class, 'user_id');
    }

    public function rehomingRequests()
    {
        return $this->hasMany(Rehoming::class, 'user_id');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    // Accessor
    public function getFullNameAttribute()
    {
        return $this->name;
    }

    public function getAvatarUrlAttribute()
    {
        return $this->avatar ? asset('storage/' . $this->avatar) : asset('images/default-avatar.png');
    }

    // Scopes
    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    public function scopeAdmin($query)
    {
        return $query->where('is_admin', true);
    }

    // Methods
    public function favoritePets()
    {
        return $this->belongsToMany(Pet::class, 'favorites');
    }

    public function hasFavorited(Pet $pet)
    {
        return $this->favorites()->where('pet_id', $pet->id)->exists();
    }

    public function toggleFavorite(Pet $pet)
    {
        return $this->favorites()->toggle($pet->id);
    }
}