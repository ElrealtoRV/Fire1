<?php

namespace App\Http\Livewire\FireExtinguisher;

use Livewire\Component;
use App\Models\FireList;
use App\Models\TypeList;
use App\Models\LocationList;

class FireForm extends Component
{
    public $fireId, $type, $firename, $serial_number, $building,$floor,$room, $installation_date, $expiration_date, $description, $status;
    public $action = '';  //flash
    public $message = '';  //flashSSS
    public $fireCheck = array();
    public $selectedFire = [];

    protected $listeners = [
        'fireId',
        'resetInputFields'
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function fireId($fireId)
    {
        $this->fireId = $fireId;
        $fire = FireList::find($fireId);
        $this->type = $fire->type;
        $this->firename = $fire->firename;
        $this->serial_number = $fire->serial_number;
        $this->building = $fire->building;
        $this->floor = $fire->floor;
        $this->room = $fire->room;
        $this->installation_date = $fire->installation_date;
        $this->expiration_date = $fire->expiration_date;
        $this->description = $fire->description;
        $this->status = $fire->status;

        $this->selectedFire = $fire->getFireNames()->toArray();
    }

    public function store()
    {
          if (is_object($this->selectedFire)) {
            $this->selectedFire = json_decode(json_encode($this->selectedFire), true);
        }

        if (empty($this->fireCheck)) {
            $this->fireCheck = array_map('strval', $this->selectedFire);
        }

        if ($this->fireId) {

            $data = $this->validate([
                'type'    => 'required',
                'firename'   => 'required',
                'serial_number'     => 'required|digits:7',
                'building'     => 'required',
                'floor'     => 'nullable',
                'room'     => 'required',
                'installation_date'     => 'required',
                'expiration_date'     => 'required',
                'description'         => 'nullable',
                'status'     => 'nullable',
                
            ]);
            

            $fire = FireList::find($this->fireId);
            $fire->update($data);


            $fire->syncFire($this->fireCheck);

            $action = 'edit';
            $message = 'Successfully Updated';
        } else {

            $this->validate([
                'type'    => 'required',
                'firename'   => 'required',
                'serial_number'     => 'required|digits:7',
                'building'     => 'required',
                'floor'     => 'nullable',
                'room'     => 'required',
                'installation_date'     => 'required',
                'expiration_date'         => 'required',
                'description'     => 'nullable',
                'status'      => 'nullable',
            ]);

            $fire = FireList::create([
                'type'    => $this->type,
                'firename'   => $this->firename,
                'serial_number'      => $this->serial_number,
                'building'      => $this->building,
                'floor'      => $this->floor,
                'room'      => $this->room,
                'installation_date'      => $this->installation_date,
                'expiration_date'      => $this->expiration_date,
                'description'      => $this->description,
                'status'      => $this->status,
            ]);
            
       


            $action = 'store';
            $message = 'Successfully Created';
        }
        
        $this->emit('flashAction', $action, $message);
        $this->resetInputFields();
        $this->emit('closeFireModal');
        $this->emit('refreshParentFire');
        $this->emit('refreshParentGroundFLoor');
        $this->emit('refreshTable');

    }
    public function openViewModal($fireId)
    {
        $fire = FireList::findOrFail($fireId);
        $this->fireId = $fireId;
        $this->type = $fire->type;
        $this->firename = $fire->firename;
        $this->serial_number = $fire->serial_number;
        $this->building = $fire->building;
        $this->floor = $fire->floor;
        $this->room = $fire->room;
        $this->installation_date = $fire->installation_date;
        $this->expiration_date = $fire->expiration_date;
        $this->description = $fire->description;
        $this->status = $fire->status;

        $this->emit('openViewModal');
    }

    public function render()
    {
        $fire =FireList::all();
        $types =TypeList::all();
        $locations =LocationList::all();

        return view('livewire.fire-extinguisher.fire-form', [
            'fire' => $fire,
            'types' => $types,
            'locations' => $locations,

        ]);
    }
}
