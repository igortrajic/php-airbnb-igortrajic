@props(['images'])

@php $count = $images->count(); @endphp

@if($count === 1)
    <div class="h-75 md:h-100 mb-8 rounded-2xl overflow-hidden bg-gray-200">
        <img src="{{ Storage::url($images[0]->image_url) }}" class="w-full h-full object-cover object-center hover:opacity-90 transition cursor-pointer">
    </div>

@elseif($count === 2)
    <div class="grid grid-cols-2 gap-2 h-75 md:h-100 mb-8 rounded-2xl overflow-hidden">
        <div class="h-full bg-gray-200">
            <img src="{{ Storage::url($images[0]->image_url) }}" class="w-full h-full object-cover object-center hover:opacity-90 transition cursor-pointer">
        </div>
        <div class="h-full bg-gray-200">
            <img src="{{ Storage::url($images[1]->image_url) }}" class="w-full h-full object-cover object-center hover:opacity-90 transition cursor-pointer">
        </div>
    </div>

@elseif($count === 3)
    <div class="grid grid-cols-2 grid-rows-2 gap-2 h-75 md:h-100 mb-8 rounded-2xl overflow-hidden">
        <div class="col-span-1 row-span-2 bg-gray-200">
            <img src="{{ Storage::url($images[0]->image_url) }}" class="w-full h-full object-cover object-center hover:opacity-90 transition cursor-pointer">
        </div>
        <div class="col-span-1 row-span-1 bg-gray-200">
            <img src="{{ Storage::url($images[1]->image_url) }}" class="w-full h-full object-cover object-center hover:opacity-90 transition cursor-pointer">
        </div>
        <div class="col-span-1 row-span-1 bg-gray-200">
            <img src="{{ Storage::url($images[2]->image_url) }}" class="w-full h-full object-cover object-center hover:opacity-90 transition cursor-pointer">
        </div>
    </div>

@elseif($count === 4)
    <div class="grid grid-cols-4 grid-rows-2 gap-2 h-75 md:h-100 mb-8 rounded-2xl overflow-hidden">
        <div class="col-span-2 row-span-2 bg-gray-200">
            <img src="{{ Storage::url($images[0]->image_url) }}" class="w-full h-full object-cover object-center hover:opacity-90 transition cursor-pointer">
        </div>
        <div class="col-span-2 row-span-1 bg-gray-200">
            <img src="{{ Storage::url($images[1]->image_url) }}" class="w-full h-full object-cover object-center hover:opacity-90 transition cursor-pointer">
        </div>
        <div class="col-span-1 row-span-1 bg-gray-200">
            <img src="{{ Storage::url($images[2]->image_url) }}" class="w-full h-full object-cover object-center hover:opacity-90 transition cursor-pointer">
        </div>
        <div class="col-span-1 row-span-1 bg-gray-200">
            <img src="{{ Storage::url($images[3]->image_url) }}" class="w-full h-full object-cover object-center hover:opacity-90 transition cursor-pointer">
        </div>
    </div>

@elseif($count >= 5)
    <div class="grid grid-cols-4 grid-rows-2 gap-2 h-75 md:h-100 mb-8 rounded-2xl overflow-hidden">
        <div class="col-span-2 row-span-2 bg-gray-200">
            <img src="{{ Storage::url($images[0]->image_url) }}" class="w-full h-full object-cover object-center hover:opacity-90 transition cursor-pointer">
        </div>
        <div class="col-span-1 row-span-1 bg-gray-200">
            <img src="{{ Storage::url($images[1]->image_url) }}" class="w-full h-full object-cover object-center hover:opacity-90 transition cursor-pointer">
        </div>
        <div class="col-span-1 row-span-1 bg-gray-200">
            <img src="{{ Storage::url($images[2]->image_url) }}" class="w-full h-full object-cover object-center hover:opacity-90 transition cursor-pointer">
        </div>
        <div class="col-span-1 row-span-1 bg-gray-200">
            <img src="{{ Storage::url($images[3]->image_url) }}" class="w-full h-full object-cover object-center hover:opacity-90 transition cursor-pointer">
        </div>
        <div class="col-span-1 row-span-1 bg-gray-200">
            <img src="{{ Storage::url($images[4]->image_url) }}" class="w-full h-full object-cover object-center hover:opacity-90 transition cursor-pointer">
        </div>
    </div>

@else
    <div class="h-75 md:h-100 mb-8 rounded-2xl overflow-hidden bg-gray-100 flex items-center justify-center">
        <span class="text-gray-400">No images provided</span>
    </div>
@endif