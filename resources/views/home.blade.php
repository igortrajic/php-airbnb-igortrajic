<div class="max-w-7xl mx-auto px-4 py-12">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Popular Locations</h2>

    @if(empty($locationsWithApartments))
        <div class="text-center py-12 bg-gray-50 rounded-2xl border border-gray-200">
            <p class="text-gray-500 text-sm">No popular destinations available yet. Check back soon!</p>
        </div>
    @else
        <div class="space-y-12">
            @foreach($locationsWithApartments as $city => $apartments)
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ $city }}</h3>
                    
                    @if($apartments->isEmpty())
                        <p class="text-sm text-gray-400 italic">No apartments listed in this location yet.</p>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 gap-6">
                            @foreach($apartments as $apartment)
                                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition">
                                    <div class="p-4">
                                        <h4 class="font-semibold text-gray-900">{{ $apartment->title }}</h4>
                                        <p class="text-sm text-gray-500">€{{ $apartment->price_night }} / night</p>
                                        <a href="{{ route('apartments.show', $apartment->id) }}" class="mt-3 inline-block text-xs font-medium text-emerald-600 hover:underline">
                                            View apartment &rarr;
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>
