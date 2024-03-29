<!-- resources/views/livewire/add-task-modal.blade.php -->
<div class="modal fade" id="addTaskModal" tabindex="-1" role="dialog" aria-labelledby="addTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTaskModalLabel">{{ $editingTaskId ? 'Edit Task' : 'Add Task' }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form to add/edit task -->
                <form wire:submit.prevent="{{ $editingTaskId ? 'updateTask' : 'addTask' }}">
                    <div class="form-group">
                        <label for="taskName">Task Name</label>
                        <input type="text" class="form-control" id="taskName" wire:model="taskName">
                        @error('taskName') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="dueDate">Due Date</label>
                        <input type="date" class="form-control" id="dueDate" wire:model="dueDate">
                        @error('dueDate') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <input type="text" class="form-control" id="firstName" wire:model="first_name">
                        @error('first_name') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name</label>
                        <input type="text" class="form-control" id="lastName" wire:model="last_name">
                        @error('last_name') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" wire:click="{{ $editingTaskId ? 'updateTask' : 'addTask' }}">{{ $editingTaskId ? 'Update Task' : 'Save Task' }}</button>
            </div>
        </div>
    </div>
</div>
