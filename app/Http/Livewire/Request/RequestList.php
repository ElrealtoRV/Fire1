<?php

namespace App\Http\Livewire\Request;

use Livewire\Component;
use App\Models\RequestLists;
use App\Models\Request;
use App\Models\TypeList;


class RequestList extends Component
{
    public $requestId;
    public $search = '';
    public $action = '';  //flash
    public $message = '';  //flash

    protected $listeners = [
        'refreshRequest' => '$refresh',
        'deleteRequest',
        'editRequest',
        'deleteConfirmRequest'
        
    ];
    public function updatingSearch()
    {
        $this->emit('refreshTable');
    }
    public function createRequest()
    {
        $this->emit('resetInputFields');
        $this->emit('openRequestModal');
    }
    public function editRequest($requestId)
    {
        $this->requestId = $requestId;
        $this->emit('requestId', $this->requestId);
        $this->emit('openRequestModal');
        
    }
    public function deleteFire($requestId)
    {
        RequestLists::destroy($requestId);

        $action = 'error';
        $message = 'Successfully Deleted';

        $this->emit('flashAction', $action, $message);
        $this->emit('refreshTable');
    }

    public function render()
    {
        $requests = RequestLists::with('fireex')->get();
        $types = TypeList::query();
        $locations = RequestLists::with('fireLocation')->get();
        $addrequests = RequestLists::with('AddRequest')->get();

        

        

        if (!empty($this->search)) {
            $requests->where(function ($query) {
                $query->where('type', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('firename', 'LIKE', '%' . $this->search . '%') 
                    ->orWhereHas('serialNum', function ($locationQuery) {
                        $locationQuery->where('description', 'LIKE', '%' . $this->search . '%');
                    });
                });
            }
            return view('livewire.request.request-list', [
                'requests' => $requests,
                'types' => $types,
                'locations' => $locations,
                'addrequests' => $addrequests,
            ]); 
    }
}