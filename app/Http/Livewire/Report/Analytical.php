<?php

namespace App\Http\Livewire\Report;

use Livewire\Component;
use App\Models\FireList;
use App\Models\User;
use App\Models\RegularList;
use App\Models\ExpiredList;

class Analytical extends Component
{
    public $fires;
    public $userCounts;
    public $regularusers;

    public function mount()
    {
        $this->fires = FireList::count();
        $this->userCounts = User::count();
        $this->regularusers = RegularList::count();
    }

    public function render()
    {
        return view('livewire.report.analytical', [
            'fires' => $this->fires,
            'userCounts' => $this->userCounts,
            'regularusers' => $this->regularusers,
        ]);
    }
}
