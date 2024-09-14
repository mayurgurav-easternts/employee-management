<div class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-black bg-opacity-50">
    <div class="bg-white rounded-lg shadow-lg w-1/3">
        <div class="flex justify-between items-center bg-blue-500 text-white text-lg px-4 py-2 rounded-t-lg">
            <h2>{{ $attendance_id ? 'Edit Attendance' : 'Create Attendance' }}</h2>
            <button wire:click="closeModal" class="text-white">&times;</button>
        </div>

        <div class="p-4">
            <form>
                <div class="mb-4">
                    <label for="employee_id" class="block text-sm font-medium text-gray-700">Employee</label>
                    <select wire:model="employee_id" id="employee_id" class="form-control w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:border-blue-500">
                        <option value="">Select Employee</option>
                        @foreach($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                        @endforeach
                    </select>
                    @error('employee_id') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="attendance_date" class="block text-sm font-medium text-gray-700">Attendance Date</label>
                    <input type="date" wire:model="attendance_date" id="attendance_date" class="form-control w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:border-blue-500">
                    @error('attendance_date') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select wire:model="status" id="status" class="form-control w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:border-blue-500">
                        <option value="">Select Status</option>
                        <option value="Present">Present</option>
                        <option value="Absent">Absent</option>
                    </select>
                    @error('status') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end space-x-2">
                    <button wire:click.prevent="store" class="bg-blue-500 text-black px-4 py-2 rounded-lg hover:bg-blue-700">Save</button>
                    <button wire:click.prevent="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-700">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
