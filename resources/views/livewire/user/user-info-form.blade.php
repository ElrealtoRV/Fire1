<div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5">
            @if ($userId)
            Add UserInfo
            @else
            Add UserInfo
            @endif
        </h1>
        <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    {{--@if ($errors->any())
    {{ implode('', $errors->all('<div>:message</div>')) }}
    @endif--}}

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
                <div class="col-md-6">
                    <div class="form-group local-forms">
                        <label>
                            Id Number

                        </label>
                        <input class="form-control" type="text" wire:model="idnum" placeholder />
                    </div>
                </div>
                {{--<div class="col-md-6">
                    <div class="form-group local-forms">
                        <label>Position
                        </label>
                        <select class="form-control select" wire:model="position_id">
                            <option value="" selected>Select a Position</option>
                            @foreach ($positions as $position)
                            @if ($position->description != 'Head of Office')
                            <option value="{{ $position->id }}">
                {{ $position->description }}
                </option>
                @endif
                @endforeach
                </select>
            </div>

        </div>--}}

        <div class="col-md-6">
            <div class="form-group local-forms">
                <label>
                    First name

                </label>
                <input class="form-control" type="text" wire:model="first_name" placeholder />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group local-forms">
                <label>
                    Middle name

                </label>
                <input class="form-control" type="text" wire:model="middle_name" placeholder />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group local-forms">
                <label>
                    Last name

                </label>
                <input class="form-control" type="text" wire:model="last_name" placeholder />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group local-forms">
                <label>
                    Contact Number

                </label>
                <input class="form-control" type="text" wire:model="contnum" placeholder />
            </div>
        </div>

      <div class="col-md-12">
            <div class="form-group local-forms">
                <label>Position

                </label>
                <select class="form-control select" wire:model="position_id">
                    <option value="" selected>Position</option>
                    @foreach ($positions as $position)
                    <option value="{{ $position->id }}">
                        {{ $position->description }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group local-forms">
                <label>
                    Department

                </label>
                <input class="form-control" type="text" wire:model="dept" placeholder />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group local-forms">
                <label>
                    Age

                </label>
                <input class="form-control" type="text" wire:model="age" placeholder />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group local-forms">
                <label>
                    BIrthdate

                </label>
                <input class="form-control" type="date" wire:model="bdate" placeholder />
            </div>
        </div>
  {{--
        <div class="col-md-12">
            <div class="form-group local-forms">
                <label>Course
                </label>
                <select class="form-control select" wire:model="course_id">
                    <option value=null selected>Select a Course</option>
                    @foreach ($courses as $course)
                    <option value="{{ $course->id }}">
                        {{ $course->description }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
  

        <div class="col-md-6">
            <div class="form-group local-forms">
                <label>Gender

                </label>
                <select class="form-control select" wire:model="sex_id">
                    <option value="" selected>Select a Gender</option>
                    @foreach ($sexes as $sex)
                    <option value="{{ $sex->id }}">
                        {{ $sex->description }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>--}}

</div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-primary">Save</button>
</div>
</form>
</div>