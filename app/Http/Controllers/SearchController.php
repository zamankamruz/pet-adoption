<?php
// File: SearchController.php
// Path: /app/Http/Controllers/SearchController.php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Breed;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function pets(Request $request)
    {
        $query = $request->get('q');
        $filters = $request->only([
            'species', 'breed_id', 'category_id', 'size', 'age_min', 'age_max',
            'location_id', 'gender', 'color', 'good_with_kids', 'good_with_pets',
            'energy_level', 'training_level', 'adoption_fee_max'
        ]);

        $petsQuery = Pet::with(['breed', 'category', 'location', 'images'])
            ->available();

        // Text search
        if ($query) {
            $petsQuery->where(function($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('description', 'LIKE', "%{$query}%")
                  ->orWhere('personality', 'LIKE', "%{$query}%")
                  ->orWhereHas('breed', function($breedQuery) use ($query) {
                      $breedQuery->where('name', 'LIKE', "%{$query}%");
                  })
                  ->orWhere('color', 'LIKE', "%{$query}%");
            });
        }

        // Apply filters
        foreach ($filters as $key => $value) {
            if (empty($value)) continue;

            switch ($key) {
                case 'species':
                    $petsQuery->where('species', $value);
                    break;
                case 'breed_id':
                    $petsQuery->where('breed_id', $value);
                    break;
                case 'category_id':
                    $petsQuery->where('category_id', $value);
                    break;
                case 'size':
                    $petsQuery->whereIn('size', is_array($value) ? $value : [$value]);
                    break;
                case 'age_min':
                    $petsQuery->where('age_years', '>=', $value);
                    break;
                case 'age_max':
                    $petsQuery->where('age_years', '<=', $value);
                    break;
                case 'location_id':
                    $petsQuery->where('location_id', $value);
                    break;
                case 'gender':
                    $petsQuery->whereIn('gender', is_array($value) ? $value : [$value]);
                    break;
                case 'color':
                    $petsQuery->whereIn('color', is_array($value) ? $value : [$value]);
                    break;
                case 'good_with_kids':
                    if ($value) $petsQuery->where('good_with_kids', true);
                    break;
                case 'good_with_pets':
                    if ($value) $petsQuery->where('good_with_pets', true);
                    break;
                case 'energy_level':
                    $petsQuery->whereIn('energy_level', is_array($value) ? $value : [$value]);
                    break;
                case 'training_level':
                    $petsQuery->whereIn('training_level', is_array($value) ? $value : [$value]);
                    break;
                case 'adoption_fee_max':
                    $petsQuery->where('adoption_fee', '<=', $value);
                    break;
            }
        }

        // Sorting
        $sort = $request->get('sort', 'relevance');
        switch ($sort) {
            case 'name':
                $petsQuery->orderBy('name');
                break;
            case 'age':
                $petsQuery->orderBy('age_years')->orderBy('age_months');
                break;
            case 'fee_low':
                $petsQuery->orderBy('adoption_fee');
                break;
            case 'fee_high':
                $petsQuery->orderByDesc('adoption_fee');
                break;
            case 'newest':
                $petsQuery->orderByDesc('created_at');
                break;
            case 'featured':
                $petsQuery->orderByDesc('is_featured')->orderByDesc('created_at');
                break;
            default: // relevance
                if ($query) {
                    $petsQuery->orderByRaw("
                        CASE 
                            WHEN name LIKE '%{$query}%' THEN 1
                            WHEN description LIKE '%{$query}%' THEN 2
                            ELSE 3
                        END
                    ");
                } else {
                    $petsQuery->orderByDesc('is_featured')->orderByDesc('created_at');
                }
        }

        $pets = $petsQuery->paginate(12)->withQueryString();
        
        // Get filter options for sidebar
        $breeds = Breed::active()->orderBy('name')->get();
        $locations = Location::active()->orderBy('city')->get();
        $categories = Category::active()->orderBy('name')->get();

        // Get available colors for filter
        $colors = Pet::available()
            ->select('color')
            ->distinct()
            ->whereNotNull('color')
            ->orderBy('color')
            ->pluck('color');

        return view('search.pets', compact(
            'pets', 'query', 'filters', 'breeds', 'locations', 'categories', 'colors'
        ));
    }

    public function suggestions(Request $request)
    {
        $query = $request->get('q');
        
        if (strlen($query) < 2) {
            return response()->json(['suggestions' => []]);
        }

        $suggestions = [];

        // Pet names
        $petNames = Pet::available()
            ->where('name', 'LIKE', "%{$query}%")
            ->select('name')
            ->distinct()
            ->limit(5)
            ->get()
            ->map(function($pet) {
                return [
                    'type' => 'pet',
                    'value' => $pet->name,
                    'label' => $pet->name,
                    'url' => route('pets.search', ['q' => $pet->name])
                ];
            });

        // Breed names
        $breeds = Breed::active()
            ->where('name', 'LIKE', "%{$query}%")
            ->limit(5)
            ->get()
            ->map(function($breed) {
                return [
                    'type' => 'breed',
                    'value' => $breed->name,
                    'label' => $breed->name . ' (Breed)',
                    'url' => route('pets.search', ['breed_id' => $breed->id])
                ];
            });

        // Locations
        $locations = Location::active()
            ->where('city', 'LIKE', "%{$query}%")
            ->orWhere('state', 'LIKE', "%{$query}%")
            ->limit(3)
            ->get()
            ->map(function($location) {
                return [
                    'type' => 'location',
                    'value' => $location->full_location,
                    'label' => $location->full_location . ' (Location)',
                    'url' => route('pets.search', ['location_id' => $location->id])
                ];
            });

        $suggestions = $petNames->concat($breeds)->concat($locations);

        return response()->json(['suggestions' => $suggestions]);
    }

    public function autoComplete(Request $request)
    {
        $query = $request->get('term');
        
        if (strlen($query) < 2) {
            return response()->json([]);
        }

        $results = [];

        // Search pets
        $pets = Pet::available()
            ->where('name', 'LIKE', "%{$query}%")
            ->with(['breed', 'location'])
            ->limit(5)
            ->get();

        foreach ($pets as $pet) {
            $results[] = [
                'label' => $pet->name . ' - ' . $pet->breed->name . ' (' . $pet->location->city . ')',
                'value' => $pet->name,
                'id' => $pet->id,
                'type' => 'pet',
                'url' => route('pets.show', $pet)
            ];
        }

        // Search breeds
        $breeds = Breed::active()
            ->where('name', 'LIKE', "%{$query}%")
            ->limit(3)
            ->get();

        foreach ($breeds as $breed) {
            $results[] = [
                'label' => $breed->name . ' (Breed)',
                'value' => $breed->name,
                'id' => $breed->id,
                'type' => 'breed',
                'url' => route('pets.search', ['breed_id' => $breed->id])
            ];
        }

        return response()->json($results);
    }

    public function getFilters()
    {
        $filters = [
            'breeds' => Breed::active()->orderBy('name')->get(['id', 'name']),
            'categories' => Category::active()->orderBy('name')->get(['id', 'name']),
            'locations' => Location::active()->orderBy('city')->get(['id', 'city', 'state']),
            'sizes' => ['small', 'medium', 'large', 'extra_large'],
            'genders' => ['male', 'female'],
            'energy_levels' => ['low', 'moderate', 'high'],
            'training_levels' => ['none', 'basic', 'intermediate', 'advanced'],
            'colors' => Pet::available()
                ->select('color')
                ->distinct()
                ->whereNotNull('color')
                ->orderBy('color')
                ->pluck('color'),
        ];

        return response()->json($filters);
    }

    public function advancedSearch(Request $request)
    {
        $breeds = Breed::active()->orderBy('name')->get();
        $locations = Location::active()->orderBy('city')->get();
        $categories = Category::active()->orderBy('name')->get();

        return view('search.advanced', compact('breeds', 'locations', 'categories'));
    }

    public function savedSearches()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $savedSearches = auth()->user()->savedSearches()
            ->latest()
            ->paginate(10);

        return view('search.saved', compact('savedSearches'));
    }

    public function saveSearch(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Authentication required'], 401);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'query' => 'nullable|string',
            'filters' => 'nullable|array'
        ]);

        $savedSearch = auth()->user()->savedSearches()->create([
            'name' => $request->name,
            'query' => $request->query,
            'filters' => $request->filters ?? [],
            'results_count' => $this->getSearchResultsCount($request->query, $request->filters ?? [])
        ]);

        return response()->json([
            'message' => 'Search saved successfully',
            'saved_search' => $savedSearch
        ]);
    }

    private function getSearchResultsCount($query, $filters)
    {
        $petsQuery = Pet::available();

        if ($query) {
            $petsQuery->where(function($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('description', 'LIKE', "%{$query}%");
            });
        }

        // Apply filters (same logic as pets method)
        foreach ($filters as $key => $value) {
            if (empty($value)) continue;
            // Apply filter logic here...
        }

        return $petsQuery->count();
    }
}