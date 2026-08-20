<div id="actionModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-900 bg-opacity-50 transition-opacity backdrop-blur-sm"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-md border border-gray-200">

                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-6 text-center">
                    <h3 class="text-xl font-semibold leading-6 text-gray-900 mb-2" id="modalTitle">Confirm Action</h3>
                    <p class="text-sm text-gray-500" id="modalMessage">Are you sure?</p>
                </div>

                <div class="bg-gray-50 px-4 py-4 sm:px-6 border-t border-gray-200 flex flex-col sm:flex-row justify-center gap-3">
                    <button type="button" onclick="closeModal()" class="w-full sm:w-auto inline-flex justify-center rounded-xl bg-white px-5 py-2.5 text-sm font-medium text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 transition">
                        Cancel
                    </button>
                    <form id="modalForm" method="POST" class="w-full sm:w-auto m-0">
                        @csrf
                        <input type="hidden" name="_method" id="modalMethod" value="POST">
                        <button type="submit" id="modalConfirmBtn" class="w-full sm:w-auto inline-flex justify-center rounded-xl px-5 py-2.5 text-sm font-medium text-white shadow-sm transition">
                            Confirm
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    function openModal(actionType, formUrl, title, message) {
        document.getElementById('modalTitle').innerText = title;
        document.getElementById('modalMessage').innerText = message;
        document.getElementById('modalForm').action = formUrl;
        document.getElementById('modalMethod').value = actionType === 'delete' ? 'DELETE' : 'PATCH';
        
        const confirmBtn = document.getElementById('modalConfirmBtn');
        if (actionType === 'delete') {
            confirmBtn.className = 'w-full sm:w-auto inline-flex justify-center rounded-xl px-5 py-2.5 text-sm font-medium text-white shadow-sm transition bg-red-600 hover:bg-red-700';
            confirmBtn.innerText = 'Delete User';
        } else {
            confirmBtn.className = 'w-full sm:w-auto inline-flex justify-center rounded-xl px-5 py-2.5 text-sm font-medium text-white shadow-sm transition bg-emerald-600 hover:bg-emerald-700';
            confirmBtn.innerText = 'Promote to Admin';
        }

        document.getElementById('actionModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('actionModal').classList.add('hidden');
    }
</script>
