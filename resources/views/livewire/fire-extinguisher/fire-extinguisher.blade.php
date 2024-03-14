<div class="content">
	<div class="page-header">
		<div class="row">
			<div class="col-sm-12">
				<ul class="breadcrumb">
					<li class="breadcrumb-item"><a href="/">Dashboard</a></li>
					<li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
					<li class="breadcrumb-item active">Fire Extinguisher List</li>
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
									<h3>Fire Extinguisher List</h3>
									<div class="doctor-search-blk">
										<div class="add-group">
											<a wire:click="createFire" class="btn btn-primary ms-2"><img src="{{ asset('assets/img/icons/plus.svg') }}" alt>
											</a>
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
									<th style="width: auto; color:white;">Type</th>
									<th style="width: auto; color:white;">Name</th>
									<th style="width: 20%;  color:white;">Serial Number</th>
									<th style="width:auto; color:white;">Location</th>
									<th style="width: auto; color:white;">Installation Date</th>
									<th style="width: auto; color:white;">Expiration Date</th>
									<th style="width: auto; color:white;">Description</th>
									<th style="width: 10%; color:white;">Status</th>
									<th style="width: 10%; text-align: center;color:white;">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($fire as $fires)
								<tr>
									<td>{{ $fires->fireex->description  }}</td>
									<td>{{ $fires->firename }}</td>
									<td>{{ $fires->serial_number }}</td>
									<td>{{ optional($fires->FireLocation)->description }}</td>
									<td>{{ $fires->installation_date }}</td>
									<td>{{ $fires->expiration_date }}</td>
									<td>{{ $fires->description }}</td>
									{{--<td>{{ $fires->status1->name ?? '' }}</td>--}}
									<td>
										@php
										// Set timezone to Philippine time
										$now = Carbon\Carbon::now('Asia/Manila');
										// Check if expiration_date is today in Philippine time
										$expiration_date_ph = Carbon\Carbon::parse($fires->expiration_date, 'UTC')->setTimezone('Asia/Manila');
										if ($now->toDateString() === $expiration_date_ph->toDateString()) {
										$fires->status_id = 2; // Update status_id to 2
										$fires->save(); // Save the changes to the database
										}
										@endphp

										{{ $fires->status1->name ?? '' }}
									</td>


									<td class="text-center">
										<div class="btn-group" role="group">
											<button type="button" class="btn btn-primary btn-sm mx-1" wire:click="editFire({{ $fires->id }})" title="Edit">
												<i class='fa fa-pen-to-square'></i>
											</button>

											<a class="btn btn-danger btn-sm mx-1" wire:click="deleteFire({{ $fires->id }})" title="Delete">
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

	{{-- Modal --}}
	<div wire.ignore.self class="modal fade" id="FireModal" tabindex="-1" role="dialog" aria-labelledby="FireModal" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<livewire:fire-extinguisher.fire-form />
		</div>
	</div>
	@section('custom_script')
	@include('layouts.scripts.fire-scripts')
	@endsection