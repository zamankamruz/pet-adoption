@extends('layouts.admin')

@section('title', 'Setup Pet Data')

@section('content')
<div class="max-w-7xl mx-auto py-8 space-y-12">

    {{-- CATEGORY FORM --}}
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Add New Category</h2>
        <form action="{{ route('admin.setup.category') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium">Name</label>
                <input type="text" name="name" required class="w-full border px-3 py-2 rounded" />
            </div>
            <div>
                <label class="block text-sm font-medium">Slug</label>
                <input type="text" name="slug" required class="w-full border px-3 py-2 rounded" />
            </div>
            <div>
                <label class="block text-sm font-medium">Description</label>
                <textarea name="description" class="w-full border px-3 py-2 rounded"></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium">Icon (optional)</label>
                <input type="text" name="icon" class="w-full border px-3 py-2 rounded" />
            </div>
            <button class="bg-blue-600 text-white px-4 py-2 rounded">Add Category</button>
        </form>
    </div>

    {{-- BREED FORM --}}
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Add New Breed</h2>
        <form action="{{ route('admin.setup.breed') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium">Name</label>
                <input type="text" name="name" required class="w-full border px-3 py-2 rounded" />
            </div>
            <div>
                <label class="block text-sm font-medium">Category</label>
                <select name="category_id" required class="w-full border px-3 py-2 rounded">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium">Description</label>
                <textarea name="description" class="w-full border px-3 py-2 rounded"></textarea>
            </div>
            <button class="bg-green-600 text-white px-4 py-2 rounded">Add Breed</button>
        </form>
    </div>

    {{-- LOCATION FORM --}}
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Add New Location</h2>
        <form action="{{ route('admin.setup.location') }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium">City</label>
                    <input type="text" name="city" required class="w-full border px-3 py-2 rounded" />
                </div>
                <div>
                    <label class="block text-sm font-medium">State</label>
                    <input type="text" name="state" required class="w-full border px-3 py-2 rounded" />
                </div>
                <div>
                    <label class="block text-sm font-medium">Country</label>
                    <input type="text" name="country" value="USA" class="w-full border px-3 py-2 rounded" />
                </div>
                <div>
                    <label class="block text-sm font-medium">Zip Code</label>
                    <input type="text" name="zip_code" class="w-full border px-3 py-2 rounded" />
                </div>
                <div>
                    <label class="block text-sm font-medium">Latitude</label>
                    <input type="text" name="latitude" class="w-full border px-3 py-2 rounded" />
                </div>
                <div>
                    <label class="block text-sm font-medium">Longitude</label>
                    <input type="text" name="longitude" class="w-full border px-3 py-2 rounded" />
                </div>
            </div>
            <button class="bg-purple-600 text-white px-4 py-2 rounded">Add Location</button>
        </form>
    </div>

</div>
@endsection
