@props(['apartment', 'nextAvailable' => null])

<div class="flex flex-col md:flex-row justify-between items-start mb-6 gap-4">
    <div>
        <div class="flex items-center gap-2 mb-2">
            @if ($nextAvailable)
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium
                             bg-blue-50 text-blue-700 border border-blue-200">
                    <span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span>
                    Available starting {{ $nextAvailable }}
                </span>
            @else
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium
                             bg-green-50 text-green-700 border border-green-200">
                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                    Available now
                </span>
            @endif
        </div>

        <h1 class="text-3xl font-semibold text-gray-900 mb-1">{{ $apartment->title }}</h1>
    </div>

    <div class="text-right">
        <span class="text-2xl font-semibold text-teal-600">
            &euro;{{ number_format($apartment->price_night, 2) }}
        </span>
        <span class="text-gray-500">/ night</span>
    </div>
</div>