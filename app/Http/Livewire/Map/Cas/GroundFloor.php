<?php

namespace App\Http\Livewire\Map\Cas;

use Livewire\Component;
use App\Models\FireList;
use App\Models\TypeList;
use App\Models\LocationList;

class GroundFloor extends Component
{
    public $fireId;
    public $search = '';
    public $action = '';  //flash
    public $message = '';  //flash
    public $selectedFloor = 'ground-floor';

    protected $listeners = [
        'refreshGroundFLoor' => '$refresh',
        'deleteFire',
        'editFire',
        'deleteConfirmFire'
        
    ];
    public function showFloor($floor)
    {
        $this->selectedFloor = $floor;
    }
    public function updatingSearch()
    {
        $this->emit('refreshTable');
    }
    public function createFire()
    {
        
        $this->emit('resetInputFields'); // Emitting an event to reset input fields, assuming this is part of a Livewire component or similar framework
        $this->emit('openFireModal'); // Emitting an event to open a modal, assuming this is part of a Livewire component or similar framework
         
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
    
    public function getStatusIndicator($status)
    {
        if ($status === 'Active') {
            return 'green';
        } elseif ($status === 'Inactive') {
            return 'orange';
        } elseif ($status === 'Refill') {
            return 'gray';
        } else {
            return 'gray'; // Default to gray if status is not recognized
        }
    }

    public function render()
    {
        $fire =FireList::all();
        $types =TypeList::all();
        $locations =LocationList::all();

        return view('livewire.map.cas.ground-floor', [
            'fire' => $fire,
            'types' => $types,
            'locations' => $locations,

        ]);
    }
}
