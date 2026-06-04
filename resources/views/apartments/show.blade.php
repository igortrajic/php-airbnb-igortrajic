<!DOCTYPE html>
<html>

<head>
    <title>{{ $apartment->title }} - StayFinder</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-white min-h-screen">

    <x-layout.navbar />

    <div class="max-w-4xl mx-auto mt-8 px-4 pb-20">

        <x-apartment.gallery :images="$apartment->images" />
        <x-apartment.header :apartment="$apartment" />
        <x-apartment.stats :apartment="$apartment" />
        <x-booking.cta />

    </div>
</body>

</html>
