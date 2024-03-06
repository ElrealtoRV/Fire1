
@if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('Head'))


<x-app-layout>

    <div class="content">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ul>
                </div>
            </div>
        </div>

	</div>
	<div class="good-morning-blk">
		<div class="row">   
			<div class="col-md-6">
				<div class="morning-user">
				<h2>
					@php
						$currentTime = now()->hour;
					@endphp

					@if ($currentTime < 12)
						Good Morning,
					@elseif ($currentTime > 18)
						Good Afternoon,
					@else
						Good Evening,
					@endif

					<span class="text-capitalize">
						{{ auth()->user()->first_name }}
						{{ auth()->user()->last_name }}
					</span>
				</h2>
					<p>Have a nice day at work</p>
				</div>
			</div>
			<div class="col-md-6 position-blk">
				<div class="morning-img">
					<img src="assets/img/fire.png" alt>
				</div>
			</div>
		</div>
	</div>
        <div class="head-title">
				<div class="left">
        <ul class="box-info">
				<li>
					<i class="fas fa-fire-extinguisher"></i>
					<span class="text">
							@if($fires == 0)
								<h3>{{ $fires }}</h3>
								<p>Fire Extinguisher</p>
							@else
								<h3>{{ $fires }}</h3>
								<p>Fire Extinguisher{{ $fires != 1 ? 's' : '' }}</p>
							@endif
					</span>
				</li>
					<li>
					
						<i class='bx bxs-group'></i>
					<span class="text">
					@if($regularusers == 0)
						<h3>{{ $regularusers }}</h3>
						<p>User</p>
					@else
						<h3>{{ $regularusers }}</h3>
						<p>User{{ $regularusers != 1 ? 's' : '' }}</p>
					@endif
					</span>
				
					</li>
					<li>
				@php
					$employeeCount = \App\Models\EmployeeList::count();
				@endphp
				
				<i class='fas fa-briefcase'></i>
				<span class="text">
					@if($employeeCount == 0)
						<h3>{{ $employeeCount }}</h3>
						<p>Employee</p>
					@else
						<h3>{{ $employeeCount }}</h3>
						<p>Employee{{ $employeeCount != 1 ? 's' : '' }}</p>
					@endif
				</span>
			</li>
				<li>
					<i class='con fas fa-fire-extinguisher' ></i>
					<span class="text">
						<h3>2543</h3>
						<p>Expired Fire Extinguisher</p>
					</span>
				</li>
			</ul> 
    </div>
	</div>

	@if(auth()->user()->hasRole('admin'))

	<div class="table-data">
				<div class="order">
					<div class="user-list">
						<h1>Lists of Users & Employee</h1>
						<form method="get" action="/dashboard">
						<input type="text" id="searchInput" placeholder="Search...">
						<i class='bx bx-search search-icon' ></i>
						</form>
						</div>
					<table>
						<thead>
							<tr>
								<th>Name</th>
								<th>Role</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>

						@forelse ($regular as $regularuser)
							<tr data-type="user">
								<td>
									
									<p>{{ $regularuser->first_name }} {{ $regularuser->last_name }}</p>
								</td>
								<td>{{ $regularuser->Status->description }}</td>
								<td>
								
									<span class="status {{ $regularuser->status == 1 ? 'active' : 'inactive' }}">
										{{ $regularuser->status == 1 ? 'Active' : 'Inactive' }}
									</span>
								</td>
							</tr>
							@empty
							<tr>
								<td colspan="3">No users found</td>
							</tr>
						@endforelse

						@forelse ($employees as $employee)
							<tr data-type="user">
								<td>
									
									<p>{{ $employee->first_name }} {{ $employee->last_name }}</p>
								</td>
								<td>{{ $employee->position->description }}</td>
								<td>
								
									<span class="status {{ $employee->status == 1 ? 'active' : 'inactive' }}">
										{{ $employee->status == 1 ? 'Active' : 'Inactive' }}
									</span>
								</td>
							</tr>
							@empty
							<tr>
								<td colspan="3">No users found</td>
							</tr>
						@endforelse
						</tbody>
					</table>
				</div>
			</div>
					@if(auth()->user()->hasRole('admin'))
				@livewire('activity-log.activity-log')
				@endif
					@if(auth()->user()->hasRole('Head'))
				@livewire('todo-list.todo-list')
				@livewire('add-task-modal.add-task-modal')
				@livewire('add-task-modal.view-task-modal', ['tasks' => $tasks])
				@endif
				
			</div>
			@endif
				

            <script>
                // Listen for the 'viewTask' event and show the view modal
                Livewire.on('viewTask', function (taskId) {
                    Livewire.emit('showViewTaskModal', taskId);
                });

                // Listen for the 'taskAdded' event and reload the Livewire component
                Livewire.on('taskAdded', function () {
                    Livewire.emit('refreshComponent', 'todo-list');
                });
            </script>
		
</x-app-layout>
@endif

<script>

    document.addEventListener('DOMContentLoaded', function () {
        var fireIcons = document.querySelectorAll('.box-info li i.fa-fire-extinguisher');

        if (fireIcons.length > 0) {
            // Add a specific class to the last fire extinguisher icon
            fireIcons[fireIcons.length - 1].classList.add('fas-fire-extinguisher-red');
        }
    });


</script>