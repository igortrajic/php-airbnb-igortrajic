<div class="flex items-center bg-gray-100 rounded-lg p-1 w-full md:w-auto shrink-0">
    <a href="{{ route('apartments.index') }}" 
        class="px-4 py-2 text-sm font-medium rounded-md transition-all {{ request()->routeIs('apartments.index') ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-500 hover:text-gray-700' }}">
        Explore All
    </a>
    
    <a href="{{ route('apartments.popular') }}" 
        class="px-4 py-2 text-sm font-medium rounded-md transition-all {{ request()->routeIs('apartments.popular') ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-500 hover:text-gray-700' }}">
        Popular
    </a>

    @auth
        <a href="{{ route('apartments.my') }}" 
            class="px-4 py-2 text-sm font-medium rounded-md transition-all {{ request()->routeIs('apartments.my') ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-500 hover:text-gray-700' }}">
            My Apartments
        </a>
        <a href="{{ route('bookings.index') }}" 
            class="px-4 py-2 text-sm font-medium rounded-md transition-all {{ request()->routeIs('bookings.index') ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-500 hover:text-gray-700' }}">
            My Bookings
        </a>
    @endauth
</div>
