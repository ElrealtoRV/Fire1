<?php

namespace App\Http\Livewire\Employee;

use App\Models\EmployeeList;
use App\Models\Position;
use Livewire\Component;

class Employee extends Component
{
    public $userId;
    public $search = '';
    public $action = '';  //flash
    public $message = '';  //flash

    protected $listeners = [
        'refreshParentUser' => '$refresh',
        'deleteUser',
        'editUser',
        'deleteConfirmUser'
        
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

    public function editUser($userId)
    {
        $this->userId = $userId;
        $this->emit('userId', $this->userId);
        $this->emit('openEmployeeModal');
        
    }

    public function deleteUser($userId)
    {
        EmployeeList::destroy($userId);

        $action = 'error';
        $message = 'Successfully Deleted';

        $this->emit('flashAction', $action, $message);
        $this->emit('refreshTable');
    }

    public function render()
    {
        $users = EmployeeList::query();

        if (!empty($this->search)) {
            $users->where(function ($query) {
                $query->where('first_name', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $this->search . '%') 
                    ->orWhere('email', 'LIKE', '%' . $this->search . '%')
                    ->orWhereHas('position', function ($positionQuery) {
                        $positionQuery->where('description', 'LIKE', '%' . $this->search . '%');
                    });
            });
        }

        $users = $users->with('roles')->get();

        return view('livewire.employee.employee-list', [
            'users' => $users
        ]); 
    }
}
