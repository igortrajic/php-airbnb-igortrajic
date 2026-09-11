<?php

namespace App\Http\Controllers;

use App\Models\Apartment;

class FavoriteController extends Controller
{
    public function store(Apartment $apartment)
    {
        $user = auth()->user();

        $user->favorites()->toggle($apartment->id);

        return back();
    }

    public function index()
    {
        $apartments = auth()->user()->favorites()
            ->with(['images', 'amenities'])
            ->paginate(12);

        return view('apartments.favorites', compact('apartments'));
    }
}
