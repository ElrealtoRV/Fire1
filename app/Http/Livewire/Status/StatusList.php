<?php

namespace App\Http\Livewire\Status;

use Livewire\Component;
use App\Models\StatusLists;

class StatusList extends Component
{
    public $statusId;
    public $search = '';
    public $action = ''; 
    public $message = ''; 

    protected $listeners = [
        'refreshParentStatus' => '$refresh',
        'deleteStatus',
        'editStatus',
        'deleteConfirmStatus'
    ];

    public function updatingSearch()
    {
        $this->emit('refreshTable');
    }

    public function createStatus()
    {
        $this->emit('resetInputFields');
        $this->emit('openStatusModal');
    }

    public function editStatus($statusId)
    {
        $this->statusId = $statusId;
        $this->emit('statusId', $this->statusId);
        $this->emit('openStatusModal');
    }

    public function deleteStatus($statusId)
    {
       StatusLists::destroy($statusId);

        $action = 'error';
        $message = 'Successfully Deleted';

        $this->emit('flashAction', $action, $message);
        $this->emit('refreshTable');
    }

    public function render()
    {
        if (empty($this->search)) {
            $statuses  = StatusLists::all();
        } else {
            $statuses  = StatusLists::where('description', 'LIKE', '%' . $this->search . '%')->get();
        }

        return view('livewire.status.status-list', [
            'statuses' => $statuses,
        ]);
    }
}
