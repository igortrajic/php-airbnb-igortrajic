@props(['name' => 'images', 'max' => 5])

<div class="mb-8">
    <div class="border-2 border-dashed border-gray-200 rounded-lg p-6 text-center hover:border-teal-400 transition">
        <svg class="w-8 h-8 text-gray-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
        <p class="text-sm text-gray-400 mb-2">Upload apartment photos</p>
        <label for="{{ $name }}" class="cursor-pointer text-sm text-teal-600 font-medium hover:underline">
            Browse files
        </label>
        <input type="file" name="{{ $name }}[]" id="{{ $name }}" multiple accept="image/*" class="hidden">
        <div id="file-label" class="text-xs text-gray-400 mt-2">No files selected</div>
        <div id="preview" class="mt-4 space-y-1"></div>
        <p class="text-xs text-gray-300 mt-2">Select up to {{ $max }} images — JPEG, PNG up to 2MB each</p>
    </div>
    @error($name)
        <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
    @enderror
</div>

<script>
    let selectedFiles = [];
    const maxFiles = {{ $max }};

    document.getElementById('{{ $name }}').addEventListener('change', function (e) {
        const newFiles = Array.from(e.target.files);

        newFiles.forEach(file => {
            if (!selectedFiles.find(f => f.name === file.name)) {
                if (selectedFiles.length < maxFiles) {
                    selectedFiles.push(file);
                }
            }
        });

        updatePreview();
        syncInput();
    });

    function updatePreview() {
        const preview = document.getElementById('preview');
        const label = document.getElementById('file-label');

        preview.innerHTML = '';

        if (selectedFiles.length === 0) {
            label.textContent = 'No files selected';
            return;
        }

        label.textContent = selectedFiles.length === 1
            ? '1 file selected'
            : `${selectedFiles.length} / ${maxFiles} files selected`;

        selectedFiles.forEach((file, index) => {
            const div = document.createElement('div');
            div.className = 'flex items-center gap-2 text-sm text-gray-600 py-1 border-b border-gray-100';
            div.innerHTML = `
                <svg class="w-4 h-4 text-teal-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span class="flex-1 truncate">${file.name}</span>
                <span class="text-gray-300 text-xs">${(file.size / 1024).toFixed(0)} KB</span>
                <button type="button" onclick="removeFile(${index})" class="text-gray-300 hover:text-red-400 transition ml-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            `;
            preview.appendChild(div);
        });
    }

    function removeFile(index) {
        selectedFiles.splice(index, 1);
        updatePreview();
        syncInput();
    }

    function syncInput() {
        const dt = new DataTransfer();
        selectedFiles.forEach(file => dt.items.add(file));
        document.getElementById('{{ $name }}').files = dt.files;
    }
</script>