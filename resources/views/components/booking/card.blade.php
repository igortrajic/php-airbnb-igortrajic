@props(['booking'])

<div class="p-5 border rounded-2xl flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 transition {{ $booking->is_past_or_current ? 'bg-gray-50 opacity-75 border-gray-200' : 'bg-white border-gray-200 shadow-sm' }}">
    <div>
        <span class="text-xs font-semibold uppercase tracking-wider {{ $booking->is_future ? 'text-emerald-600' : 'text-gray-500' }}">
            {{ $booking->is_future ? 'Upcoming Stay' : 'Past / Completed Stay' }}
        </span>
        <h3 class="text-lg font-semibold text-gray-900 mt-1">
            <a href="{{ route('apartments.show', $booking->apartment_id) }}" class="hover:underline">
                {{ $booking->apartment->title }}
            </a>
        </h3>
        <p class="text-sm text-gray-600 mt-1">
            {{ \Carbon\Carbon::parse($booking->check_in)->format('M j, Y') }} &rarr; {{ \Carbon\Carbon::parse($booking->check_out)->format('M j, Y') }}
        </p>
    </div>

    @if($booking->is_future)
        <label for="cancel-booking-modal-{{ $booking->id }}" class="px-4 py-2 text-xs font-medium text-red-600 bg-red-50 hover:bg-red-100 rounded-xl transition cursor-pointer inline-block">
            Cancel Booking
        </label>

        <input type="checkbox" id="cancel-booking-modal-{{ $booking->id }}" class="peer hidden">

        <label for="cancel-booking-modal-{{ $booking->id }}" class="fixed inset-0 z-50 bg-gray-900/50 backdrop-blur-sm hidden peer-checked:flex items-center justify-center px-4 cursor-default">
            <div class="bg-white rounded-2xl shadow-xl max-w-md w-full p-6 relative cursor-default" onclick="event.stopPropagation()">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Cancel Reservation</h3>
                    <label for="cancel-booking-modal-{{ $booking->id }}" class="text-gray-400 hover:text-gray-600 transition cursor-pointer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </label>
                </div>

                <p class="text-sm text-gray-600 mb-6">
                    Are you sure you want to cancel your stay at <span class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($booking->check_in)->format('M j') }} to {{ \Carbon\Carbon::parse($booking->check_out)->format('M j, Y') }}</span>? 
                     This action cannot be undone.
                </p>

                <div class="flex justify-end gap-3">
                    <label for="cancel-booking-modal-{{ $booking->id }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-xl transition cursor-pointer">
                        Keep Booking
                    </label>

                    <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-xl transition">
                            Yes, Cancel
                        </button>
                    </form>
                </div>
            </div>
        </label>
    @else
        <span class="text-xs font-medium text-gray-400 bg-gray-100 px-3 py-1.5 rounded-lg">
            Cannot Cancel
        </span>
    @endif
</div>
