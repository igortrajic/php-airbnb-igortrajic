<!DOCTYPE html>
<html>
<head>
    <title>My Bookings - StayFinder</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white min-h-screen">
    <x-layout.navbar />

    <div class="max-w-4xl mx-auto mt-8 px-4 pb-20">
        <h1 class="text-3xl font-semibold text-gray-900 mb-6">My Bookings</h1>

        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-800 text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->has('booking'))
            <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 text-sm font-medium">
                {{ $errors->first('booking') }}
            </div>
        @endif

        <div class="space-y-4">
            @forelse($bookings as $booking)
                @php
                    $isFuture = $booking->check_in > now()->toDateString();
                    $isPastOrCurrent = $booking->check_in <= now()->toDateString();
                @endphp

                <div class="p-5 border rounded-2xl flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 transition {{ $isPastOrCurrent ? 'bg-gray-50 opacity-75 border-gray-200' : 'bg-white border-gray-200 shadow-sm' }}">
                    <div>
                        <span class="text-xs font-semibold uppercase tracking-wider {{ $isFuture ? 'text-emerald-600' : 'text-gray-500' }}">
                            {{ $isFuture ? 'Upcoming Stay' : 'Past / Completed Stay' }}
                        </span>
                        <h3 class="text-lg font-semibold text-gray-900 mt-1">
                            <a href="{{ route('apartments.show', $booking->apartment_id) }}" class="hover:underline">
                                {{ $booking->apartment->title }}
                            </a>
                        </h3>
                        <p class="text-sm text-gray-600 mt-1">
                            {{ \Carbon\Carbon::parse($booking->check_in)->format('M j, Y') }} &rarr; {{ \Carbon\Carbon::parse($booking->check_out)->format('M j, Y') }}
                        </p>
                    </div>
  @if($isFuture)
    <label for="cancel-booking-{{ $booking->id }}" class="px-4 py-2 text-xs font-medium text-red-600 bg-red-50 hover:bg-red-100 rounded-xl transition cursor-pointer inline-block">
        Cancel Booking
    </label>

    <x-ui.modal name="cancel-booking-{{ $booking->id }}" title="Cancel Reservation">
        <p class="text-sm text-gray-600 mb-6">
            Are you sure you want to cancel your stay at <span class="font-semibold text-gray-900">{{ $booking->apartment->title }}</span>? This action cannot be undone and your dates will become available again.
        </p>

        <div class="flex justify-end gap-3">
            <label for="cancel-booking-{{ $booking->id }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-xl transition cursor-pointer">
                Keep Booking
            </label>

            <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-xl transition">
                    Yes, Cancel
                </button>
            </form>
        </div>
    </x-ui.modal>
@else
    <span class="text-xs font-medium text-gray-400 bg-gray-100 px-3 py-1.5 rounded-lg">
        Cannot Cancel
    </span>
@endif
                </div>
            @empty
                <div class="text-center py-16 px-4 border border-dashed border-gray-200 rounded-2xl">
                    <h3 class="text-base font-semibold text-gray-900">No bookings yet</h3>
                    <p class="text-sm text-gray-500 mt-1">You haven't booked any apartments yet. Explore stays to plan your next trip!</p>
                    <a href="{{ route('apartments.index') }}" class="mt-4 inline-block px-4 py-2 bg-black text-white text-sm font-medium rounded-xl">
                        Explore stays
                    </a>
                </div>
            @endforelse
        </div>

        @if ($bookings->hasPages())
            <div class="mt-8">
                {{ $bookings->links() }}
            </div>
        @endif
    </div>
</body>
</html>
