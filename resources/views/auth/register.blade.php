<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">

    <div class="bg-white rounded-2xl border border-gray-200 p-8 w-full max-w-md">

        <div class="flex items-center gap-2 text-teal-600 font-medium text-lg mb-6">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            StayFinder
        </div>

        <h1 class="text-xl font-medium text-gray-900 mb-1">Create an account</h1>
        <p class="text-sm text-gray-400 mb-6">Fill in your details to get started</p>

        @if($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-lg px-4 py-3 text-sm text-red-600 mb-4">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('register.post') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1.5" for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="w-full h-10 px-3 text-sm border border-gray-200 rounded-lg outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-100 transition"
                    placeholder="Your name">
                @if($errors->has('name'))
                    <span class="text-xs text-red-500 mt-1 block">{{ $errors->first('name') }}</span>
                @endif
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1.5" for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                    class="w-full h-10 px-3 text-sm border border-gray-200 rounded-lg outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-100 transition"
                    placeholder="you@example.com">
                @if($errors->has('email'))
                    <span class="text-xs text-red-500 mt-1 block">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1.5" for="password">Password</label>
                <input type="password" name="password" id="password"
                    class="w-full h-10 px-3 text-sm border border-gray-200 rounded-lg outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-100 transition"
                    placeholder="Min. 8 characters">
                @if($errors->has('password'))
                    <span class="text-xs text-red-500 mt-1 block">{{ $errors->first('password') }}</span>
                @endif
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1.5" for="password_confirmation">Confirm password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="w-full h-10 px-3 text-sm border border-gray-200 rounded-lg outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-100 transition"
                    placeholder="Repeat your password">
                @if($errors->has('password_confirmation'))
                    <span class="text-xs text-red-500 mt-1 block">{{ $errors->first('password_confirmation') }}</span>
                @endif
            </div>

            <button type="submit"
                class="w-full h-10 bg-teal-600 hover:bg-teal-700 text-white text-sm font-medium rounded-lg transition">
                Create account
            </button>
        </form>

        <p class="text-center text-sm text-gray-400 mt-5">
            Already have an account?
            <a href="{{ route('login') }}" class="text-teal-600 font-medium hover:underline">Sign in</a>
        </p>

    </div>

</body>
</html>