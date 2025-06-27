<?php
// File: step3.blade.php
// Path: /resources/views/rehoming/step3.blade.php
?>

@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
            <!-- Progress Steps -->
    <div class="bg-white shadow-sm">
        <div class="max-w-4xl mx-auto px-4 py-6">
            <div class="flex items-center justify-center">
                <div class="flex items-center space-x-8">
                    <img src="{{ asset('images/steps3.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>


    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-md p-8">
            <div class="mb-6">
                <p class="text-gray-700 mb-4">
                    This will never be visible to the public and will be only shared to the adopter when you complete Rehoming Process. For your safety, we recommend you to block out any personal information on any documents.
                </p>
                <p class="text-gray-700 mb-4">
                    If you have any vaccine history, proof of spay or neuter, and/or microchip info, please upload below.
                </p>
                <div class="text-sm text-gray-600 mb-2">
                    The Image format should be (.jpg, .png, .jpeg).
                </div>
                <div class="text-sm text-gray-600 mb-2">
                    The Image measurements must be square in shape, with dimensions of 600 × 600 pixels.
                </div>
                <div class="text-sm text-gray-600 mb-6">
                    The maximum & minimum image size is 1024 and 240 KB.
                </div>
            </div>

            <form method="POST" action="{{ route('rehoming.step3.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- Image Upload Grid -->
                <div class="grid grid-cols-2 gap-4 mb-8">
                    <!-- Image 1 (Main) -->
                    <div class="border-2 border-dashed border-blue-300 rounded-lg p-8 text-center">
                        <div class="text-gray-400 mb-2">
                            <i class="fas fa-camera text-4xl"></i>
                        </div>
                        <div class="text-sm text-gray-600 mb-2">1 Main</div>
                        <input type="file" name="images[]" accept="image/*" class="hidden" id="image1" required>
                        <label for="image1" class="cursor-pointer text-blue-600 hover:text-blue-800">
                            Click to upload
                        </label>
                    </div>

                    <!-- Image 2 -->
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center">
                        <div class="text-gray-400 mb-2">
                            <i class="fas fa-camera text-4xl"></i>
                        </div>
                        <div class="text-sm text-gray-600 mb-2">2</div>
                        <input type="file" name="images[]" accept="image/*" class="hidden" id="image2">
                        <label for="image2" class="cursor-pointer text-blue-600 hover:text-blue-800">
                            Click to upload
                        </label>
                    </div>

                    <!-- Image 3 -->
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center">
                        <div class="text-gray-400 mb-2">
                            <i class="fas fa-camera text-4xl"></i>
                        </div>
                        <div class="text-sm text-gray-600 mb-2">3</div>
                        <input type="file" name="images[]" accept="image/*" class="hidden" id="image3">
                        <label for="image3" class="cursor-pointer text-blue-600 hover:text-blue-800">
                            Click to upload
                        </label>
                    </div>

                    <!-- Image 4 -->
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center">
                        <div class="text-gray-400 mb-2">
                            <i class="fas fa-camera text-4xl"></i>
                        </div>
                        <div class="text-sm text-gray-600 mb-2">4</div>
                        <input type="file" name="images[]" accept="image/*" class="hidden" id="image4">
                        <label for="image4" class="cursor-pointer text-blue-600 hover:text-blue-800">
                            Click to upload
                        </label>
                    </div>
                </div>

                @error('images')
                    <div class="text-red-500 text-sm mb-4">{{ $message }}</div>
                @enderror

                <!-- Action Buttons -->
                <div class="flex justify-between">
                    <a href="{{ route('rehoming.step2') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i> Back
                    </a>
                    <button type="submit" class="px-8 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                        Continue <i class="fas fa-arrow-right ml-2"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const fileInputs = document.querySelectorAll('input[type="file"]');

    fileInputs.forEach(input => {
        input.addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    const container = input.closest('div');
                    
                    // Hide the label and icon
                    const label = container.querySelector('label');
                    const icon = container.querySelector('.fas');
                    const text = container.querySelector('.text-sm');

                    if (icon) icon.style.display = 'none';
                    if (label) label.style.display = 'none';
                    if (text) text.style.display = 'none';

                    // Create and show image preview
                    const preview = document.createElement('img');
                    preview.src = e.target.result;
                    preview.className = 'w-full h-32 object-cover rounded mb-2';
                    container.appendChild(preview);

                    // Add remove button
                    const removeBtn = document.createElement('button');
                    removeBtn.type = 'button';
                    removeBtn.className = 'absolute top-2 right-2 bg-red-500 text-white rounded-full w-6 h-6 text-xs';
                    removeBtn.innerHTML = '×';

                    removeBtn.onclick = function () {
                        input.value = '';
                        preview.remove();
                        removeBtn.remove();
                        if (icon) icon.style.display = 'block';
                        if (label) label.style.display = 'inline';
                        if (text) text.style.display = 'block';
                    };

                    container.style.position = 'relative';
                    container.appendChild(removeBtn);
                };

                reader.readAsDataURL(file);
            }
        });
    });
});
</script>

@endsection