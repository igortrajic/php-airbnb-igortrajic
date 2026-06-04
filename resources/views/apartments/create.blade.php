<!DOCTYPE html>
<html>

<head>
    <title>New Apartment - StayFinder</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-50 min-h-screen">

    <x-layout.navbar />

    <div class="max-w-2xl mx-auto mt-10 px-4">

        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('apartments.index') }}" class="text-gray-400 hover:text-gray-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h1 class="text-xl font-medium text-gray-900">List a new apartment</h1>
        </div>

        <x-ui.alert-success />
        <x-ui.alert-error />

        <div class="bg-white rounded-2xl border border-gray-200 p-8">
            <form action="{{ route('apartments.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <x-form.section title="Basic information">
                    <x-form.input name="title" label="Title" placeholder="e.g. Cozy studio in Marais" />
                    <x-form.input name="city" label="City" placeholder="e.g. Paris" />
                </x-form.section>

                <x-form.section title="Details">
                    <div class="grid grid-cols-3 gap-4">
                        <x-form.input name="price_night" label="Price / night (€)" type="number" placeholder="85"
                            min="0" step="0.01" />
                        <x-form.input name="max_guests" label="Max guests" type="number" placeholder="4"
                            min="1" />
                        <x-form.input name="size" label="Size (m²)" type="number" placeholder="35" min="0"
                            step="0.1" />
                    </div>
                </x-form.section>

                <x-form.section title="Photos">
                    <x-form.file-upload name="images" :max="5" />
                </x-form.section>

                <x-form.submit label="List apartment" cancel="{{ route('apartments.index') }}" />

            </form>
        </div>
    </div>

</body>

</html>
