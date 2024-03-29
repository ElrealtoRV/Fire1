<?php

namespace App\Http\Livewire\Employee;

use App\Models\EmployeeList;
use App\Models\Position;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class EmployeeForm extends Component
{
    public $userId, $first_name, $middle_name, $last_name, $age, $bdate, $contnum, $email, $idnum,$position_id,$dept, $password, $password_confirmation;
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
        $user = EmployeeList::find($userId);
        $this->first_name = $user->first_name;
        $this->middle_name = $user->middle_name;
        $this->last_name = $user->last_name;
        $this->age = $user->age;
        $this->bdate = $user->bdate;
        $this->contnum = $user->contnum;
        $this->email = $user->email;
        $this->idnum = $user->idnum;
        $this->position_id = $user->position_id;
        $this->dept = $user->dept; // Changed from position to position
        $this->password = $user->password; // Changed from position to position

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
                'first_name'    => 'required',
                'middle_name'   => 'nullable',
                'last_name'     => 'required',
                'age'     => 'required',
                'bdate'     => 'required',
                'contnum'     => 'required|digits:11',
                'email'         => ['required', 'email'],
                'idnum'     => 'required|digits:9',
                'position_id'      => 'required',
                'dept'      => 'required',
                
            ]);
            
            
            $user = EmployeeList::find($this->userId);
            $user->update($data);

            if (!empty($this->password)) {
                $this->validate([
                    'password' => ['required', 'confirmed', Rules\Password::defaults()],
                ]);
    
                $user->update([
                    'password' => Hash::make($this->password),
                ]);
            }
            $user = EmployeeList::find($this->userId);
            $user->update($data);


            $user->syncRoles($this->roleCheck);

            $action = 'edit';
            $message = 'Successfully Updated';
        } else {

            $this->validate([
                'first_name'    => 'required',
                'middle_name'   => 'nullable',
                'last_name'     => 'required',
                'age'     => 'required',
                'bdate'     => 'required',
                'contnum'     => 'required|digits:11',
                'email'         => ['required', 'string', 'email', 'max:255', 'unique:' . EmployeeList::class],
                'idnum'     => 'required|digits:9',
                'position_id'      => 'required',
                'dept'      => 'required',
                'password'      => ['required', 'confirmed','min:6', Rules\Password::defaults()],
            ]);

            $user = EmployeeList::create([
                'first_name'    => $this->first_name,
                'middle_name'   => $this->middle_name,
                'last_name'      => $this->last_name,
                'age'      => $this->age,
                'bdate'      => $this->age,
                'contnum'      => $this->contnum,
                'idnum'      => $this->idnum,
                'position_id'      => $this->position_id,
                'email'        => $this->email,
                'dept'        => $this->dept,
                'password'    => Hash::make($this->password)
            ]);

            $user->assignRole($this->roleCheck);


            $action = 'store';
            $message = 'Successfully Created';
        }

        $this->emit('flashAction', $action, $message);
        $this->resetInputFields();
        $this->emit('closeEmployeeModal');
        $this->emit('refreshParentUser');
        $this->emit('refreshTable');
    }

    public function render()
    {
        $roles = Role::all();
        $positions = Position::all();
        $filteredRoles = Role::whereIn('name', ['Head', 'Maintenance Personnel'])->get();
        return view('livewire.employee.employee-form', [
            'roles' => $roles,
            'filteredRoles' => $filteredRoles,
            'positions' => $positions,
        ]);
    }
}
