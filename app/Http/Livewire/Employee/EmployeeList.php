<?php

namespace App\Http\Livewire\Employee;

use App\Models\Employee;
use Livewire\Component;

class EmployeeList extends Component
{
    public $employeeId;
    public $search = '';
    public $action = '';  //flash
    public $message = '';  //flash

    protected $listeners = [
        'refreshParentEmployee' => '$refresh',
        'deleteEmployee',
        'editEmployee',
        'deleteConfirmEmployee'
    ];

    public function updatingSearch()
    {
        $this->emit('refreshTable');
    }

    public function createEmployee()
    {
        $this->emit('resetInputFields');
        $this->emit('openEmployeeModal');
    }

    public function editEmployee($employeeId)
    {
        $this->employeeId = $employeeId;
        $this->emit('employeeId', $this->employeeId);
        $this->emit('openEmployeeModal');
    }

    public function deleteEmployee($employeeId)
    {
        Employee::destroy($employeeId);

        $action = 'error';
        $message = 'Successfully Deleted';

        $this->emit('flashAction', $action, $message);
        $this->emit('refreshTable');
    }

    public function render()
    {
        if (empty($this->search)) {
            $employees  = Employee::all();
        } else {
            $employees  = Employee::where(function ($query) {
                $query->where('first_name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('last_name', 'LIKE', '%' . $this->search . '%');
            })->get();
        }
        return view('livewire.employee.employee-list', [
            'employees' => $employees
        ]);
    }
}
