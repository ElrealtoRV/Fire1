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
    $query = FireList::query();

    // Eager load relationships
    $query->with('fireex', 'fireLocation');

    // Apply search filter
    if (!empty($this->search)) {
        $query->where(function ($subQuery) {
            $subQuery->where('type', 'LIKE', '%' . $this->search . '%')
                ->orWhere('firename', 'LIKE', '%' . $this->search . '%')
                ->orWhere('serialNum', 'LIKE', '%' . $this->search . '%')
                ->orWhereHas('type', function ($typeQuery) {
                    $typeQuery->where('description', 'LIKE', '%' . $this->search . '%');
                });
        });
    }

    // Fetch results
    $fire = $query->get();

    // Fetch types if needed
    $types = TypeList::all();
    $locations = LocationList::all();

    return view('livewire.fire-extinguisher.fire-extinguisher', [
        'fire' => $fire,
        'types' => $types,
        'locations' => $locations,
    ]);
}

}