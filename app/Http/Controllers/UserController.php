<?php
// File: UserController.php
// Path: /app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pet;
use App\Models\Adoption;
use App\Models\Favorite;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{


    public function dashboard()
    {
        $user = auth()->user();
        
        $stats = [
            'adoption_requests' => $user->adoptionRequests()->count(),
            'pending_adoptions' => $user->adoptionRequests()->where('status', 'pending')->count(),
            'favorites' => $user->favorites()->count(),
            'messages' => $user->receivedMessages()->where('is_read', false)->count(),
            'pets_listed' => $user->pets()->count(),
            'rehoming_requests' => $user->rehomingRequests()->count(),
        ];

        $recentAdoptions = $user->adoptionRequests()
            ->with(['pet.images'])
            ->latest()
            ->take(5)
            ->get();

        $recentMessages = $user->receivedMessages()
            ->with('sender')
            ->latest()
            ->take(5)
            ->get();

        return view('user.dashboard', compact('stats', 'recentAdoptions', 'recentMessages'));
    }

    public function overview()
    {
        return $this->dashboard();
    }

    public function profile()
    {
        $user = auth()->user();
        return view('user.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'zip_code' => 'nullable|string|max:10',
            'bio' => 'nullable|string|max:1000',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $user->update($validated);

        return redirect()->route('user.profile')
            ->with('success', 'Profile updated successfully!');
    }

    public function settings()
    {
        $user = auth()->user();
        return view('user.settings', compact('user'));
    }

    public function updateSettings(Request $request)
    {
        $user = auth()->user();
        
        $validated = $request->validate([
            'current_password' => 'required_with:password',
            'password' => 'nullable|min:8|confirmed',
            'preferences' => 'nullable|array',
            'email_notifications' => 'boolean',
            'sms_notifications' => 'boolean',
        ]);

        if ($request->filled('password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->back()
                    ->withErrors(['current_password' => 'Current password is incorrect.']);
            }
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password'], $validated['current_password']);
        }

        $user->update($validated);

        return redirect()->route('user.settings')
            ->with('success', 'Settings updated successfully!');
    }

    public function adoptions()
    {
        $adoptions = auth()->user()->adoptionRequests()
            ->with(['pet.breed', 'pet.location', 'pet.images'])
            ->latest()
            ->paginate(10);

        return view('user.adoptions', compact('adoptions'));
    }

    public function showAdoption(Adoption $adoption)
    {
        $this->authorize('view', $adoption);
        
        $adoption->load(['pet.breed', 'pet.location', 'pet.images']);

        return view('user.adoption-show', compact('adoption'));
    }

public function rehomedPets()
{
    $user = auth()->user();
    
    // Get user's rehoming requests
    $rehomings = $user->rehomingRequests()
        ->latest()
        ->paginate(10);

    // Get the active pet (if any) - for example, the most recent published pet
    $activePet = $user->pets()
        ->where('status', 'available')
        ->latest()
        ->first();

    // Get adoption requests for the active pet
    $adoptionRequests = collect();
    if ($activePet) {
        $adoptionRequests = $activePet->adoptionRequests()
            ->with(['user'])
            ->where('status', 'pending')
            ->latest()
            ->get();
    }

    // Get favorite pets for display
    $favoritePets = $user->favorites()
        ->with(['pet.breed', 'pet.location', 'pet.images'])
        ->whereHas('pet', function($query) {
            $query->whereNull('deleted_at');
        })
        ->latest()
        ->take(3)
        ->get();

    return view('user.rehomed', compact('rehomings', 'activePet', 'adoptionRequests', 'favoritePets'));
}



    public function favorites()
    {
        $favorites = auth()->user()->favorites()
            ->with(['pet.breed', 'pet.location', 'pet.images'])
            ->latest()
            ->paginate(12);

        return view('user.favorites', compact('favorites'));
    }

    public function messages()
    {
        $conversations = Message::where('sender_id', auth()->id())
            ->orWhere('receiver_id', auth()->id())
            ->with(['sender', 'receiver'])
            ->latest()
            ->paginate(10);

        return view('user.messages', compact('conversations'));
    }

    public function deleteAccount()
    {
        $user = auth()->user();
        
        // Check if user has pending adoptions
        if ($user->adoptionRequests()->whereIn('status', ['pending', 'approved'])->exists()) {
            return redirect()->back()
                ->with('error', 'Cannot delete account with pending adoption requests.');
        }

        // Delete avatar
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        // Soft delete user
        $user->delete();

        auth()->logout();

        return redirect()->route('home')
            ->with('success', 'Account deleted successfully.');
    }

    public function uploadAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $user = auth()->user();

        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        $path = $request->file('avatar')->store('avatars', 'public');
        $user->update(['avatar' => $path]);

        return response()->json([
            'message' => 'Avatar uploaded successfully',
            'avatar_url' => $user->avatar_url
        ]);
    }

    public function getNotifications()
    {
        $notifications = auth()->user()->notifications()
            ->latest()
            ->take(10)
            ->get();

        return response()->json([
            'notifications' => $notifications,
            'unread_count' => auth()->user()->unreadNotifications()->count()
        ]);
    }

    public function markNotificationsAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();

        return response()->json(['message' => 'Notifications marked as read']);
    }
}