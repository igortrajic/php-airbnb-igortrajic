<!DOCTYPE html>
<html>
<head>
    <title>Edit Apartment - StayFinder</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-50 min-h-screen">
    <x-layout.navbar />

    <div class="max-w-2xl mx-auto mt-8 px-4 pb-20">
        <div class="mb-6">
            <a href="{{ route('apartments.show', $apartment->id) }}" class="text-sm font-medium text-gray-500 hover:text-gray-900 inline-flex items-center gap-1">
                &larr; Back to apartment
            </a>
            <h1 class="text-2xl font-semibold text-gray-900 mt-2">Edit apartment</h1>
        </div>

        <x-layout.form-errors />

        <div class="bg-white border border-gray-200 rounded-2xl p-6 sm:p-8 shadow-sm">
            <form action="{{ route('apartments.update', $apartment->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <h3 class="text-sm font-semibold text-gray-900 mb-4">Basic information</h3>
                    
                    <div>
                        <x-form.input name="title" label="Title" :value="$apartment->title" />
                        <x-form.input name="city" label="City" :value="$apartment->city" />
                    </div>
                </div>

                <hr class="border-gray-100">

                <div>
                    <h3 class="text-sm font-semibold text-gray-900 mb-4">Details</h3>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <x-form.input type="number" step="0.01" name="price_night" label="Price / night (€)" :value="$apartment->price_night" required />
                        <x-form.input type="number" name="max_guests" label="Max guests" :value="$apartment->max_guests" required />
                        <x-form.input type="number" name="size" label="Size (m²)" :value="$apartment->size" required />
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('apartments.show', $apartment->id) }}" class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 rounded-xl transition">
                        Cancel
                    </a>
                    <button type="submit" class="px-6 py-2.5 text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl transition shadow-sm">
                        Save changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
