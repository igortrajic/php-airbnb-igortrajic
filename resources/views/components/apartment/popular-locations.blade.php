@props(['locations'])

<div class="space-y-12 mt-8">
    @forelse($locations as $city => $cityApartments)
        <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-bold text-gray-900">{{ $city }}</h3>
                <a href="{{ route('apartments.index', ['location' => $city]) }}" class="text-sm font-medium text-emerald-600 hover:text-emerald-700 transition">
                    View all in {{ $city }} &rarr;
                </a>
            </div>

            @if($cityApartments->isEmpty())
                <p class="text-sm text-gray-400 italic">No apartments listed in this location yet.</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($cityApartments as $apartment)
                        <x-apartment.card :apartment="$apartment" />
                    @endforeach
                </div>
            @endif
        </div>
    @empty
        <div class="text-center py-12 bg-gray-50 rounded-2xl border border-gray-200 mt-8">
            <p class="text-gray-500 text-sm">No popular destinations available yet.</p>
        </div>
    @endforelse
</div>
