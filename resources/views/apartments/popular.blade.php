<!DOCTYPE html>
<html>
<head>
    <title>Popular Locations - StayFinder</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-white min-h-screen">
    <x-layout.navbar :showListProperty="true" />

    <div class="max-w-7xl mx-auto mt-8 px-6 pb-20">
        <h1 class="text-3xl font-semibold text-gray-900 mb-8">Popular destinations</h1>

        <x-apartment.filter-bar />

        <x-apartment.popular-locations :locations="$locationsWithApartments" />
    </div>
</body>
</html>
