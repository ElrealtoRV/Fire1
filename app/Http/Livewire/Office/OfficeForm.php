<?php

namespace App\Http\Livewire\Office;

use Livewire\Component;
use App\Models\OfficeLists;

class OfficeForm extends Component
{

    public $officeId, $description;
    public $action = '';  //flash
    public $message = '';  //flash

    protected $listeners = [
        'officeId',
        'resetInputFields'
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    //edit
    public function officeId($officeId)
    {
        $this->officeId = $officeId;
        $office = OfficeLists::whereId($officeId)->first();
        $this->description = $office->description;
    }

    //store
    public function store()
    {
        $data = $this->validate([
            'description' => 'required',
        ]);

        if ($this->officeId) {
            OfficeLists::whereId($this->officeId)->first()->update($data);
            $action = 'edit';
            $message = 'Successfully Updated';
        } else {
            OfficeLists::create($data);
            $action = 'store';
            $message = 'Successfully Created';
        }

        $this->emit('flashAction', $action, $message);
        $this->resetInputFields();
        $this->emit('closeOfficeModal');
        $this->emit('refreshParentOffice');
        $this->emit('refreshTable');
    }
    public function render()
    {
        return view('livewire.office.office-form');
    }
}
