<?php

namespace App\Http\Livewire\Location;

use Livewire\Component;
use App\Models\LocationList;

class LocationForm extends Component
{

    public $locationId, $building,$floor,$room;
    public $action = '';  //flash
    public $message = '';  //flash

    protected $listeners = [
        'locationId',
        'resetInputFields'
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    //edit
    public function locationId($locationId)
    {
        $this->locationId = $locationId;
        $location = LocationList::whereId($locationId)->first();
        $this->building = $location->building;
        $this->floor = $location->floor;
        $this->room = $location->room;
    }

    //store
    public function store()
    {
        $data = $this->validate([
            'building' => 'nullable|unique:location_Lists,building', // Table: buildings, Column: name
            'floor' => 'nullable|unique:location_Lists,floor', // Table: floors, Column: number
            'room' => 'nullable|unique:location_Lists,room', // Table: rooms, Column: designation
        ]);
    

        if ($this->locationId) {
            LocationList::whereId($this->locationId)->first()->update($data);
            $action = 'edit';
            $message = 'Successfully Updated';
        } else {
            LocationList::create($data);
            $action = 'store';
            $message = 'Successfully Created';
        }

        $this->emit('flashAction', $action, $message);
        $this->resetInputFields();
        $this->emit('closeLocationModal');
        $this->emit('refreshParentLocation');
        $this->emit('refreshTable');
    }
    public function render()
    {
        
        return view('livewire.location.location-form');
    }
}
