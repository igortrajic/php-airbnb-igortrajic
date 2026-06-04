@props(['showListProperty' => false])

<nav class="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between sticky top-0 z-50">
    <a href="{{ route('apartments.index') }}" class="flex items-center gap-2 text-teal-600 font-medium text-lg">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
        </svg>
        StayFinder
    </a>
    <div class="flex items-center gap-4">
        @if($showListProperty)
            <a href="{{ route('apartments.create') }}" class="text-sm font-medium text-teal-600 hover:text-teal-700 transition">
                List your property
            </a>
            <div class="h-4 w-px bg-gray-300"></div>
        @endif
        <span class="text-sm text-gray-500">{{ Auth::user()?->name ?? 'Guest' }}</span>
        @auth
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-sm text-gray-500 hover:text-red-500 transition">Logout</button>
            </form>
        @endauth
    </div>
</nav>