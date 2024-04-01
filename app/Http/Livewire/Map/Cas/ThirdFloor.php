<?php

namespace App\Http\Livewire\Map\Cas;

use Livewire\Component;

class ThirdFloor extends Component
{
    public $selectedFloor = 'third-floor';


    public function showFloor($floor)
{
    $this->selectedFloor = $floor;
}
    public function render()
    {
        return view('livewire.map.cas.third-floor');
    }
}
