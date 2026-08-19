<!DOCTYPE html>
<html>

<head>
    <title>{{ $apartment->title }} - StayFinder</title>
    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</head>

<body class="bg-white min-h-screen">

    <x-layout.navbar />

    <div class="max-w-4xl mx-auto mt-8 px-4 pb-20">
        @if (session('success'))
            <div class="mb-6 px-4 py-3 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <x-apartment.gallery :images="$apartment->images" />
<x-apartment.header :apartment="$apartment" :nextAvailable="$nextAvailable" />
        <x-apartment.stats :apartment="$apartment" />
<x-booking.cta :apartment="$apartment" :checkInDisabled="$checkInDisabled" :checkOutDisabled="$checkOutDisabled" />

    </div>
    
</body>

</html>