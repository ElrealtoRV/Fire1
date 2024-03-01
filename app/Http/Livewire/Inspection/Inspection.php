<?php

namespace App\Http\Livewire\Inspection;

use Livewire\Component;
use App\Models\FindingList;

class Inspection extends Component
{

    public $inspectionId;
    public $search = '';
    public $action = ''; 
    public $message = ''; 

    protected $listeners = [
        'refreshParentInspection' => '$refresh',
        'deleteInspection',
        'editInspection',
        'deleteConfirmInspection'
    ];

    public function updatingSearch()
    {
        $this->emit('refreshTable');
    }

    public function createInspection()
    {
        $this->emit('resetInputFields');
        $this->emit('openInspectionModal');
    }

    public function editInspection($inspectionId)
    {
        $this->inspectionId = $inspectionId;
        $this->emit('inspectionId', $this->inspectionId);
        $this->emit('openInspectionModal');
    }

    public function deleteInspection($inspectionId)
    {
        FindingList::destroy($inspectionId);

        $action = 'error';
        $message = 'Successfully Deleted';

        $this->emit('flashAction', $action, $message);
        $this->emit('refreshTable');
    }

    public function render()
    {
        if (empty($this->search)) {
            $inspections  = FindingList::all();
        } else {
            $inspections  = FindingList::where('description', 'LIKE', '%' . $this->search . '%')->get();
        }

        return view('livewire.inspection.inspection', [
            'inspections' => $inspections
        ]);
    }

}
