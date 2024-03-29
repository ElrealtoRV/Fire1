<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use App\Models\Position;
use App\Models\OfficeLists;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;

class UserForm extends Component
{
    public $userId, $first_name, $middle_name, $last_name, $age, $bdate, $contnum, $email, $idnum, $position_id, $office, $password, $password_confirmation;
    public $action = '';  //flash
    public $message = '';  //flash
    public $roleCheck = array();
    public $selectedRoles = [];

    protected $listeners = [
        'userId',
        'resetInputFields'
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
        $user = User::find($userId);
        $this->first_name = $user->first_name;
        $this->middle_name = $user->middle_name;
        $this->last_name = $user->last_name;
        $this->age = $user->age;
        $this->bdate = $user->bdate;
        $this->contnum = $user->contnum;
        $this->email = $user->email;
        $this->idnum = $user->idnum;
        $this->position_id = $user->position_id; // Changed from 'position' to 'position_id'
        $this->office = $user->office;
        $this->password = $user->password;
        $this->selectedRoles = $user->getRoleNames()->toArray();
    }

    public function store()
    {
        if (is_object($this->selectedRoles)) {
            $this->selectedRoles = json_decode(json_encode($this->selectedRoles), true);
        }
    
        if (empty($this->roleCheck)) {
            $this->roleCheck = array_map('strval', $this->selectedRoles);
        }
    
        if ($this->userId) {
            $data = $this->validate([
                'first_name' => 'required',
                'middle_name' => 'nullable',
                'last_name' => 'required',
                'age' => 'required',
                'bdate' => 'required',
                'contnum' => ['required', 'max:11', 'unique:users,contnum'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
                'idnum' => ['required', 'max:9', 'unique:users,idnum'],
                'position_id' => 'required', // Changed from 'position' to 'position_id'
                'office' => 'required',
            ]);
    
            $user = User::find($this->userId);
            $user->update($data);
    
            if (!empty($this->password)) {
                $this->validate([
                    'password' => ['required', 'confirmed', Rules\Password::defaults()],
                ]);
    
                $user->update([
                    'password' => Hash::make($this->password),
                ]);
            }
    
            $user->position_id = $this->position_id; // Assign the new position_id value
            $user->save();
            $user->syncRoles($this->roleCheck);
    
            $action = 'edit';
            $message = 'Successfully Updated';
        } else {
            $this->validate([
                'first_name' => 'required',
                'middle_name' => 'nullable',
                'last_name' => 'required',
                'age' => 'required',
                'bdate' => 'required',
                'contnum' => ['required', 'max:11', 'unique:users,contnum'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
                'idnum' => ['required', 'max:9', 'unique:users,idnum'],
                'position_id' => 'required', // Changed from 'position' to 'position_id'
                'office' => 'required',
                'password' => ['required', 'confirmed', 'min:6', Rules\Password::defaults()],
            ]);
    
            $user = User::create([
                'first_name' => $this->first_name,
                'middle_name' => $this->middle_name,
                'last_name' => $this->last_name,
                'age' => $this->age,
                'bdate' => $this->bdate,
                'contnum' => $this->contnum,
                'idnum' => $this->idnum,
                'position_id' => $this->position_id, // Changed from 'position' to 'position_id'
                'email' => $this->email,
                'office' => $this->office,
                'password' => Hash::make($this->password)
            ]);
    
            $user->assignRole($this->roleCheck);
    
            $action = 'store';
            $message = 'Successfully Created';
        }
    
        $this->emit('flashAction', $action, $message);
        $this->resetInputFields();
        $this->emit('closeUserModal');
        $this->emit('refreshParentUser');
        $this->emit('refreshTable');
    }
    public function render()
    {
        $roles = Role::all();
        $positions = Position::all();
        $offices = OfficeLists::all();
        $filteredPos = Position::where('description', '!=', 'Admin')->get();
        $filteredRoles = Role::whereIn('name', ['Head', 'Maintenance Personnel'])->get();
        return view('livewire.user.user-form', [
            'roles' => $roles,
            'filteredRoles' =>  $filteredRoles,
            'filteredPos' =>   $filteredPos,
            'positions' => $positions,
            'offices' => $offices,
        ]);
    }
}