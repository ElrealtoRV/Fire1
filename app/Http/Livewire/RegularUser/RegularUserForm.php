<?php

namespace App\Http\Livewire\RegularUser;

use Livewire\Component;
use App\Models\RegularList;
use Spatie\Permission\Models\Role;
use App\Models\AffiliationLists;
use App\Models\OfficeLists;
use App\Models\DepartmentLists;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegularUserForm extends Component
{
    public $regularuserId, $first_name, $middle_name, $last_name, $age, $bdate, $contnum, $email, $idnum,$affiliation,$dept,$office, $password, $password_confirmation;
    public $action = '';  //flash
    public $message = '';  //flash
    public $roleCheck = array();
    public $selectedRoles = [];

    protected $listeners = [
        'regularuserId',
        'resetInputFields'
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function regularuserId($regularuserId)
    {
        $this->regularuserId = $regularuserId;
        $regularusers = RegularList::find($regularuserId);
        $this->first_name = $regularusers->first_name;
        $this->middle_name = $regularusers->middle_name;
        $this->last_name = $regularusers->last_name;
        $this->age = $regularusers->age;
        $this->bdate = $regularusers->bdate;
        $this->contnum = $regularusers->contnum;
        $this->email = $regularusers->email;
        $this->idnum = $regularusers->idnum;
        $this->affiliation = $regularusers->affiliation;
        $this->dept = $regularusers->dept; // Changed from position to position
        $this->office = $regularusers->office; // Changed from position to position
        $this->password = $regularusers->password; // Changed from position to position

        $this->selectedRoles = $regularusers->getRoleNames()->toArray();
    }

    public function store()
    {
          if (is_object($this->selectedRoles)) {
            $this->selectedRoles = json_decode(json_encode($this->selectedRoles), true);
        }

        if (empty($this->roleCheck)) {
            $this->roleCheck = array_map('strval', $this->selectedRoles);
        }

        if ($this->regularuserId) {

            $data = $this->validate([
                'first_name'    => 'required',
                'middle_name'   => 'nullable',
                'last_name'     => 'required',
                'age'     => 'required',
                'bdate'     => 'required',
                'contnum'     => 'required|digits:11',
                'email'         => ['required', 'email'],
                'idnum'     => 'required|digits:9',
                'affiliation' => 'required',
                'dept'      => 'nullable',
                'office'      => 'nullable',
                
            ]);
            
            
            $regularusers = RegularList::find($this->regularuserId);
            $regularusers->update($data);

            if (!empty($this->password)) {
                $this->validate([
                    'password' => ['required', 'confirmed', Rules\Password::defaults()],
                ]);
    
                $regularusers->update([
                    'password' => Hash::make($this->password),
                ]);
            }
            $regularusers = RegularList::find($this->regularuserId);
            $regularusers->update($data);


            $regularusers->syncRoles($this->roleCheck);

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
                'email'         => ['required', 'string', 'email', 'max:255', 'unique:' . RegularList::class],
                'idnum'     => 'required|digits:9',
                'affiliation'      => 'required',
                'dept'      => 'nullable',
                'office'      => 'nullable',
                'password'      => ['required', 'confirmed','min:6', Rules\Password::defaults()],
            ]);

            $regularusers = RegularList::create([
                'first_name'    => $this->first_name,
                'middle_name'   => $this->middle_name,
                'last_name'      => $this->last_name,
                'age'      => $this->age,
                'bdate'      => $this->age,
                'contnum'      => $this->contnum,
                'idnum'      => $this->idnum,
                'affiliation'      => $this->affiliation,
                'email'        => $this->email,
                'dept'        => $this->dept,
                'office' => $this->office,
                'password'    => Hash::make($this->password)
            ]);

            $regularusers->assignRole($this->roleCheck);


            $action = 'store';
            $message = 'Successfully Created';
        }

        $this->emit('flashAction', $action, $message);
        $this->resetInputFields();
        $this->emit('closeRegularUserModal');
        $this->emit('refreshParentRegularUser');
        $this->emit('refreshTable');
    }

    public function render()
    {
        $roles = Role::all();
        $affiliations = AffiliationLists::all();
        $offices = OfficeLists::all();
        $depts = DepartmentLists::all();
        $filteredRoles = Role::whereIn('name', ['Student', 'Staff'])->get();
        return view('livewire.regular-user.regular-user-form', [
            'roles' => $roles,
            'filteredRoles' => $filteredRoles,
            'affiliations' => $affiliations,
            'affiliations' => $affiliations,
            'offices' => $offices,
            'depts' => $depts,
        ]);
    }
}
