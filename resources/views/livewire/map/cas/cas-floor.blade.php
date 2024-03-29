<style>
.container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: auto;
      width: auto;
      background-color: #eee;
      padding-top: 20px;
    }

    .floor-selection {
      text-align: center;
      padding-top:10px;
    }

    .floor-button {
      padding: 10px 20px;
      margin: 5px;
      font-size: 16px;
      background: linear-gradient(to right, #3498db, #2e37a4);
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .floor-button:hover {
      background-color: #eee;
    }
    .card {
        display: inline-block;
        cursor: pointer;
        width: auto;
        height: auto;
        padding-top: 20px;
        aspect-ratio: 1/1.5;
        border-radius: 8px;
        position: relative;
        margin: 0 auto;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        overflow: hidden;
    }

    .card:hover img {
        filter: grayscale(1) brightness(0.4);
    }

    .card:hover::after {
        opacity: 1;
        inset: 20px;
    }

    .card .content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        width: 80%;
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
    }

    .card:hover .content {
        opacity: 1;
    }


@media (max-width: 768px) {
  .modal-content {
    width: 200px;
  }
}
    .scroll-container {
        width: 100%;
        overflow-x: auto;
        white-space: nowrap;
        scrollbar-width: thin;
        scrollbar-color: #888 #f1f1f1;
    }

    .scroll-container::-webkit-scrollbar {
        height: 8px;
    }

    .scroll-container::-webkit-scrollbar-track {
        background-color: #f1f1f1;
    }

    .scroll-container::-webkit-scrollbar-thumb {
        background-color: #888;
        border-radius: 4px;
    }

    .horizontal-scroll-container {
        width: 100%;
        position: relative;
    }

    .floor-content {
        display: inline-block;
        padding: 20px;
        position: relative;
    }
.horizontal-scroll-container {
    width: 100%;
    overflow-x: auto;
    white-space: nowrap;
    position: relative; /* Added to make it a positioning context */
}
        @media screen and (max-width:600px) { 
           body{
            width: 350vw;
        
           }
        }
</style>
<div class="container">
    <div class="card">
      <div class="horizontal-scroll-container">
        
      <div class="floor-selection">
      
        <a href="#" class="floor-button" value="ground-floor"data-floor="Ground" onclick="showFloor('ground-floor')">Ground Floor</a>
        <a href="#" class="floor-button"  value="second-floor" data-floor="2nd" onclick="showFloor('second-floor')">2nd Floor</a>
        <a href="#" class="floor-button" value="third-floor"data-floor="3rd" onclick="showFloor('third-floor')">3rd Floor</a>
        <a href="#" class="floor-button" value="fourth-floor" data-floor="4th" onclick="showFloor('fourth-floor')">4th Floor</a>
       
      </div>
    @livewire('map.cas.ground-floor')

    <!-- Modal -->
</div>
</div>
</div>
</div>

<div id="myModal" class="modal">

    @livewire('fire-extinguisher.fire-form')
    
    <p id="modalContent"></p>
</div>
    <script>
  function showFloor(floorId) {
    const floorContents = document.getElementsByClassName('floor-content');
    for (let i = 0; i < floorContents.length; i++) {
      floorContents[i].style.display = 'none';
    }
    document.getElementById(floorId).style.display = 'block';
  }

  function openModal(content) {
    document.getElementById('modalContent').innerText = content;
    document.getElementById('myModal').style.display = 'flex';
  }

  function closeModal() {
    document.getElementById('myModal').style.display = 'none';
  }

  // Function to save the current floor ID to sessionStorage
  function saveCurrentFloor(floorId) {
    sessionStorage.setItem('currentFloor', floorId);
  }

  // Function to reload the page and stay on the current floor
  function reloadPage() {
    const currentFloorId = sessionStorage.getItem('currentFloor');
    saveCurrentFloor(currentFloorId); // Save current floor before reloading
    location.reload(); // Reload the page
  }

  // Function to restore the current floor after the page reloads
  function restoreCurrentFloor() {
    const currentFloorId = sessionStorage.getItem('currentFloor');
    if (currentFloorId !== null) {
      showFloor(currentFloorId); // Show the current floor after reloading
    }
  }

  // Call restoreCurrentFloor on page load to show the correct floor
  window.addEventListener('load', restoreCurrentFloor);
</script>
