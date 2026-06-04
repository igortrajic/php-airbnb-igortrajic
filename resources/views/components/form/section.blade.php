@props(['title'])

<div class="mb-6">
    <h2 class="text-sm font-medium text-gray-900 mb-4 pb-2 border-b border-gray-100">{{ $title }}</h2>
    {{ $slot }}
</div>
