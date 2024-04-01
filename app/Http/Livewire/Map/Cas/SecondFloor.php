<?php

namespace App\Http\Livewire\Map\Cas;

use Livewire\Component;

class SecondFloor extends Component
{
    public $selectedFloor = 'second-floor';
    public function showFloor($floor)
    {
        $this->selectedFloor = $floor;
    }
    public function render()
    {
        return view('livewire.map.cas.second-floor');
    }
}
