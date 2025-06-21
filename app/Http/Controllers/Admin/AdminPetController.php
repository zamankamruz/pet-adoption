<?php
// File: AdminPetController.php
// Path: /app/Http/Controllers/Admin/AdminPetController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\Breed;
use App\Models\Category;
use App\Models\Location;
use App\Models\PetImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Mail\PetApprovedMail;
use App\Mail\PetRejectedMail;
use Illuminate\Support\Facades\Mail;

class AdminPetController extends Controller
{


    public function index(Request $request)
    {
        $query = Pet::with(['breed', 'category', 'location', 'owner', 'images']);

        // Apply filters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('species')) {
            $query->where('species', $request->species);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('location_id')) {
            $query->where('location_id', $request->location_id);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%")
                  ->orWhereHas('breed', function($breedQuery) use ($search) {
                      $breedQuery->where('name', 'LIKE', "%{$search}%");
                  });
            });
        }

        // Sorting
        $sortBy = $request->get('sort', 'latest');
        switch ($sortBy) {
            case 'name':
                $query->orderBy('name');
                break;
            case 'oldest':
                $query->orderBy('created_at');
                break;
            case 'status':
                $query->orderBy('status');
                break;
            default:
                $query->orderByDesc('created_at');
        }

        $pets = $query->paginate(20)->withQueryString();

        // Get filter options
        $categories = Category::active()->orderBy('name')->get();
        $locations = Location::active()->orderBy('city')->get();
        $statuses = ['available', 'pending', 'adopted', 'on_hold', 'not_available'];

        return view('admin.pets.index', compact('pets', 'categories', 'locations', 'statuses'));
    }

    public function show(Pet $pet)
    {
        $pet->load(['breed', 'category', 'location', 'owner', 'images', 'vaccinations', 'adoptionRequests']);
        
        return view('admin.pets.show', compact('pet'));
    }

    public function create()
    {
        $breeds = Breed::active()->orderBy('name')->get();
        $categories = Category::active()->orderBy('name')->get();
        $locations = Location::active()->orderBy('city')->get();

        return view('admin.pets.create', compact('breeds', 'categories', 'locations'));
    }

    public function store(Request $request)
    {
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
            'status' => 'required|in:available,pending,adopted,on_hold,not_available',
            'is_featured' => 'boolean',
            'is_urgent' => 'boolean',
            'owner_id' => 'nullable|exists:users,id',
        ]);

        if ($request->hasFile('main_image')) {
            $validated['main_image'] = $request->file('main_image')->store('pets', 'public');
        }

        $pet = Pet::create($validated);

        return redirect()->route('admin.pets.show', $pet)
            ->with('success', 'Pet created successfully!');
    }

    public function edit(Pet $pet)
    {
        $breeds = Breed::active()->orderBy('name')->get();
        $categories = Category::active()->orderBy('name')->get();
        $locations = Location::active()->orderBy('city')->get();

        return view('admin.pets.edit', compact('pet', 'breeds', 'categories', 'locations'));
    }

    public function update(Request $request, Pet $pet)
    {
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
            'status' => 'required|in:available,pending,adopted,on_hold,not_available',
            'is_featured' => 'boolean',
            'is_urgent' => 'boolean',
            'owner_id' => 'nullable|exists:users,id',
        ]);

        if ($request->hasFile('main_image')) {
            if ($pet->main_image) {
                Storage::disk('public')->delete($pet->main_image);
            }
            $validated['main_image'] = $request->file('main_image')->store('pets', 'public');
        }

        $pet->update($validated);

        return redirect()->route('admin.pets.show', $pet)
            ->with('success', 'Pet updated successfully!');
    }

    public function destroy(Pet $pet)
    {
        // Delete main image
        if ($pet->main_image) {
            Storage::disk('public')->delete($pet->main_image);
        }

        // Delete additional images
        foreach ($pet->images as $image) {
            Storage::disk('public')->delete($image->image_path);
            if ($image->thumbnail_path) {
                Storage::disk('public')->delete($image->thumbnail_path);
            }
        }

        $pet->delete();

        return redirect()->route('admin.pets.index')
            ->with('success', 'Pet deleted successfully!');
    }

    public function approve(Pet $pet)
    {
        if ($pet->status !== 'pending') {
            return redirect()->back()
                ->with('error', 'Only pending pets can be approved.');
        }

        $pet->update(['status' => 'available']);

        // Send email notification to owner
        if ($pet->owner) {
            try {
                Mail::to($pet->owner->email)->send(new PetApprovedMail($pet));
            } catch (\Exception $e) {
                \Log::error('Failed to send pet approval email: ' . $e->getMessage());
            }
        }

        return redirect()->back()
            ->with('success', 'Pet approved successfully!');
    }

    public function reject(Request $request, Pet $pet)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:1000'
        ]);

        if ($pet->status !== 'pending') {
            return redirect()->back()
                ->with('error', 'Only pending pets can be rejected.');
        }

        $pet->update([
            'status' => 'not_available',
            'rejection_reason' => $request->rejection_reason
        ]);

        // Send email notification to owner
        if ($pet->owner) {
            try {
                Mail::to($pet->owner->email)->send(new PetRejectedMail($pet, $request->rejection_reason));
            } catch (\Exception $e) {
                \Log::error('Failed to send pet rejection email: ' . $e->getMessage());
            }
        }

        return redirect()->back()
            ->with('success', 'Pet rejected successfully!');
    }

    public function toggleFeature(Pet $pet)
    {
        $pet->update(['is_featured' => !$pet->is_featured]);

        $status = $pet->is_featured ? 'featured' : 'unfeatured';
        
        return redirect()->back()
            ->with('success', "Pet {$status} successfully!");
    }

    public function updateStatus(Request $request, Pet $pet)
    {
        $request->validate([
            'status' => 'required|in:available,pending,adopted,on_hold,not_available'
        ]);

        $pet->update(['status' => $request->status]);

        return response()->json([
            'message' => 'Pet status updated successfully!',
            'status' => $pet->status
        ]);
    }

    public function manageImages(Pet $pet)
    {
        $pet->load('images');
        
        return view('admin.pets.images', compact('pet'));
    }

    public function uploadImages(Request $request, Pet $pet)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

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

    public function deleteImage(PetImage $image)
    {
        Storage::disk('public')->delete($image->image_path);
        
        if ($image->thumbnail_path) {
            Storage::disk('public')->delete($image->thumbnail_path);
        }

        $image->delete();
        
        return response()->json(['message' => 'Image deleted successfully']);
    }

    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:approve,reject,delete,feature,unfeature,available,adopted',
            'pet_ids' => 'required|array',
            'pet_ids.*' => 'exists:pets,id'
        ]);

        $pets = Pet::whereIn('id', $request->pet_ids);
        $count = $pets->count();

        switch ($request->action) {
            case 'approve':
                $pets->where('status', 'pending')->update(['status' => 'available']);
                $message = "{$count} pets approved successfully";
                break;
                
            case 'reject':
                $pets->where('status', 'pending')->update(['status' => 'not_available']);
                $message = "{$count} pets rejected successfully";
                break;
                
            case 'delete':
                foreach ($pets->get() as $pet) {
                    $this->destroy($pet);
                }
                $message = "{$count} pets deleted successfully";
                break;
                
            case 'feature':
                $pets->update(['is_featured' => true]);
                $message = "{$count} pets featured successfully";
                break;
                
            case 'unfeature':
                $pets->update(['is_featured' => false]);
                $message = "{$count} pets unfeatured successfully";
                break;
                
            case 'available':
                $pets->update(['status' => 'available']);
                $message = "{$count} pets marked as available";
                break;
                
            case 'adopted':
                $pets->update(['status' => 'adopted']);
                $message = "{$count} pets marked as adopted";
                break;
        }

        return redirect()->back()->with('success', $message);
    }

    public function export(Request $request)
    {
        $query = Pet::with(['breed', 'category', 'location', 'owner']);

        // Apply same filters as index
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pets = $query->get();

        $csvData = [];
        $csvData[] = [
            'ID', 'Name', 'Species', 'Breed', 'Category', 'Age', 'Gender', 'Size', 
            'Color', 'Location', 'Status', 'Adoption Fee', 'Owner', 'Created At'
        ];

        foreach ($pets as $pet) {
            $csvData[] = [
                $pet->id,
                $pet->name,
                $pet->species,
                $pet->breed->name,
                $pet->category->name,
                $pet->age_display,
                $pet->gender,
                $pet->size,
                $pet->color,
                $pet->location->full_location,
                $pet->status,
                $pet->adoption_fee,
                $pet->owner ? $pet->owner->name : 'Admin',
                $pet->created_at->format('Y-m-d H:i:s')
            ];
        }

        $filename = 'pets-export-' . now()->format('Y-m-d-H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($csvData) {
            $file = fopen('php://output', 'w');
            foreach ($csvData as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}