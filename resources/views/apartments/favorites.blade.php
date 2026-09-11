<!DOCTYPE html>
<html>
<head>
    <title>My Wishlist - StayFinder</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-white min-h-screen">
    <x-layout.navbar :showListProperty="true" />

    <div class="max-w-7xl mx-auto mt-8 px-6 pb-20">
        <h1 class="text-3xl font-semibold text-gray-900 mb-8">My Wishlist</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mt-8">
            @forelse($apartments as $apartment)
                <x-apartment.card :apartment="$apartment" />
            @empty
                <div class="col-span-full py-16 text-center">
                    <p class="text-gray-500 text-lg mb-4">You haven't added any apartments to your wishlist yet.</p>
                    <a href="{{ route('apartments.index') }}" class="px-5 py-2.5 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 font-medium transition shadow-sm">
                        Explore Stays
                    </a>
                </div>
            @endforelse
        </div>

        @if ($apartments->hasPages())
            <div class="mt-8">{{ $apartments->links() }}</div>
        @endif
    </div>
</body>
</html>
