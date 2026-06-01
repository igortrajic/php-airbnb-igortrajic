<!DOCTYPE html>
<html>
<head>
    <title>New Apartment</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-50 min-h-screen">

    <nav class="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-2 text-teal-600 font-medium text-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            StayFinder
        </div>
        <div class="flex items-center gap-4">
            <span class="text-sm text-gray-500">{{ Auth::user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-sm text-gray-500 hover:text-red-500 transition">Logout</button>
            </form>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto mt-10 px-4">

        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('apartments.index') }}" class="text-gray-400 hover:text-gray-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <h1 class="text-xl font-medium text-gray-900">List a new apartment</h1>
        </div>

        @if(session('success'))
            <div class="bg-teal-50 border border-teal-200 rounded-lg px-4 py-3 text-sm text-teal-700 mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-lg px-4 py-3 text-sm text-red-600 mb-6">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <div class="bg-white rounded-2xl border border-gray-200 p-8">

            <form action="{{ route('apartments.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Basic info --}}
                <div class="mb-6">
                    <h2 class="text-sm font-medium text-gray-900 mb-4 pb-2 border-b border-gray-100">Basic information</h2>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1.5" for="title">Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}"
                            class="w-full h-10 px-3 text-sm border border-gray-200 rounded-lg outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-100 transition"
                            placeholder="e.g. Cozy studio in Marais">
                        @if($errors->has('title'))
                            <span class="text-xs text-red-500 mt-1 block">{{ $errors->first('title') }}</span>
                        @endif
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1.5" for="city">City</label>
                        <input type="text" name="city" id="city" value="{{ old('city') }}"
                            class="w-full h-10 px-3 text-sm border border-gray-200 rounded-lg outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-100 transition"
                            placeholder="e.g. Paris">
                        @if($errors->has('city'))
                            <span class="text-xs text-red-500 mt-1 block">{{ $errors->first('city') }}</span>
                        @endif
                    </div>
                </div>

                {{-- Details --}}
                <div class="mb-6">
                    <h2 class="text-sm font-medium text-gray-900 mb-4 pb-2 border-b border-gray-100">Details</h2>

                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5" for="price_night">Price / night (€)</label>
                            <input type="number" name="price_night" id="price_night" value="{{ old('price_night') }}" min="0" step="0.01"
                                class="w-full h-10 px-3 text-sm border border-gray-200 rounded-lg outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-100 transition"
                                placeholder="85">
                            @if($errors->has('price_night'))
                                <span class="text-xs text-red-500 mt-1 block">{{ $errors->first('price_night') }}</span>
                            @endif
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5" for="max_guests">Max guests</label>
                            <input type="number" name="max_guests" id="max_guests" value="{{ old('max_guests') }}" min="1"
                                class="w-full h-10 px-3 text-sm border border-gray-200 rounded-lg outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-100 transition"
                                placeholder="4">
                            @if($errors->has('max_guests'))
                                <span class="text-xs text-red-500 mt-1 block">{{ $errors->first('max_guests') }}</span>
                            @endif
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5" for="size">Size (m²)</label>
                            <input type="number" name="size" id="size" value="{{ old('size') }}" min="0" step="0.1"
                                class="w-full h-10 px-3 text-sm border border-gray-200 rounded-lg outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-100 transition"
                                placeholder="35">
                            @if($errors->has('size'))
                                <span class="text-xs text-red-500 mt-1 block">{{ $errors->first('size') }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Images --}}
                <div class="mb-8">
                    <h2 class="text-sm font-medium text-gray-900 mb-4 pb-2 border-b border-gray-100">Photos</h2>

                    <div class="border-2 border-dashed border-gray-200 rounded-lg p-6 text-center hover:border-teal-400 transition">
                        <svg class="w-8 h-8 text-gray-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="text-sm text-gray-400 mb-2">Upload apartment photos</p>
                        <label for="images" class="cursor-pointer text-sm text-teal-600 font-medium hover:underline">
                            Browse files
                        </label>
                        <input type="file" name="images[]" id="images" multiple accept="image/*" class="hidden">
                        <p class="text-xs text-gray-300 mt-2">JPEG, PNG, GIF up to 2MB each</p>
                    </div>
                    @if($errors->has('images'))
                        <span class="text-xs text-red-500 mt-1 block">{{ $errors->first('images') }}</span>
                    @endif
                </div>

                <div class="flex gap-3">
                    <button type="submit"
                        class="flex-1 h-10 bg-teal-600 hover:bg-teal-700 text-white text-sm font-medium rounded-lg transition">
                        List apartment
                    </button>
                    <a href="{{ route('apartments.index') }}"
                        class="h-10 px-6 flex items-center text-sm text-gray-500 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                        Cancel
                    </a>
                </div>

            </form>
        </div>
    </div>

</body>
</html>