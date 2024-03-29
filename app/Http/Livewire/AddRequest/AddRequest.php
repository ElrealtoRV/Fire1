<?php

namespace App\Http\Livewire\AddRequest;

use Livewire\Component;
use App\Models\Request;

class AddRequest extends Component
{
    public $addrequestId;
    public $search = '';
    public $action = ''; 
    public $message = ''; 

    protected $listeners = [
        'refreshParentAddRequest' => '$refresh',
        'deleteAddRequest',
        'editAddRequest',
        'deleteConfirmAddRequest'
    ];

    public function updatingSearch()
    {
        $this->emit('refreshTable');
    }

    public function createAddRequest()
    {
        $this->emit('resetInputFields');
        $this->emit('openAddRequestModal');
    }

    public function editAddRequest($addrequestId)
    {
        $this->addrequestId = $addrequestId;
        $this->emit('addrequestId', $this->addrequestId);
        $this->emit('openAddRequestModal');
    }

    public function deleteAddRequest($addrequestId)
    {
        Request::destroy($addrequestId);

        $action = 'error';
        $message = 'Successfully Deleted';

        $this->emit('flashAction', $action, $message);
        $this->emit('refreshTable');
    }

    public function render()
    {
        if (empty($this->search)) {
            $addrequests  = Request::all();
           
        } else {
            $addrequests  = Request::where('description', 'LIKE', '%' . $this->search . '%')->get();
        }

        return view('livewire.add-request.add-request', [
            'addrequests' => $addrequests,
        ]);
    }
}
