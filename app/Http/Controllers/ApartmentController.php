<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreApartmentRequest;
use App\Models\Apartment;
use Illuminate\Support\Facades\Auth;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $validated = $request->validated();
        $validated['owner_id'] = Auth::id();

        $apartment = Apartment::create($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('apartment_images', 'public');
                $apartment->images()->create(['image_url' => $path]);
            }
        }

        return redirect()->route('apartments.index')->with('success', 'Apartment created successfully.');
    }


    public function show(string $id)
    {
        //
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
