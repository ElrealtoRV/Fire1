<?php

namespace App\Http\Livewire\Task;

use Livewire\Component;
use App\Models\Task;
use App\Models\User;
use Illuminate\Validation\Rule;

class TaskManager extends Component
{
    public $tasks;
    public $taskName;
    public $dueDate;
    public $first_name;
    public $last_name;
    public $editingTaskId;
    public $selectedUserId; 

    protected $rules = [
        'taskName' => 'required',
        'dueDate' => 'required|date',
        'first_name' => 'required',
        'last_name' => 'required',
    ];

    public function mount()
    {
        $this->tasks = Task::all();
    }
    public function createTask()
    {
        $this->emit('resetInputFields');
        $this->emit('openTaskModal');
    }
    public function addTask()
    {
        $this->validate($this->rules);

        Task::create([
            'name' => $this->taskName,
            'due_date' => $this->dueDate,
            'first_name' => $this->first_Name,
            'last_name' => $this->last_name,
            'done' => false,
        ]);

        $this->resetFields();
        $this->tasks = Task::all();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function editTask($taskId)
    {
        $task = Task::findOrFail($taskId);
        $this->taskName = $task->name;
        $this->dueDate = $task->due_date;
        $this->first_name = $task->first_name;
        $this->last_name = $task->last_name;
        $this->editingTaskId = $taskId;
    }

    public function updateTask()
    {
        $this->validate($this->rules);

        $task = Task::findOrFail($this->editingTaskId);
        $task->update([
            'name' => $this->taskName,
            'due_date' => $this->dueDate,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
        ]);

        $this->resetFields();
        $this->tasks = Task::all();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function deleteTask($taskId)
    {
        Task::findOrFail($taskId)->delete();
        $this->tasks = Task::all();
    }

    public function toggleTaskStatus($taskId)
    {
        $task = Task::findOrFail($taskId);
        $task->done = !$task->done;
        $task->save();
        $this->tasks = Task::all();
    }

    private function resetFields()
    {
        $this->taskName = '';
        $this->dueDate = '';
        $this->first_name = '';
        $this->last_name = '';
        $this->editingTaskId = null;
    }

    public function render()
    {   
        $users = User::all();
        $tasks = Task::with('user')->get();
        return view('livewire.task.task-manager', compact('tasks', 'users'));
    }
}
