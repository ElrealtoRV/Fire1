<div class="container d-flex justify-content-center align-items-center vh-100">
<div class="modal-content" style="max-width: 800px; width: 100%;">
    <div class="modal-header" style="background: linear-gradient(to right, #3498db, #2e37a4); color:white;">
        <h1 class="modal-title fs-5" style="color: white;">
            @if ($fireId)
                Edit Fire Extinguisher
            @else
                Install Fire Extinguisher
            @endif
        </h1>
        <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal"  aria-label="Close"></button>
    </div>
    @if ($errors->any())
    <span class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </span>
    @endif
    <form wire:submit.prevent="store" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="row">
            <div class="col-md-10 mx-auto">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group local-forms">
                                <label>
                                    Type
                                    <span class="login-danger">*</span>
                                </label>
                                <select class="form-control select" wire:model="type">

                                    <option value="" selected>Select a Types</option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}">
                                            {{ $type->description }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group local-forms">
                                <label>Name</label>
                                <input class="form-control" type="text" wire:model="firename" placeholder />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group local-forms">
                                <label>
                                    Serial Number
                                    <span class="login-danger">*</span>
                                </label>
                                <input class="form-control" type="text" wire:model="serial_number" placeholder />
                            </div>
                        </div>
                    </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group local-forms">
                                            <label>
                                                Building / Department
                                                <span class="login-danger">*</span>
                                            </label>
                                            <select class="form-control select" wire:model="building">

                                                <option value="" selected>Select a Building</option>
                                                @foreach ($locations as $location)
                                                    <option value="{{ $location->id }}">
                                                        {{ $location->building }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group local-forms">
                                            <label>
                                               Floor
                                                
                                            </label>
                                            <select class="form-control select" wire:model="floor">

                                                <option value="" selected>Select a Floor</option>
                                                @foreach ($locations as $location)
                                                    <option value="{{ $location->id }}">
                                                        {{ $location->floor }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group local-forms">
                                            <label>
                                                Room / Office
                                                <span class="login-danger">*</span>
                                            </label>
                                            <select class="form-control select" wire:model="room">

                                                <option value="" selected>Select a Room</option>
                                                @foreach ($locations as $location)
                                                    <option value="{{ $location->id }}">
                                                        {{ $location->room }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                        <div class="row">
                        <div class="col-md-6">
                            <div class="form-group local-forms">
                                <label>
                                    Installation Date
                                    <span class="login-danger">*</span>
                                </label>
                                <input class="form-control" type="date" wire:model="installation_date" placeholder />
                            </div>
                        </div>
                    


                        <div class="col-md-6">
                            <div class="form-group local-forms">
                                <label>
                                    Expiration Date
                                    <span class="login-danger">*</span>
                                </label>
                                <input class="form-control" type="date" id="expiry-date" wire:model="expiration_date" placeholder />
                                @error('expiration_date') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                        </div>
                        </div>
                        </div>
                        
                        <div class="row">
                        <div class="col-md-12">
                            <div class="form-group local-forms">
                                <label>
                                 Description
                                    <span class="login-danger">*</span>
                                </label>
                                <input class="form-control" type="text" wire:model="description" placeholder />
                               
                                
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                            <div class="col-md-6">
                                <div class="form-group local-forms">
                                    <label>
                                        Status
                                        <span class="login-danger">*</span>
                                    </label>
                                    <select class="form-control" wire:model="status">
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                        <option value="Refill">Refill</option>
                                    </select>
                                </div>
                                
                            </div>
                            
                        </div>

                        </div>
                    </div>
                </div>

                
      
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>
</div>
@push('scripts')
    <script>
            $(function(){
                $('#expiry-date').datetimepicker({
                    format: 'Y-MM-DD'
                })
                .on('dp.change',function(ev){
                    var data = $('#expiry-date').val();
                    Livewire.emit('expiration_date', data);
                })
            });
    </script>
@endpush