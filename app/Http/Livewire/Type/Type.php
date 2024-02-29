<?php

namespace App\Http\Livewire\Type;

use Livewire\Component;
use App\Models\TypeList;

class Type extends Component
{

    public $typeId;
    public $search = '';
    public $action = ''; 
    public $message = ''; 

    protected $listeners = [
        'refreshParentType' => '$refresh',
        'deleteType',
        'editType',
        'deleteConfirmType'
    ];

    public function updatingSearch()
    {
        $this->emit('refreshTable');
    }

    public function createType()
    {
        $this->emit('resetInputFields');
        $this->emit('openTypeModal');
    }

    public function editType($typeId)
    {
        $this->typeId = $typeId;
        $this->emit('typeId', $this->typeId);
        $this->emit('openTypeModal');
    }

    public function deleteType($typeId)
    {
        TypeList::destroy($typeId);

        $action = 'error';
        $message = 'Successfully Deleted';

        $this->emit('flashAction', $action, $message);
        $this->emit('refreshTable');
    }

    public function render()
    {
        if (empty($this->search)) {
            $type  = TypeList::all();
        } else {
            $type  = TypeList::where('description', 'LIKE', '%' . $this->search . '%')->get();
        }

        return view('livewire.type.type', [
            'type' => $type
        ]);
    }
}
