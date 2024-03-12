<?php

namespace App\Http\Livewire\Requester;

use App\Models\Requester;
use Livewire\Component;
use Livewire\WithPagination;

class RequesterList extends Component
{
    use withPagination;
    protected $paginationTheme = 'bootstrap';
    public $requesterId;
    public $search = '';
    public $action = '';  //flash
    public $message = '';  //flash
    public $perPage = 10;

    protected $listeners = [
        'refreshParentRequester' => '$refresh',
        'refreshParentRequesterAccount' => '$refresh',
        'deleteRequester',
        'editRequester',
        'deleteConfirmRequester'
    ];

    public function updatingSearch()
    {
        $this->emit('refreshTable');
    }

    public function createRequesterAccount($requesterId)
    {
        $this->requesterId = $requesterId;
        $this->emit('resetInputFields');
        $this->emit('requesterId', $this->requesterId);
        $this->emit('openRequesterAccountModal');
    }

    public function createRequester()
    {
        // $Requester = Requester::with([
        //     'sex',
        //     'college',
        //     'course',
        //     'status',
        // ])
        // ->first();
        
        // dd($Requester);
        $this->emit('resetInputFields');
        $this->emit('openRequesterModal');
    }

    public function editRequester($requesterId)
    {
        $this->requesterId = $requesterId;
        $this->emit('requesterId', $this->requesterId);
        $this->emit('openRequesterModal');
    }

    public function deleteRequester($requesterId)
    {
        Requester::destroy($requesterId);

        $action = 'error';
        $message = 'Successfully Deleted';

        $this->emit('flashAction', $action, $message);
        $this->emit('refreshTable');
    }

    public function render()
    {
        if (empty($this->search)) {
            $requesters  = Requester::paginate($this->perPage);
        } else {
            $requesters  = Requester::where('first_name', 'LIKE', '%' . $this->search . '%')->paginate($this->perPage);
        }

        // $Requester = Requester::with('sex')->get();

        return view('livewire.request.request-list', [
            'requesters' => $requesters,
            // "Requester" => $Requester
        ]);
    }
}
