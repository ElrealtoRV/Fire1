<?php

namespace App\Http\Livewire\TodoList;

use Livewire\Component;
use App\Models\Task;
use Livewire\WithPagination;

class TodoList extends Component
{
    use WithPagination;
    
    public $newTask;
    public $tasks;
    public $slot;
    public $showAddTaskModal = false;
    public $showViewTaskModal = false;
    public $selectedTask;
    public function mount()
    {
        $this->tasks = Task::all(); 
    }



    public function addTask()
    {
        $this->validate(['newTask' => 'required']);
        Task::create(['name' => $this->newTask]);

        $this->tasks = Task::all();
        $this->showAddTaskModal = false; // Hide the modal after adding a task
        $this->newTask = '';
        $this->emit('taskAdded');
    }
    public function deleteTask($taskId)
    {
        // Delete the task from the database
        Task::destroy($taskId);
        
        $this->tasks = Task::all(); // Reload tasks from the database
    }

    public function openViewTaskModal($taskId)
    {
        $this->selectedTask = Task::find($taskId);
        $this->showViewTaskModal = true;
        $this->emit('viewTask', $taskId); // Emit an event to trigger the view modal
    }
    public function render()
    {
        return view('livewire.todo.todo-list');
    }
}
