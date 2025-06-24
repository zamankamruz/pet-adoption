<?php
// File: Setting.php
// Path: /app/Models/Setting.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'type',
        'description',
        'group',
    ];

    protected $casts = [
        'value' => 'string',
    ];

    // Scopes
    public function scopeByGroup($query, $group)
    {
        return $query->where('group', $group);
    }

    public function scopeByKey($query, $key)
    {
        return $query->where('key', $key);
    }

    // Static methods for easy access
    public static function get($key, $default = null)
    {
        $settings = Cache::remember('app_settings', 3600, function () {
            return self::all()->pluck('value', 'key');
        });

        return $settings->get($key, $default);
    }

    public static function set($key, $value, $type = 'string', $group = 'general')
    {
        $setting = self::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'type' => $type,
                'group' => $group
            ]
        );

        // Clear cache
        Cache::forget('app_settings');

        return $setting;
    }

    public static function getByGroup($group)
    {
        return self::where('group', $group)->pluck('value', 'key');
    }

    // Accessor for typed values
    public function getTypedValueAttribute()
    {
        switch ($this->type) {
            case 'boolean':
                return in_array(strtolower($this->value), ['true', '1', 'yes', 'on']);
            case 'number':
                return is_numeric($this->value) ? (float) $this->value : 0;
            case 'json':
                return json_decode($this->value, true) ?? [];
            default:
                return $this->value;
        }
    }

    // Boot method to clear cache on save/delete
    protected static function boot()
    {
        parent::boot();

        static::saved(function () {
            Cache::forget('app_settings');
        });

        static::deleted(function () {
            Cache::forget('app_settings');
        });
    }
}