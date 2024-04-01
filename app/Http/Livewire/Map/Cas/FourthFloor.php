<?php

namespace App\Http\Livewire\Map\Cas;

use Livewire\Component;

class FourthFloor extends Component
{
    public $selectedFloor = 'fourth-floor';

    public function showFloor($floor)
{
    $this->selectedFloor = $floor;
}
    public function render()
    {
        return view('livewire.map.cas.fourth-floor');
    }
}
