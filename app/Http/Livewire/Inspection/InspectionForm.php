<?php

namespace App\Http\Livewire\Inspection;

use Livewire\Component;
use App\Models\FindingList;

class InspectionForm extends Component
{

    public $inspectionId, $description;
    public $action = '';  //flash
    public $message = '';  //flash

    protected $listeners = [
        'inspectionId',
        'resetInputFields'
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    //edit
    public function inspectionId($inspectionId)
    {
        $this->inspectionId = $inspectionId;
        $inspection = FindingList::whereId($inspectionId)->first();
        $this->description = $inspection->description;
    }

    //store
    public function store()
    {
        $data = $this->validate([
            'description' => 'required',
        ]);

        if ($this->inspectionId) {
            FindingList::whereId($this->inspectionId)->first()->update($data);
            $action = 'edit';
            $message = 'Successfully Updated';
        } else {
            FindingList::create($data);
            $action = 'store';
            $message = 'Successfully Created';
        }

        $this->emit('flashAction', $action, $message);
        $this->resetInputFields();
        $this->emit('closeInspectionModal');
        $this->emit('refreshParentInspection');
        $this->emit('refreshTable');
    }
    public function render()
    {
        return view('livewire.inspection.inspection-form');
    }
}
