<?php
// File: step8.blade.php
// Path: /resources/views/rehoming/step8.blade.php
?>

@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
            <!-- Progress Steps -->
    <div class="bg-white shadow-sm">
        <div class="max-w-4xl mx-auto px-4 py-6">
            <div class="flex items-center justify-center">
                <div class="flex items-center space-x-8">
                    <img src="{{ asset('images/steps8.png') }}" alt="">
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

            <form method="POST" action="{{ route('rehoming.step8.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- Document Upload Grid -->
                <div class="grid grid-cols-2 gap-4 mb-8">
                    <!-- Document 1 -->
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center">
                        <div class="text-gray-400 mb-2">
                            <i class="fas fa-file text-4xl"></i>
                        </div>
                        <div class="text-sm text-gray-600 mb-2">1</div>
                        <input type="file" name="documents[]" accept=".pdf,.doc,.docx,.jpg,.png,.jpeg" class="hidden" id="doc1">
                        <label for="doc1" class="cursor-pointer text-blue-600 hover:text-blue-800">
                            Click to upload
                        </label>
                    </div>

                    <!-- Document 2 -->
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center">
                        <div class="text-gray-400 mb-2">
                            <i class="fas fa-file text-4xl"></i>
                        </div>
                        <div class="text-sm text-gray-600 mb-2">2</div>
                        <input type="file" name="documents[]" accept=".pdf,.doc,.docx,.jpg,.png,.jpeg" class="hidden" id="doc2">
                        <label for="doc2" class="cursor-pointer text-blue-600 hover:text-blue-800">
                            Click to upload
                        </label>
                    </div>

                    <!-- Document 3 -->
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center">
                        <div class="text-gray-400 mb-2">
                            <i class="fas fa-file text-4xl"></i>
                        </div>
                        <div class="text-sm text-gray-600 mb-2">3</div>
                        <input type="file" name="documents[]" accept=".pdf,.doc,.docx,.jpg,.png,.jpeg" class="hidden" id="doc3">
                        <label for="doc3" class="cursor-pointer text-blue-600 hover:text-blue-800">
                            Click to upload
                        </label>
                    </div>

                    <!-- Document 4 -->
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center">
                        <div class="text-gray-400 mb-2">
                            <i class="fas fa-file text-4xl"></i>
                        </div>
                        <div class="text-sm text-gray-600 mb-2">4</div>
                        <input type="file" name="documents[]" accept=".pdf,.doc,.docx,.jpg,.png,.jpeg" class="hidden" id="doc4">
                        <label for="doc4" class="cursor-pointer text-blue-600 hover:text-blue-800">
                            Click to upload
                        </label>
                    </div>
                </div>

                @error('documents')
                    <div class="text-red-500 text-sm mb-4">{{ $message }}</div>
                @enderror


                <!-- Action Buttons -->
                <div class="flex justify-between">
                    <a href="{{ route('rehoming.step7') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
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
document.addEventListener('DOMContentLoaded', function() {
    // Handle file input changes
    const fileInputs = document.querySelectorAll('input[type="file"]');
    
    fileInputs.forEach(input => {
        input.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const container = input.closest('div');
                const fileName = file.name;
                const fileSize = (file.size / 1024 / 1024).toFixed(2);
                
                // Update the display
                container.innerHTML = `
                    <div class="text-green-500 mb-2">
                        <i class="fas fa-check-circle text-2xl"></i>
                    </div>
                    <div class="text-sm text-gray-700 font-medium">${fileName}</div>
                    <div class="text-xs text-gray-500">${fileSize} MB</div>
                    <button type="button" class="mt-2 text-red-500 text-sm hover:text-red-700" onclick="removeFile(this)">
                        Remove
                    </button>
                `;
                container.appendChild(input);
                input.style.display = 'none';
            }
        });
    });
});

function removeFile(button) {
    const container = button.closest('div');
    const input = container.querySelector('input[type="file"]');
    input.value = '';
    location.reload(); // Simple reload to reset the form
}
</script>
@endsection