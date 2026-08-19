@props(['checkInDisabled' => [], 'checkOutDisabled' => []])

<div class="flex flex-col sm:flex-row gap-4">

    <div class="flex-1 flex flex-col gap-1">
        <label for="check_in" class="text-xs font-medium text-gray-600 uppercase tracking-wide">
            Check-in
        </label>
        <input
            type="text"
            id="check_in"
            name="check_in"
            placeholder="Select date"
            value="{{ old('check_in') }}"
            class="w-full rounded-xl border @error('check_in') border-red-400 bg-red-50 @else border-gray-300 bg-white @enderror
                   px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-teal-500"
        >
        @error('check_in')
            <p class="text-xs text-red-600 mt-0.5">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex-1 flex flex-col gap-1">
        <label for="check_out" class="text-xs font-medium text-gray-600 uppercase tracking-wide">
            Check-out
        </label>
        <input
            type="text"
            id="check_out"
            name="check_out"
            placeholder="Select date"
            value="{{ old('check_out') }}"
            class="w-full rounded-xl border @error('check_out') border-red-400 bg-red-50 @else border-gray-300 bg-white @enderror
                   px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-teal-500"
        >
        @error('check_out')
            <p class="text-xs text-red-600 mt-0.5">{{ $message }}</p>
        @enderror
    </div>

</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const disabledForCheckIn = @json($checkInDisabled);
        const disabledForCheckOut = @json($checkOutDisabled);

        const checkOutPicker = flatpickr("#check_out", {
            minDate: "today",
            dateFormat: "Y-m-d",
            disable: disabledForCheckOut,
        });

        flatpickr("#check_in", {
            minDate: "today",
            dateFormat: "Y-m-d",
            disable: disabledForCheckIn,
            onChange: function(selectedDates, dateStr, instance) {
                if (selectedDates[0]) {
                    const minCheckoutDate = new Date(selectedDates[0].getTime() + 86400000);
                    checkOutPicker.set("minDate", minCheckoutDate);
                }
            }
        });
    });
</script>