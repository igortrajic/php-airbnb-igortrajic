<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreApartmentRequest;
use App\Models\Apartment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\IndexApartmentRequest;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexApartmentRequest $request)
    {
        $query = Apartment::with('images');

        if ($request->filter === 'my_apartments' && Auth::check()) {
            $query->where('owner_id', Auth::id());
        } elseif ($request->filter === 'my_bookings' && Auth::check()) {
            $query->whereHas('bookings', function($q) {
                $q->where('user_id', Auth::id());
            });
        }

        if ($request->filled('location')) {
            $query->where('city', 'like', '%' . $request->location . '%');
        }

        $sort = $request->input('sort', 'created_desc');

        match ($sort) {
            'price_asc' => $query->orderBy('price_night', 'asc'),
            'price_desc' => $query->orderBy('price_night', 'desc'),
            'guests_asc' => $query->orderBy('max_guests', 'asc'),
            'guests_desc' => $query->orderBy('max_guests', 'desc'),
            default => $query->latest(), 
        };

        $apartments = $query->paginate(12)->withQueryString(); 

        return view('apartments.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('apartments.create');

    }

    /**
     * Store a newly created resource in storage.
     */
        public function store(StoreApartmentRequest $request): RedirectResponse
    {
        $validated = $request->safe()->except(['images']);
        $validated['owner_id'] = Auth::id();
        $uploadedImages = [];

        try {
            DB::transaction(function () use ($validated, $request, &$uploadedImages) {
                $apartment = Apartment::create($validated);

                if ($request->hasFile('images')) {
                    foreach ($request->file('images') as $image) {
                        $path = $image->store('apartment_images', 'public');
                        $uploadedImages[] = $path;
                        $apartment->images()->create(['image_url' => $path]);
                    }
                }
            });

            return redirect()->route('apartments.index')->with('success', 'Apartment created successfully.');
        } catch (\Exception $e) {
            foreach ($uploadedImages as $path) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($path);
            }

            \Illuminate\Support\Facades\Log::error('Failed to create apartment: ' . $e->getMessage(), [
                'exception' => $e,
                'user_id' => Auth::id(),
            ]);

            return back()->withErrors('Failed to create apartment. Please try again.')->withInput();
        }
    }

    public function show(string $id)
    {
        $apartment = Apartment::with('images', 'owner')->findOrFail($id);
        return view('apartments.show', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
