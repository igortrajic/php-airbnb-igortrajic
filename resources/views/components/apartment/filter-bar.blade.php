@props(['amenities', 'filters' => []])

<form action="{{ url()->current() }}" method="GET" class="mb-10">
    <div class="bg-white border border-gray-200 rounded-2xl p-4 shadow-sm">

        <div class="flex flex-col md:flex-row items-center gap-4">
            <x-apartment.filter-tabs />

            @if(request()->routeIs('apartments.index', 'apartments.my'))
                <div class="h-8 w-px bg-gray-200 hidden md:block"></div>

                <x-apartment.location-search :value="$filters['location'] ?? null" />

                <div class="flex-1"></div>

                <x-apartment.sort-select />
            @endif
        </div>

        @if(request()->routeIs('apartments.index', 'apartments.my'))
            <x-apartment.amenity-filter :amenities="$amenities" :selected="$filters['amenities'] ?? []" />
        @endif

    </div>
</form>
