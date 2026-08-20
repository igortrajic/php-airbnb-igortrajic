<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreApartmentRequest;
use App\Http\Requests\IndexApartmentRequest;
use App\Http\Requests\UpdateApartmentRequest;
use App\Models\Apartment;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Throwable;
use Carbon\CarbonPeriod;
use Illuminate\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ApartmentController extends Controller
{
    use AuthorizesRequests;

    public function index(IndexApartmentRequest $request)
    {
        if ($request->filter === 'my_apartments') {
            return redirect()->route('apartments.my');
        }
        if ($request->filter === 'my_bookings') {
            return redirect()->route('bookings.index');
        }
        if ($request->filter === 'popular') {
            return redirect()->route('apartments.popular');
        }

        $query = Apartment::with('images');

        if ($request->filled('location')) {
            $query->where('city', 'like', '%' . $request->location . '%');
        }

        match ($request->input('sort', 'created_desc')) {
            'price_asc'   => $query->orderBy('price_night', 'asc'),
            'price_desc'  => $query->orderBy('price_night', 'desc'),
            'guests_asc'  => $query->orderBy('max_guests', 'asc'),
            'guests_desc' => $query->orderBy('max_guests', 'desc'),
            default       => $query->latest(),
        };

        $apartments = $query->paginate(12)->withQueryString();

        return view('apartments.index', compact('apartments'));
    }

    public function myApartments(IndexApartmentRequest $request)
    {
        $query = Apartment::with('images')->where('owner_id', Auth::id());

        match ($request->input('sort', 'created_desc')) {
            'price_asc'   => $query->orderBy('price_night', 'asc'),
            'price_desc'  => $query->orderBy('price_night', 'desc'),
            'guests_asc'  => $query->orderBy('max_guests', 'asc'),
            'guests_desc' => $query->orderBy('max_guests', 'desc'),
            default       => $query->latest(),
        };

        $apartments = $query->paginate(12)->withQueryString();

        return view('apartments.index', compact('apartments'));
    }

    public function create()
    {
        return view('apartments.create');
    }

    public function store(StoreApartmentRequest $request): RedirectResponse
    {
        $validated = $request->safe()->except(['images']);
        $validated['owner_id'] = Auth::id();

        $uploadedImages = [];

        try {
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $uploadedImages[] = $image->store('apartment_images', 'public');
                }
            }

            DB::transaction(function () use ($validated, $uploadedImages) {
                $apartment = Apartment::create($validated);

                $imageRecords = array_map(fn ($path) => ['image_url' => $path], $uploadedImages);

                if (!empty($imageRecords)) {
                    $apartment->images()->createMany($imageRecords);
                }
            });

            return redirect()->route('apartments.index')->with('success', 'Apartment created successfully.');

        } catch (Throwable $e) {
            if (!empty($uploadedImages)) {
                Storage::disk('public')->delete($uploadedImages);
            }

            Log::error('Failed to create apartment: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
            ]);

            return back()->withErrors('Failed to create apartment. Please try again.')->withInput();
        }
    }

    public function show(Apartment $apartment): View
    {
        $apartment->load('images');
        $today = now()->startOfDay();

        $futureBookings = Booking::query()
            ->where('apartment_id', $apartment->id)
            ->where('check_out', '>=', $today)
            ->get(['check_in', 'check_out']);

        $disabledDates = [];

        foreach ($futureBookings as $booking) {
            $start = $booking->check_in->copy()->startOfDay();
            $end   = $booking->check_out->copy()->startOfDay();

            $period = CarbonPeriod::create($start, $end);
            foreach ($period as $date) {
                $disabledDates[] = $date->toDateString();
            }
        }

        $checkDate = $today->copy();
        while (in_array($checkDate->toDateString(), $disabledDates)) {
            $checkDate->addDay();
        }

        $nextAvailable = $checkDate->isSameDay($today)
            ? null
            : $checkDate->format('M j, Y');

        $userBooking = auth()->check()
        ? $apartment->bookings()
            ->where('user_id', auth()->id())
            ->where('check_out', '>=', now())
            ->first()
        : null;

        return view('apartments.show', compact('apartment', 'nextAvailable', 'userBooking', 'disabledDates'))
         ->with('checkInDisabled', $disabledDates)
         ->with('checkOutDisabled', $disabledDates);
    }
    
    public function edit(Apartment $apartment)
    {
        $this->authorize('update', $apartment);
        return view('apartments.edit', compact('apartment'));
    }

    public function update(UpdateApartmentRequest $request, Apartment $apartment)
    {
        $apartment->update($request->validated());

        return redirect()->route('apartments.show', $apartment->id)
            ->with('success', 'Apartment updated successfully.');
    }

    public function destroy(Apartment $apartment)
    {
        $this->authorize('delete', $apartment);

        $imagePaths = $apartment->images->pluck('image_url')->toArray();

        DB::transaction(function () use ($apartment) {
            $apartment->images()->delete();
            $apartment->bookings()->delete();
            $apartment->delete();
        });

        DB::afterCommit(function () use ($imagePaths) {
            if (!empty($imagePaths)) {
                Storage::disk('public')->delete($imagePaths);
            }
        });

        return redirect()->route('apartments.index')
            ->with('success', 'Apartment and its associated data deleted successfully.');
    }
}
