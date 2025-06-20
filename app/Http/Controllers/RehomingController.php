<?php
// File: RehomingController.php
// Path: /app/Http/Controllers/RehomingController.php

namespace App\Http\Controllers;

use App\Models\Rehoming;
use App\Models\Breed;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Requests\RehomingRequest;

class RehomingController extends Controller
{


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
            return redirect()->route('rehoming.step' . ($existingRehoming->step_completed + 1));
        }

        return view('rehoming.start');
    }

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
            'pet_name' => 'required|string|max:255',
            'species' => 'required|string',
            'breed' => 'required|string',
            'age' => 'required|string',
            'gender' => 'required|in:male,female',
            'size' => 'required|in:small,medium,large,extra_large',
            'description' => 'required|string|min:50',
        ]);

        $rehoming = auth()->user()->rehomingRequests()
            ->where('status', 'draft')
            ->first();

        if ($rehoming) {
            $rehoming->update($validated + ['step_completed' => 1]);
        } else {
            $rehoming = Rehoming::create($validated + [
                'user_id' => auth()->id(),
                'step_completed' => 1,
                'status' => 'draft'
            ]);
        }

        return redirect()->route('rehoming.step2')
            ->with('success', 'Step 1 completed successfully!');
    }

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
            'reason_for_rehoming' => 'required|string|min:20',
            'good_with_kids' => 'boolean',
            'good_with_pets' => 'boolean',
            'vaccination_status' => 'required|in:up_to_date,partial,none,unknown',
            'spayed_neutered' => 'boolean',
            'house_trained' => 'boolean',
            'special_needs' => 'nullable|string',
        ]);

        $rehoming = auth()->user()->rehomingRequests()
            ->where('status', 'draft')
            ->where('step_completed', '>=', 1)
            ->firstOrFail();

        $rehoming->update($validated + ['step_completed' => 2]);

        return redirect()->route('rehoming.step3')
            ->with('success', 'Step 2 completed successfully!');
    }

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
        $validated = $request->validate([
            'contact_preferences' => 'required|array',
            'contact_preferences.*' => 'in:email,phone,text',
        ]);

        $rehoming = auth()->user()->rehomingRequests()
            ->where('status', 'draft')
            ->where('step_completed', '>=', 2)
            ->firstOrFail();

        $rehoming->update($validated + [
            'step_completed' => 3,
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

        return view('rehoming.my-pets', compact('rehomings'));
    }

    public function showMyPet(Rehoming $rehoming)
    {
        $this->authorize('view', $rehoming);

        return view('rehoming.show', compact('rehoming'));
    }

    public function editMyPet(Rehoming $rehoming)
    {
        $this->authorize('update', $rehoming);

        if (!in_array($rehoming->status, ['draft', 'pending'])) {
            return redirect()->back()
                ->with('error', 'This rehoming request cannot be edited.');
        }

        return view('rehoming.edit', compact('rehoming'));
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
            'age' => 'required|string',
            'gender' => 'required|in:male,female',
            'size' => 'required|in:small,medium,large,extra_large',
            'description' => 'required|string|min:50',
            'reason_for_rehoming' => 'required|string|min:20',
            'good_with_kids' => 'boolean',
            'good_with_pets' => 'boolean',
            'vaccination_status' => 'required|in:up_to_date,partial,none,unknown',
            'spayed_neutered' => 'boolean',
            'house_trained' => 'boolean',
            'special_needs' => 'nullable|string',
            'contact_preferences' => 'required|array',
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