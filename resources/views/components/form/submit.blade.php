@props(['label' => 'Submit', 'cancel' => null])

<div class="flex gap-3 mt-2">
    <button type="submit"
        class="flex-1 h-10 bg-teal-600 hover:bg-teal-700 text-white text-sm font-medium rounded-lg transition">
        {{ $label }}
    </button>
    @if ($cancel)
        <a href="{{ $cancel }}"
            class="h-10 px-6 flex items-center text-sm text-gray-500 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
            Cancel
        </a>
    @endif
</div>
