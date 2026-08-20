@if (session('success'))
    <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-800 text-sm font-medium">
        {{ session('success') }}
    </div>
@endif

@if ($errors->has('booking'))
    <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 text-sm font-medium">
        {{ $errors->first('booking') }}
    </div>
@endif
