<div
    class="col-span-1 sm:col-span-2 lg:col-span-3 xl:col-span-4 flex flex-col items-center justify-center py-20 px-4 text-center border-2 border-dashed border-gray-200 rounded-3xl bg-gray-50">
    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mb-4 shadow-sm border border-gray-100">
        <svg class="w-8 h-8 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
        </svg>
    </div>
    <h3 class="text-lg font-medium text-gray-900 mb-2">No apartments found</h3>
    <p class="text-gray-500 max-w-sm mb-6">We couldn't find any stays matching your current filters. Try adjusting your
        search criteria.</p>
    <a href="{{ route('apartments.index') }}"
        class="px-6 py-2.5 bg-teal-600 hover:bg-teal-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
        Add New Apartment
    </a>
</div>
