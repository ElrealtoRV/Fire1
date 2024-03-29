<?php

namespace App\Http\Livewire\Affiliation;

use Livewire\Component;
use App\Models\AffiliationLists;

class AffiliationList extends Component
{
    public $affiliationId;
    public $search = '';
    public $action = ''; 
    public $message = ''; 

    protected $listeners = [
        'refreshParentAffiliation' => '$refresh',
        'deleteAffiliation',
        'editAffiliation',
        'deleteConfirmAffiliation'
    ];

    public function updatingSearch()
    {
        $this->emit('refreshTable');
    }

    public function createAffiliation()
    {
        $this->emit('resetInputFields');
        $this->emit('openAffiliationModal');
    }

    public function editAffiliation($affiliationId)
    {
        $this->affiliationId = $affiliationId;
        $this->emit('affiliationId', $this->affiliationId);
        $this->emit('openAffiliationModal');
    }

    public function deleteAffiliation($affiliationId)
    {
        AffiliationLists::destroy($affiliationId);

        $action = 'error';
        $message = 'Successfully Deleted';

        $this->emit('flashAction', $action, $message);
        $this->emit('refreshTable');
    }

    public function render()
    {
        if (empty($this->search)) {
            $affiliations  = AffiliationLists::all();
        } else {
            $affiliations  = AffiliationLists::where('description', 'LIKE', '%' . $this->search . '%')->get();
        }

        return view('livewire.affiliation.affiliation-list', [
            'affiliations' => $affiliations,
        ]);
    }
}
