@props(['apartment', 'checkInDisabled' => [], 'checkOutDisabled' => []])

@error('booking')
    <div class="mb-4 px-4 py-3 rounded-xl bg-red-50 border border-red-200 text-red-700 text-sm">
        {{ $message }}
    </div>
@enderror

<div class="border border-gray-200 rounded-2xl p-6 bg-gray-50">

    @auth
        @if(auth()->id() === $apartment->owner_id)
            <div class="flex flex-col items-center justify-center text-center py-4">
                <h3 class="font-medium text-gray-900">This is your property</h3>
                <p class="text-sm text-gray-500 mt-1">You cannot book your own apartment.</p>
                <a href="{{ route('apartments.edit', $apartment->id) }}" class="text-sm font-medium text-emerald-600 hover:text-emerald-700 transition inline-flex items-center gap-1">
        Manage your apartment &rarr;
    </a>
            </div>
        @else
            <form action="{{ route('bookings.store') }}" method="POST" class="flex flex-col gap-5">
                @csrf
                <input type="hidden" name="apartment_id" value="{{ $apartment->id }}">

                <x-booking.calendar :checkInDisabled="$checkInDisabled" :checkOutDisabled="$checkOutDisabled" />

                <p class="text-sm text-gray-500">
                    &euro;{{ number_format($apartment->price_night, 2) }} / night &middot; total calculated at checkout
                </p>

                <button type="submit" class="w-full px-8 py-3 bg-teal-600 hover:bg-teal-700 text-white font-medium rounded-xl transition shadow-sm">
                    Book this apartment
                </button>
            </form>
        @endif

    @else
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
            <div>
                <h3 class="font-medium text-gray-900">Ready to book?</h3>
                <p class="text-sm text-gray-500">You need to be logged in to make a booking.</p>
            </div>
            <a href="{{ route('login') }}"
               class="w-full sm:w-auto px-8 py-3 bg-teal-600 hover:bg-teal-700 text-white font-medium rounded-xl transition shadow-sm text-center">
                Log in to book
            </a>
        </div>
    @endauth

</div>
