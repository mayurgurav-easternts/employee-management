<div class="modal">
    <div class="modal-content">
        <h2>{{ $leave_id ? 'Edit' : 'Apply' }} Leave</h2>
        <form>
            <div class="form-group">
                <label>Employee</label>
                <select wire:model="employee_id" class="form-control">
                    <option value="">Select Employee</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                    @endforeach
                </select>
                @error('employee_id') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label>Leave Start</label>
                <input type="date" wire:model="leave_start" class="form-control">
                @error('leave_start') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label>Leave End</label>
                <input type="date" wire:model="leave_end" class="form-control">
                @error('leave_end') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label>Leave Type</label>
                <select wire:model="leave_type" class="form-control">
                    <option value="">Select Leave Type</option>
                    <option value="Sick">Sick</option>
                    <option value="Casual">Casual</option>
                    <option value="Vacation">Vacation</option>
                </select>
                @error('leave_type') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <button wire:click.prevent="store()" class="btn btn-primary">Save</button>
            <button wire:click.prevent="closeModal()" class="btn btn-secondary">Cancel</button>
        </form>
    </div>
</div>
