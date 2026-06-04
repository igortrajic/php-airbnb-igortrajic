@props(['apartment'])

<div class="grid grid-cols-2 gap-4 mb-8">
    <div class="bg-[#eefafb] rounded-xl py-4 flex flex-col items-center justify-center text-teal-700 gap-2 border border-teal-50">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
        <span class="text-sm font-medium">Up to {{ $apartment->max_guests }} guests</span>
    </div>
    <div class="bg-[#eefafb] rounded-xl py-4 flex flex-col items-center justify-center text-teal-700 gap-2 border border-teal-50">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/></svg>
        <span class="text-sm font-medium">{{ $apartment->size }} m&sup2;</span>
    </div>
</div>