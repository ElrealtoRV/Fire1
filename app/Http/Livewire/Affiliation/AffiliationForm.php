<?php

namespace App\Http\Livewire\Affiliation;

use Livewire\Component;
use App\Models\AffiliationLists;

class AffiliationForm extends Component
{
    public $affiliationId, $description;
    public $action = '';  //flash
    public $message = '';  //flash

    protected $listeners = [
        'affiliationId',
        'resetInputFields'
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    //edit
    public function affiliationId($affiliationId)
    {
        $this->affiliationId = $affiliationId;
        $affiliations = AffiliationLists::whereId($affiliationId)->first();
        $this->description = $affiliations->description;
    }

    //store
    public function store()
    {
        $data = $this->validate([
            'description' => 'required',
        ]);

        if ($this->affiliationId) {
            AffiliationLists::whereId($this->affiliationId)->first()->update($data);
            $action = 'edit';
            $message = 'Successfully Updated';
        } else {
            AffiliationLists::create($data);
            $action = 'store';
            $message = 'Successfully Created';
        }

        $this->emit('flashAction', $action, $message);
        $this->resetInputFields();
        $this->emit('closeAffiliationModal');
        $this->emit('refreshParentAffiliation');
        $this->emit('refreshTable');
    }

    public function render()
    {
        return view('livewire.affiliation.affiliation-form');
    }
}
