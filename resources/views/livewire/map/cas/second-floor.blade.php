<style>
   

    .floor-content {
        display: inline-block;
        padding: 20px;
        position: relative;
    }



/* Other styles... */

.FCRH,
.RA,
.LRA,
.LBS,
.IAO,
.ITO,
.ITO-DS,
.LSR,
.OOTL,
.RPS,
.LS,
.GSS {
    position: absolute;
    cursor: pointer;
    display: flex;
    gap: 10px;
}

.FCRH {
    top: 35px;
    left: 120px;
}

.RA {
    top: 35px;
    left: 445px;
}

.LRA {
    top: 35px;
    left: 830px;
}

.LBS {
    top: 35px;
    left: 965px;
}

.IAO {
    top: 215px;
    left: 120px;
    justify-content: space-between;
    gap: 5px;
}

.ITO {
    top: 205px;
    left: 180px;
    justify-content: space-between;
    gap: 5px;
}

.ITO-DS {
    top: 205px;
    left: 250px;
    justify-content: space-between;
    gap: 5px;
}

.LSR {
    top: 205px;
    left: 290px;
    justify-content: space-between;
    gap: 5px;
}

.OOTL {
    top: 205px;
    left: 375px;
    justify-content: space-between;
    gap: 5px;
}

.RPS {
    top: 205px;;
    left: 680px;
    justify-content: space-between;
    gap: 5px;
}

.LS {
    top: 205px;
    left: 810px;
    justify-content: space-between;
    gap: 5px;
}

.GSS {
    top: 205px;
    left: 945px;
    justify-content: space-between;
    gap: 5px;
}

#eye-icon,
#edit-icon {
    font-size: small;
    display: inline-block;
    margin-left: 13px;
}

#edit-icon {
    color: green;
    margin-left: 5px;
}

#eye-icon {
    color: gray;
    margin-left: 20px;
}

.edit-icon {
    color: green;
    margin-left: -13px;
}

.eye-icon {
    color: gray;
    padding-right: 25px;
}
@media (max-width: 768px) {
        .horizontal-scroll-container {
            width: 800px; /* Adjust this value based on your desired width for smaller screens */
        }
    }
</style>
<div class="scroll-container">
    <div id="second-floor" class="floor-content">
        <img src="{{ asset('assets/img/CasSecondFloor.png') }}" alt="SecondFloor" width="1000px" height="300px">
          <span class="FCRH" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-eye eye-icon"></i></span>
          <span class="FCRH" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-edit edit-icon"></i></span>
          <span class="RA" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-eye eye-icon"></i></span>
          <span class="RA" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-edit edit-icon"></i></span>
          <span class="LRA" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-eye eye-icon"></i></span>
          <span class="LRA" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-edit edit-icon"></i></span>
          <span class="LBS" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-eye eye-icon"></i></span>
          <span class="LBS" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-edit edit-icon"></i></span>
          <span class="IAO" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-eye eye-icon"id="eye-icon"></i></span>
          <span class="IAO" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-edit edit-icon" id="edit-icon"></i></span>
          <span class="ITO" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-eye eye-icon"id="eye-icon"></i></span>
          <span class="ITO" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-edit edit-icon" id="edit-icon"></i></span>
          <span class="ITO-DS" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-eye eye-icon"id="eye-icon"></i></span>
          <span class="ITO-DS" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-edit edit-icon" id="edit-icon"></i></span>
          <span class="LSR" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-eye eye-icon"id="eye-icon"></i></span>
          <span class="LSR" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-edit edit-icon" id="edit-icon"></i></span>
          <span class="OOTL" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-eye eye-icon"></i></span>
          <span class="OOTL" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-edit edit-icon" ></i></span>
          <span class="RPS" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-eye eye-icon"></i></span>
          <span class="RPS" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-edit edit-icon" ></i></span>
          <span class="LS" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-eye eye-icon"></i></span>
          <span class="LS" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-edit edit-icon" ></i></span>
          <span class="GSS" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-eye eye-icon"></i></span>
          <span class="GSS" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-edit edit-icon" ></i></span>
          <h1>SECOND FLOOR</h1>
    
        </div>

</div>



