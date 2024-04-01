<!-- resources/views/livewire/task-manager.blade.php -->
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Task Manager</h1>
        <button type="button" class="btn btn-primary" data-toggle="modal" id="AddTask" data-target="#addTaskModal">
            <i class="fas fa-plus"></i> Add Task
            
        </button>
    </div>

    <!-- Include the modal -->
    @include('livewire.task.task-form')

    <!-- Display tasks -->
    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width: 30%; text-align: center; color:black;">Task</th>
                        <th style="width: 30%; text-align: center; color:black;">Due Date</th>
                        <th style="width: 30%; text-align: center; color:black;">Employee</th>
                        <th style="width: 30%; text-align: center; color:black;">Status</th>
                        <th style="width: 30%; text-align: center; color:black;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tasks as $task)
                    <tr>
                        <td>{{ $task->name }}</td>
                        <td>{{ $task->due_date->format('M d, Y') }}</td>
                        <p>Assigned To: {{ $task->user->first_name }} {{ $task->user->last_name }}</p>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" wire:click="toggleTaskStatus({{ $task->id }})" {{ $task->done ? 'checked' : '' }}>
                            </div>
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm" wire:click="editTask({{ $task->id }})"><i class="fas fa-edit"></i></button>
                            <button type="button" class="btn btn-danger btn-sm" wire:click="deleteTask({{ $task->id }})"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">No tasks found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>