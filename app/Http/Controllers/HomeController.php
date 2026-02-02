<?php

namespace App\Http\Controllers;

use App\Models\Dragon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredDragons = Dragon::where('is_hidden', false)
            ->where('status', 'available')
            ->with('primaryImage')
            ->latest()
            ->take(6)
            ->get();
        
        return view('home', compact('featuredDragons'));
    }

    public function morphs()
    {
        $dragons = Dragon::where('is_hidden', false)
            ->whereIn('status', ['available', 'reserved'])
            ->with('primaryImage')
            ->latest()
            ->get();
        
        return view('morphs', compact('dragons'));
    }

    public function breedingStock()
    {
        $dragons = Dragon::where('is_hidden', false)
            ->where('status', 'breeding_stock')
            ->with('primaryImage')
            ->latest()
            ->get();
        
        return view('breeding-stock', compact('dragons'));
    }
}