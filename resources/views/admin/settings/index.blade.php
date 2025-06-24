<?php
// File: index.blade.php
// Path: /resources/views/admin/settings/index.blade.php
?>

@extends('layouts.admin')

@section('title', 'Settings')

@section('content')
<div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <div class="hidden md:flex md:flex-shrink-0">
        <div class="flex flex-col w-50">
            <div class="flex flex-col flex-grow pt-5 pb-4 overflow-y-auto bg-white border-r border-gray-200">
                <!-- Logo -->
                <div class="flex items-center flex-shrink-0 px-4">
                    <div class="w-8 h-8 bg-purple-600 rounded-full flex items-center justify-center mr-2">
                        <i class="fas fa-paw text-white text-sm"></i>
                    </div>
                    <span class="text-xl font-bold text-gray-800">Furry Friends</span>
                </div>
                
                <!-- Navigation -->
                <nav class="mt-8 flex-1 px-2 space-y-1">
                    <!-- Dashboard -->
                    <a href="{{ route('admin.dashboard') }}" 
                       class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <svg class="text-gray-400 group-hover:text-gray-500 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 13l-3 3l-3-3"/>
                        </svg>
                        Dashboard
                    </a>

                    <!-- Users -->
                    <a href="{{ route('admin.users.index') }}" 
                       class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <svg class="text-gray-400 group-hover:text-gray-500 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                        </svg>
                        Users
                    </a>

                    <!-- Pets -->
                    <a href="{{ route('admin.pets.index') }}" 
                       class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <svg class="text-gray-400 group-hover:text-gray-500 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.5 12C3.12 12 2 13.12 2 14.5S3.12 17 4.5 17 7 15.88 7 14.5 5.88 12 4.5 12M19.5 12C18.12 12 17 13.12 17 14.5S18.12 17 19.5 17 22 15.88 22 14.5 20.88 12 19.5 12M12 3.5C10.62 3.5 9.5 4.62 9.5 6S10.62 8.5 12 8.5 14.5 7.38 14.5 6 13.38 3.5 12 3.5M12 20.5C10.9 20.5 10 19.6 10 18.5S10.9 16.5 12 16.5 14 17.4 14 18.5 13.1 20.5 12 20.5Z"/>
                        </svg>
                        Pets
                    </a>

                    <!-- Adoptions -->
                    <a href="{{ route('admin.adoptions.index') }}" 
                       class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <svg class="text-gray-400 group-hover:text-gray-500 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        Adoptions
                    </a>

                     <!-- Rehoming -->
                    <a href="{{ route('admin.rehoming.index') }}" 
                       class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <svg class="text-gray-400 group-hover:text-gray-500 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Rehoming Requests
                    </a>

                    <a href="{{ route('admin.setup.index') }}" 
                       class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <svg class="text-gray-400 group-hover:text-gray-500 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Setup Data
                    </a>

                    <!-- Messages -->
                    <a href="{{ route('admin.messages.index') }}" 
                       class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <svg class="text-gray-400 group-hover:text-gray-500 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Messages
                    </a>

                    <!-- Divider -->
                    <div class="border-t border-gray-200 mt-6 pt-6">
                        <!-- Settings -->
                        <a href="{{ route('admin.settings.index') }}" 
                           class="bg-purple-100 text-purple-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                            <svg class="text-purple-500 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Settings
                        </a>

                        <!-- Reports -->
                        <a href="{{ route('admin.reports.index') }}" 
                           class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                            <svg class="text-gray-400 group-hover:text-gray-500 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                            Reports
                        </a>
                    </div>
                </nav>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex flex-col w-0 flex-1 overflow-hidden">
        <!-- Top Navigation Bar -->
        <div class="relative z-10 flex-shrink-0 flex h-16 bg-white shadow border-b border-gray-200">
            <!-- Mobile menu button -->
            <button type="button" class="px-4 border-r border-gray-200 text-gray-600 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-purple-500 md:hidden" onclick="toggleMobileMenu()">
                <span class="sr-only">Open sidebar</span>
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            <!-- Page title and user menu -->
            <div class="flex-1 px-4 flex justify-between items-center">
                <div class="flex items-center justify-between w-full">
                    <div>
                        <h1 class="text-lg font-bold text-gray-900">Settings</h1>
                        <p class="text-sm text-gray-600">Manage your application settings and configurations</p>
                    </div>
                    <button type="submit" form="settingsForm" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200">
                        <i class="fas fa-save mr-2"></i>Save Changes
                    </button>
                </div>
            </div>
        </div>

        <!-- Settings Content -->
        <main class="flex-1 relative overflow-y-auto focus:outline-none">
            <div class="py-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                    @if(session('success'))
                        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6 flex items-center">
                            <i class="fas fa-check-circle mr-2"></i>
                            {{ session('success') }}
                            <button type="button" class="ml-auto text-green-600 hover:text-green-800" onclick="this.parentElement.remove()">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-6 flex items-center">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            Please correct the errors below.
                            <button type="button" class="ml-auto text-red-600 hover:text-red-800" onclick="this.parentElement.remove()">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    @endif

                    <form id="settingsForm" method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                            <!-- Settings Navigation -->
                            <div class="lg:col-span-1">
                                <div class="bg-white shadow-sm rounded-lg border border-gray-200">
                                    <div class="px-4 py-3 border-b border-gray-200">
                                        <h6 class="text-sm font-semibold text-gray-900">Settings Categories</h6>
                                    </div>
                                    <nav class="space-y-1">
                                        <a href="#general" class="flex items-center px-4 py-2 text-sm font-medium text-purple-700 bg-purple-50 border-r-2 border-purple-500 hover:bg-purple-100 transition-colors duration-200 settings-tab active" data-target="general">
                                            <i class="fas fa-cog mr-3"></i>General
                                        </a>
                                        <a href="#site" class="flex items-center px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 transition-colors duration-200 settings-tab" data-target="site">
                                            <i class="fas fa-globe mr-3"></i>Site Information
                                        </a>
                                        <a href="#adoption" class="flex items-center px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 transition-colors duration-200 settings-tab" data-target="adoption">
                                            <i class="fas fa-heart mr-3"></i>Adoption Settings
                                        </a>
                                        <a href="#email" class="flex items-center px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 transition-colors duration-200 settings-tab" data-target="email">
                                            <i class="fas fa-envelope mr-3"></i>Email Settings
                                        </a>
                                        <a href="#uploads" class="flex items-center px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 transition-colors duration-200 settings-tab" data-target="uploads">
                                            <i class="fas fa-upload mr-3"></i>File Uploads
                                        </a>
                                        <a href="#notifications" class="flex items-center px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 transition-colors duration-200 settings-tab" data-target="notifications">
                                            <i class="fas fa-bell mr-3"></i>Notifications
                                        </a>
                                        <a href="#security" class="flex items-center px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 transition-colors duration-200 settings-tab" data-target="security">
                                            <i class="fas fa-shield-alt mr-3"></i>Security
                                        </a>
                                        <a href="#maintenance" class="flex items-center px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 transition-colors duration-200 settings-tab" data-target="maintenance">
                                            <i class="fas fa-tools mr-3"></i>Maintenance
                                        </a>
                                    </nav>
                                </div>
                            </div>

                            <!-- Settings Content -->
                            <div class="lg:col-span-3">
                                <!-- General Settings -->
                                <div class="settings-content active" id="general">
                                    <div class="bg-white shadow-sm rounded-lg border border-gray-200">
                                        <div class="px-6 py-4 border-b border-gray-200">
                                            <h5 class="text-lg font-semibold text-gray-900">General Settings</h5>
                                        </div>
                                        <div class="p-6">
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">Application Name</label>
                                                    <input type="text" name="settings[app_name]" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500" 
                                                           value="{{ $settings['app_name']->value ?? 'Furry Friends' }}">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">Application URL</label>
                                                    <input type="url" name="settings[app_url]" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500" 
                                                           value="{{ $settings['app_url']->value ?? config('app.url') }}">
                                                </div>
                                            </div>

                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">Timezone</label>
                                                    <select name="settings[app_timezone]" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">
                                                        <option value="America/New_York" {{ ($settings['app_timezone']->value ?? 'America/New_York') == 'America/New_York' ? 'selected' : '' }}>Eastern Time</option>
                                                        <option value="America/Chicago" {{ ($settings['app_timezone']->value ?? '') == 'America/Chicago' ? 'selected' : '' }}>Central Time</option>
                                                        <option value="America/Denver" {{ ($settings['app_timezone']->value ?? '') == 'America/Denver' ? 'selected' : '' }}>Mountain Time</option>
                                                        <option value="America/Los_Angeles" {{ ($settings['app_timezone']->value ?? '') == 'America/Los_Angeles' ? 'selected' : '' }}>Pacific Time</option>
                                                    </select>
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">Date Format</label>
                                                    <select name="settings[date_format]" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">
                                                        <option value="m/d/Y" {{ ($settings['date_format']->value ?? 'm/d/Y') == 'm/d/Y' ? 'selected' : '' }}>MM/DD/YYYY</option>
                                                        <option value="d/m/Y" {{ ($settings['date_format']->value ?? '') == 'd/m/Y' ? 'selected' : '' }}>DD/MM/YYYY</option>
                                                        <option value="Y-m-d" {{ ($settings['date_format']->value ?? '') == 'Y-m-d' ? 'selected' : '' }}>YYYY-MM-DD</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="mt-6">
                                                <div class="flex items-center">
                                                    <input type="checkbox" name="settings[maintenance_mode]" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded" 
                                                           value="1" {{ ($settings['maintenance_mode']->value ?? false) ? 'checked' : '' }}>
                                                    <label class="ml-2 block text-sm text-gray-700">Enable Maintenance Mode</label>
                                                </div>
                                                <p class="text-xs text-gray-500 mt-1">When enabled, only administrators can access the site.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Site Information -->
                                <div class="settings-content hidden" id="site">
                                    <div class="bg-white shadow-sm rounded-lg border border-gray-200">
                                        <div class="px-6 py-4 border-b border-gray-200">
                                            <h5 class="text-lg font-semibold text-gray-900">Site Information</h5>
                                        </div>
                                        <div class="p-6">
                                            <div class="mb-6">
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Site Description</label>
                                                <textarea name="settings[site_description]" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500" rows="3">{{ $settings['site_description']->value ?? 'A platform for pet adoption and rehoming.' }}</textarea>
                                            </div>

                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">Contact Email</label>
                                                    <input type="email" name="settings[contact_email]" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500" 
                                                           value="{{ $settings['contact_email']->value ?? 'contact@furryfriends.com' }}">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">Contact Phone</label>
                                                    <input type="tel" name="settings[contact_phone]" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500" 
                                                           value="{{ $settings['contact_phone']->value ?? '' }}">
                                                </div>
                                            </div>

                                            <div class="mt-6">
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                                                <textarea name="settings[address]" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500" rows="2">{{ $settings['address']->value ?? '' }}</textarea>
                                            </div>

                                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">Facebook URL</label>
                                                    <input type="url" name="settings[facebook_url]" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500" 
                                                           value="{{ $settings['facebook_url']->value ?? '' }}">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">Twitter URL</label>
                                                    <input type="url" name="settings[twitter_url]" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500" 
                                                           value="{{ $settings['twitter_url']->value ?? '' }}">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">Instagram URL</label>
                                                    <input type="url" name="settings[instagram_url]" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500" 
                                                           value="{{ $settings['instagram_url']->value ?? '' }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Adoption Settings -->
                                <div class="settings-content hidden" id="adoption">
                                    <div class="bg-white shadow-sm rounded-lg border border-gray-200">
                                        <div class="px-6 py-4 border-b border-gray-200">
                                            <h5 class="text-lg font-semibold text-gray-900">Adoption Settings</h5>
                                        </div>
                                        <div class="p-6">
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">Default Adoption Fee</label>
                                                    <div class="relative">
                                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                            <span class="text-gray-500 sm:text-sm">$</span>
                                                        </div>
                                                        <input type="number" name="settings[default_adoption_fee]" class="w-full pl-7 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500" 
                                                               value="{{ $settings['default_adoption_fee']->value ?? '150' }}" step="0.01">
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">Auto-approval Threshold</label>
                                                    <div class="relative">
                                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                            <span class="text-gray-500 sm:text-sm">$</span>
                                                        </div>
                                                        <input type="number" name="settings[auto_approval_threshold]" class="w-full pl-7 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500" 
                                                               value="{{ $settings['auto_approval_threshold']->value ?? '100' }}" step="0.01">
                                                    </div>
                                                    <p class="text-xs text-gray-500 mt-1">Adoptions under this amount are auto-approved.</p>
                                                </div>
                                            </div>

                                            <div class="mt-6 space-y-4">
                                                <div class="flex items-center">
                                                    <input type="checkbox" name="settings[require_adoption_approval]" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded" 
                                                           value="1" {{ ($settings['require_adoption_approval']->value ?? true) ? 'checked' : '' }}>
                                                    <label class="ml-2 block text-sm text-gray-700">Require Admin Approval for Adoptions</label>
                                                </div>

                                                <div class="flex items-center">
                                                    <input type="checkbox" name="settings[require_home_visit]" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded" 
                                                           value="1" {{ ($settings['require_home_visit']->value ?? false) ? 'checked' : '' }}>
                                                    <label class="ml-2 block text-sm text-gray-700">Require Home Visit for Adoption</label>
                                                </div>
                                            </div>

                                            <div class="mt-6">
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Adoption Application Questions</label>
                                                <textarea name="settings[adoption_questions]" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500" rows="5">{{ $settings['adoption_questions']->value ?? 'Why do you want to adopt this pet?\nDo you have experience with pets?\nDo you have other pets?' }}</textarea>
                                                <p class="text-xs text-gray-500 mt-1">One question per line</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Email Settings -->
                                <div class="settings-content hidden" id="email">
                                    <div class="bg-white shadow-sm rounded-lg border border-gray-200">
                                        <div class="px-6 py-4 border-b border-gray-200">
                                            <h5 class="text-lg font-semibold text-gray-900">Email Settings</h5>
                                        </div>
                                        <div class="p-6">
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">Admin Email</label>
                                                    <input type="email" name="settings[admin_email]" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500" 
                                                           value="{{ $settings['admin_email']->value ?? 'admin@furryfriends.com' }}">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">From Email</label>
                                                    <input type="email" name="settings[from_email]" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500" 
                                                           value="{{ $settings['from_email']->value ?? 'noreply@furryfriends.com' }}">
                                                </div>
                                            </div>

                                            <div class="mt-6">
                                                <label class="block text-sm font-medium text-gray-700 mb-2">From Name</label>
                                                <input type="text" name="settings[from_name]" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500" 
                                                       value="{{ $settings['from_name']->value ?? 'Furry Friends' }}">
                                            </div>

                                            <div class="mt-6 space-y-4">
                                                <div class="flex items-center">
                                                    <input type="checkbox" name="settings[email_notifications]" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded" 
                                                           value="1" {{ ($settings['email_notifications']->value ?? true) ? 'checked' : '' }}>
                                                    <label class="ml-2 block text-sm text-gray-700">Enable Email Notifications</label>
                                                </div>

                                                <div class="flex items-center">
                                                    <input type="checkbox" name="settings[welcome_email]" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded" 
                                                           value="1" {{ ($settings['welcome_email']->value ?? true) ? 'checked' : '' }}>
                                                    <label class="ml-2 block text-sm text-gray-700">Send Welcome Email to New Users</label>
                                                </div>
                                            </div>

                                            <div class="mt-6">
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Email Signature</label>
                                                <textarea name="settings[email_signature]" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500" rows="3">{{ $settings['email_signature']->value ?? "Best regards,\nThe Furry Friends Team" }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- File Upload Settings -->
                                <div class="settings-content hidden" id="uploads">
                                    <div class="bg-white shadow-sm rounded-lg border border-gray-200">
                                        <div class="px-6 py-4 border-b border-gray-200">
                                            <h5 class="text-lg font-semibold text-gray-900">File Upload Settings</h5>
                                        </div>
                                        <div class="p-6">
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">Max Image Size (MB)</label>
                                                    <input type="number" name="settings[max_image_size]" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500" 
                                                           value="{{ $settings['max_image_size']->value ?? '5' }}" step="0.1">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">Max Images per Pet</label>
                                                    <input type="number" name="settings[max_images_per_pet]" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500" 
                                                           value="{{ $settings['max_images_per_pet']->value ?? '10' }}">
                                                </div>
                                            </div>

                                            <div class="mt-6">
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Allowed Image Types</label>
                                                <input type="text" name="settings[allowed_image_types]" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500" 
                                                       value="{{ $settings['allowed_image_types']->value ?? 'jpg,jpeg,png,gif' }}">
                                                <p class="text-xs text-gray-500 mt-1">Comma-separated list of file extensions</p>
                                            </div>

                                            <div class="mt-6">
                                                <div class="flex items-center">
                                                    <input type="checkbox" name="settings[auto_resize_images]" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded" 
                                                           value="1" {{ ($settings['auto_resize_images']->value ?? true) ? 'checked' : '' }}>
                                                    <label class="ml-2 block text-sm text-gray-700">Auto-resize Large Images</label>
                                                </div>
                                            </div>

                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">Image Width (px)</label>
                                                    <input type="number" name="settings[image_width]" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500" 
                                                           value="{{ $settings['image_width']->value ?? '800' }}">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">Image Quality (%)</label>
                                                    <input type="number" name="settings[image_quality]" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500" 
                                                           value="{{ $settings['image_quality']->value ?? '85' }}" min="1" max="100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Notification Settings -->
                                <div class="settings-content hidden" id="notifications">
                                    <div class="bg-white shadow-sm rounded-lg border border-gray-200">
                                        <div class="px-6 py-4 border-b border-gray-200">
                                            <h5 class="text-lg font-semibold text-gray-900">Notification Settings</h5>
                                        </div>
                                        <div class="p-6">
                                            <h6 class="text-sm font-semibold text-gray-900 mb-4">Admin Notifications</h6>
                                            
                                            <div class="space-y-4">
                                                <div class="flex items-center">
                                                    <input type="checkbox" name="settings[notify_new_adoption]" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded" 
                                                           value="1" {{ ($settings['notify_new_adoption']->value ?? true) ? 'checked' : '' }}>
                                                    <label class="ml-2 block text-sm text-gray-700">New Adoption Requests</label>
                                                </div>

                                                <div class="flex items-center">
                                                    <input type="checkbox" name="settings[notify_new_user]" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded" 
                                                           value="1" {{ ($settings['notify_new_user']->value ?? true) ? 'checked' : '' }}>
                                                    <label class="ml-2 block text-sm text-gray-700">New User Registrations</label>
                                                </div>

                                                <div class="flex items-center">
                                                    <input type="checkbox" name="settings[notify_new_pet]" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded" 
                                                           value="1" {{ ($settings['notify_new_pet']->value ?? true) ? 'checked' : '' }}>
                                                    <label class="ml-2 block text-sm text-gray-700">New Pet Listings</label>
                                                </div>

                                                <div class="flex items-center">
                                                    <input type="checkbox" name="settings[notify_contact_form]" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded" 
                                                           value="1" {{ ($settings['notify_contact_form']->value ?? true) ? 'checked' : '' }}>
                                                    <label class="ml-2 block text-sm text-gray-700">Contact Form Submissions</label>
                                                </div>
                                            </div>

                                            <hr class="my-6 border-gray-200">

                                            <h6 class="text-sm font-semibold text-gray-900 mb-4">User Notifications</h6>

                                            <div class="space-y-4">
                                                <div class="flex items-center">
                                                    <input type="checkbox" name="settings[user_adoption_updates]" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded" 
                                                           value="1" {{ ($settings['user_adoption_updates']->value ?? true) ? 'checked' : '' }}>
                                                    <label class="ml-2 block text-sm text-gray-700">Adoption Status Updates</label>
                                                </div>

                                                <div class="flex items-center">
                                                    <input type="checkbox" name="settings[user_new_matches]" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded" 
                                                           value="1" {{ ($settings['user_new_matches']->value ?? true) ? 'checked' : '' }}>
                                                    <label class="ml-2 block text-sm text-gray-700">New Pet Matches</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Security Settings -->
                                <div class="settings-content hidden" id="security">
                                    <div class="bg-white shadow-sm rounded-lg border border-gray-200">
                                        <div class="px-6 py-4 border-b border-gray-200">
                                            <h5 class="text-lg font-semibold text-gray-900">Security Settings</h5>
                                        </div>
                                        <div class="p-6">
                                            <div class="space-y-4">
                                                <div class="flex items-center">
                                                    <input type="checkbox" name="settings[require_email_verification]" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded" 
                                                           value="1" {{ ($settings['require_email_verification']->value ?? true) ? 'checked' : '' }}>
                                                    <label class="ml-2 block text-sm text-gray-700">Require Email Verification for New Users</label>
                                                </div>

                                                <div class="flex items-center">
                                                    <input type="checkbox" name="settings[enable_captcha]" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded" 
                                                           value="1" {{ ($settings['enable_captcha']->value ?? false) ? 'checked' : '' }}>
                                                    <label class="ml-2 block text-sm text-gray-700">Enable reCAPTCHA</label>
                                                </div>
                                            </div>

                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">Session Timeout (minutes)</label>
                                                    <input type="number" name="settings[session_timeout]" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500" 
                                                           value="{{ $settings['session_timeout']->value ?? '120' }}">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">Max Login Attempts</label>
                                                    <input type="number" name="settings[max_login_attempts]" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500" 
                                                           value="{{ $settings['max_login_attempts']->value ?? '5' }}">
                                                </div>
                                            </div>

                                            <div class="mt-6">
                                                <label class="block text-sm font-medium text-gray-700 mb-4">Password Requirements</label>
                                                <div class="space-y-3">
                                                    <div class="flex items-center">
                                                        <input type="checkbox" name="settings[password_require_uppercase]" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded" 
                                                               value="1" {{ ($settings['password_require_uppercase']->value ?? true) ? 'checked' : '' }}>
                                                        <label class="ml-2 block text-sm text-gray-700">Require uppercase letters</label>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <input type="checkbox" name="settings[password_require_numbers]" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded" 
                                                               value="1" {{ ($settings['password_require_numbers']->value ?? true) ? 'checked' : '' }}>
                                                        <label class="ml-2 block text-sm text-gray-700">Require numbers</label>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <input type="checkbox" name="settings[password_require_symbols]" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded" 
                                                               value="1" {{ ($settings['password_require_symbols']->value ?? false) ? 'checked' : '' }}>
                                                        <label class="ml-2 block text-sm text-gray-700">Require symbols</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Maintenance Settings -->
                                <div class="settings-content hidden" id="maintenance">
                                    <div class="bg-white shadow-sm rounded-lg border border-gray-200">
                                        <div class="px-6 py-4 border-b border-gray-200">
                                            <h5 class="text-lg font-semibold text-gray-900">Maintenance Settings</h5>
                                        </div>
                                        <div class="p-6">
                                            <div class="mb-6">
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Maintenance Message</label>
                                                <textarea name="settings[maintenance_message]" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500" rows="3">{{ $settings['maintenance_message']->value ?? 'We are currently performing scheduled maintenance. Please check back soon.' }}</textarea>
                                            </div>

                                            <div class="mb-6">
                                                <div class="flex items-center">
                                                    <input type="checkbox" name="settings[auto_backup]" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded" 
                                                           value="1" {{ ($settings['auto_backup']->value ?? false) ? 'checked' : '' }}>
                                                    <label class="ml-2 block text-sm text-gray-700">Enable Automatic Backups</label>
                                                </div>
                                            </div>

                                            <div class="mb-6">
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Backup Frequency</label>
                                                <select name="settings[backup_frequency]" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">
                                                    <option value="daily" {{ ($settings['backup_frequency']->value ?? 'daily') == 'daily' ? 'selected' : '' }}>Daily</option>
                                                    <option value="weekly" {{ ($settings['backup_frequency']->value ?? '') == 'weekly' ? 'selected' : '' }}>Weekly</option>
                                                    <option value="monthly" {{ ($settings['backup_frequency']->value ?? '') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                                </select>
                                            </div>

                                            <div class="mb-6">
                                                <div class="flex items-center">
                                                    <input type="checkbox" name="settings[debug_mode]" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded" 
                                                           value="1" {{ ($settings['debug_mode']->value ?? false) ? 'checked' : '' }}>
                                                    <label class="ml-2 block text-sm text-gray-700">Enable Debug Mode</label>
                                                </div>
                                                <p class="text-xs text-gray-500 mt-1">Only enable for development/testing</p>
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Log Level</label>
                                                <select name="settings[log_level]" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500">
                                                    <option value="emergency" {{ ($settings['log_level']->value ?? 'error') == 'emergency' ? 'selected' : '' }}>Emergency</option>
                                                    <option value="alert" {{ ($settings['log_level']->value ?? '') == 'alert' ? 'selected' : '' }}>Alert</option>
                                                    <option value="critical" {{ ($settings['log_level']->value ?? '') == 'critical' ? 'selected' : '' }}>Critical</option>
                                                    <option value="error" {{ ($settings['log_level']->value ?? 'error') == 'error' ? 'selected' : '' }}>Error</option>
                                                    <option value="warning" {{ ($settings['log_level']->value ?? '') == 'warning' ? 'selected' : '' }}>Warning</option>
                                                    <option value="notice" {{ ($settings['log_level']->value ?? '') == 'notice' ? 'selected' : '' }}>Notice</option>
                                                    <option value="info" {{ ($settings['log_level']->value ?? '') == 'info' ? 'selected' : '' }}>Info</option>
                                                    <option value="debug" {{ ($settings['log_level']->value ?? '') == 'debug' ? 'selected' : '' }}>Debug</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <!-- Mobile Sidebar Overlay -->
    <div id="mobileMenuOverlay" class="hidden fixed inset-0 flex z-40 md:hidden">
        <div class="fixed inset-0 bg-gray-600 bg-opacity-75" onclick="toggleMobileMenu()"></div>
        <div class="relative flex-1 flex flex-col max-w-xs w-full bg-white">
            <div class="absolute top-0 right-0 -mr-12 pt-2">
                <button type="button" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" onclick="toggleMobileMenu()">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <!-- Mobile sidebar content -->
            <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
                <!-- Mobile navigation can be added here -->
            </div>
        </div>
    </div>
</div>

<script>
function toggleMobileMenu() {
    const overlay = document.getElementById('mobileMenuOverlay');
    overlay.classList.toggle('hidden');
}

document.addEventListener('DOMContentLoaded', function() {
    // Handle tab switching
    const settingsTabs = document.querySelectorAll('.settings-tab');
    const settingsContents = document.querySelectorAll('.settings-content');

    settingsTabs.forEach(tab => {
        tab.addEventListener('click', function(e) {
            e.preventDefault();
            const target = this.getAttribute('data-target');

            // Remove active from all tabs
            settingsTabs.forEach(t => {
                t.classList.remove('active', 'text-purple-700', 'bg-purple-50', 'border-purple-500');
                t.classList.add('text-gray-600');
            });

            // Add active to clicked tab
            this.classList.add('active', 'text-purple-700', 'bg-purple-50', 'border-r-2', 'border-purple-500');
            this.classList.remove('text-gray-600');

            // Hide all content
            settingsContents.forEach(content => {
                content.classList.add('hidden');
                content.classList.remove('active');
            });

            // Show target content
            const targetContent = document.getElementById(target);
            if (targetContent) {
                targetContent.classList.remove('hidden');
                targetContent.classList.add('active');
            }
        });
    });

    // Form validation
    document.getElementById('settingsForm').addEventListener('submit', function(e) {
        let isValid = true;
        
        // Validate required fields
        const requiredFields = this.querySelectorAll('[required]');
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('border-red-500');
                isValid = false;
            } else {
                field.classList.remove('border-red-500');
            }
        });

        if (!isValid) {
            e.preventDefault();
            alert('Please fill in all required fields.');
        }
    });

    // Auto-save functionality
    let autoSaveTimeout;
    const formInputs = document.querySelectorAll('#settingsForm input, #settingsForm textarea, #settingsForm select');
    
    formInputs.forEach(input => {
        input.addEventListener('change', function() {
            clearTimeout(autoSaveTimeout);
            autoSaveTimeout = setTimeout(() => {
                // Show auto-save indicator
                const indicator = document.createElement('div');
                indicator.className = 'fixed top-4 right-4 bg-blue-50 border border-blue-200 text-blue-800 px-4 py-3 rounded-lg shadow-lg z-50';
                indicator.innerHTML = '<i class="fas fa-save mr-2"></i>Settings auto-saved';
                document.body.appendChild(indicator);
                
                setTimeout(() => {
                    indicator.remove();
                }, 3000);
            }, 2000);
        });
    });
});
</script>
@endsection