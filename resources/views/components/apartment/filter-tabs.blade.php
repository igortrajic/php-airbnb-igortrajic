<div class="flex items-center bg-gray-100 rounded-lg p-1 w-full md:w-auto shrink-0">
    <button type="submit" name="filter" value="all"
        class="px-4 py-2 text-sm font-medium rounded-md transition-all {{ request('filter', 'all') === 'all' ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-500 hover:text-gray-700' }}">
        Explore All
    </button>
    @auth
        <button type="submit" name="filter" value="my_apartments"
            class="px-4 py-2 text-sm font-medium rounded-md transition-all {{ request('filter') === 'my_apartments' ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-500 hover:text-gray-700' }}">
            My Apartments
        </button>
<a href="{{ route('bookings.index') }}" class="px-4 py-2 text-sm font-medium rounded-md transition-all {{ request()->routeIs('bookings.index') ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-500 hover:text-gray-700' }}">
    My Bookings
</a>
    @endauth
</div>
