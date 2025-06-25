<?php
// File: AdminTestimonialController.php
// Path: /app/Http/Controllers/Admin/AdminTestimonialController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminTestimonialController extends Controller
{

    public function index(Request $request)
    {
        $query = Testimonial::with(['user', 'pet']);

        // Apply filters
        if ($request->filled('status')) {
            if ($request->status === 'approved') {
                $query->where('is_approved', true);
            } elseif ($request->status === 'pending') {
                $query->where('is_approved', false);
            }
        }

        if ($request->filled('featured')) {
            $query->where('is_featured', $request->featured);
        }

        if ($request->filled('rating')) {
            $query->where('rating', '>=', $request->rating);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('testimonial', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        $testimonials = $query->latest()->paginate(20)->withQueryString();

        $stats = [
            'total' => Testimonial::count(),
            'approved' => Testimonial::where('is_approved', true)->count(),
            'pending' => Testimonial::where('is_approved', false)->count(),
            'featured' => Testimonial::where('is_featured', true)->count(),
        ];

        return view('admin.testimonials.index', compact('testimonials', 'stats'));
    }

    public function create()
    {
        $users = User::where('is_admin', false)->orderBy('name')->get();
        $pets = Pet::with('breed')->orderBy('name')->get();
        
        return view('admin.testimonials.create', compact('users', 'pets'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'testimonial' => 'required|string|min:10',
            'rating' => 'required|integer|min:1|max:5',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'user_id' => 'nullable|exists:users,id',
            'pet_id' => 'nullable|exists:pets,id',
            'is_featured' => 'boolean',
            'is_approved' => 'boolean',
        ]);

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('testimonials', 'public');
        }

        Testimonial::create($validated);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial created successfully!');
    }

    public function show(Testimonial $testimonial)
    {
        $testimonial->load(['user', 'pet']);
        return view('admin.testimonials.show', compact('testimonial'));
    }

    public function edit(Testimonial $testimonial)
    {
        $users = User::where('is_admin', false)->orderBy('name')->get();
        $pets = Pet::with('breed')->orderBy('name')->get();
        
        return view('admin.testimonials.edit', compact('testimonial', 'users', 'pets'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'testimonial' => 'required|string|min:10',
            'rating' => 'required|integer|min:1|max:5',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'user_id' => 'nullable|exists:users,id',
            'pet_id' => 'nullable|exists:pets,id',
            'is_featured' => 'boolean',
            'is_approved' => 'boolean',
        ]);

        if ($request->hasFile('avatar')) {
            // Delete old avatar
            if ($testimonial->avatar) {
                Storage::disk('public')->delete($testimonial->avatar);
            }
            $validated['avatar'] = $request->file('avatar')->store('testimonials', 'public');
        }

        $testimonial->update($validated);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial updated successfully!');
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->avatar) {
            Storage::disk('public')->delete($testimonial->avatar);
        }

        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial deleted successfully!');
    }

public function approve(Testimonial $testimonial)
{
    $testimonial->update(['is_approved' => true]);

    return redirect()->back()
        ->with('success', 'Testimonial approved successfully!');
}

    public function toggleFeature(Testimonial $testimonial)
    {
        $testimonial->update(['is_featured' => !$testimonial->is_featured]);

        $status = $testimonial->is_featured ? 'featured' : 'unfeatured';
        
        return redirect()->back()
            ->with('success', "Testimonial {$status} successfully!");
    }

    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:approve,disapprove,feature,unfeature,delete',
            'testimonial_ids' => 'required|array',
            'testimonial_ids.*' => 'exists:testimonials,id'
        ]);

        $testimonials = Testimonial::whereIn('id', $request->testimonial_ids);
        $count = $testimonials->count();

        switch ($request->action) {
            case 'approve':
                $testimonials->update(['is_approved' => true]);
                $message = "{$count} testimonials approved successfully";
                break;
                
            case 'disapprove':
                $testimonials->update(['is_approved' => false]);
                $message = "{$count} testimonials disapproved successfully";
                break;
                
            case 'feature':
                $testimonials->update(['is_featured' => true]);
                $message = "{$count} testimonials featured successfully";
                break;
                
            case 'unfeature':
                $testimonials->update(['is_featured' => false]);
                $message = "{$count} testimonials unfeatured successfully";
                break;
                
            case 'delete':
                foreach ($testimonials->get() as $testimonial) {
                    if ($testimonial->avatar) {
                        Storage::disk('public')->delete($testimonial->avatar);
                    }
                    $testimonial->delete();
                }
                $message = "{$count} testimonials deleted successfully";
                break;
        }

        return redirect()->back()->with('success', $message);
    }
}