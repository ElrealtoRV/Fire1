<?php

namespace App\Http\Livewire\Request;

use Livewire\Component;
use App\Models\RequestLists;
use App\Models\TypeList;
use App\Models\LocationList;
use App\Models\Request;
use App\Models\FindingList;

class RequestForm extends Component
{
    public $requestId, $type, $firename, $serial_number, $location,$request;
    public $action = '';  //flash
    public $message = '';  //flashSSS
    public $requestCheck = array();
    public $selectedRequest = [];

    protected $listeners = [
        'requestId',
        'resetInputFields'
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function requestId($requestId)
    {
        $this->requestId = $requestId;
        $request = RequestLists::find($requestId);
        $this->type = $request->type;
        $this->firename = $request->firename;
        $this->serial_number = $request->serial_number;
        $this->location = $request->location;
        $this->request = $request->request;

        $this->selectedRequest = $request->getRequestNames()->toArray();
    }

    public function store()
    {
          if (is_object($this->selectedRequest)) {
            $this->selectedRequest = json_decode(json_encode($this->selectedRequest), true);
        }

        if (empty($this->requestCheck)) {
            $this->requestCheck = array_map('strval', $this->selectedRequest);
        }

        if ($this->requestId) {

            $data = $this->validate([
                'type'    => 'required',
                'firename'   => 'required',
                'serial_number'     => 'required',
                'location'     => 'required',
                'request'     => 'required',
                
            ]);
            

            $request = RequestLists::find($this->requestId);
            $request->update($data);


            $request->syncFire($this->requestCheck);

            $action = 'edit';
            $message = 'Successfully Updated';
        } else {

            $this->validate([
                'type'    => 'required',
                'firename'   => 'required',
                'serial_number'     => 'required',
                'location'     => 'required',
                'request'     => 'required',
            ]);

            $request = RequestLists::create([
                'type'    => $this->type,
                'firename'   => $this->firename,
                'serial_number'      => $this->serial_number,
                'location'      => $this->location,
                'request'      => $this->request,
            ]);

            $action = 'store';
            $message = 'Successfully Created';
        }
        
        $this->emit('flashAction', $action, $message);
        $this->resetInputFields();
        $this->emit('closeRequestModal');
        $this->emit('refreshParentRequest   ');
        $this->emit('refreshTable');

    }

    public function render()
    {
        $requests =RequestLists::all();
        $types =TypeList::all();
        $locations =LocationList::all();
        $addrequests =Request::all();

        return view('livewire.request.request-form', [
            'requests' => $requests,
            'types' => $types,
            'locations' => $locations,
            'addrequests' => $addrequests,

        ]);
    }
}
