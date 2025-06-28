<?php
// File: broadcast.blade.php
// Path: /resources/views/admin/newsletter/broadcast.blade.php
?>
@extends('layouts.admin')
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
                    Rehoming
                </a>
                
                <a href="{{ route('admin.setup.index') }}" 
                   class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                    <svg class="text-gray-400 group-hover:text-gray-500 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Setup Data
                </a>

                <!-- News -->
                <a href="{{ route('admin.news.index') }}" 
                   class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                    <svg class="text-gray-400 group-hover:text-gray-500 mr-3 h-5 w-5"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 20H5a2 2 0 01-2-2V7a2 2 0 012-2h3l2-2h4l2 2h3a2 2 0 012 2v11a2 2 0 01-2 2zM7 10h10M7 14h10M7 18h10" />
                    </svg>
                    News
                </a>

                <!-- Testimonials -->
                <a href="{{ route('admin.testimonials.index') }}" 
                   class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                    <svg class="text-gray-400 group-hover:text-gray-500 mr-3 h-5 w-5"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 20H5a2 2 0 01-2-2V7a2 2 0 012-2h3l2-2h4l2 2h3a2 2 0 012 2v11a2 2 0 01-2 2zM7 10h10M7 14h10M7 18h10" />
                    </svg>
                    Testimonials
                </a>

                <!-- Messages -->
                <a href="{{ route('admin.messages.index') }}" 
                   class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                    <svg class="text-gray-400 group-hover:text-gray-500 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Messages
                </a>

<!-- Newsletter - Active -->
<a href="{{ route('admin.newsletter.index') }}" 
   class="bg-purple-100 text-purple-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
    <svg class="text-purple-500 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
              d="M3 10l9 4-9 4V6l18 6-18 6" />
    </svg>
    Newsletter
</a>


                <!-- Divider -->
                <div class="border-t border-gray-200 mt-6 pt-6">
                    <!-- Settings -->
                    <a href="{{ route('admin.settings.index') }}" 
                       class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <svg class="text-gray-400 group-hover:text-gray-500 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
            <div>
                <h1 class="text-lg font-bold text-gray-900">Send Newsletter Broadcast</h1>
                <p class="text-sm text-gray-600">Send a newsletter to all or active subscribers</p>
            </div>
            
            <!-- User Menu -->
            <div class="ml-4 flex items-center md:ml-6">
                <div class="relative">
                    <button type="button" class="max-w-xs bg-white flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500" onclick="toggleUserMenu()">
                        <span class="sr-only">Open user menu</span>
                        @if(auth()->user()->avatar)
                            <img class="h-8 w-8 rounded-full" src="{{ auth()->user()->avatar_url }}" alt="{{ auth()->user()->name }}">
                        @else
                            <div class="h-8 w-8 bg-purple-600 rounded-full flex items-center justify-center">
                                <span class="text-white text-sm font-medium">{{ substr(auth()->user()->name, 0, 1) }}</span>
                            </div>
                        @endif
                        <span class="ml-2 text-gray-700 text-sm">{{ auth()->user()->name }}</span>
                        <svg class="ml-1 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    
                    <!-- User Dropdown Menu -->
                    <div id="userMenu" class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                        <div class="py-1">
                            <a href="{{ route('user.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-user mr-2"></i>Your Profile
                            </a>
                            <a href="{{ route('user.settings') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-cog mr-2"></i>Settings
                            </a>
                            <div class="border-t border-gray-100"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Sign out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Area -->
    <main class="flex-1 relative overflow-y-auto focus:outline-none">
        <div class="py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                <!-- Back Button -->
                <div class="mb-6">
                    <a href="{{ route('admin.newsletter.index') }}" 
                       class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                        <i class="fas fa-arrow-left mr-2"></i>Back to Subscribers
                    </a>
                </div>

                <!-- Broadcast Form -->
                <div class="bg-white shadow-lg rounded-lg">
                    <form method="POST" action="{{ route('admin.newsletter.send-broadcast') }}">
                        @csrf
                        <div class="p-6 space-y-6">
                            <!-- Recipients -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-3">Send To</label>
                                <div class="space-y-3">
                                    <label class="flex items-center">
                                        <input type="radio" name="send_to" value="active_only" checked 
                                               class="text-purple-600 focus:ring-purple-500">
                                        <span class="ml-2 text-sm text-gray-700">Active subscribers only (recommended)</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="send_to" value="all" 
                                               class="text-purple-600 focus:ring-purple-500">
                                        <span class="ml-2 text-sm text-gray-700">All subscribers (including inactive)</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Subject -->
                            <div>
                                <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject *</label>
                                <input type="text" 
                                       id="subject" 
                                       name="subject" 
                                       value="{{ old('subject') }}"
                                       required 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 @error('subject') border-red-500 @enderror"
                                       placeholder="Enter email subject">
                                @error('subject')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Message -->
                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message *</label>
                                <div class="border border-gray-300 rounded-lg overflow-hidden @error('message') border-red-500 @enderror">
                                    <div class="bg-gray-50 px-3 py-2 border-b border-gray-300">
                                        <div class="flex items-center space-x-2">
                                            <button type="button" onclick="formatText('bold')" class="p-1 hover:bg-gray-200 rounded text-sm">
                                                <i class="fas fa-bold text-sm"></i>
                                            </button>
                                            <button type="button" onclick="formatText('italic')" class="p-1 hover:bg-gray-200 rounded text-sm">
                                                <i class="fas fa-italic text-sm"></i>
                                            </button>
                                            <button type="button" onclick="formatText('underline')" class="p-1 hover:bg-gray-200 rounded text-sm">
                                                <i class="fas fa-underline text-sm"></i>
                                            </button>
                                            <div class="w-px h-6 bg-gray-300"></div>
                                            <button type="button" onclick="insertVariable('@{{name}}')" class="text-sm px-2 py-1 bg-purple-100 text-purple-700 rounded hover:bg-purple-200">Insert Name</button>
                                            <button type="button" onclick="insertVariable('@{{email}}')" class="text-sm px-2 py-1 bg-purple-100 text-purple-700 rounded hover:bg-purple-200">Insert Email</button>
                                        </div>
                                    </div>
                                    <textarea id="message" 
                                              name="message" 
                                              rows="12" 
                                              required 
                                              class="w-full px-3 py-3 border-0 focus:ring-0 resize-none text-sm"
                                              placeholder="Enter your newsletter message here...">{{ old('message') }}</textarea>
                                </div>
                                @error('message')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                               <p class="mt-2 text-sm text-gray-500">
                                    Use <code class="bg-gray-100 px-1 rounded">@{{name}}</code> to insert subscriber's name and <code class="bg-gray-100 px-1 rounded">@{{email}}</code> for their email address.
                                </p>
                            </div>

                            <!-- Preview -->
                            <div>
                                <button type="button" 
                                        onclick="togglePreview()" 
                                        class="mb-3 text-purple-600 hover:text-purple-800 font-medium text-sm">
                                    <i class="fas fa-eye mr-1"></i>Preview Email
                                </button>
                                
                                <div id="preview-panel" class="hidden border border-gray-300 rounded-lg p-4 bg-gray-50">
                                    <h4 class="font-semibold text-gray-900 mb-2 text-sm">Email Preview</h4>
                                    <div class="bg-white border rounded p-4">
                                        <div class="border-b pb-2 mb-3">
                                            <strong class="text-sm">Subject:</strong> <span id="preview-subject" class="text-sm">Enter subject above</span>
                                        </div>
                                        <div id="preview-content" class="text-sm">Enter message above</div>
                                        <div class="mt-4 pt-3 border-t text-xs text-gray-500">
                                            <p>This is a preview. Variables like <code class="bg-gray-100 px-1 rounded">@{{name}}</code> will be replaced with actual subscriber data.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-between items-center">
                            <div class="text-sm text-gray-600">
                                <i class="fas fa-info-circle mr-1"></i>
                                This will send the newsletter to all selected subscribers immediately.
                            </div>
                            
                            <div class="flex space-x-3">
                                <a href="{{ route('admin.newsletter.index') }}" 
                                   class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium transition-colors duration-200 text-sm">
                                    Cancel
                                </a>
                                <button type="submit" 
                                        onclick="return confirmSend()"
                                        class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-200 text-sm">
                                    <i class="fas fa-paper-plane mr-2"></i>Send Newsletter
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
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
        <!-- Mobile sidebar content (same as desktop) -->
        <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
            <!-- Mobile navigation would go here -->
        </div>
    </div>
