<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use App\Models\Employee;
use App\Models\Position;

class UserInfoForm extends Component
{
    public $user_id, $userId, $last_name, $first_name, $middle_name, $position_id, $dept, $idnum, $age, $bdate, $contnum, $email, $password;
    public $action = '';  //flash
    public $message = '';  //flash
    public $showButton = true;
    protected $listeners = [
        'userId',
        'resetInputFields',

    ];
    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }
    public function userId($userId)
    {
        $this->userId = $userId;
        $user = User::whereId($userId)->first();
        $this->first_name = $user->first_name;
        $this->middle_name = $user->middle_name;
        $this->last_name = $user->last_name;
        $this->email = $user->email;
        $this->password = $user->password;
        $this->position_id = $user->position_id;
        // $this->dept = $user->dept;
        // $this->idnum = $user->idnum;
        // $this->age = $user->age;
        // $this->bdate = $user->bdate;
        // $this->contnum = $user->contnum;
        // $this->username = strtolower($this->first_name . $this->last_name);
        // $this->username = str_replace(' ', '', $this->username);
        //$this->position = $user->position;
        // $this->email = strtolower($this->first_name . $this->last_name . "@gmail.com");
        // $this->email = str_replace(' ', '', $this->email);
        // $this->password = Str::random(8); // Generate a random passcode of length 8
    }
        //store
        public function store()
        {
            $data = $this->validate([
                'idnum' => 'required',
                'last_name' => 'required',
                'first_name' =>  'required',
                'middle_name' =>  'required',
                'age' =>  'required',
                'bdate' =>  'required',
                'contnum' =>  'required',
                'dept' =>  'required',
                'user_id' =>  'nullable',
                'position_id' => 'required',
                'email' => 'nullable',
                'password' => 'nullable',
          
            ]);



            $user = User::find($this->userId);
    
           // Concatenate and convert to lowercase
            $employeeInfo = Employee::create([
                //'id' => $this->user_id,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'middle_name' => $this->middle_name,
                'position_id' => $this->position_id,
                'dept' => $this->dept,
                'idnum' => $this->idnum,
                'age' => $this->age,
                'bdate' => $this->bdate,
                'contnum' => $this->contnum,
                'email' => $this->email,
                'password' => $this->password
            ]);
    
            // Assign the "employeeInfo" role to the user
            //$user->assignRole('employeeInfo');
    
    
    
            // Update the user_id field in the employeeInfo model
            $employeeInfo->user_id = $user->id; // Set the user_id to the ID of the newly created user
          
            $employeeInfo->save(); // Save the changes to the Requester record

          
    
            $action = 'store';
            $message = 'Employee Successfully Created';
            $this->emit('flashAction', $action, $message);
            $this->resetInputFields();
            $this->emit('closeUserInfoModal');
            $this->emit('refreshParentUserInfo');
            $this->emit('refreshTable');
            //$this->reset();
        }
    public function render()
    {
        $userId = $this->userId;
        $positions = Position::all();
        return view('livewire.user.user-info-form', [
            'userId' => $userId,
            'positions' => $positions,
        ]);
    }
}
