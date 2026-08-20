@props(['apartment'])

<div class="mt-8 p-6 bg-red-50/50 border border-red-200 rounded-2xl flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
    <div>
        <h4 class="text-sm font-semibold text-gray-900">Danger Zone</h4>
        <p class="text-xs text-gray-600 mt-0.5">Once you delete this apartment, it cannot be undone.</p>
    </div>

    <label for="delete-apartment-modal" class="px-4 py-2 text-xs font-medium text-white bg-red-600 hover:bg-red-700 rounded-xl transition shadow-sm cursor-pointer inline-block">
        Delete apartment
    </label>
</div>

<input type="checkbox" id="delete-apartment-modal" class="peer hidden">

<label for="delete-apartment-modal" class="fixed inset-0 z-50 bg-gray-900/50 backdrop-blur-sm hidden peer-checked:flex items-center justify-center px-4 cursor-default">
    <div class="bg-white rounded-2xl shadow-xl max-w-md w-full p-6 relative cursor-default" onclick="event.stopPropagation()">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Delete Apartment</h3>
            <label for="delete-apartment-modal" class="text-gray-400 hover:text-gray-600 transition cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </label>
        </div>

        <p class="text-sm text-gray-600 mb-6">
            Are you sure you want to delete <span class="font-semibold text-gray-900">{{ $apartment->title }}</span>? This action cannot be undone and will remove all associated data.
        </p>

        <div class="flex justify-end gap-3">
            <label for="delete-apartment-modal" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-xl transition cursor-pointer">
                Cancel
            </label>

            <form action="{{ route('apartments.destroy', $apartment->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-xl transition">
                    Yes, Delete
                </button>
            </form>
        </div>
    </div>
</label>
