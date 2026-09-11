@props(['apartment'])

<div class="group relative block">
    <div class="relative w-full aspect-square bg-[#f4f4f0] rounded-2xl overflow-hidden mb-3">
        <!-- Main Image Link -->
        <a href="{{ route('apartments.show', $apartment->id) }}" class="absolute inset-0 z-0">
            @if ($apartment->images->isNotEmpty())
                <img src="{{ Storage::disk('public')->url($apartment->images->first()->image_url) }}"
                    alt="{{ $apartment->title }}"
                    class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
            @else
                <div class="w-full h-full flex items-center justify-center text-gray-400">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            @endif
        </a>

        <!-- Favorite / Wishlist Button -->
        @auth
            <form action="{{ route('favorites.store', $apartment) }}" method="POST" class="absolute top-3 right-3 z-10">
                @csrf
                <button type="submit" class="p-2 rounded-full bg-white/80 hover:bg-white backdrop-blur-sm shadow-md transition text-gray-700 hover:text-red-500">
                    @php
                        $isFavorited = auth()->user()->favorites->contains($apartment->id);
                    @endphp
                    <svg class="w-5 h-5 {{ $isFavorited ? 'text-red-500 fill-current' : 'fill-none' }}" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </button>
            </form>
        @endauth
    </div>

    <div>
        <a href="{{ route('apartments.show', $apartment->id) }}">
            <div class="flex justify-between items-start">
                <h3 class="font-medium text-gray-900 truncate pr-4">{{ $apartment->city }}</h3>
            </div>
            <p class="text-sm text-gray-500 mt-0.5 truncate">{{ $apartment->title }}</p>
            <p class="text-sm text-gray-500 mt-0.5">{{ $apartment->max_guests }} guests &middot; {{ $apartment->size }}m&sup2;</p>
            <div class="mt-2 text-gray-900">
                <span class="font-semibold">&euro;{{ number_format($apartment->price_night, 2) }}</span>
                <span class="text-sm font-normal">/ night</span>
            </div>
        </a>
    </div>
</div>
