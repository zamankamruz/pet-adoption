<?php
// File: index.blade.php
// Path: /resources/views/user/rehoming/index.blade.php
?>

@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 py-6">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <!-- Sidebar Navigation -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-sm border overflow-hidden sticky top-6">
                    <!-- Navigation Menu -->
                    <nav class="p-4">
                        <ul class="space-y-1">
                            <li>
                                <a href="{{ route('dashboard') }}" 
                                   class="flex items-center px-4 py-3 rounded-xl text-gray-600 hover:bg-purple-50 hover:text-purple-600 transition-all duration-200">
                                    <div class="w-8 h-8 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mr-3 text-sm">
                                        📊
                                    </div>
                                    <span class="font-medium">Overview</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.profile') }}" 
                                   class="flex items-center px-4 py-3 rounded-xl text-gray-600 hover:bg-purple-50 hover:text-purple-600 transition-all duration-200">
                                    <div class="w-8 h-8 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mr-3 text-sm">
                                        👤
                                    </div>
                                    <span class="font-medium">Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.adoptions') }}" 
                                   class="flex items-center px-4 py-3 rounded-xl text-gray-600 hover:bg-purple-50 hover:text-purple-600 transition-all duration-200">
                                    <div class="w-8 h-8 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mr-3 text-sm">
                                        🐾
                                    </div>
                                    <span class="font-medium">Adopt</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('rehoming.my-pets') }}" 
                                   class="flex items-center px-4 py-3 rounded-xl bg-gradient-to-r from-purple-500 to-purple-600 text-white">
                                    <div class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-3 text-sm font-bold">
                                        🏠
                                    </div>
                                    <span class="font-medium">Rehome</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.messages') }}" 
                                   class="flex items-center px-4 py-3 rounded-xl text-gray-600 hover:bg-purple-50 hover:text-purple-600 transition-all duration-200">
                                    <div class="w-8 h-8 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mr-3 text-sm">
                                        💬
                                    </div>
                                    <span class="font-medium">Message</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.settings') }}" 
                                   class="flex items-center px-4 py-3 rounded-xl text-gray-600 hover:bg-purple-50 hover:text-purple-600 transition-all duration-200">
                                    <div class="w-8 h-8 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mr-3 text-sm">
                                        ⚙️
                                    </div>
                                    <span class="font-medium">Setting</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    
                    <!-- Charity Widget -->
                    <div class="p-4">
                        <div class="relative bg-white border-2 border-gray-100 rounded-2xl p-4 text-center">
                            <div class="flex justify-center mb-3">
                                <div class="flex -space-x-1">
                                    <img src="{{ asset('images/donate1.jpeg') }}" alt="Pet 1" class="w-8 h-8 rounded-full border-2 border-white">
                                    <img src="{{ asset('images/donate2.jpeg') }}" alt="Pet 2" class="w-8 h-8 rounded-full border-2 border-white">
                                    <img src="{{ asset('images/donate3.jpeg') }}" alt="Pet 3" class="w-8 h-8 rounded-full border-2 border-white">
                                    <img src="{{ asset('images/donate4.jpeg') }}" alt="Pet 4" class="w-8 h-8 rounded-full border-2 border-white">
                                    <img src="{{ asset('images/donate5.jpeg') }}" alt="Pet 5" class="w-8 h-8 rounded-full border-2 border-white">
                                    <img src="{{ asset('images/donate6.jpeg') }}" alt="Pet 6" class="w-8 h-8 rounded-full border-2 border-white">
                                </div>
                            </div>
                            <p class="text-sm text-gray-700 font-medium mb-3">Join Furry Friends Charity</p>
                            <button class="flex items-center justify-center space-x-1 bg-purple-100 text-purple-600 px-4 py-2 rounded-lg text-sm font-medium w-full hover:bg-purple-200 transition-colors">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                                </svg>
                                <span>Donate</span>
                            </button>
                        </div>
                    </div>


                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-3">
                <!-- Header -->
                <div class="bg-white shadow-sm rounded-lg mb-6">
                    <div class="px-6 py-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900">My Rehoming Requests</h1>
                                <p class="text-gray-600 mt-1">Manage your pet rehoming applications</p>
                            </div>
                            <a href="{{ route('rehoming.start') }}" class="px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                                <i class="fas fa-plus mr-2"></i> New Rehoming Request
                            </a>
                        </div>
                    </div>
                </div>

                @if($rehomings->count() > 0)
                    <!-- Stats -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                        <div class="bg-white rounded-lg p-6 shadow-sm">
                            <div class="flex items-center">
                                <div class="p-2 bg-blue-100 rounded-lg">
                                    <i class="fas fa-list text-blue-600"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm text-gray-600">Total Requests</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ $rehomings->total() }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white rounded-lg p-6 shadow-sm">
                            <div class="flex items-center">
                                <div class="p-2 bg-yellow-100 rounded-lg">
                                    <i class="fas fa-clock text-yellow-600"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm text-gray-600">Pending</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ $rehomings->where('status', 'pending')->count() }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white rounded-lg p-6 shadow-sm">
                            <div class="flex items-center">
                                <div class="p-2 bg-green-100 rounded-lg">
                                    <i class="fas fa-check text-green-600"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm text-gray-600">Approved</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ $rehomings->where('status', 'approved')->count() }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-white rounded-lg p-6 shadow-sm">
                            <div class="flex items-center">
                                <div class="p-2 bg-purple-100 rounded-lg">
                                    <i class="fas fa-home text-purple-600"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm text-gray-600">Published</p>
                                    <p class="text-2xl font-bold text-gray-900">{{ $rehomings->where('status', 'published')->count() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Rehoming Requests List -->
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-semibold text-gray-900">Rehoming Requests</h2>
                        </div>
                        
                        <div class="divide-y divide-gray-200">
                            @foreach($rehomings as $rehoming)
                                <div class="p-6 hover:bg-gray-50 transition-colors">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-4">
                                            <!-- Pet Info -->
                                            <div>
                                                <h3 class="text-lg font-semibold text-gray-900">
                                                    {{ $rehoming->pet_name ?: 'Unnamed Pet' }}
                                                </h3>
                                                <div class="flex items-center space-x-4 text-sm text-gray-600 mt-1">
                                                    @if($rehoming->species)
                                                        <span>{{ ucfirst($rehoming->species) }}</span>
                                                    @endif
                                                    @if($rehoming->breed)
                                                        <span>{{ $rehoming->breed }}</span>
                                                    @endif
                                                    @if($rehoming->age !== null)
                                                        <span>{{ $rehoming->age }}</span>
                                                    @endif
                                                </div>
                                                <div class="text-sm text-gray-500 mt-1">
                                                    Submitted: {{ $rehoming->created_at->format('M j, Y') }}
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="flex items-center space-x-4">
                                            <!-- Status Badge -->
                                            <span class="px-3 py-1 rounded-full text-xs font-medium
                                                @if($rehoming->status === 'draft') bg-gray-100 text-gray-800
                                                @elseif($rehoming->status === 'pending') bg-yellow-100 text-yellow-800
                                                @elseif($rehoming->status === 'approved') bg-green-100 text-green-800
                                                @elseif($rehoming->status === 'rejected') bg-red-100 text-red-800
                                                @elseif($rehoming->status === 'published') bg-blue-100 text-blue-800
                                                @elseif($rehoming->status === 'completed') bg-purple-100 text-purple-800
                                                @endif">
                                                {{ ucfirst($rehoming->status) }}
                                            </span>
                                            
                                            <!-- Progress -->
                                            <div class="text-sm text-gray-600">
                                                {{ $rehoming->step_completed }}/3 steps
                                            </div>
                                            
                                            <!-- Actions -->
                                            <div class="flex items-center space-x-2">
                                                <a href="{{ route('rehoming.my-pets.show', $rehoming) }}" 
                                                   class="px-3 py-1 text-sm text-purple-600 hover:text-purple-800 hover:bg-purple-50 rounded transition-colors">
                                                    View
                                                </a>
                                                
                                                @if(in_array($rehoming->status, ['draft', 'pending']))
                                                    <a href="{{ route('rehoming.my-pets.edit', $rehoming) }}" 
                                                       class="px-3 py-1 text-sm text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded transition-colors">
                                                        Edit
                                                    </a>
                                                @endif
                                                
                                                @if($rehoming->status === 'draft' && $rehoming->step_completed < 3)
                                                    <a href="{{ route('rehoming.step' . ($rehoming->step_completed + 1)) }}" 
                                                       class="px-3 py-1 text-sm text-green-600 hover:text-green-800 hover:bg-green-50 rounded transition-colors">
                                                        Continue
                                                    </a>
                                                @endif
                                                
                                                @if(in_array($rehoming->status, ['draft', 'pending']))
                                                    <form method="POST" action="{{ route('rehoming.my-pets.delete', $rehoming) }}" 
                                                          onsubmit="return confirm('Are you sure you want to delete this rehoming request?')"
                                                          class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="px-3 py-1 text-sm text-red-600 hover:text-red-800 hover:bg-red-50 rounded transition-colors">
                                                            Delete
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Progress Bar -->
                                    <div class="mt-4">
                                        <div class="flex items-center justify-between text-sm text-gray-600 mb-2">
                                            <span>Progress</span>
                                            <span>{{ number_format(($rehoming->step_completed / 3) * 100, 0) }}%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-purple-600 h-2 rounded-full transition-all duration-300" 
                                                 style="width: {{ ($rehoming->step_completed / 3) * 100 }}%"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8">
                        {{ $rehomings->links() }}
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                        <div class="w-24 h-24 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-heart text-purple-500 text-3xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">No Rehoming Requests Yet</h2>
                        <p class="text-gray-600 mb-8 max-w-md mx-auto">
                            You haven't started any rehoming requests yet. Create your first one to help find a loving home for your pet.
                        </p>
                        <a href="{{ route('rehoming.start') }}" 
                           class="inline-flex items-center px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                            <i class="fas fa-plus mr-2"></i>
                            Start Rehoming Process
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection