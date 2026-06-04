<!DOCTYPE html>
<html>
<head>
    <title>Page Not Found - StayFinder</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center px-6">
    <div class="text-center max-w-md">
        <div class="w-20 h-20 bg-teal-100 text-teal-600 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <h1 class="text-3xl font-bold text-gray-900 mb-3">Oops! Apartment not found.</h1>
        <p class="text-gray-500 mb-8">It looks like the apartment you're looking for doesn't exist or has been removed by the owner.</p>
        <a href="{{ route('apartments.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-teal-600 hover:bg-teal-700 transition">
            Browse available stays
        </a>
    </div>
</body>
</html>