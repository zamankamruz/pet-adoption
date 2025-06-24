<?php
// File: 2025_06_24_120000_create_settings_table.php
// Path: /database/migrations/2025_06_24_120000_create_settings_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('type')->default('string'); // string, number, boolean, json
            $table->text('description')->nullable();
            $table->string('group')->default('general');
            $table->timestamps();
            
            $table->index('key');
            $table->index('group');
        });

        // Insert default settings
        $defaultSettings = [
            ['key' => 'app_name', 'value' => 'Furry Friends', 'type' => 'string', 'group' => 'general'],
            ['key' => 'app_url', 'value' => config('app.url'), 'type' => 'string', 'group' => 'general'],
            ['key' => 'app_timezone', 'value' => 'America/New_York', 'type' => 'string', 'group' => 'general'],
            ['key' => 'date_format', 'value' => 'm/d/Y', 'type' => 'string', 'group' => 'general'],
            ['key' => 'maintenance_mode', 'value' => '0', 'type' => 'boolean', 'group' => 'general'],
            
            ['key' => 'site_description', 'value' => 'A platform for pet adoption and rehoming.', 'type' => 'string', 'group' => 'site'],
            ['key' => 'contact_email', 'value' => 'contact@furryfriends.com', 'type' => 'string', 'group' => 'site'],
            ['key' => 'contact_phone', 'value' => '', 'type' => 'string', 'group' => 'site'],
            ['key' => 'address', 'value' => '', 'type' => 'string', 'group' => 'site'],
            ['key' => 'facebook_url', 'value' => '', 'type' => 'string', 'group' => 'site'],
            ['key' => 'twitter_url', 'value' => '', 'type' => 'string', 'group' => 'site'],
            ['key' => 'instagram_url', 'value' => '', 'type' => 'string', 'group' => 'site'],
            
            ['key' => 'default_adoption_fee', 'value' => '150', 'type' => 'number', 'group' => 'adoption'],
            ['key' => 'auto_approval_threshold', 'value' => '100', 'type' => 'number', 'group' => 'adoption'],
            ['key' => 'require_adoption_approval', 'value' => '1', 'type' => 'boolean', 'group' => 'adoption'],
            ['key' => 'require_home_visit', 'value' => '0', 'type' => 'boolean', 'group' => 'adoption'],
            
            ['key' => 'admin_email', 'value' => 'admin@furryfriends.com', 'type' => 'string', 'group' => 'email'],
            ['key' => 'from_email', 'value' => 'noreply@furryfriends.com', 'type' => 'string', 'group' => 'email'],
            ['key' => 'from_name', 'value' => 'Furry Friends', 'type' => 'string', 'group' => 'email'],
            ['key' => 'email_notifications', 'value' => '1', 'type' => 'boolean', 'group' => 'email'],
            ['key' => 'welcome_email', 'value' => '1', 'type' => 'boolean', 'group' => 'email'],
            
            ['key' => 'max_image_size', 'value' => '5', 'type' => 'number', 'group' => 'uploads'],
            ['key' => 'max_images_per_pet', 'value' => '10', 'type' => 'number', 'group' => 'uploads'],
            ['key' => 'allowed_image_types', 'value' => 'jpg,jpeg,png,gif', 'type' => 'string', 'group' => 'uploads'],
            ['key' => 'auto_resize_images', 'value' => '1', 'type' => 'boolean', 'group' => 'uploads'],
            ['key' => 'image_width', 'value' => '800', 'type' => 'number', 'group' => 'uploads'],
            ['key' => 'image_quality', 'value' => '85', 'type' => 'number', 'group' => 'uploads'],
            
            ['key' => 'require_email_verification', 'value' => '1', 'type' => 'boolean', 'group' => 'security'],
            ['key' => 'enable_captcha', 'value' => '0', 'type' => 'boolean', 'group' => 'security'],
            ['key' => 'session_timeout', 'value' => '120', 'type' => 'number', 'group' => 'security'],
            ['key' => 'max_login_attempts', 'value' => '5', 'type' => 'number', 'group' => 'security'],
        ];

        foreach ($defaultSettings as $setting) {
            DB::table('settings')->insert(array_merge($setting, [
                'created_at' => now(),
                'updated_at' => now()
            ]));
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};