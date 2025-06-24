<?php
// File: PetController.php
// Path: /app/Http/Controllers/PetController.php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Breed;
use App\Models\Category;
use App\Models\Location;
use App\Models\PetImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PetController extends Controller
{


    public function byCategory(Category $category)
    {
        $pets = Pet::with(['breed', 'location', 'images'])
            ->where('category_id', $category->id)
            ->available()
            ->paginate(12);

        return view('pets.category', compact('category', 'pets'));
    }

    public function byBreed(Breed $breed)
    {
        $pets = Pet::with(['category', 'location', 'images'])
            ->where('breed_id', $breed->id)
            ->available()
            ->paginate(12);

        return view('pets.breed', compact('breed', 'pets'));
    }

    public function byLocation(Location $location)
    {
        $pets = Pet::with(['breed', 'category', 'images'])
            ->where('location_id', $location->id)
            ->available()
            ->paginate(12);

        return view('pets.location', compact('location', 'pets'));
    }

    public function filter(Request $request)
    {
        $query = Pet::with(['breed', 'category', 'location'])
            ->available();

        // Apply same filters as index method
        if ($request->filled('species')) {
            $query->where('species', $request->species);
        }

        if ($request->filled('breed_id')) {
            $query->where('breed_id', $request->breed_id);
        }

        // ... (apply all other filters)

        $pets = $query->get();

        return response()->json([
            'html' => view('pets.partials.pet-grid', compact('pets'))->render(),
            'count' => $pets->count()
        ]);
    }

    public function ajaxFilter(Request $request)
    {
        $query = Pet::with(['breed', 'category', 'location'])
            ->available();

        // Apply filters (same as index method)
        // ... filter logic here ...

        $pets = $query->paginate(12);

        return response()->json([
            'html' => view('pets.partials.pet-cards', compact('pets'))->render(),
            'pagination' => $pets->links()->render(),
            'total' => $pets->total()
        ]);
    }

    public function uploadImages(Request $request)
    {
        $request->validate([
            'pet_id' => 'required|exists:pets,id',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $pet = Pet::findOrFail($request->pet_id);
        $this->authorize('update', $pet);

        $uploaded = [];

        foreach ($request->file('images') as $image) {
            $path = $image->store('pets', 'public');
            
            $petImage = PetImage::create([
                'pet_id' => $pet->id,
                'image_path' => $path,
                'order' => $pet->images()->count()
            ]);

            $uploaded[] = $petImage;
        }
        
        return response()->json([
            'message' => 'Images uploaded successfully',
            'images' => $uploaded
        ]);
    }

    public function deleteImage($imageId)
    {
        $image = PetImage::findOrFail($imageId);
        $this->authorize('update', $image->pet);

        Storage::disk('public')->delete($image->image_path);
        
        if ($image->thumbnail_path) {
            Storage::disk('public')->delete($image->thumbnail_path);
        }

        $image->delete();
        
        return response()->json(['message' => 'Image deleted successfully']);
    }
}