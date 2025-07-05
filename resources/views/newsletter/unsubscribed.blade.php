<?php
// File: unsubscribed.blade.php
// Path: /resources/views/newsletter/unsubscribed.blade.php
?>

@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-16">
    <div class="max-w-md mx-auto bg-white rounded-lg shadow-sm p-8 text-center">
        <div class="mb-6">
            <i class="fas fa-check-circle text-5xl text-green-500"></i>
        </div>
        
        <h1 class="text-2xl font-semibold text-gray-900 mb-4">Newsletter Unsubscription</h1>
        
        <p class="text-gray-600 mb-8">{{ $message }}</p>
        
        <div class="space-y-4">
            <a href="{{ route('home') }}" 
               class="block w-full bg-violet-500 hover:bg-violet-600 text-white font-medium py-3 px-6 rounded-lg transition-colors duration-300">
                Return to Homepage
            </a>
            
            <a href="{{ route('newsletter.subscribe') }}" 
               class="block w-full border border-violet-500 text-violet-500 hover:bg-violet-50 font-medium py-3 px-6 rounded-lg transition-colors duration-300">
                Subscribe Again
            </a>
        </div>
    </div>
</div>
@endsection