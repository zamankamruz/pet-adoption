<?php
// File: FavoriteController.php
// Path: /app/Http/Controllers/FavoriteController.php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $favorites = auth()->user()->favorites()
            ->with(['pet.breed', 'pet.location', 'pet.images'])
            ->whereHas('pet', function($query) {
                $query->whereNull('deleted_at'); // Only show favorites for existing pets
            })
            ->latest()
            ->paginate(12);

        $totalFavorites = auth()->user()->favorites()->count();

        return view('user.favorites', compact('favorites', 'totalFavorites'));
    }

    public function toggle(Pet $pet)
    {
        $user = auth()->user();
        
        $favorite = $user->favorites()->where('pet_id', $pet->id)->first();

        if ($favorite) {
            $favorite->delete();
            $favorited = false;
            $message = 'Pet removed from favorites';
        } else {
            $user->favorites()->create(['pet_id' => $pet->id]);
            $favorited = true;
            $message = 'Pet added to favorites';
        }

        if (request()->ajax()) {
            return response()->json([
                'favorited' => $favorited,
                'message' => $message,
                'favorites_count' => $user->favorites()->count()
            ]);
        }

        return redirect()->back()->with('success', $message);
    }

    public function remove(Pet $pet)
    {
        $user = auth()->user();
        
        $favorite = $user->favorites()->where('pet_id', $pet->id)->first();

        if ($favorite) {
            $favorite->delete();
            $message = 'Pet removed from favorites successfully';
        } else {
            $message = 'Pet was not in your favorites';
        }

        if (request()->ajax()) {
            return response()->json([
                'message' => $message,
                'favorites_count' => $user->favorites()->count()
            ]);
        }

        return redirect()->back()->with('success', $message);
    }

    public function ajaxToggle(Pet $pet)
    {
        if (!auth()->check()) {
            return response()->json([
                'error' => 'You must be logged in to favorite pets',
                'redirect' => route('login')
            ], 401);
        }

        $user = auth()->user();
        $favorite = $user->favorites()->where('pet_id', $pet->id)->first();

        if ($favorite) {
            $favorite->delete();
            $favorited = false;
            $message = 'Removed from favorites';
        } else {
            $user->favorites()->create(['pet_id' => $pet->id]);
            $favorited = true;
            $message = 'Added to favorites';
        }

        return response()->json([
            'favorited' => $favorited,
            'message' => $message,
            'favorites_count' => $user->favorites()->count(),
            'pet_id' => $pet->id
        ]);
    }

    public function addMultiple(Request $request)
    {
        $request->validate([
            'pet_ids' => 'required|array',
            'pet_ids.*' => 'exists:pets,id'
        ]);

        $user = auth()->user();
        $addedCount = 0;

        foreach ($request->pet_ids as $petId) {
            $exists = $user->favorites()->where('pet_id', $petId)->exists();
            if (!$exists) {
                $user->favorites()->create(['pet_id' => $petId]);
                $addedCount++;
            }
        }

        return response()->json([
            'message' => "{$addedCount} pets added to favorites",
            'favorites_count' => $user->favorites()->count()
        ]);
    }

    public function removeMultiple(Request $request)
    {
        $request->validate([
            'pet_ids' => 'required|array',
            'pet_ids.*' => 'exists:pets,id'
        ]);

        $user = auth()->user();
        $removedCount = $user->favorites()->whereIn('pet_id', $request->pet_ids)->delete();

        return response()->json([
            'message' => "{$removedCount} pets removed from favorites",
            'favorites_count' => $user->favorites()->count()
        ]);
    }

    public function clear()
    {
        $user = auth()->user();
        $count = $user->favorites()->count();
        $user->favorites()->delete();

        if (request()->ajax()) {
            return response()->json([
                'message' => "All {$count} favorites cleared",
                'favorites_count' => 0
            ]);
        }

        return redirect()->route('user.favorites')
            ->with('success', "All {$count} favorites cleared successfully");
    }

    public function export()
    {
        $user = auth()->user();
        $favorites = $user->favorites()
            ->with(['pet.breed', 'pet.location'])
            ->get();

        $csvData = [];
        $csvData[] = ['Pet Name', 'Breed', 'Age', 'Gender', 'Size', 'Location', 'Added Date', 'Pet URL'];

        foreach ($favorites as $favorite) {
            $pet = $favorite->pet;
            $csvData[] = [
                $pet->name,
                $pet->breed->name,
                $pet->age_display,
                ucfirst($pet->gender),
                ucfirst($pet->size),
                $pet->location->full_location,
                $favorite->created_at->format('Y-m-d'),
                route('pets.show', $pet)
            ];
        }

        $filename = 'my-favorite-pets-' . now()->format('Y-m-d') . '.csv';

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

    public function getFavoritesCount()
    {
        if (!auth()->check()) {
            return response()->json(['count' => 0]);
        }

        $count = auth()->user()->favorites()->count();
        
        return response()->json(['count' => $count]);
    }

    public function checkFavoriteStatus(Pet $pet)
    {
        if (!auth()->check()) {
            return response()->json(['favorited' => false]);
        }

        $favorited = auth()->user()->favorites()->where('pet_id', $pet->id)->exists();
        
        return response()->json(['favorited' => $favorited]);
    }
}