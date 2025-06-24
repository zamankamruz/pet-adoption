<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Breed;
use App\Models\Location;
use Illuminate\Http\Request;

class AdminSetupController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.setup-data', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug',
            'description' => 'nullable',
            'icon' => 'nullable'
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'icon' => $request->icon,
        ]);

        return back()->with('success', 'Category added!');
    }

    public function storeBreed(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable'
        ]);

        Breed::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
        ]);

        return back()->with('success', 'Breed added!');
    }

    public function storeLocation(Request $request)
    {
        $request->validate([
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'zip_code' => 'nullable',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        Location::create($request->only([
            'city', 'state', 'country', 'zip_code', 'latitude', 'longitude'
        ]));

        return back()->with('success', 'Location added!');
    }
}
