<?php

namespace App\Http\Livewire\Record;

use App\Models\FindingList;
use Livewire\Component;
use App\Models\FireList;
use App\Models\TypeList;
use App\Models\LocationList;
use App\Models\RecordLists;
use App\Models\RegularLists;

class RecordForm extends Component
{
    public $recordId, $type, $firename, $serial_number, $location, $maintenance_date, $expiration_date, $finding, $status;
    public $action = '';  //flash
    public $message = '';  //flashSSS
    public $recordCheck = array();
    public $selectedrecord = [];

    protected $listeners = [
        'recordId',
        'resetInputFields'
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function recordId($recordId)
    {
        $this->recordId = $recordId;
        $record = RecordLists::find($recordId);
        $this->type = $record->type;
        $this->firename = $record->firename;
        $this->serial_number = $record->serial_number;
        $this->location = $record->location;
        $this->maintenance_date = $record->maintenance_date;
        $this->expiration_date = $record->expiration_date;
        $this->finding = $record->finding;
        $this->status = $record->status;

        $this->selectedrecord = $record->getrecordeNames()->toArray();
    }

    public function store()
    {
          if (is_object($this->selectedrecord)) {
            $this->selectedrecord = json_decode(json_encode($this->selectedrecord), true);
        }

        if (empty($this->recordCheck)) {
            $this->recordCheck = array_map('strval', $this->selectedrecord);
        }

        if ($this->recordId) {

            $data = $this->validate([
                'type'    => 'required',
                'firename'   => 'required',
                'serial_number'     => ['required','min:4', 'max:10'],
                'location'     => 'required',
                'installation_date'     => 'required',
                'expiration_date'     => 'required',
                'finding'         => 'nullable',
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
                'serial_number'     => ['required','min:4', 'max:10'],
                'location'     => 'required',
                'maintenance_date'     => 'required',
                'expiration_date'         => 'required',
                'finding'     => 'nullable',
                'status'      => 'nullable',
            ]);

            $fire = FireList::create([
                'type'    => $this->type,
                'firename'   => $this->firename,
                'serial_number'      => $this->serial_number,
                'location'      => $this->location,
                'maintenance_date'      => $this->maintenace_date,
                'expiration_date'      => $this->expiration_date,
                'finding'      => $this->finding,
                'status'      => $this->status,
            ]);
            
       


            $action = 'store';
            $message = 'Successfully Created';
        }
        
        $this->emit('flashAction', $action, $message);
        $this->resetInputFields();
        $this->emit('closeRecordModal');
        $this->emit('refreshParentRecord');
        $this->emit('refreshTable');

    }

    public function render()
    {
        $fire =FireList::all();
        $types =TypeList::all();
        $locations =LocationList::all();
        $findings =FindingList::all();

        return view('livewire.record.record-form', [
            'fire' => $fire,
            'types' => $types,
            'locations' => $locations,
            'findings' => $findings,

        ]);
    }
}
