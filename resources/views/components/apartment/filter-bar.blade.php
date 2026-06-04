<form action="{{ route('apartments.index') }}" method="GET" class="mb-10">
    <div class="bg-white border border-gray-200 rounded-2xl p-4 shadow-sm flex flex-col md:flex-row items-center gap-4">

        <x-apartment.filter-tabs />

        <div class="h-8 w-px bg-gray-200 hidden md:block"></div>

        <div class="relative w-full md:w-64 shrink-0">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
            <input type="text" name="location" value="{{ request('location') }}" placeholder="Location (e.g. Paris)"
                class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-teal-100 focus:border-teal-500 transition">
        </div>

        <div class="flex-1"></div>

        <x-apartment.sort-select />

    </div>
</form>
