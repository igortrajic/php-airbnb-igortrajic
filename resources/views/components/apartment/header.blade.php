@props(['apartment', 'nextAvailable'])

<div class="mb-6">
    <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
        <span>{{ $apartment->city }}</span>
        <span>&bull;</span>
        <span>{{ $apartment->property_type ?? 'Entire place' }}</span>
    </div>

    <h1 class="text-3xl font-semibold text-gray-900 mb-2">{{ $apartment->title }}</h1>
    
    @if($nextAvailable)
        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-amber-50 text-amber-700 border border-amber-200">
            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
            Available starting {{ $nextAvailable }}
        </div>
    @else
        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
            Available now
        </div>
    @endif
</div>
