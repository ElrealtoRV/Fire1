<?php

namespace App\Http\Livewire\RegularUser;

use Livewire\Component;
use App\Models\RegularList;

class RegularUserList extends Component
{
    public $regularuserId;
    public $search = '';
    public $action = '';  //flash
    public $message = '';  //flash

    protected $listeners = [
        'refreshParentRegularUser' => '$refresh',
        'deleteRegularUser',
        'editRegularUser',
        'deleteConfirmRegularUser'
        
    ];
    

    public function updatingSearch()
    {
        $this->emit('refreshTable');
    }

    public function createRegularUser()
    {
        $this->emit('resetInputFields');
        $this->emit('openRegularUserModal');
    }

    public function editRegularUser($regularuserId)
    {
        $this->regularuserId = $regularuserId;
        $this->emit('regularuserId', $this->regularuserId);
        $this->emit('openRegularUserModal');
        
    }

    public function deleteRegularUser($regularuserId)
    {
        RegularUserList::destroy($regularuserId);

        $action = 'error';
        $message = 'Successfully Deleted';

        $this->emit('flashAction', $action, $message);
        $this->emit('refreshTable');
    }

    public function render()
    {
        $regularusers = RegularList::query();
        $regular = RegularList::with('Status')->get();


        if (!empty($this->search)) {
            $regularusers->where(function ($query) {
                $query->where('first_name', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $this->search . '%') 
                    ->orWhere('email', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('status', 'LIKE', '%' . $this->search . '%')
                    ->orWhereHas('dept', function ($deptQuery) {
                        $deptQuery->where('description', 'LIKE', '%' . $this->search . '%');
                    });
            });
        }

        $regularusers = $regularusers->with('roles')->get();

        return view('livewire.regular-user.regular-user-list', [
            'regularusers' => $regularusers,
            'regular' => $regular,
        ]); 
    }
}
