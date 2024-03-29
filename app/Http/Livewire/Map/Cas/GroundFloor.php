<?php

namespace App\Http\Livewire\Map\Cas;

use Livewire\Component;
use App\Models\FireList;

class GroundFloor extends Component
{

    public $fireId;
    public $search = '';
    public $action = '';  //flash
    public $message = '';  //flash

    protected $listeners = [
        'refreshFireExtinguisher' => '$refresh',
        'deleteFire',
        'editFire',
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
        return view('livewire.map.cas.ground-floor');
    }
}
