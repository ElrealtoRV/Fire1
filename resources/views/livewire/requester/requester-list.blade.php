<div class="content">
	<div class="page-header">
		<div class="row">
			<div class="col-sm-12">
				<ul class="breadcrumb">
					<li class="breadcrumb-item"><a href="/">Dashboard</a></li>
					<li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
					<li class="breadcrumb-item active">Requester List</li>
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
									<h3>Requester List</h3>
									<div class="doctor-search-blk">
										<div class="add-group">
											<a wire:click="createRequester" class="btn btn-primary ms-2"><img src="{{ asset('assets/img/icons/plus.svg') }}" alt>
											</a>
										</div>
									</div>
								</div>
							</div>
							<div class="col-auto text-end float-end ms-auto download-grp">
								<div class="top-nav-search table-search-blk">
									<form>
										<input type="text" class="form-control" placeholder="Search here" wire:model.debounce.500ms="search">
										<a class="btn"><img src="{{ asset('assets/img/icons/search-normal.svg') }}" alt></a>
									</form>
								</div>
							</div>
						</div>
					</div>

					<div class="table-responsive">
						<table class="table border-0 custom-table comman-table mb-0">
							<thead>
								<tr>
									<th>Requester</th>
									<th>Id Number</th>
									<th>Contact Number</th>
									{{--<th>Sex</th>
									<th>Position</th>
									<th>College</th>
									<th>Course</th>--}}
									<th>Action</th>

								</tr>
							</thead>
							<tbody>

								@foreach ($requesters as $requester)
								<tr>
									<td>
										{{ $requester->first_name }} {{ $requester->middle_name }} {{ $requester->last_name }}
									</td>
									<td>
										{{ $requester->id_number}}
									</td>
									<td>
										{{ $requester->contact_number}}
									</td>
									{{--<td>
										{{ $requester->sex->description ?? ''}}
									</td>
									<td>
										{{ $requester->position->description ?? ''}}
									</td>
									<td>
										{{ $requester->college->description}}
									</td>
									<td>
										{{ $requester->course->description ?? ''}}
									</td>--}}

									<td class="text-center">
										<div class="btn-group" role="group">

											@if(auth()->user()->hasRole('admin'))
											@if ($requester->user_id == null)
											<button type="button" class="btn btn-primary btn-sm mx-1" wire:click="createRequesterAccount({{ $requester->id }})" title="Add">
										
												<i class="fa-solid fa-user-plus"></i>
											</button>
											@endif
											@endif
											<button type="button" class="btn btn-primary btn-sm mx-1" wire:click="editRequester({{ $requester->id }})" title="Edit">
												<i class='fa fa-pen-to-square'></i>
											</button>
											{{--<a class="btn btn-danger btn-sm mx-1" wire:click="deleteRequester({{ $requester->id }})" title="Delete">
												<i class="fa fa-trash"></i>
											</a>--}}
										</div>
									</td>

								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
			{{-- Modal --}}

			<div wire.ignore.self class="modal fade" id="requesterModal" tabindex="-1" role="dialog" aria-labelledby="requesterModal" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
				<div class="modal-dialog modal-dialog-centered">
					<livewire:requester.requester-form />
				</div>
			</div>
			<div wire.ignore.self class="modal fade" id="requesterAccountModal" tabindex="-1" role="dialog" aria-labelledby="requesterAccountModal" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
				<div class="modal-dialog modal-dialog-centered">
					<livewire:requester.requester-account-form />
				</div>
			</div>
			@section('custom_script')
			@include('layouts.scripts.requester-scripts')
			@endsection

		</div>
		<!-- Pagination links -->
		{{ $requesters->links() }}
	</div>
</div>