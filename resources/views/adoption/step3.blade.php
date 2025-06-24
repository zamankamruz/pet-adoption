<?php
// File: step3.blade.php
// Path: /resources/views/adoption/step3.blade.php
?>

@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Progress Steps -->
    <div class="bg-white shadow-sm">
        <div class="max-w-4xl mx-auto px-4 py-6">
            <div class="flex items-center justify-center">
                <div class="flex items-center space-x-8">
                    <!-- Start -->
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-purple-600 text-white rounded-full flex items-center justify-center font-semibold">
                            ✓
                        </div>
                        <span class="ml-2 text-sm font-medium text-purple-600">Start</span>
                    </div>

                    <div class="w-8 h-0.5 bg-purple-600"></div>

                    <!-- Address -->
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-purple-600 text-white rounded-full flex items-center justify-center font-semibold">
                            ✓
                        </div>
                        <span class="ml-2 text-sm font-medium text-purple-600">Address</span>
                    </div>

                    <div class="w-8 h-0.5 bg-purple-600"></div>

                    <!-- Home -->
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-purple-600 text-white rounded-full flex items-center justify-center font-semibold">
                            ✓
                        </div>
                        <span class="ml-2 text-sm font-medium text-purple-600">Home</span>
                    </div>

                    <div class="w-8 h-0.5 bg-purple-600"></div>

                    <!-- Images of Home (Current) -->
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-green-500 text-white rounded-full flex items-center justify-center font-semibold">
                            4
                        </div>
                        <span class="ml-2 text-sm font-medium text-green-500">Images of Home</span>
                    </div>

                    <div class="w-8 h-0.5 bg-gray-300"></div>

                    <!-- Other steps -->
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center font-semibold">
                            5
                        </div>
                        <span class="ml-2 text-sm font-medium text-gray-600">Roommate</span>
                    </div>

                    <div class="w-8 h-0.5 bg-gray-300"></div>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center font-semibold">
                            6
                        </div>
                        <span class="ml-2 text-sm font-medium text-gray-600">Other Animals</span>
                    </div>

                    <div class="w-8 h-0.5 bg-gray-300"></div>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center font-semibold">
                            7
                        </div>
                        <span class="ml-2 text-sm font-medium text-gray-600">Confirm</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-sm p-8">
            <div class="mb-6">
                <p class="text-gray-700 mb-2">Please add 4 photos of your home and any outside space, as it helps the pet's current owner to visualize the home you are offering.</p>
                <p class="text-gray-600 text-sm mb-2">(A minimum of 2 photos are required but uploading 4 is better!)</p>
                <div class="text-sm text-gray-600">
                    <p>• The image format should be (.jpg, .png, .jpeg).</p>
                    <p>• The image measurements must be square in shape, with dimensions of 800 x 600 pixels.</p>
                    <p>• The maximum & minimum image size is 1024 and 240 KB.</p>
                </div>
            </div>

            <form action="{{ route('adoption.step3.store', $pet) }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Image Upload Boxes -->
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-purple-400 transition-colors">
                        <div class="mb-4">
                            <svg class="w-16 h-16 mx-auto text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z" />
                            </svg>
                        </div>
                        <input type="file" 
                               name="home_images[]" 
                               accept="image/jpeg,image/png,image/jpg"
                               class="hidden" 
                               id="image1"
                               onchange="previewImage(this, 'preview1')">
                        <label for="image1" class="cursor-pointer">
                            <span class="text-purple-600 font-medium">1 Main</span>
                            <p class="text-gray-500 text-sm mt-2">Click to upload</p>
                        </label>
                        <div id="preview1" class="mt-4 hidden">
                            <img class="w-full h-32 object-cover rounded-lg">
                        </div>
                    </div>

                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-purple-400 transition-colors">
                        <div class="mb-4">
                            <svg class="w-16 h-16 mx-auto text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z" />
                            </svg>
                        </div>
                        <input type="file" 
                               name="home_images[]" 
                               accept="image/jpeg,image/png,image/jpg"
                               class="hidden" 
                               id="image2"
                               onchange="previewImage(this, 'preview2')">
                        <label for="image2" class="cursor-pointer">
                            <span class="text-purple-600 font-medium">2</span>
                            <p class="text-gray-500 text-sm mt-2">Click to upload</p>
                        </label>
                        <div id="preview2" class="mt-4 hidden">
                            <img class="w-full h-32 object-cover rounded-lg">
                        </div>
                    </div>

                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-purple-400 transition-colors">
                        <div class="mb-4">
                            <svg class="w-16 h-16 mx-auto text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z" />
                            </svg>
                        </div>
                        <input type="file" 
                               name="home_images[]" 
                               accept="image/jpeg,image/png,image/jpg"
                               class="hidden" 
                               id="image3"
                               onchange="previewImage(this, 'preview3')">
                        <label for="image3" class="cursor-pointer">
                            <span class="text-purple-600 font-medium">3</span>
                            <p class="text-gray-500 text-sm mt-2">Click to upload</p>
                        </label>
                        <div id="preview3" class="mt-4 hidden">
                            <img class="w-full h-32 object-cover rounded-lg">
                        </div>
                    </div>

                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-purple-400 transition-colors">
                        <div class="mb-4">
                            <svg class="w-16 h-16 mx-auto text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z" />
                            </svg>
                        </div>
                        <input type="file" 
                               name="home_images[]" 
                               accept="image/jpeg,image/png,image/jpg"
                               class="hidden" 
                               id="image4"
                               onchange="previewImage(this, 'preview4')">
                        <label for="image4" class="cursor-pointer">
                            <span class="text-purple-600 font-medium">4</span>
                            <p class="text-gray-500 text-sm mt-2">Click to upload</p>
                        </label>
                        <div id="preview4" class="mt-4 hidden">
                            <img class="w-full h-32 object-cover rounded-lg">
                        </div>
                    </div>
                </div>

                @error('home_images.*')
                    <p class="text-red-500 text-sm mb-4">{{ $message }}</p>
                @enderror

                <!-- Navigation Buttons -->
                <div class="flex justify-between">
                    <a href="{{ route('adoption.step2', $pet) }}" 
                       class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-3 rounded-lg font-medium transition-colors">
                        ← Back
                    </a>
                    <button type="submit" 
                            class="bg-purple-600 hover:bg-purple-700 text-white px-8 py-3 rounded-lg font-medium transition-colors">
                        Continue →
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    const img = preview.querySelector('img');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            img.src = e.target.result;
            preview.classList.remove('hidden');
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection