<div class="flex items-center gap-2 w-full md:w-auto">
    <label for="sort" class="text-sm text-gray-500 whitespace-nowrap">Sort by:</label>
    <select name="sort" id="sort" onchange="this.form.submit()"
        class="w-full md:w-auto border border-gray-200 bg-white text-gray-700 py-2 pl-3 pr-8 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-teal-100 focus:border-teal-500 appearance-none cursor-pointer">
        <option value="created_desc" {{ request('sort') == 'created_desc' ? 'selected' : '' }}>Newest</option>
        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
        <option value="guests_asc" {{ request('sort') == 'guests_asc' ? 'selected' : '' }}>Guests: Low to High</option>
        <option value="guests_desc" {{ request('sort') == 'guests_desc' ? 'selected' : '' }}>Guests: High to Low</option>
    </select>
</div>
