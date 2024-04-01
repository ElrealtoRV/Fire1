<?php

namespace App\Http\Livewire\FireExtinguisher;

use Livewire\Component;
use App\Models\FireList;
use App\Models\TypeList;
use App\Models\LocationList;

class FireExtinguisher extends Component
{
    public $fireId;
    public $search = '';
    public $action = '';  //flash
    public $message = '';  //flash

    protected $listeners = [
        'refreshFireExtinguisher' => '$refresh',
        'deleteFire',
        'editFire',
        'viewFire',
        'deleteConfirmFire'
        
    ];
    public function updatingSearch()
    {
        $this->emit('refreshTable');
    }
    public function createFire()
    {
        $this->emit('resetInputFields');
        $this->emit('openFireModal');
    }

    public function editFire($fireId)
    {
        $this->fireId = $fireId;
        $this->emit('fireId', $this->fireId);
        $this->emit('openFireModal');
        
    }
    public function viewFire($fireId)
    {
        $this->fireId = $fireId;
        $this->emit('openFireModal', $this->fireId);
    }
    public function deleteFire($fireId)
    {
        FireList::destroy($fireId);

        $action = 'error';
        $message = 'Successfully Deleted';

        $this->emit('flashAction', $action, $message);
        $this->emit('refreshTable');
    }

    public function render()
    {
        $fire = FireList::with('fireex')->get();
        $types = TypeList::query();
        $locations = FireList::with('FireLocation')->get();
        

        

        if (!empty($this->search)) {
            $fire->where(function ($query) {
                $query->where('type', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('firename', 'LIKE', '%' . $this->search . '%') 
                    ->orWhere('serialNum', 'LIKE', '%' . $this->search . '%')
                    ->orWhereHas('status', function ($positionQuery) {
                        $positionQuery->where('description', 'LIKE', '%' . $this->search . '%');
                    });
                });
            }
            return view('livewire.fire-extinguisher.fire-extinguisher', [
                'fire' => $fire,
                'types' => $types,
                'locations' => $locations,
            ]); 
    }
}