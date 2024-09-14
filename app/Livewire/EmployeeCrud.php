<?php

namespace App\Livewire;

use App\Models\Employee;
use Livewire\Component;
use Illuminate\Validation\Rule;

class EmployeeCrud extends Component {
    public $employees, $name, $email, $phone, $gender, $date_of_birth, $position, $employee_id;
    public $isOpen = false;

    public function render() {
        $this->employees = Employee::all();
        return view('livewire.employee-crud')->layout('layouts.app');
    }
    public function create() {
        $this->resetInputFields();
        $this->openModal();
    }

    public function store() {
        $this->validate([
            'name' => 'required',
            //'email' => 'required|email|unique:employees',
            'email' => ['required', 'email', Rule::unique('employees')->ignore($this->employee_id)],
            'phone' => 'required',
            'gender' => 'required',
            'date_of_birth' => 'required',
            'position' => 'required',
        ]);

        Employee::updateOrCreate(
            ['id' => $this->employee_id],
            [
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'gender' => $this->gender,
                'date_of_birth' => $this->date_of_birth,
                'position' => $this->position,
            ]);

        session()->flash('message', $this->employee_id ? 'Employee Updated Successfully.' : 'Employee Created Successfully.');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id) {
        $employee = Employee::findOrFail($id);
        $this->employee_id = $id;
        $this->name = $employee->name;
        $this->email = $employee->email;
        $this->phone = $employee->phone;
        $this->gender = $employee->gender;
        $this->date_of_birth = $employee->date_of_birth;
        $this->position = $employee->position;
        $this->openModal();
    }

    public function delete($id) {
        Employee::find($id)->delete();
        session()->flash('message', 'Employee Deleted Successfully.');
    }

    private function resetInputFields() {
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->gender = '';
        $this->date_of_birth = '';
        $this->position = '';
        $this->employee_id = '';
    }

    public function openModal() {
        $this->isOpen = true;
    }

    public function closeModal() {
        $this->isOpen = false;
    }
}
