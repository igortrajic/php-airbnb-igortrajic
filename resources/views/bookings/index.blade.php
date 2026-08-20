<!DOCTYPE html>
<html>
<head>
    <title>My Bookings - StayFinder</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white min-h-screen">
    <x-layout.navbar :showListProperty="true" />

    <div class="max-w-7xl mx-auto mt-8 px-4 pb-20">
        <h1 class="text-3xl font-semibold text-gray-900 mb-6">My Bookings</h1>

        <x-apartment.filter-bar />

        <x-layout.alerts />

        <div class="space-y-4">
            @forelse($bookings as $booking)
                <x-booking.card :booking="$booking" />
            @empty
                <x-booking.empty-state />
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
