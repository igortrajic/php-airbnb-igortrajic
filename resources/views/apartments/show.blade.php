<!DOCTYPE html>
<html>

<head>
    <title>{{ $apartment->title }} - StayFinder</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white min-h-screen">
    <x-layout.navbar />

    <div class="max-w-4xl mx-auto mt-8 px-4 pb-20">
        @if (session('success'))
            <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-800 text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->has('booking'))
            <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 text-sm font-medium">
                {{ $errors->first('booking') }}
            </div>
        @endif

        <x-apartment.gallery :images="$apartment->images" />
        <x-apartment.header :apartment="$apartment" :nextAvailable="$nextAvailable" />
        <x-apartment.stats :apartment="$apartment" />
        
        @php
            $userBooking = auth()->check() ? \App\Models\Booking::where('apartment_id', $apartment->id)
                ->where('user_id', auth()->id())
                ->where('check_out', '>=', now())
                ->first() : null;
        @endphp

@if($userBooking)
            <div class="p-6 bg-gray-50 border border-gray-200 rounded-2xl mt-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Your Reservation</h3>
                <p class="text-sm text-gray-600 mb-4">
                    {{ \Carbon\Carbon::parse($userBooking->check_in)->format('M j, Y') }} &rarr; {{ \Carbon\Carbon::parse($userBooking->check_out)->format('M j, Y') }}
                </p>

                <form action="{{ route('bookings.destroy', $userBooking->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this booking?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="py-2.5 px-4 bg-red-600 hover:bg-red-700 text-white font-medium rounded-xl transition">
                        Cancel Booking
                    </button>
                </form>
            </div>
        @else
            <x-booking.cta 
                :apartment="$apartment" 
                :checkInDisabled="$checkInDisabled" 
                :checkOutDisabled="$checkOutDisabled" 
            />
        @endif
    </div>
    
    @push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const disabledForCheckIn = @json($checkInDisabled);
            const disabledForCheckOut = @json($checkOutDisabled);

            const checkOutPicker = window.flatpickr("#check_out", {
                minDate: "today",
                dateFormat: "Y-m-d",
                disable: disabledForCheckOut,
            });

            window.flatpickr("#check_in", {
                minDate: "today",
                dateFormat: "Y-m-d",
                disable: disabledForCheckIn,
                onChange: function(selectedDates, dateStr, instance) {
                    if (selectedDates[0]) {
                        const minCheckoutDate = new Date(selectedDates[0].getTime() + 86400000);
                        checkOutPicker.set("minDate", minCheckoutDate);

                        const sortedDisabled = disabledForCheckIn.sort();
                        let nextBookedDate = null;

                        for (let i = 0; i < sortedDisabled.length; i++) {
                            if (sortedDisabled[i] > dateStr) {
                                nextBookedDate = sortedDisabled[i];
                                break;
                            }
                        }

                        if (nextBookedDate) {
                            checkOutPicker.set("maxDate", nextBookedDate);
                        } else {
                            checkOutPicker.set("maxDate", null);
                        }
                    }
                }
            });
        });
    </script>
    @endpush
    @stack('scripts')
</body>
</html>
