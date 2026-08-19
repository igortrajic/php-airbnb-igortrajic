<!DOCTYPE html>
<html>

<head>
    <title>{{ $apartment->title }} - StayFinder</title>
   @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white min-h-screen">
    <x-layout.navbar />

    <div class="max-w-4xl mx-auto mt-8 px-4 pb-20">
        @if (session('success'))
    <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-800 text-sm font-medium">
        {{ session('success') }}
    </div>
@endif

@if ($errors->has('booking'))
    <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 text-sm font-medium">
        {{ $errors->first('booking') }}
    </div>
@endif
        <x-apartment.gallery :images="$apartment->images" />
        <x-apartment.header :apartment="$apartment" :nextAvailable="$nextAvailable" />
        <x-apartment.stats :apartment="$apartment" />
        
        <x-booking.cta 
            :apartment="$apartment" 
            :checkInDisabled="$checkInDisabled" 
            :checkOutDisabled="$checkOutDisabled" 
        />
    </div>
    

    @push('scripts')
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

                        const sortedDisabled = disabledForCheckIn.sort();
                        let nextBookedDate = null;

                        for (let i = 0; i < sortedDisabled.length; i++) {
                            if (sortedDisabled[i] > dateStr) {
                                nextBookedDate = sortedDisabled[i];
                                break;
                            }
                        }

                        if (nextBookedDate) {
                            checkOutPicker.set("maxDate", nextBookedDate);
                        } else {
                            checkOutPicker.set("maxDate", null);
                        }
                    }
                }
            });
        });
    </script>
    @endpush
    @stack('scripts')
</body>
</html>
