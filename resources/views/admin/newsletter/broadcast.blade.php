<?php
// File: broadcast.blade.php
// Path: /resources/views/admin/newsletter/broadcast.blade.php
?>

@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Send Newsletter Broadcast</h1>
            <p class="text-gray-600">Send a newsletter to all or active subscribers</p>
        </div>
        <a href="{{ route('admin.newsletter.index') }}" 
           class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
            <i class="fas fa-arrow-left mr-2"></i>Back to Subscribers
        </a>
    </div>

    <!-- Broadcast Form -->
    <div class="bg-white rounded-lg shadow">
        <form method="POST" action="{{ route('admin.newsletter.send-broadcast') }}">
            @csrf
            <div class="p-6 space-y-6">
                <!-- Recipients -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Send To</label>
                    <div class="space-y-3">
                        <label class="flex items-center">
                            <input type="radio" name="send_to" value="active_only" checked 
                                   class="text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700">Active subscribers only (recommended)</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="send_to" value="all" 
                                   class="text-blue-600 focus:ring-blue-500">
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
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('subject') border-red-500 @enderror"
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
                                <button type="button" onclick="formatText('bold')" class="p-1 hover:bg-gray-200 rounded">
                                    <i class="fas fa-bold text-sm"></i>
                                </button>
                                <button type="button" onclick="formatText('italic')" class="p-1 hover:bg-gray-200 rounded">
                                    <i class="fas fa-italic text-sm"></i>
                                </button>
                                <button type="button" onclick="formatText('underline')" class="p-1 hover:bg-gray-200 rounded">
                                    <i class="fas fa-underline text-sm"></i>
                                </button>
                                <div class="w-px h-6 bg-gray-300"></div>
                                <button type="button" onclick="insertVariable('{{name}}')" class="px-2 py-1 text-xs bg-blue-100 text-blue-700 rounded hover:bg-blue-200">
                                    Insert Name
                                </button>
                                <button type="button" onclick="insertVariable('{{email}}')" class="px-2 py-1 text-xs bg-blue-100 text-blue-700 rounded hover:bg-blue-200">
                                    Insert Email
                                </button>
                            </div>
                        </div>
                        <textarea id="message" 
                                  name="message" 
                                  rows="12" 
                                  required 
                                  class="w-full px-3 py-3 border-0 focus:ring-0 resize-none"
                                  placeholder="Enter your newsletter message here...">{{ old('message') }}</textarea>
                    </div>
                    @error('message')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-sm text-gray-500">
                        Use {{name}} to insert subscriber's name and {{email}} for their email address.
                    </p>
                </div>

                <!-- Preview -->
                <div>
                    <button type="button" 
                            onclick="togglePreview()" 
                            class="mb-3 text-blue-600 hover:text-blue-800 font-medium">
                        <i class="fas fa-eye mr-1"></i>Preview Email
                    </button>
                    
                    <div id="preview-panel" class="hidden border border-gray-300 rounded-lg p-4 bg-gray-50">
                        <h4 class="font-semibold text-gray-900 mb-2">Email Preview</h4>
                        <div class="bg-white border rounded p-4">
                            <div class="border-b pb-2 mb-3">
                                <strong>Subject:</strong> <span id="preview-subject">Enter subject above</span>
                            </div>
                            <div id="preview-content">Enter message above</div>
                            <div class="mt-4 pt-3 border-t text-xs text-gray-500">
                                <p>This is a preview. Variables like {{name}} will be replaced with actual subscriber data.</p>
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
                       class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium transition-colors duration-200">
                        Cancel
                    </a>
                    <button type="submit" 
                            onclick="return confirmSend()"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-200">
                        <i class="fas fa-paper-plane mr-2"></i>Send Newsletter
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
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