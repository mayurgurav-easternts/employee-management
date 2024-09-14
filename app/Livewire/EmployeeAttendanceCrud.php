<?php

namespace App\Livewire;

use App\Models\Employee;
use App\Models\EmployeeAttendance;
use Livewire\Component;

class EmployeeAttendanceCrud extends Component
{
    public $attendances, $employee_id, $attendance_date, $status, $attendance_id,$employees;
    public $isOpen = false;

    public function render()
    {
        // $this->attendances = EmployeeAttendance::with('employee')->get();
        $this->employees = Employee::all();
        $this->attendances = EmployeeAttendance::join('employees', 'employee_attendances.employee_id', '=', 'employees.id')
            ->select('employee_attendances.*', 'employees.name as employee_name', 'employees.email as employee_email')
            ->get();

        return view('livewire.employee-attendance-crud')->layout('layouts.app');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function store()
    {
        $this->validate([
            'employee_id' => 'required',
            'attendance_date' => 'required|date',
            'status' => 'required',
        ]);

        EmployeeAttendance::updateOrCreate(['id' => $this->attendance_id], [
            'employee_id' => $this->employee_id,
            'attendance_date' => $this->attendance_date,
            'status' => $this->status,
        ]);

        session()->flash('message', $this->attendance_id ? 'Attendance Updated Successfully.' : 'Attendance Created Successfully.');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $attendance = EmployeeAttendance::findOrFail($id);
        $this->attendance_id = $id;
        $this->employee_id = $attendance->employee_id;
        $this->attendance_date = $attendance->attendance_date;
        $this->status = $attendance->status;
        $this->openModal();
    }

    public function delete($id)
    {
        EmployeeAttendance::find($id)->delete();
        session()->flash('message', 'Attendance Deleted Successfully.');
    }

    private function resetInputFields()
    {
        $this->employee_id = '';
        $this->attendance_date = '';
        $this->status = '';
        $this->attendance_id = '';
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }
}
