<?php

namespace App\Http\Livewire\Map\Cas;

use Livewire\Component;
use App\Models\FireList;
use App\Models\TypeList;
use App\Models\LocationList;

class GroundFloor extends Component
{
    public $fireId;
    public $viewMode = false;
    public $search = '';
    public $action = '';  //flash
    public $message = '';  //flash
    public $selectedFloor = 'ground-floor';

    protected $listeners = [
        'refreshGroundFLoor' => '$refresh',
        'deleteFire',
        'editFire',
        'openViewModal'
        
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
        $this->emit('resetInputFields');
        $this->emit('openMapFormModal');
    }
    public function editFire($fireId)
    {
        $this->fireId = $fireId;
        $this->emit('fireId', $this->fireId);
        $this->emit('openMapFormModal');
        
    }
    public function viewFire($fireId)
    {
        $this->fireId = $fireId;
        $this->viewMode = true; // Set view mode to true
        $this->emit('openMapFormModal', $this->fireId);
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


        return view('livewire.map.cas.ground-floor', [
            'fire' => $fire,

        ]);
    }
}
