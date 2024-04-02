<div>
<style>
  
    .floor-content {
        display: inline-block;
        padding: 20px;
        position: relative;
    }
    

.CasDean,
.CAS106,
.CAS105,
.CAS104,
.MCL,
.CAS103,
.CAS102,
.CAS101,
.CAS107,
.CAS108,
.CAS109,
.CAS110,
.CAS111,
.CAS112,
.CAS-SSG {
    position: absolute;
    cursor: pointer;
    display: flex;
    gap: 10px;
}
  .CasDean{
    top: 45px;
    left: 113px;
  }
  .CAS106{
    top: 45px;
    left: 233px;
  }
  .CAS105{
    top: 45px;
    left: 353px;
  }
  .CAS104{
    top: 45px;
    left: 470px;
  }
  .MCL{
    top: 45px;
    left: 530px;
  }
  .CAS103{
    top: 45px;
    left: 645px;
  }
  .CAS102{
    top: 45px;
    left: 765px;
  }
  .CAS101{
    top: 45px;
    left: 885px;
  }
  .CAS107{
    top: 220px;
    left: 173px;
  }
  .CAS108{
    top: 200px;
    left: 265px;
  }
  .CAS109{
    top: 200px;
    left: 385px;
  }
  .CAS-SSG{
    top: 200px;
    left: 485px;
  }
  .CAS110{
    top: 200px;
    left: 620px;
  }
  .CAS111{
    top: 200px;
    left: 740px;
  }
  .CAS112{
    top: 200px;
    left: 857px;
  }

  #eye-icons,
  #edit-icons {
      font-size: small;
      display: inline-block;
      margin-left: 13px;
  }

  #edit-icons {
      color: green;
      margin-left: -3px;
  }

  #eye-icons {
      color: gray;
      margin-left: 30px;
  }

  .edit-icon {
      color: green;
      margin-left: -13px;
  }
  .plus-icon{
      color: black;
      margin-left: -35px;
  }
  .circle-icon{
    margin-left: -70px;
  }

  .eye-icon {
      color: gray;
      padding-right: 25px;
  }
  .active {
    background-color: green; /* Active state background color */
}

.inactive {
    background-color: orange; /* Inactive state background color */
}

.refill {
    background-color: blue; /* Refill state background color */
}
</style>
<livewire:flash-message.flash-message />
<div class="scroll-container">
    <div id="ground-floor" class="floor-content">
        
        <img src="{{ asset('assets/img/GroundFloor.png') }}" alt="GroundFloor" width="1000px" height="300px">
        @foreach ($fire as $fires)
        <div class="icon-container CasDean" wire:click="editFire({{ $fires->id }})">
            <i class="fas fa-edit edit-icon"></i>
        </div>
        <div class="icon-container CasDean" wire:click="viewFire({{ $fires->id }})">
            <i class="fas fa-eye eye-icon"></i>
        </div>
        <div class="icon-container CasDean" wire:click="createFire">
            <i class="fas fa-plus plus-icon"></i>
        </div>


        <div class="icon-container CAS106" wire:click="editFire({{ $fires->id }})">
            <i class="fas fa-edit edit-icon"></i>
        </div>
        <div class="icon-container CAS106" wire:click="viewFire({{ $fires->id }})">
            <i class="fas fa-eye eye-icon"></i>
        </div>
        <div class="icon-container CAS106" wire:click="createFire">
            <i class="fas fa-plus plus-icon"></i>
        </div>
       
        <span class="CAS105" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-eye eye-icon"></i></span>
        <span class="CAS105" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-edit edit-icon"></i></span>
        <span class="CAS105" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-plus plus-icon"></i></span>
        <span class="CAS104" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-eye eye-icon"></i></span>
        <span class="CAS104" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-edit edit-icon"></i></span>
        <span class="MCL" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-eye eye-icon"></i></span>
        <span class="MCL" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-edit edit-icon"></i></span>
        <span class="CAS103" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-eye eye-icon"></i></span>
        <span class="CAS103" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-edit edit-icon"></i></span>
        <span class="CAS102" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-eye eye-icon"></i></span>
        <span class="CAS102" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-edit edit-icon"></i></span>
        <span class="CAS101" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-eye eye-icon"></i></span>
        <span class="CAS101" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-edit edit-icon"></i></span>
        <span class="CAS107" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-eye eye-icon"></i></span>
        <span class="CAS107" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-edit edit-icon"></i></span>
        <span class="CAS108" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-eye eye-icon"></i></span>
        <span class="CAS108" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-edit edit-icon"></i></span>
        <span class="CAS109" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-eye eye-icon"></i></span>
        <span class="CAS109" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-edit edit-icon"></i></span>
        <span class="CAS-SSG" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-eye eye-icon" id="eye-icons"></i></span>
        <span class="CAS-SSG" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-edit edit-icon"id="edit-icons"></i></span>
        <span class="CAS110" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-eye eye-icon"></i></span>
        <span class="CAS110" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-edit edit-icon"></i></span>
        <span class="CAS111" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-eye eye-icon"></i></span>
        <span class="CAS111" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-edit edit-icon"></i></span>
        <span class="CAS112" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-eye eye-icon"></i></span>
        <span class="CAS112" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-edit edit-icon"></i></span>
        @endforeach
        <h1>GROUND FLOOR</h1>
    </div>
</div>

<div>
  {{-- Modal --}}
      <div wire.ignore.self class="modal fade" id="MapFormModal" tabindex="-1" role="dialog" aria-labelledby="MapFormModal" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <livewire:map.form />
        </div>
      </div>
      @section('custom_script')
      @include('layouts.scripts.MapForm-scripts')
      @endsection
  </div>