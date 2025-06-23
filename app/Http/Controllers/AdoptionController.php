<?php
// File: AdoptionController.php
// Path: /app/Http/Controllers/AdoptionController.php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Adoption;
use App\Models\Breed;
use App\Models\Category;
use App\Models\Location;
use App\Models\PetImage;
use App\Http\Requests\AdoptionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdoptionRequestMail;
use App\Notifications\AdoptionRequestNotification;

class AdoptionController extends Controller
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

        return view('adoption.index', compact('pets', 'breeds', 'locations', 'categories'));
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

        return view('adoption.show', compact('pet', 'similarPets', 'canAdopt', 'isFavorited'));
    }



    public function howItWorks()
    {
        return view('adoption.how-it-works');
    }

    

    public function requirements()
    {
        return view('adoption.requirements');
    }

    public function requestForm(Pet $pet)
    {
        $this->authorize('adopt', $pet);
        
        if (!$pet->canBeAdoptedBy(auth()->user())) {
            return redirect()->route('pets.show', $pet)
                ->with('error', 'This pet cannot be adopted at this time.');
        }
        
        return view('adoption.request', compact('pet'));
    }

    public function submitRequest(AdoptionRequest $request, Pet $pet)
    {
        $this->authorize('adopt', $pet);

        if (!$pet->canBeAdoptedBy(auth()->user())) {
            return redirect()->route('pets.show', $pet)
                ->with('error', 'This pet cannot be adopted at this time.');
        }

        $adoption = Adoption::create([
            'user_id' => auth()->id(),
            'pet_id' => $pet->id,
            'status' => 'pending',
            'application_data' => $request->validated(),
            'requested_at' => now(),
            'reference_number' => 'ADO-' . now()->format('Ymd') . '-' . rand(1000, 9999),
        ]);

        // Send notification emails
        if ($pet->owner) {
            $pet->owner->notify(new AdoptionRequestNotification($adoption));
        }

        // Send email to admins
        Mail::to(config('mail.admin_email'))->send(new AdoptionRequestMail($adoption));

        return redirect()->route('adoption.requests')
            ->with('success', 'Your adoption request has been submitted successfully! Reference: ' . $adoption->reference_number);
    }

    public function userRequests()
    {
        $adoptions = auth()->user()->adoptionRequests()
            ->with(['pet.breed', 'pet.location', 'pet.images'])
            ->latest()
            ->paginate(10);

        return view('adoption.requests', compact('adoptions'));
    }

    public function showRequest(Adoption $adoption)
    {
        $this->authorize('view', $adoption);
        
        $adoption->load(['pet.breed', 'pet.location', 'pet.images']);

        return view('adoption.show', compact('adoption'));
    }

    public function cancelRequest(Adoption $adoption)
    {
        $this->authorize('cancel', $adoption);

        if ($adoption->status !== 'pending') {
            return redirect()->back()
                ->with('error', 'Only pending requests can be cancelled.');
        }

        $adoption->update(['status' => 'cancelled']);

        return redirect()->route('adoption.requests')
            ->with('success', 'Adoption request cancelled successfully.');
    }

    public function uploadDocuments(Request $request)
    {
        $request->validate([
            'adoption_id' => 'required|exists:adoptions,id',
            'documents.*' => 'required|file|mimes:pdf,doc,docx,jpg,png|max:5120'
        ]);

        $adoption = Adoption::findOrFail($request->adoption_id);
        $this->authorize('view', $adoption);

        $uploaded = [];

        foreach ($request->file('documents') as $file) {
            $path = $file->store('documents/adoptions', 'public');
            
            $document = $adoption->documents()->create([
                'title' => $file->getClientOriginalName(),
                'file_path' => $path,
                'file_name' => $file->getClientOriginalName(),
                'file_type' => $file->getClientMimeType(),
                'file_size' => $file->getSize(),
                'type' => 'adoption_form'
            ]);

            $uploaded[] = $document;
        }

        return response()->json([
            'message' => 'Documents uploaded successfully',
            'documents' => $uploaded
        ]);
    }
}