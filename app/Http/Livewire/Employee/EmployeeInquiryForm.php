<?php

namespace App\Http\Livewire\Employee;

use Livewire\Component;
use App\Models\EmployeeList;
use App\Models\EmployeeInquiry;
use Exception;
use Illuminate\Support\Facades\DB;


class EmployeeInquiryForm extends Component 
    {
    public $userId, $company_id;
    public $action = '';  //flash
    public $message = '';  //flash

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

    //edit
    public function userId($userId)
    {
        $this->userId = $userId;
        $user = EmployeeInquiry::where('user_id', $this->userId)->first();
        if ($user) {
            $this->company_id = $user->company_id;
        }
    }

    //store
    public function store()
    {
        try {
            DB::beginTransaction();

            $data = $this->validate([
                'company_id' => 'required'
            ]);
            $data['user_id'] = $this->userId;

            $user = EmployeeInquiry::where('user_id', $this->userId)->first();


            if ($user) {
                $user->update($data);

                $action = 'edit';
                $message = 'Successfully Updated';
            } else {

                $user = EmployeeInquiry::create($data);

                $action = 'store';
                $message = 'Successfully Created';
            }

            DB::commit();

            $this->emit('flashAction', $action, $message);
            $this->resetInputFields();
            $this->emit('closeUserInquiryModal');
            $this->emit('refreshParentUser');
            $this->emit('refreshTable');
        } catch (Exception $e) {
            DB::rollBack();
            $errorMessage = $e->getMessage();
            $this->emit('flashAction', 'error', $errorMessage);
        }
    }
    public function render()
    {
        return view('livewire.employee.employee-inquiry-form');
    }
}
