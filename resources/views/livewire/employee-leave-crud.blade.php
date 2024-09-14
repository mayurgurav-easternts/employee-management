<div>
    <button wire:click="create()" class="btn btn-primary">Apply Leave</button>

    @if($isOpen)
        @include('livewire.leave-create')
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Employee Name</th>
                <th>Leave Start</th>
                <th>Leave End</th>
                <th>Leave Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($leaves as $leave)
                <tr>
                    <td>{{ $leave->employee_name }}</td>
                    <td>{{ $leave->leave_start }}</td>
                    <td>{{ $leave->leave_end }}</td>
                    <td>{{ $leave->leave_type }}</td>
                    <td>
                        <button wire:click="edit({{ $leave->id }})" class="btn btn-success">Edit</button>
                        <button wire:click="delete({{ $leave->id }})" class="btn btn-danger">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
