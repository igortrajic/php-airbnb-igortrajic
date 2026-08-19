@props([
    'name',
    'title' => 'Confirm Action'
])

<input type="checkbox" id="{{ $name }}" class="peer hidden">

<label for="{{ $name }}" class="fixed inset-0 z-50 bg-gray-900/50 backdrop-blur-sm hidden peer-checked:flex items-center justify-center px-4 cursor-default">
    <div class="bg-white rounded-2xl shadow-xl max-w-md w-full p-6 relative cursor-default" onclick="event.stopPropagation()">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">{{ $title }}</h3>
            <label for="{{ $name }}" class="text-gray-400 hover:text-gray-600 transition cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </label>
        </div>

        <div>
            {{ $slot }}
        </div>
    </div>
</label>
