<div class="content">
	<div class="page-header">
		<div class="row">
			<div class="col-sm-12">
				<ul class="breadcrumb">
					<li class="breadcrumb-item"><a href="/">Dashboard</a></li>
					<li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
					<li class="breadcrumb-item active">Regular User List</li>
				</ul>
			</div>
		</div>
	</div>
	<livewire:flash-message.flash-message />
	<div class="row d-flex justify-content-center">
		<div class="col-sm-12">
			<div class="card card-table show-entire">
				<div class="card-body">
					<div class="page-table-header mb-2">
						<div class="row align-items-center">
							<div class="col">
								<div class="doctor-table-blk">
									<h3>Regular User List</h3>
									<div class="doctor-search-blk">
										<div class="add-group">
										@if(auth()->user()->hasRole('admin'))
											<a wire:click="createRegularUser" class="btn btn-primary ms-2"><img src="{{ asset('assets/img/icons/plus.svg') }}" alt>
											</a>
										@endif
										</div>
									</div>
								</div>
							</div>
							<div class="col-auto text-end float-end ms-auto download-grp">
								<div class="top-nav-search table-search-blk">
									<form>
										<input type="text" class="form-control" placeholder="Search here" wire:model.debounce.500ms="search" name="search">
										<a class="btn"><img src="{{ asset('assets/img/icons/search-normal.svg') }}" alt></a>
									</form>
								</div>
							</div>
						</div>
					</div>
					<div>
						<div class="row">
							<div class="col-sm-2">

							</div>
							<div class="col-sm-2">

							</div>
						</div>
					</div>

					<div class="table-responsive">
						<table class="table border-0 custom-table comman-table datatable mb-0">
							<thead>
								<tr style="background: linear-gradient(to right, #3498db, #2e37a4); color:white;">
									<th style="width: 30%; color:white;">Name</th>

									<th style="width: 20%; color:white;">Affiliation</th>
									<th style="width: 20%; color:white;">Department</th>
									<th style="width: 30%; color:white;text-align: center;">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($regular as $user)
								<tr>
									<td class="text-capitalize">
										{{ $user->first_name }} {{ $user->middle_name ?? '' }}
										{{ $user->last_name }}
									</td>

                                    <td>{{ optional($user->Affiliation)->description }}</td>
									<td>
										{{ $user->dept }}
									</td>
									<td class="text-center">
										<div class="btn-group" role="group">
											<button type="button" class="btn btn-primary btn-sm mx-1" wire:click="editRegularUser({{ $user->id }})" title="Edit">
												<i class='fa fa-pen-to-square'></i>
											</button>

											<a class="btn btn-danger btn-sm mx-1" wire:click="deleteRegularUser({{ $user->id }})" title="Delete">
												<i class="fa fa-trash"></i>
											</a>
										</div>
																				</div>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		@if(auth()->user()->hasRole('admin'))
		{{-- Modal --}}
		<div wire.ignore.self class="modal fade" id="RegularUserModal" tabindex="-1" role="dialog" aria-labelledby="RegularUserModal" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
			<div class="modal-dialog modal-dialog-centered modal-lg">
				<livewire:regular-user.regular-user-form />
			</div>
		</div>
		@section('custom_script')
		@include('layouts.scripts.regularuser-scripts')
		@endsection
		@endif