<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dragon;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DragonController extends Controller
{
    public function index()
    {
        $dragons = Dragon::with('primaryImage')->latest()->get();
        return view('admin.dragons.index', compact('dragons'));
    }

    public function create()
    {
        $dragons = Dragon::all();
        $morphs = ['Hypo', 'Trans', 'Leatherback', 'Silkback', 'Dunner', 'Genetic Stripe', 'Zero', 'Witblits', 'Wero'];
        return view('admin.dragons.create', compact('dragons', 'morphs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'sex' => 'required|in:male,female',
            'dob' => 'required|date',
            'morph' => 'required|string',
            'weight' => 'nullable|numeric',
            'price' => 'nullable|numeric',
            'status' => 'required|in:available,sold,reserved,breeding_stock',
            'is_hidden' => 'boolean',
            'parent_male_id' => 'nullable|exists:dragons,id',
            'parent_female_id' => 'nullable|exists:dragons,id',
            'clutch_id' => 'nullable|string',
            'description' => 'nullable|string',
            'notes' => 'nullable|string',
            'date_listed' => 'nullable|date',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $dragon = Dragon::create($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('dragons', 'public');
                Image::create([
                    'dragon_id' => $dragon->id,
                    'image_path' => $path,
                    'is_primary' => $index === 0,
                    'order' => $index
                ]);
            }
        }

        return redirect()->route('admin.dragons.index')->with('success', 'Dragon created successfully!');
    }

    public function edit(Dragon $dragon)
    {
        $dragons = Dragon::where('id', '!=', $dragon->id)->get();
        $morphs = ['Hypo', 'Trans', 'Leatherback', 'Silkback', 'Dunner', 'Genetic Stripe', 'Zero', 'Witblits', 'Wero'];
        return view('admin.dragons.edit', compact('dragon', 'dragons', 'morphs'));
    }

    public function update(Request $request, Dragon $dragon)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'sex' => 'required|in:male,female',
            'dob' => 'required|date',
            'morph' => 'required|string',
            'weight' => 'nullable|numeric',
            'price' => 'nullable|numeric',
            'status' => 'required|in:available,sold,reserved,breeding_stock',
            'is_hidden' => 'boolean',
            'parent_male_id' => 'nullable|exists:dragons,id',
            'parent_female_id' => 'nullable|exists:dragons,id',
            'clutch_id' => 'nullable|string',
            'description' => 'nullable|string',
            'notes' => 'nullable|string',
            'date_listed' => 'nullable|date',
            'date_sold' => 'nullable|date',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $dragon->update($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('dragons', 'public');
                Image::create([
                    'dragon_id' => $dragon->id,
                    'image_path' => $path,
                    'is_primary' => $dragon->images()->count() === 0 && $index === 0,
                    'order' => $dragon->images()->max('order') + 1 + $index
                ]);
            }
        }

        return redirect()->route('admin.dragons.index')->with('success', 'Dragon updated successfully!');
    }

    public function destroy(Dragon $dragon)
    {
        foreach ($dragon->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }
        $dragon->delete();

        return redirect()->route('admin.dragons.index')->with('success', 'Dragon deleted successfully!');
    }
}
