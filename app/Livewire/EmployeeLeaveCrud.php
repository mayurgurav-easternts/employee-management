<?php

namespace App\Livewire;

use App\Models\Employee;
use App\Models\EmployeeLeave;
use Livewire\Component;

class EmployeeLeaveCrud extends Component {

    public $leaves, $employee_id, $leave_start, $leave_end, $leave_type, $leave_id, $employees;
    public $isOpen = false;

    public function render() {
        //$this->leaves = EmployeeLeave::with('employee')->get();
        $this->leaves = EmployeeLeave::join('employees', 'employee_leaves.employee_id', '=', 'employees.id')
            ->select('employee_leaves.*', 'employees.name as employee_name', 'employees.email as employee_email')
            ->get();

        $this->employees = Employee::all();
        return view('livewire.employee-leave-crud')->layout('layouts.app');
    }

    public function create() {
        $this->resetInputFields();
        $this->openModal();
    }

    public function store() {
        $this->validate([
            'employee_id' => 'required',
            'leave_start' => 'required|date',
            'leave_end' => 'required|date',
            'leave_type' => 'required',
        ]);

        EmployeeLeave::updateOrCreate(['id' => $this->leave_id], [
            'employee_id' => $this->employee_id,
            'leave_start' => $this->leave_start,
            'leave_end' => $this->leave_end,
            'leave_type' => $this->leave_type,
        ]);

        session()->flash('message', $this->leave_id ? 'Leave Updated Successfully.' : 'Leave Created Successfully.');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id) {
        $leave = EmployeeLeave::findOrFail($id);
        $this->leave_id = $id;
        $this->employee_id = $leave->employee_id;
        $this->leave_start = $leave->leave_start;
        $this->leave_end = $leave->leave_end;
        $this->leave_type = $leave->leave_type;
        $this->openModal();
    }

    public function delete($id) {
        EmployeeLeave::find($id)->delete();
        session()->flash('message', 'Leave Deleted Successfully.');
    }

    private function resetInputFields() {
        $this->employee_id = '';
        $this->leave_start = '';
        $this->leave_end = '';
        $this->leave_type = '';
        $this->leave_id = '';
    }

    public function openModal() {
        $this->isOpen = true;
    }

    public function closeModal() {
        $this->isOpen = false;
    }
}
