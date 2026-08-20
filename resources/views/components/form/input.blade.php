@props(['name', 'label', 'type' => 'text', 'placeholder' => '', 'min' => null, 'step' => null, 'value' => null])

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700 mb-1.5" for="{{ $name }}">
        {{ $label }}
    </label>
<input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{ old($name, $value) }}"
    placeholder="{{ $placeholder }}" @if ($min !== null) min="{{ $min }}" @endif
    @if ($step !== null) step="{{ $step }}" @endif
    {{ $attributes }} 
    class="w-full h-10 px-3 text-sm border border-gray-200 rounded-lg outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-100 transition">
    @error($name)
        <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
    @enderror
</div>
