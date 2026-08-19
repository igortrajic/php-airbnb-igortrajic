<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Models\Apartment;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function store(StoreBookingRequest $request) 
    {
        $validated = $request->validated();
        
        $apartment = Apartment::findOrFail($validated['apartment_id']);

if ($apartment->owner_id === auth()->id()) {
    return back()->withErrors([
        'booking' => 'You cannot book your own apartment.', 
    ])->withInput();
}
        $checkIn  = Carbon::parse($validated['check_in']);
        $checkOut = Carbon::parse($validated['check_out']);

        $checkInString  = $checkIn->toDateString();
        $checkOutString = $checkOut->toDateString();
        
        $days  = $checkIn->diffInDays($checkOut);
        $total = $apartment->price_night * $days;

        $booking = DB::transaction(function () use ($validated, $apartment, $total, $checkIn, $checkOut, $checkInString, $checkOutString) {
            
            Apartment::where('id', $apartment->id)->lockForUpdate()->first();

            $alreadyBooked = Booking::query()
                ->where('apartment_id', $apartment->id)
                ->where('check_in', '<', $checkOutString)
                ->where('check_out', '>', $checkInString)
                ->exists();

            if ($alreadyBooked) {
                return false; 
            }

            return Booking::create([
                ...$validated,
                'user_id'      => auth()->id(),
                'apartment_id' => $apartment->id, 
                'total_price'  => $total,
                'status'       => Booking::STATUS_UNAVAILABLE, 
            ]);
        });

if (! $booking) {
        return back()->withErrors([
            'booking' => 'Apartment is no longer available at the specified dates.',
        ])->withInput();
    }

return redirect()
    ->route('apartments.show', $apartment->id)
    ->with('success', 'Booking confirmed!');
    }
}