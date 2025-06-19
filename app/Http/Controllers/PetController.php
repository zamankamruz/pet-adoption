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

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('size')) {
            $query->whereIn('size', (array) $request->size);
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
            $query->whereIn('gender', (array) $request->gender);
        }

        if ($request->filled('color')) {
            $query->whereIn('color', (array) $request->color);
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
            case 'urgent':
                $query->orderByDesc('is_urgent')->orderByDesc('created_at');
                break;
            default:
                $query->orderByDesc('created_at');
        }

        $pets = $query->paginate(12)->withQueryString();
        
        // Get filter options
        $breeds = Breed::active()->orderBy('name')->get();
        $locations = Location::active()->orderBy('city')->get();
        $categories = Category::active()->orderBy('name')->get();

        return view('pets.index', compact('pets', 'breeds', 'locations', 'categories'));
    }

    public function show(Pet $pet)
    {
        // Increment view count
        $pet->increment('views_count');
        $pet->update(['last_viewed_at' => now()]);

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

    public function create()
    {
        $this->authorize('create', Pet::class);
        
        $breeds = Breed::active()->orderBy('name')->get();
        $categories = Category::active()->orderBy('name')->get();
        $locations = Location::active()->orderBy('city')->get();

        return view('pets.create', compact('breeds', 'categories', 'locations'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Pet::class);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string',
            'breed_id' => 'required|exists:breeds,id',
            'category_id' => 'required|exists:categories,id',
            'age_years' => 'required|integer|min:0|max:30',
            'age_months' => 'required|integer|min:0|max:11',
            'gender' => 'required|in:male,female',
            'size' => 'required|in:small,medium,large,extra_large',
            'color' => 'required|string|max:255',
            'weight' => 'nullable|numeric|min:0',
            'description' => 'required|string',
            'personality' => 'nullable|string',
            'good_with_kids' => 'boolean',
            'good_with_pets' => 'boolean',
            'good_with_strangers' => 'boolean',
            'energy_level' => 'required|in:low,moderate,high',
            'training_level' => 'required|in:none,basic,intermediate,advanced',
            'health_status' => 'required|string',
            'special_needs' => 'nullable|string',
            'adoption_fee' => 'required|numeric|min:0',
            'location_id' => 'required|exists:locations,id',
            'vaccination_status' => 'required|in:up_to_date,partial,none,unknown',
            'spayed_neutered' => 'boolean',
            'house_trained' => 'boolean',
            'microchip_id' => 'nullable|string',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $validated['owner_id'] = auth()->id();
        $validated['status'] = auth()->user()->is_admin ? 'available' : 'pending';

        if ($request->hasFile('main_image')) {
            $validated['main_image'] = $request->file('main_image')->store('pets', 'public');
        }

        $pet = Pet::create($validated);

        return redirect()->route('pets.show', $pet)
            ->with('success', 'Pet listed successfully!');
    }

    public function edit(Pet $pet)
    {
        $this->authorize('update', $pet);
        
        $breeds = Breed::active()->orderBy('name')->get();
        $categories = Category::active()->orderBy('name')->get();
        $locations = Location::active()->orderBy('city')->get();

        return view('pets.edit', compact('pet', 'breeds', 'categories', 'locations'));
    }

    public function update(Request $request, Pet $pet)
    {
        $this->authorize('update', $pet);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string',
            'breed_id' => 'required|exists:breeds,id',
            'category_id' => 'required|exists:categories,id',
            'age_years' => 'required|integer|min:0|max:30',
            'age_months' => 'required|integer|min:0|max:11',
            'gender' => 'required|in:male,female',
            'size' => 'required|in:small,medium,large,extra_large',
            'color' => 'required|string|max:255',
            'weight' => 'nullable|numeric|min:0',
            'description' => 'required|string',
            'personality' => 'nullable|string',
            'good_with_kids' => 'boolean',
            'good_with_pets' => 'boolean',
            'good_with_strangers' => 'boolean',
            'energy_level' => 'required|in:low,moderate,high',
            'training_level' => 'required|in:none,basic,intermediate,advanced',
            'health_status' => 'required|string',
            'special_needs' => 'nullable|string',
            'adoption_fee' => 'required|numeric|min:0',
            'location_id' => 'required|exists:locations,id',
            'vaccination_status' => 'required|in:up_to_date,partial,none,unknown',
            'spayed_neutered' => 'boolean',
            'house_trained' => 'boolean',
            'microchip_id' => 'nullable|string',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('main_image')) {
            if ($pet->main_image) {
                Storage::disk('public')->delete($pet->main_image);
            }
            $validated['main_image'] = $request->file('main_image')->store('pets', 'public');
        }

        $pet->update($validated);

        return redirect()->route('pets.show', $pet)
            ->with('success', 'Pet updated successfully!');
    }

    public function destroy(Pet $pet)
    {
        $this->authorize('delete', $pet);

        if ($pet->main_image) {
            Storage::disk('public')->delete($pet->main_image);
        }

        foreach ($pet->images as $image) {
            Storage::disk('public')->delete($image->image_path);
            if ($image->thumbnail_path) {
                Storage::disk('public')->delete($image->thumbnail_path);
            }
        }

        $pet->delete();

        return redirect()->route('pets.index')
            ->with('success', 'Pet deleted successfully!');
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