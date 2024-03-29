<?php

namespace App\Http\Livewire\Office;

use Livewire\Component;
use App\Models\OfficeLists;

class OfficeList extends Component
{

    public $officeId;
    public $search = '';
    public $action = ''; 
    public $message = ''; 

    protected $listeners = [
        'refreshParentOffice' => '$refresh',
        'deleteOffice',
        'editOffice',
        'deleteConfirmOffice'
    ];

    public function updatingSearch()
    {
        $this->emit('refreshTable');
    }

    public function createOffice()
    {
        $this->emit('resetInputFields');
        $this->emit('openOfficeModal');
    }

    public function editOffice($officeId)
    {
        $this->officeId = $officeId;
        $this->emit('officeId', $this->officeId);
        $this->emit('openOfficeModal');
    }

    public function deleteOffice($officeId)
    {
        OfficeLists::destroy($officeId);

        $action = 'error';
        $message = 'Successfully Deleted';

        $this->emit('flashAction', $action, $message);
        $this->emit('refreshTable');
    }

    public function render()
    {
        if (empty($this->search)) {
            $offices  = OfficeLists::all();
        } else {
            $offices  = OfficeLists::where('description', 'LIKE', '%' . $this->search . '%')->get();
        }

        return view('livewire.office.office-list', [
            'offices' => $offices
        ]);
    }

}
