<div>
    <button wire:click="create()" class="btn btn-primary">Record Attendance</button>

    @if($isOpen)
        @include('livewire.attendance-create')
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Employee Name</th>
                <th>Attendance Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $attendance)
                <tr>
                    <td>{{ $attendance->employee_name }}</td>
                    <td>{{ $attendance->attendance_date }}</td>
                    <td>{{ $attendance->status }}</td>
                    <td>
                        <button wire:click="edit({{ $attendance->id }})" class="btn btn-success">Edit</button>
                        <button wire:click="delete({{ $attendance->id }})" class="btn btn-danger">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
