<?php

namespace App\Http\Livewire\Requester;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\Models\Requester;
use App\Models\User;
use Livewire\Component;

class RequesterAccountForm extends Component
{
    public $user_id, $requesterId, $last_name, $first_name, $middle_name, $email, $password/*, $position_id, $position*/;
    public $action = '';  //flash
    public $message = '';  //flash
    public $showButton = true;
    protected $listeners = [
        'requesterId',
        'resetInputFields',

    ];
    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }
    public function requesterId($requesterId)
    {
        $this->requesterId = $requesterId;
        $requester = Requester::whereId($requesterId)->first();
        $this->first_name = $requester->first_name;
        $this->middle_name = $requester->middle_name;
        $this->last_name = $requester->last_name;
        // $this->username = strtolower($this->first_name . $this->last_name);
        // $this->username = str_replace(' ', '', $this->username);
        //$this->position = $requester->position;
        $this->email = strtolower($this->first_name . $this->last_name . "@gmail.com");
        $this->email = str_replace(' ', '', $this->email);
        $this->password = Str::random(8); // Generate a random passcode of length 8
    }
        //store
        public function store()
        {
            $data = $this->validate([
                'last_name' => 'required',
                'first_name' =>  'required',
                'middle_name' =>  'nullable',
                // 'username' =>  'required',
                //'position' => 'required',
                'email' => ['required', 'email', Rule::unique('users', 'email')],
                'password' => ['required', 'min:6']
            ]);

            $requester = Requester::find($this->requesterId);
    
           // Concatenate and convert to lowercase
            $user = User::create([
                'id' => $this->user_id,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'middle_name' => $this->middle_name,
                // 'username' => $this->username,
                //'position' => $this->position,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                //'position_id' => $requester->position_id,
            ]);
    
            // Assign the "requester" role to the user
            //$user->assignRole('requester');
    
    
    
            // Update the user_id field in the Requester model
            $requester->user_id = $user->id; // Set the user_id to the ID of the newly created user
            $requester->save(); // Save the changes to the Requester record

          
    
            $action = 'store';
            $message = 'Account Successfully Created';
            $this->emit('flashAction', $action, $message);
            $this->resetInputFields();
            $this->emit('closeRequesterAccountModal');
            $this->emit('refreshParentRequesterAccount');
            $this->emit('refreshTable');
            //$this->reset();
        }
    public function render()
    {
        $requesterId = $this->requesterId;
        return view('livewire.requester.requester-account-form', [
            'requesterId' => $requesterId,
        ]);
    }
}
