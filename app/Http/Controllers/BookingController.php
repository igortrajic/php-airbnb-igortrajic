<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Models\Apartment;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class BookingController extends Controller
{
    public function store(StoreBookingRequest $request)
    {
        $validated = $request->validated();

        $apartment = Apartment::findOrFail($validated['apartment_id']);

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

            try {
                return Booking::create([
                    ...$validated,
                    'user_id'      => auth()->id(),
                    'apartment_id' => $apartment->id,
                    'total_price'  => $total,
                    'status'       => Booking::STATUS_UNAVAILABLE,
                ]);
            } catch (QueryException $e) {
                return false;
            }
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
