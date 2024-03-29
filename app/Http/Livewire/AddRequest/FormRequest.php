<?php

namespace App\Http\Livewire\AddRequest;

use App\Models\Request;
use Livewire\Component;

class FormRequest extends Component
{
    public $addrequestId, $description;
    public $action = '';  //flash
    public $message = '';  //flash

    protected $listeners = [
        'addrequestId',
        'resetInputFields'
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    //edit
    public function addrequestId($addrequestId)
    {
        $this->addrequestId = $addrequestId;
        $addrequests = Request::whereId($addrequestId)->first();
        $this->description = $addrequests->description;
    }

    //store
    public function store()
    {
        $data = $this->validate([
            'description' => 'required',
        ]);

        if ($this->addrequestId) {
           Request::whereId($this->addrequestId)->first()->update($data);
            $action = 'edit';
            $message = 'Successfully Updated';
        } else {
            Request::create($data);
            $action = 'store';
            $message = 'Successfully Created';
        }

        $this->emit('flashAction', $action, $message);
        $this->resetInputFields();
        $this->emit('closeAddRequestModal');
        $this->emit('refreshParentAddRequest');
        $this->emit('refreshTable');
    }

    public function render()
    {
        return view('livewire.add-request.form-request');
    }
}
