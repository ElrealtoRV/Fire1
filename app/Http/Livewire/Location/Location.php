<?php

namespace App\Http\Livewire\Location;

use Livewire\Component;
use App\Models\LocationList;

class Location extends Component
{

    public $locationId;
    public $search = '';
    public $action = ''; 
    public $message = ''; 

    protected $listeners = [
        'refreshParentLocation' => '$refresh',
        'deleteLocation',
        'editLocation',
        'deleteConfirmLocation'
    ];

    public function updatingSearch()
    {
        $this->emit('refreshTable');
    }

    public function createLocation()
    {
        $this->emit('resetInputFields');
        $this->emit('openLocationModal');
    }

    public function editLocation($locationId)
    {
        $this->locationId = $locationId;
        $this->emit('locationId', $this->locationId);
        $this->emit('openLocationModal');
    }

    public function deleteLocation($locationId)
    {
        LocationList::destroy($locationId);

        $action = 'error';
        $message = 'Successfully Deleted';

        $this->emit('flashAction', $action, $message);
        $this->emit('refreshTable');
    }

    public function render()
    {
        
        if (empty($this->search)) {
            $locations  = LocationList::all();
        } else {
            $locations  = LocationList::where('description', 'LIKE', '%' . $this->search . '%')->get();
        }

        return view('livewire.location.location', [
            'locations' => $locations
        ]);
    }

}
