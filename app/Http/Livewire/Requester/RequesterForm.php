<?php

namespace App\Http\Livewire\Requester;

// use App\Models\Sex;
// use App\Models\Course;
// use App\Models\College;
use Livewire\Component;
use App\Models\Requester;
// use App\Models\Position;

class RequesterForm extends Component
{
    public $requesterId, $id_number, $first_name, $middle_name, $last_name, $contact_number/*, $sex_id, $position_id, $college_id, $course_id, $status_id, $positionId*/;
    public $action = '';  //flash
    public $message = '';  //flash

    protected $listeners = [
        'requesterId',
        'resetInputFields'
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    //edit
    public function requesterId($requesterId)
    {
        $this->requesterId = $requesterId;
        $requester = Requester::whereId($requesterId)->first();
        $this->id_number = $requester->id_number;
        $this->first_name = $requester->first_name;
        $this->middle_name = $requester->middle_name;
        $this->last_name = $requester->last_name;
        $this->contact_number = $requester->contact_number;
        // $this->sex_id = $requester->sex_id;
        // $this->position_id = $requester->position_id;
        // $this->college_id = $requester->college_id;
        // $this->course_id = $requester->course_id;
        // $this->status_id = $requester->status_id;
    }

    //store
    public function store()
    {
        
        $rules = [
            'id_number' => 'required|unique:requesters,id_number,' . $this->requesterId,
            'first_name' => 'required',
            'middle_name' => 'nullable',
            'last_name' => 'required',
            'contact_number' => 'required',
            // 'sex_id' => 'nullable',
            // 'position_id' => 'required',
            // 'college_id' => 'nullable',
            // 'course_id' => 'nullable',
            // 'status_id' => 'nullable',
        ];

        // if($this->position_id == 1){
        //     $rules['course_id'] = 'required'; 

        // }

        $data = $this->validate($rules);

        if ($this->requesterId) {
            Requester::whereId($this->requesterId)->first()->update($data);
            $action = 'edit';
            $message = 'Successfully Updated';
        } else {
            Requester::create($data);
            $action = 'store';
            $message = 'Successfully Created';
        }

        $this->emit('flashAction', $action, $message);
        $this->resetInputFields();
        $this->emit('closeRequesterModal');
        $this->emit('refreshParentRequester');
        $this->emit('refreshTable');
    }

    public function render()
    {
        // $sexes = Sex::all();
        // $positions = Position::all();
        // $colleges = College::all();
        // $courses = Course::where('college_id', $this->college_id)->get();
        return view('livewire.requester.requester-form'/*, [
            'sexes' => $sexes,
            'colleges' => $colleges,
            'courses' => $courses,
            'positions' => $positions
        ]*/);
    }
}
