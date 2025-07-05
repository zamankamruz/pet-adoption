<?php
// File: PetController.php
// Path: /app/Http/Controllers/PetController.php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Breed;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index(Request $request)
    {
        $query = Pet::with(['breed', 'category', 'location', 'images'])
            ->available();

        // Apply filters
        if ($request->filled('species')) {
            $query->where('species', $request->species);
        }

        if ($request->filled('breed_id')) {
            $query->where('breed_id', $request->breed_id);
        }

        if ($request->filled('size')) {
            $query->where('size', $request->size);
        }

        if ($request->filled('age_min') && $request->filled('age_max')) {
            $query->whereBetween('age_years', [$request->age_min, $request->age_max]);
        }

        if ($request->filled('location_id')) {
            $query->where('location_id', $request->location_id);
        }

        if ($request->filled('good_with_kids')) {
            $query->where('good_with_kids', true);
        }

        if ($request->filled('good_with_pets')) {
            $query->where('good_with_pets', true);
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        // Sorting
        $sortBy = $request->get('sort', 'latest');
        switch ($sortBy) {
            case 'name':
                $query->orderBy('name');
                break;
            case 'age':
                $query->orderBy('age_years')->orderBy('age_months');
                break;
            case 'featured':
                $query->orderByDesc('is_featured')->orderByDesc('created_at');
                break;
            default:
                $query->orderByDesc('created_at');
        }

        $pets = $query->paginate(12)->withQueryString();
        
        // Get filter options
        $breeds = Breed::active()->orderBy('name')->get();
        $locations = Location::active()->orderBy('city')->get();
        $categories = Category::active()->orderBy('name')->get();

        return view('adoption.index', compact('pets', 'breeds', 'locations', 'categories'));
    }

    public function show(Pet $pet)
    {
        $pet->load(['breed', 'category', 'location', 'images', 'vaccinations', 'owner']);
        
        $similarPets = Pet::where('id', '!=', $pet->id)
            ->where('breed_id', $pet->breed_id)
            ->available()
            ->take(4)
            ->get();

        $canAdopt = auth()->check() && $pet->canBeAdoptedBy(auth()->user());
        $isFavorited = auth()->check() && auth()->user()->hasFavorited($pet);

        return view('pets.show', compact('pet', 'similarPets', 'canAdopt', 'isFavorited'));
    }

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
        // AJAX filter method
        $query = Pet::with(['breed', 'category', 'location'])
            ->available();

        // Apply filters (same logic as index)
        // ... filter logic here ...

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

        // Apply all the same filters as index method
        // ... (copy filter logic from index method)

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
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Image upload logic here
        
        return response()->json(['message' => 'Images uploaded successfully']);
    }

    public function deleteImage($imageId)
    {
        // Image deletion logic here
        
        return response()->json(['message' => 'Image deleted successfully']);
    }
}