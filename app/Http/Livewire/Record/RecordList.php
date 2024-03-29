<?php

namespace App\Http\Livewire\Record;

use Livewire\Component;
use App\Models\RecordLists;

class RecordList extends Component
{
    public $recordId;
    public $search = '';
    public $action = '';  //flash
    public $message = '';  //flash

    protected $listeners = [
        'refreshRecord' => '$refresh',
        'deleteRecord',
        'editRecord',
        'deleteConfirmRecord'
        
    ];
    public function updatingSearch()
    {
        $this->emit('refreshTable');
    }
    public function createRecord()
    {
        $this->emit('resetInputFields');
        $this->emit('openRecordModal');
    }
    public function editRecord($recordId)
    {
        $this->recordId = $recordId;
        $this->emit('recordId', $this->recordId);
        $this->emit('openRecordModal');
        
    }
    public function deleteRecord($recordId)
    {
        RecordLists::destroy($recordId);

        $action = 'error';
        $message = 'Successfully Deleted';

        $this->emit('flashAction', $action, $message);
        $this->emit('refreshTable');
    }

    public function render()
    {


        $records = RecordLists::all();
        

        

        if (!empty($this->search)) {
            $records->where(function ($query) {
                $query->where('type', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('firename', 'LIKE', '%' . $this->search . '%') 
                    ->orWhere('serialNum', 'LIKE', '%' . $this->search . '%')
                    ->orWhereHas('status', function ($positionQuery) {
                        $positionQuery->where('description', 'LIKE', '%' . $this->search . '%');
                    });
                });
            }
            return view('livewire.record.record-list', [
                'records' => $records,
            ]); 
    }
}
