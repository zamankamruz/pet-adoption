<?php
// File: RehomingController.php
// Path: /app/Http/Controllers/RehomingController.php

namespace App\Http\Controllers;

use App\Models\Rehoming;
use App\Models\Breed;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Requests\RehomingRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RehomingController extends Controller
{

    use AuthorizesRequests;
    
    public function index()
    {
        return view('rehoming.index');
    }

    public function howItWorks()
    {
        return view('rehoming.how-it-works');
    }

    public function faqRehomers()
    {
        return view('rehoming.faq-rehomers');
    }

    public function start()
    {
        // Check if user has incomplete rehoming request
        $existingRehoming = auth()->user()->rehomingRequests()
            ->where('status', 'draft')
            ->first();

        if ($existingRehoming) {
            $nextStep = $existingRehoming->step_completed + 1;
            if ($nextStep <= 9) {
                return redirect()->route('rehoming.step' . $nextStep);
            }
        }

        return view('rehoming.start');
    }

    // Step 1: Start/User Info
    public function step1()
    {
        $rehoming = auth()->user()->rehomingRequests()
            ->where('status', 'draft')
            ->first() ?? new Rehoming(['user_id' => auth()->id()]);

        return view('rehoming.step1', compact('rehoming'));
    }

    public function storeStep1(Request $request)
    {
        $validated = $request->validate([
            'agree_terms' => 'required|accepted',
        ]);

        $rehoming = auth()->user()->rehomingRequests()
            ->where('status', 'draft')
            ->first();

        if ($rehoming) {
            $rehoming->update(['step_completed' => 1]);
        } else {
            $rehoming = Rehoming::create([
                'user_id' => auth()->id(),
                'step_completed' => 1,
                'status' => 'draft'
            ]);
        }

        return redirect()->route('rehoming.step2')
            ->with('success', 'Step 1 completed successfully!');
    }

    // Step 2: Primary Questions
    public function step2()
    {
        $rehoming = auth()->user()->rehomingRequests()
            ->where('status', 'draft')
            ->where('step_completed', '>=', 1)
            ->firstOrFail();

        return view('rehoming.step2', compact('rehoming'));
    }

    public function storeStep2(Request $request)
    {
        $validated = $request->validate([
            'species' => 'required|in:dog,cat',
            'spayed_neutered' => 'required|in:yes,no',
            'reason_for_rehoming' => 'required|string',
            'how_long_keep' => 'required|string',
        ]);

        $rehoming = auth()->user()->rehomingRequests()
            ->where('status', 'draft')
            ->where('step_completed', '>=', 1)
            ->firstOrFail();

        $rehoming->update($validated + ['step_completed' => 2]);

        return redirect()->route('rehoming.step3')
            ->with('success', 'Step 2 completed successfully!');
    }

    // Step 3: Pet Images
    public function step3()
    {
        $rehoming = auth()->user()->rehomingRequests()
            ->where('status', 'draft')
            ->where('step_completed', '>=', 2)
            ->firstOrFail();

        return view('rehoming.step3', compact('rehoming'));
    }

    public function storeStep3(Request $request)
    {
        $request->validate([
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $rehoming = auth()->user()->rehomingRequests()
            ->where('status', 'draft')
            ->where('step_completed', '>=', 2)
            ->firstOrFail();

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('rehoming/pets', 'public');
                $imagePaths[] = $path;
            }
        }

        $rehoming->update([
            'images' => $imagePaths,
            'step_completed' => 3
        ]);

        return redirect()->route('rehoming.step4')
            ->with('success', 'Step 3 completed successfully!');
    }

    // Step 4: Characteristics
    public function step4()
    {
        $rehoming = auth()->user()->rehomingRequests()
            ->where('status', 'draft')
            ->where('step_completed', '>=', 3)
            ->firstOrFail();

        return view('rehoming.step4', compact('rehoming'));
    }

    public function storeStep4(Request $request)
    {
        $validated = $request->validate([
            'shots_up_to_date' => 'required|in:yes,no,unknown',
            'microchipped' => 'required|in:yes,no,unknown',
            'house_trained' => 'required|in:yes,no,unknown',
            'good_with_dogs' => 'required|in:yes,no,unknown',
            'good_with_cats' => 'required|in:yes,no,unknown',
            'good_with_kids' => 'required|in:yes,no,unknown',
            'purebred' => 'required|in:yes,no,unknown',
            'has_special_needs' => 'required|in:yes,no,unknown',
            'has_behavioral_issues' => 'required|in:yes,no,unknown',
        ]);

        $rehoming = auth()->user()->rehomingRequests()
            ->where('status', 'draft')
            ->where('step_completed', '>=', 3)
            ->firstOrFail();

        $rehoming->update($validated + ['step_completed' => 4]);

        return redirect()->route('rehoming.step5')
            ->with('success', 'Step 4 completed successfully!');
    }

    // Step 5: Key Facts
    public function step5()
    {
        $rehoming = auth()->user()->rehomingRequests()
            ->where('status', 'draft')
            ->where('step_completed', '>=', 4)
            ->firstOrFail();

        return view('rehoming.step5', compact('rehoming'));
    }

    public function storeStep5(Request $request)
    {
        $validated = $request->validate([
            'pet_name' => 'required|string|max:255',
            'age_years' => 'required|integer|min:0|max:30',
            'size' => 'required|in:small,medium,large,extra_large',
            'gender' => 'required|in:male,female',
            'breed' => 'required|string|max:255',
            'color' => 'required|string|max:255',
        ]);

        $rehoming = auth()->user()->rehomingRequests()
            ->where('status', 'draft')
            ->where('step_completed', '>=', 4)
            ->firstOrFail();

        $rehoming->update($validated + ['step_completed' => 5]);

        return redirect()->route('rehoming.step6')
            ->with('success', 'Step 5 completed successfully!');
    }

    // Step 6: Pet's Location
    public function step6()
    {
        $rehoming = auth()->user()->rehomingRequests()
            ->where('status', 'draft')
            ->where('step_completed', '>=', 5)
            ->firstOrFail();

        return view('rehoming.step6', compact('rehoming'));
    }

    public function storeStep6(Request $request)
    {
        $validated = $request->validate([
            'postcode' => 'required|string|max:10',
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
        ]);

        $rehoming = auth()->user()->rehomingRequests()
            ->where('status', 'draft')
            ->where('step_completed', '>=', 5)
            ->firstOrFail();

        $rehoming->update($validated + ['step_completed' => 6]);

        return redirect()->route('rehoming.step7')
            ->with('success', 'Step 6 completed successfully!');
    }

    // Step 7: Pet's Story
    public function step7()
    {
        $rehoming = auth()->user()->rehomingRequests()
            ->where('status', 'draft')
            ->where('step_completed', '>=', 6)
            ->firstOrFail();

        return view('rehoming.step7', compact('rehoming'));
    }

    public function storeStep7(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string|min:50',
        ]);

        $rehoming = auth()->user()->rehomingRequests()
            ->where('status', 'draft')
            ->where('step_completed', '>=', 6)
            ->firstOrFail();

        $rehoming->update($validated + ['step_completed' => 7]);

        return redirect()->route('rehoming.step8')
            ->with('success', 'Step 7 completed successfully!');
    }

    // Step 8: Documents
    public function step8()
    {
        $rehoming = auth()->user()->rehomingRequests()
            ->where('status', 'draft')
            ->where('step_completed', '>=', 7)
            ->firstOrFail();

        return view('rehoming.step8', compact('rehoming'));
    }

    public function storeStep8(Request $request)
    {
        $request->validate([
            'documents' => 'nullable',
            'documents.*' => 'file|mimes:pdf,doc,docx,jpg,png|max:5120'
        ]);

        $rehoming = auth()->user()->rehomingRequests()
            ->where('status', 'draft')
            ->where('step_completed', '>=', 7)
            ->firstOrFail();

        $documentPaths = [];
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $document) {
                $path = $document->store('rehoming/documents', 'public');
                $documentPaths[] = [
                    'path' => $path,
                    'name' => $document->getClientOriginalName(),
                    'type' => $document->getClientMimeType()
                ];
            }
        }

        $rehoming->update([
            'documents' => $documentPaths,
            'step_completed' => 8
        ]);

        return redirect()->route('rehoming.step9')
            ->with('success', 'Step 8 completed successfully!');
    }

    // Step 9: Confirm
    public function step9()
    {
        $rehoming = auth()->user()->rehomingRequests()
            ->where('status', 'draft')
            ->where('step_completed', '>=', 8)
            ->firstOrFail();

        return view('rehoming.step9', compact('rehoming'));
    }

    public function storeStep9(Request $request)
    {
        $rehoming = auth()->user()->rehomingRequests()
            ->where('status', 'draft')
            ->where('step_completed', '>=', 8)
            ->firstOrFail();

        $rehoming->update([
            'step_completed' => 9,
            'status' => 'pending',
            'submitted_at' => now()
        ]);

        return redirect()->route('rehoming.complete')
            ->with('success', 'Rehoming request submitted successfully!');
    }

    public function complete()
    {
        $rehoming = auth()->user()->rehomingRequests()
            ->where('status', 'pending')
            ->latest()
            ->firstOrFail();

        return view('rehoming.complete', compact('rehoming'));
    }

    public function myPets()
    {
        $rehomings = auth()->user()->rehomingRequests()
            ->latest()
            ->paginate(10);

        return view('user.rehoming.index', compact('rehomings'));
    }

    public function showMyPet(Rehoming $rehoming)
    {

        return view('user.rehoming.show', compact('rehoming'));
    }

    public function editMyPet(Rehoming $rehoming)
    {

        if (!in_array($rehoming->status, ['draft', 'pending'])) {
            return redirect()->back()
                ->with('error', 'This rehoming request cannot be edited.');
        }

        return view('user.rehoming.edit', compact('rehoming'));
    }

    public function updateMyPet(Request $request, Rehoming $rehoming)
    {
        $this->authorize('update', $rehoming);

        if (!in_array($rehoming->status, ['draft', 'pending'])) {
            return redirect()->back()
                ->with('error', 'This rehoming request cannot be edited.');
        }

        $validated = $request->validate([
            'pet_name' => 'required|string|max:255',
            'species' => 'required|string',
            'breed' => 'required|string',
            'age_years' => 'required|integer',
            'gender' => 'required|in:male,female',
            'size' => 'required|in:small,medium,large,extra_large',
            'description' => 'required|string|min:50',
            'reason_for_rehoming' => 'required|string|min:20',
            'good_with_kids' => 'boolean',
            'good_with_pets' => 'boolean',
            'spayed_neutered' => 'boolean',
            'house_trained' => 'boolean',
            'special_needs' => 'nullable|string',
        ]);

        $rehoming->update($validated);

        return redirect()->route('rehoming.my-pets')
            ->with('success', 'Rehoming request updated successfully!');
    }

    public function deleteMyPet(Rehoming $rehoming)
    {
        $this->authorize('delete', $rehoming);

        if (!in_array($rehoming->status, ['draft', 'pending'])) {
            return redirect()->back()
                ->with('error', 'This rehoming request cannot be deleted.');
        }

        $rehoming->delete();

        return redirect()->route('rehoming.my-pets')
            ->with('success', 'Rehoming request deleted successfully!');
    }
}