</div>
</div>
<script>
function toggleMobileMenu() {
    const overlay = document.getElementById('mobileMenuOverlay');
    overlay.classList.toggle('hidden');
}

function toggleUserMenu() {
    const menu = document.getElementById('userMenu');
    menu.classList.toggle('hidden');
}

// Close user menu when clicking outside
document.addEventListener('click', function(event) {
    const userMenu = document.getElementById('userMenu');
    const userButton = event.target.closest('button');
    
    if (!userButton || !userButton.onclick.toString().includes('toggleUserMenu')) {
        userMenu.classList.add('hidden');
    }
});

function formatText(command) {
    document.execCommand(command, false, null);
    document.getElementById('message').focus();
}

function insertVariable(variable) {
    const textarea = document.getElementById('message');
    const start = textarea.selectionStart;
    const end = textarea.selectionEnd;
    const text = textarea.value;
    
    textarea.value = text.substring(0, start) + variable + text.substring(end);
    textarea.selectionStart = textarea.selectionEnd = start + variable.length;
    textarea.focus();
    
    updatePreview();
}

function togglePreview() {
    const panel = document.getElementById('preview-panel');
    panel.classList.toggle('hidden');
    
    if (!panel.classList.contains('hidden')) {
        updatePreview();
    }
}

function updatePreview() {
    const subject = document.getElementById('subject').value || 'Enter subject above';
    const message = document.getElementById('message').value || 'Enter message above';
    
    document.getElementById('preview-subject').textContent = subject;
    document.getElementById('preview-content').innerHTML = message.replace(/\n/g, '<br>');
}

function confirmSend() {
    const sendTo = document.querySelector('input[name="send_to"]:checked').value;
    const subject = document.getElementById('subject').value;
    
    if (!subject.trim()) {
        alert('Please enter a subject');
        return false;
    }
    
    const message = document.getElementById('message').value;
    if (!message.trim()) {
        alert('Please enter a message');
        return false;
    }
    
    const recipients = sendTo === 'all' ? 'all subscribers' : 'active subscribers only';
    return confirm(`Are you sure you want to send this newsletter to ${recipients}?\n\nSubject: ${subject}`);
}

// Update preview when typing
document.getElementById('subject').addEventListener('input', updatePreview);
document.getElementById('message').addEventListener('input', updatePreview);
</script>
@endsection