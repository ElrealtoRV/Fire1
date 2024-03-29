<?php

namespace App\Http\Livewire\Department;

use Livewire\Component;
use App\Models\DepartmentLists;

class DepartmentList extends Component
{

    public $deptId;
    public $search = '';
    public $action = ''; 
    public $message = ''; 

    protected $listeners = [
        'refreshParentDepartment' => '$refresh',
        'deleteDepartment',
        'editDepartment',
        'deleteConfirmDepartment'
    ];

    public function updatingSearch()
    {
        $this->emit('refreshTable');
    }

    public function createDepartment()
    {
        $this->emit('resetInputFields');
        $this->emit('openDepartmentModal');
    }

    public function editDepartment($deptId)
    {
        $this->deptId = $deptId;
        $this->emit('deptId', $this->deptId);
        $this->emit('openDepartmentModal');
    }

    public function deleteDepartment($deptId)
    {
        DepartmentLists::destroy($deptId);

        $action = 'error';
        $message = 'Successfully Deleted';

        $this->emit('flashAction', $action, $message);
        $this->emit('refreshTable');
    }

    public function render()
    {
        if (empty($this->search)) {
            $depts  =DepartmentLists::all();
        } else {
            $depts  = DepartmentLists::where('description', 'LIKE', '%' . $this->search . '%')->get();
        }

        return view('livewire.department.department-list', [
            'depts' => $depts
        ]);
    }

}
