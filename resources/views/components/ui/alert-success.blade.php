@props(['message' => session('success')])

@if ($message)
    <div class="bg-teal-50 border border-teal-200 rounded-lg px-4 py-3 text-sm text-teal-700 mb-6">
        {{ $message }}
    </div>
@endif
