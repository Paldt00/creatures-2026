<?php

namespace App\Http\Controllers;

use App\Models\Region;

class RegionController extends Controller
{
    public function show(string $slug)
    {
        $region = Region::with([
            'fishes' => function ($query) {
                $query->latest('id');
            },
        ])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('region', compact('region'));
    }
}
