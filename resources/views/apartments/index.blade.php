<!DOCTYPE html>
<html>
<head>
    <title>Explore Apartments - StayFinder</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-white min-h-screen">

    <nav class="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between sticky top-0 z-50">
        <div class="flex items-center gap-2 text-teal-600 font-medium text-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            StayFinder
        </div>
        <div class="flex items-center gap-6">
            <a href="{{ route('apartments.create') }}" class="text-sm font-medium text-teal-600 hover:text-teal-700 transition">List your property</a>
            <div class="h-4 w-px bg-gray-300"></div>
            <span class="text-sm text-gray-500">{{ Auth::user()->name ?? 'User' }}</span>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-sm text-gray-500 hover:text-red-500 transition">Logout</button>
            </form>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto mt-8 px-6 pb-20">
        
        <h1 class="text-3xl font-semibold text-gray-900 mb-8">Explore stays</h1>

        <form action="{{ route('apartments.index') }}" method="GET" class="mb-10">
            <div class="bg-white border border-gray-200 rounded-2xl p-4 shadow-sm flex flex-col md:flex-row items-center gap-4">
                
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
                    <button type="submit" name="filter" value="my_bookings" 
                        class="px-4 py-2 text-sm font-medium rounded-md transition-all {{ request('filter') === 'my_bookings' ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-500 hover:text-gray-700' }}">
                        My Bookings
                    </button>
                    @endauth
                </div>

                <div class="h-8 w-px bg-gray-200 hidden md:block"></div>

                <div class="relative w-full md:w-64 shrink-0">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <input type="text" name="location" value="{{ request('location') }}" placeholder="Location (e.g. Paris)" 
                        class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-teal-100 focus:border-teal-500 transition">
                </div>

                <div class="flex-1"></div>

                <div class="flex items-center gap-2 w-full md:w-auto">
                    <label for="sort" class="text-sm text-gray-500 whitespace-nowrap">Sort by:</label>
                    <select name="sort" id="sort" onchange="this.form.submit()" 
                        class="w-full md:w-auto border border-gray-200 bg-white text-gray-700 py-2 pl-3 pr-8 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-teal-100 focus:border-teal-500 appearance-none cursor-pointer">
                        <option value="created_desc" {{ request('sort') == 'created_desc' ? 'selected' : '' }}>Newest</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                        <option value="guests_asc" {{ request('sort') == 'guests_asc' ? 'selected' : '' }}>Guests: Low to High</option>
                        <option value="guests_desc" {{ request('sort') == 'guests_desc' ? 'selected' : '' }}>Guests: High to Low</option>
                    </select>
                </div>

            </div>
        </form>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            
            @forelse($apartments ?? [] as $apartment)
                <a href="{{ route('apartments.show', $apartment->id) }}" class="group block cursor-pointer">
                    <div class="relative w-full aspect-square bg-[#f4f4f0] rounded-2xl overflow-hidden mb-3">
                        @if($apartment->images->isNotEmpty())
                            <img src="{{ Storage::url($apartment->images->first()->image_url) }}" alt="{{ $apartment->title }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif
                    </div>

                   <div>
                        <div class="flex justify-between items-start">
                            <h3 class="font-medium text-gray-900 truncate pr-4">{{ $apartment->city }}</h3>
                        </div>
                        <p class="text-sm text-gray-500 mt-0.5 truncate">{{ $apartment->title }}</p>
                        <p class="text-sm text-gray-500 mt-0.5">{{ $apartment->max_guests }} guests &middot; {{ $apartment->size }}m&sup2;</p>
                        <div class="mt-2 text-gray-900">
                            <span class="font-semibold">&euro;{{ number_format($apartment->price_night, 2) }}</span> <span class="text-sm font-normal">night</span>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-1 sm:col-span-2 lg:col-span-3 xl:col-span-4 flex flex-col items-center justify-center py-20 px-4 text-center border-2 border-dashed border-gray-200 rounded-3xl bg-gray-50">
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mb-4 shadow-sm border border-gray-100">
                        <svg class="w-8 h-8 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No apartments found</h3>
                    <p class="text-gray-500 max-w-sm mb-6">We couldn't find any stays matching your current filters and location. Try adjusting your search criteria.</p>
                    <a href="{{ route('apartments.index') }}" class="px-6 py-2.5 bg-teal-600 hover:bg-teal-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
                        Clear all filters
                    </a>
                </div>
            @endforelse

        </div>

    </div>
</body>
</html>