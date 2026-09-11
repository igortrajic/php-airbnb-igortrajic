@props(['amenities'])

<div class="mt-10 pt-10 border-t border-gray-200">
    <h2 class="text-2xl font-semibold text-gray-900 mb-6">What this place offers</h2>

    @if($amenities->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            @foreach($amenities as $amenity)
                <div class="flex items-center gap-3 text-gray-700">
                    <svg class="w-6 h-6 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span class="text-base font-medium">{{ $amenity->name }}</span>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-500 italic">No specific amenities listed for this apartment.</p>
    @endif
</div>
