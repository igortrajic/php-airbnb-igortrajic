<!DOCTYPE html>
<html>

<head>
    <title>{{ $apartment->title }} - StayFinder</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white min-h-screen">
    <x-layout.navbar />

    <div class="max-w-4xl mx-auto mt-8 px-4 pb-20">
        <x-layout.alerts />

        <x-apartment.gallery :images="$apartment->images" />
        <x-apartment.header :apartment="$apartment" :nextAvailable="$nextAvailable" />
        <x-apartment.stats :apartment="$apartment" />
        
        @if($userBooking)
            <x-booking.user-reservation :booking="$userBooking" />
        @else
            <x-booking.cta 
                :apartment="$apartment" 
                :disabledDates="$disabledDates" 
            />
        @endif

        @can('delete', $apartment)
            <x-apartment.delete-modal :apartment="$apartment" />
        @endcan
    </div>
    
    @push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const disabledDates = @json($disabledDates);

            window.flatpickr("#check_in", {
                minDate: "today",
                dateFormat: "Y-m-d",
                disable: disabledDates,
            });
            
            window.flatpickr("#check_out", {
                minDate: "today",
                dateFormat: "Y-m-d",
                disable: disabledDates,
            });
        });
    </script>
    @endpush

    @stack('scripts')
</body>
</html>
