<?php

namespace App\Http\Livewire\Type;

use App\Models\TypeList;
use Livewire\Component;

class TypeForm extends Component
{
    public $typeId, $description;
    public $action = '';  //flash
    public $message = '';  //flash

    protected $listeners = [
        'typeId',
        'resetInputFields'
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    //edit
    public function typeId($typeId)
    {
        $this->typeId = $typeId;
        $type = TypeList::whereId($typeId)->first();
        $this->description = $type->description;
    }

    //store
    public function store()
    {
        $data = $this->validate([
            'description' => 'required',
        ]);

        if ($this->typeId) {
            TypeList::whereId($this->typeId)->first()->update($data);
            $action = 'edit';
            $message = 'Successfully Updated';
        } else {
            TypeList::create($data);
            $action = 'store';
            $message = 'Successfully Created';
        }

        $this->emit('flashAction', $action, $message);
        $this->resetInputFields();
        $this->emit('closeTypeModal');
        $this->emit('refreshParentType');
        $this->emit('refreshTable');
    }

    public function render()
    {
        return view('livewire.type.type-form');
    }
}