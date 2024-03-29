<?php

namespace App\Http\Livewire\Department;

use Livewire\Component;
use App\Models\DepartmentLists;

class DepartmentForm extends Component
{

    public $deptId, $description;
    public $action = '';  //flash
    public $message = '';  //flash

    protected $listeners = [
        'deptId',
        'resetInputFields'
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    //edit
    public function departmentId($deptId)
    {
        $this->deptId = $deptId;
        $depts = DepartmentLists::whereId($deptId)->first();
        $this->description = $depts->description;
    }

    //store
    public function store()
    {
        $data = $this->validate([
            'description' => 'required',
        ]);

        if ($this->deptId) {
            DepartmentLists::whereId($this->deptId)->first()->update($data);
            $action = 'edit';
            $message = 'Successfully Updated';
        } else {
            DepartmentLists::create($data);
            $action = 'store';
            $message = 'Successfully Created';
        }

        $this->emit('flashAction', $action, $message);
        $this->resetInputFields();
        $this->emit('closeDepartmentModal');
        $this->emit('refreshParentDepartment');
        $this->emit('refreshTable');
    }
    public function render()
    {
        return view('livewire.department.department-form');
    }
}
