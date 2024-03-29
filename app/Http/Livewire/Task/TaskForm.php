<?php

namespace App\Http\Livewire\Task;

use Livewire\Component;
use App\Models\Task;

class TaskForm extends Component
{
    public $task;
    public $taskName;
    public $dueDate;
    public $firstName;
    public $lastName;

    public function mount(Task $task)
    {
        $this->task = $task;
        $this->taskName = $task->name ?? '';
        $this->dueDate = $task->due_date ?? '';
        $this->firstName = $task->first_name ?? '';
        $this->lastName = $task->last_name ?? '';
    }

    public function saveTask()
    {
        $this->validate([
            'taskName' => 'required',
            'dueDate' => 'required|date',
            'firstName' => 'required',
            'lastName' => 'required',
        ]);

        if ($this->task->id) {
            $this->task->update([
                'name' => $this->taskName,
                'due_date' => $this->dueDate,
                'first_name' => $this->firstName,
                'last_name' => $this->lastName,
            ]);
        } else {
            Task::create([
                'name' => $this->taskName,
                'due_date' => $this->dueDate,
                'first_name' => $this->firstName,
                'last_name' => $this->lastName,
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
        $this->firstName = '';
        $this->lastName = '';
    }

    public function render()
    {
        return view('livewire.task.task-form');
    }
}
