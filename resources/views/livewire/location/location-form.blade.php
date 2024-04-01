<div class="modal-content">
    <div class="modal-header" style="background: linear-gradient(to right, #3498db, #2e37a4); color:white;">
        <h1 class="modal-title fs-5" style="color:white;">
            @if ($locationId)
            Edit Location
            @else
            Add Location
            @endif
        </h1>
        <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    @if ($errors->any())
    {{ implode('', $errors->all('<div>:message</div>')) }}
    @endif
    <form wire:submit.prevent="store" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group local-forms">
                        <label>
                            Building
                            <span class="login-danger">*</span>
                        </label>
                        <input class="form-control" type="text" wire:model="building" placeholder />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group local-forms">
                        <label>
                            Floor
                            <span class="login-danger">*</span>
                        </label>
                        <input class="form-control" type="text" wire:model="floor" placeholder />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group local-forms">
                        <label>
                            Room
                            <span class="login-danger">*</span>
                        </label>
                        <input class="form-control" type="text" wire:model="room" placeholder />
                    </div>
                </div>
                <div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
    </form>
</div>