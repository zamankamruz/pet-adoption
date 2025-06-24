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
use Illuminate\Support\Facades\Storage;
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

    // Start adoption process
    public function start(Pet $pet)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('message', 'Please login to start the adoption process.');
        }

        if (!$pet->canBeAdoptedBy(auth()->user())) {
            return redirect()->route('adoption.show', $pet)
                ->with('error', 'This pet cannot be adopted at this time.');
        }

        // Check if user has an existing adoption request for this pet
        $existingAdoption = auth()->user()->adoptionRequests()
            ->where('pet_id', $pet->id)
            ->where('status', 'draft')
            ->first();

        if ($existingAdoption) {
            return redirect()->route('adoption.step1', ['pet' => $pet->id]);
        }

        // Create new adoption request
        $adoption = Adoption::create([
            'user_id' => auth()->id(),
            'pet_id' => $pet->id,
            'status' => 'draft',
            'application_data' => [],
            'requested_at' => now(),
        ]);

        return view('adoption.start', compact('pet', 'adoption'));
    }

    // Step 1: Address
    public function step1(Pet $pet)
    {
        $adoption = $this->getOrCreateAdoption($pet);
        return view('adoption.step1', compact('pet', 'adoption'));
    }

    public function storeStep1(Request $request, Pet $pet)
    {
        $request->validate([
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'postcode' => 'required|string|max:20',
            'town' => 'required|string|max:100',
            'telephone' => 'required|string|max:20',
            'mobile' => 'required|string|max:20',
            'verification_code' => '|string|size:6',
        ]);

        $adoption = $this->getOrCreateAdoption($pet);
        
        $applicationData = $adoption->application_data ?? [];
        $applicationData['step1'] = $request->only([
            'address_line_1', 'address_line_2', 'postcode', 'town', 'telephone', 'mobile'
        ]);
        $applicationData['completed_steps'] = 1;

        $adoption->update(['application_data' => $applicationData]);

        return redirect()->route('adoption.step2', $pet);
    }

    // Step 2: Home
    public function step2(Pet $pet)
    {
        $adoption = $this->getOrCreateAdoption($pet);
        return view('adoption.step2', compact('pet', 'adoption'));
    }

    public function storeStep2(Request $request, Pet $pet)
    {
        $request->validate([
            'has_garden' => 'required|in:yes,no',
            'living_situation' => 'required|string',
            'household_setting' => 'required|string',
            'activity_level' => 'required|string',
        ]);

        $adoption = $this->getOrCreateAdoption($pet);
        
        $applicationData = $adoption->application_data ?? [];
        $applicationData['step2'] = $request->only([
            'has_garden', 'living_situation', 'household_setting', 'activity_level'
        ]);
        $applicationData['completed_steps'] = 2;

        $adoption->update(['application_data' => $applicationData]);

        return redirect()->route('adoption.step3', $pet);
    }

    // Step 3: Images of Home
    public function step3(Pet $pet)
    {
        $adoption = $this->getOrCreateAdoption($pet);
        return view('adoption.step3', compact('pet', 'adoption'));
    }

    public function storeStep3(Request $request, Pet $pet)
    {
        $request->validate([
            'home_images.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $adoption = $this->getOrCreateAdoption($pet);
        
        $imagePaths = [];
        if ($request->hasFile('home_images')) {
            foreach ($request->file('home_images') as $image) {
                $path = $image->store('adoption/home_images', 'public');
                $imagePaths[] = $path;
            }
        }

        $applicationData = $adoption->application_data ?? [];
        $applicationData['step3'] = ['home_images' => $imagePaths];
        $applicationData['completed_steps'] = 3;

        $adoption->update(['application_data' => $applicationData]);

        return redirect()->route('adoption.step4', $pet);
    }

    // Step 4: Roommate
    public function step4(Pet $pet)
    {
        $adoption = $this->getOrCreateAdoption($pet);
        return view('adoption.step4', compact('pet', 'adoption'));
    }

    public function storeStep4(Request $request, Pet $pet)
    {
        $request->validate([
            'number_of_adults' => 'required|integer|min:0',
            'number_of_children' => 'required|integer|min:0',
            'age_of_youngest_children' => 'nullable|string',
            'visiting_children' => 'required|in:yes,no',
            'ages_of_visiting_children' => 'nullable|string',
            'flatmates_lodgers' => 'required|in:yes,no',
        ]);

        $adoption = $this->getOrCreateAdoption($pet);
        
        $applicationData = $adoption->application_data ?? [];
        $applicationData['step4'] = $request->only([
            'number_of_adults', 'number_of_children', 'age_of_youngest_children',
            'visiting_children', 'ages_of_visiting_children', 'flatmates_lodgers'
        ]);
        $applicationData['completed_steps'] = 4;

        $adoption->update(['application_data' => $applicationData]);

        return redirect()->route('adoption.step5', $pet);
    }

    // Step 5: Other Animals
    public function step5(Pet $pet)
    {
        $adoption = $this->getOrCreateAdoption($pet);
        return view('adoption.step5', compact('pet', 'adoption'));
    }

    public function storeStep5(Request $request, Pet $pet)
    {
        $request->validate([
            'household_allergies' => 'required|in:yes,no',
            'allergy_details' => 'nullable|string',
            'other_animals' => 'required|in:yes,no',
            'other_animals_details' => 'nullable|string',
            'animals_neutered' => 'nullable|in:yes,no,not_applicable',
            'animals_vaccinated' => 'nullable|in:yes,no,not_applicable',
            'previous_pet_experience' => 'nullable|string',
        ]);

        $adoption = $this->getOrCreateAdoption($pet);
        
        $applicationData = $adoption->application_data ?? [];
        $applicationData['step5'] = $request->only([
            'household_allergies', 'allergy_details', 'other_animals', 'other_animals_details',
            'animals_neutered', 'animals_vaccinated', 'previous_pet_experience'
        ]);
        $applicationData['completed_steps'] = 5;

        $adoption->update(['application_data' => $applicationData]);

        return redirect()->route('adoption.step6', $pet);
    }

    // Step 6: Confirm
    public function step6(Pet $pet)
    {
        $adoption = $this->getOrCreateAdoption($pet);
        return view('adoption.step6', compact('pet', 'adoption'));
    }

    public function storeStep6(Request $request, Pet $pet)
    {
        $request->validate([
            'terms_agreement' => 'required|accepted',
        ]);

        $adoption = $this->getOrCreateAdoption($pet);
        
        // Update status to pending
        $adoption->update([
            'status' => 'pending',
            'reference_number' => 'ADO-' . now()->format('Ymd') . '-' . rand(1000, 9999),
        ]);

       
        return redirect()->route('adoption.complete', $pet);
    }

    // Complete
    public function complete(Pet $pet)
    {
        $adoption = auth()->user()->adoptionRequests()
            ->where('pet_id', $pet->id)
            ->where('status', 'pending')
            ->latest()
            ->first();

        if (!$adoption) {
            return redirect()->route('adoption.show', $pet);
        }

        return view('adoption.complete', compact('pet', 'adoption'));
    }

    // Helper method to get or create adoption
    private function getOrCreateAdoption(Pet $pet)
    {
        return auth()->user()->adoptionRequests()
            ->where('pet_id', $pet->id)
            ->where('status', 'draft')
            ->firstOrCreate([
                'user_id' => auth()->id(),
                'pet_id' => $pet->id,
                'status' => 'draft',
            ], [
                'application_data' => [],
                'requested_at' => now(),
            ]);
    }

    // Send verification code
    public function sendVerificationCode(Request $request)
    {
        $request->validate([
            'mobile' => 'required|string|max:20',
        ]);

        // Generate 6-digit code
        $code = rand(100000, 999999);
        
        // Store in session for verification
        session(['verification_code' => $code, 'mobile_number' => $request->mobile]);

        // Here you would integrate with SMS service
        // For demo purposes, we'll just return success
        
        return response()->json([
            'success' => true,
            'message' => 'Verification code sent to ' . $request->mobile,
            'code' => $code // Remove this in production
        ]);
    }

    // Verify code
    public function verifyCode(Request $request)
    {
        $request->validate([
            'code' => 'required|string|size:6',
        ]);

        $sessionCode = session('verification_code');
        
        if ($request->code == $sessionCode) {
            session(['mobile_verified' => true]);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Invalid verification code']);
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

        return view('adoption.show-request', compact('adoption'));
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
}