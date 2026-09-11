@props(['amenities', 'selected' => []])

<div class="mt-4 pt-4 border-t border-gray-100 flex flex-wrap gap-2">
    @foreach($amenities as $amenity)
        <label class="cursor-pointer">
            <input type="checkbox" name="amenities[]" value="{{ $amenity->id }}"
                   class="hidden peer"
                   onchange="this.form.submit()"
                   @if(in_array($amenity->id, $selected)) checked @endif>

            <div class="px-4 py-2 rounded-full border border-gray-300 text-sm font-medium text-gray-700 bg-white peer-checked:bg-emerald-600 peer-checked:text-white peer-checked:border-emerald-600 hover:bg-gray-50 peer-checked:hover:bg-emerald-700 transition shadow-sm">
                {{ $amenity->name }}
            </div>
        </label>
    @endforeach
</div>
