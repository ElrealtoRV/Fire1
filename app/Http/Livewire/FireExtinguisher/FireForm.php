<?php

namespace App\Http\Livewire\FireExtinguisher;

use Livewire\Component;
use App\Models\FireList;
use App\Models\TypeList;
use App\Models\LocationList;
use App\Models\FindingList;

class FireForm extends Component
{
    public $fireId, $type, $firename, $serial_number, $location, $installation_date, $expiration_date, $inspection_findings, $status,$position_id,$dept, $password;
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
        $this->location = $fire->location;
        $this->installation_date = $fire->installation_date;
        $this->expiration_date = $fire->expiration_date;
        $this->inspection_findings = $fire->inspection_findings;
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
                'serial_number'     => 'required',
                'location'     => 'required',
                'installation_date'     => 'required',
                'expiration_date'     => 'required',
                'inspection_findings'         => 'required',
                'status'     => 'required|digits:9',
                
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
                'serial_number'     => 'required',
                'location'     => 'required',
                'installation_date'     => 'required',
                'expiration_date'         => 'required',
                'inspection_findings'     => 'required',
                'status'      => 'required',
            ]);

            $fire = FireList::create([
                'type'    => $this->type,
                'firename'   => $this->firename,
                'serial_number'      => $this->serial_number,
                'location'      => $this->location,
                'installation_date'      => $this->installation_date,
                'expiration_date'      => $this->expiration_date,
                'inspection_findings'      => $this->inspection_findings,
                'status'      => $this->status,
            ]);

       


            $action = 'store';
            $message = 'Successfully Created';
        }

        $this->emit('flashAction', $action, $message);
        $this->resetInputFields();
        $this->emit('closeFireModal');
        $this->emit('refreshParentFire');
        $this->emit('refreshTable');
    }

    public function render()
    {
        $fire =FireList::all();
        $types =TypeList::all();
        $locations =LocationList::all();
        $inspections =FindingList::all();

        return view('livewire.fire-extinguisher.fire-form', [
            'fire' => $fire,
            'types' => $types,
            'locations' => $locations,
            'inspections' => $inspections,

        ]);
    }
}
