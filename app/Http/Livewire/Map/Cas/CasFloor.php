<?php

namespace App\Http\Livewire\Map\Cas;

use Livewire\Component;
use App\Models\FireList;
use App\Models\TypeList;
use App\Models\LocationList;
use Livewire\Livewire;

class CasFloor extends Component
{
    public $selectedFloor = 'ground-floor';

    public function mount()
    {
        Livewire::listen('floorSelected', function ($floorName) {
            $this->selectedFloor = $floorName; // Optional update
            // Implement logic to display the modal based on $floorName
            $this->createFire($floorName); // Call your modal logic method
        });
    }

    public function render()
    {
        return view('livewire.map.cas.cas-floor');
    }
}
