<?php

namespace App\Http\Livewire\Task;

use Livewire\Component;
use App\Models\Task;
use App\Models\User;

class TaskForm extends Component
{
    public $task;
    public $taskName;
    public $dueDate;
    public $selectedUserId;

    public function mount(Task $task)
    {
        $this->task = $task;
        $this->taskName = $task->name ?? '';
        $this->dueDate = $task->due_date ?? '';
        $this->selectedUserId = $task->user_id ?? null;
    }

    public function saveTask()
    {
        $this->validate([
            'taskName' => 'required',
            'dueDate' => 'required|date',
            'user_id' => 'required',
           
        ]);

        if ($this->task->id) {
            $this->task->update([
                'name' => $this->taskName,
                'due_date' => $this->dueDate,
                'user_id' => $this->selectedUserId,
                
            ]);
        } else {
            Task::create([
                'name' => $this->taskName,
                'due_date' => $this->dueDate,
                'user_id' => $this->selectedUserId,
                'done' => false,
            ]);
        }

        $this->emit('taskSaved');
        $this->resetFields();
    }

    private function resetFields()
    {
        $this->taskName = '';
        $this->dueDate = '';
        $this->selectedUserId = '';
       
    }

    public function render()
    {
        $employees = User::select('id', 'first_name', 'last_name')->get();
        return view('livewire.your-view-name', compact('employees'));
    }
   
}
