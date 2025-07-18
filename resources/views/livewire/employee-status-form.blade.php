<div>
    <!-- Button to open modal -->
    <button wire:click="openModal"
        class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md">
        Update Status
    </button>

    <!-- Modal -->
    @if($showModal)
        <div class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
            <div class="bg-white dark:bg-gray-800 rounded-lg p-6 w-full max-w-md shadow-lg">
                <h2 class="text-lg font-semibold mb-4">Update Employee Position Title</h2>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium">Position Title</label>
                        <input type="text" wire:model.defer="position_title"
                            class="w-full border-gray-300 rounded-md shadow-sm" />
                        @error('position_title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Effective Date</label>
                        <input type="date" wire:model.defer="effective_date"
                            class="w-full border-gray-300 rounded-md shadow-sm" />
                        @error('effective_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Remarks</label>
                        <textarea wire:model.defer="remarks" class="w-full border-gray-300 rounded-md shadow-sm"></textarea>
                        @error('remarks') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-2">
                    <button wire:click="closeModal" class="px-4 py-2 bg-gray-200 rounded-md">Cancel</button>
                    <button wire:click="save" class="px-4 py-2 bg-blue-600 text-white rounded-md">Save</button>
                </div>
            </div>
        </div>
    @endif
</div>
