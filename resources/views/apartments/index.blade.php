<!DOCTYPE html>
<html>

<head>
    <title>Explore Apartments - StayFinder</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-white min-h-screen">

    <x-layout.navbar :showListProperty="true" />

    <div class="max-w-7xl mx-auto mt-8 px-6 pb-20">
        <h1 class="text-3xl font-semibold text-gray-900 mb-8">Explore stays</h1>

        <x-apartment.filter-bar />

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($apartments as $apartment)
                <x-apartment.card :apartment="$apartment" />
            @empty
                <x-apartment.empty-state />
            @endforelse
        </div>

        @if ($apartments->hasPages())
            <div class="mt-8">{{ $apartments->links() }}</div>
        @endif
    </div>

</body>

</html>
