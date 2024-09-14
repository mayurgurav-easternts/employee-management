<div class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-black bg-opacity-50">
    <div class="bg-white rounded-lg shadow-lg w-1/3">
        <div class="flex justify-between items-center bg-blue-500 text-white text-lg px-4 py-2 rounded-t-lg">
            <h2>{{ $employee_id ? 'Edit Employee' : 'Create Employee' }}</h2>
            <button wire:click="closeModal" class="text-white">&times;</button>
        </div>

        <div class="p-4">
            <form>
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" wire:model="name" id="name" class="form-control w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:border-blue-500">
                    @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" wire:model="email" id="email" class="form-control w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:border-blue-500">
                    @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end space-x-2">
                    <button wire:click.prevent="store" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Save</button>
                    <button wire:click.prevent="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-700">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
