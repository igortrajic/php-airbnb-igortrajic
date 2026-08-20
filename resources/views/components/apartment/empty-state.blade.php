<div
    class="col-span-1 sm:col-span-2 lg:col-span-3 xl:col-span-4 flex flex-col items-center justify-center py-20 px-4 text-center border-2 border-dashed border-gray-200 rounded-3xl bg-gray-50">
    <h3 class="text-lg font-medium text-gray-900 mb-2">No apartments found</h3>
    <p class="text-gray-500 max-w-sm mb-6">We couldn't find any stays matching your current filters. Try adjusting your
        search criteria.</p>
    <a href="{{ route('apartments.create') }}"
        class="px-6 py-2.5 bg-teal-600 hover:bg-teal-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
        Add New Apartment
    </a>
</div>
