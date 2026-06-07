<?php

namespace App\Http\Controllers;

use App\Models\Fish;

class FishController extends Controller
{
    public function show(string $slug)
    {
        $fish = Fish::with(['region', 'user'])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('fish', compact('fish'));
    }
}
