<div>
    {{-- The Master doesn't talk, he acts. --}}
</div>
<style>


/* Other styles... */

.MC,
.RR,
.CR,
.CONROOM,
.UEO,
.RA,
.TR3,
.TR2,
.TR1,
.CONTROL1,
.CONTROL2,
.IRS,
.CL2,
.CL1,
.CMR,
.LMR {
    position: absolute;
    cursor: pointer;
    display: flex;
    gap: 10px;
}

.MC {
    top: 40px;
    left: 120px;
}
.CR {
    top: 40px;
    left: 385px;
}
.TR3 {
    top: 40px;
    left: 575px;
}
.TR2 {
    top: 40px;
    left: 708px;
}
.TR1 {
    top: 40px;
    left: 840px;
}
.CONTROL1 {
    top: 200px;
    left: 120px;
}
.CONTROL2 {
    top: 255px;
    left: 120px;
}
.IRS {
    top: 200px;
    left: 430px;
}
.CL2 {
    top: 200px;
    left: 560px;
}
.CL1 {
    top: 200px;
    left: 705px;
}
.CMR {
    top: 200px;
    left: 825px;
}
.LMR {
    top: 200px;
    left: 955px;
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
<div class="horizontal-scroll-container">
    <div id="fourth-floor" class="floor-content">
        <img src="{{ asset('assets/img/CAS4THFLOOR.png') }}" alt="FourthFloor" width="1000px" height="300px"> 
        <span class="MC" onclick="openModal('')"><i class="fas fa-eye eye-icon"></i></span>
        <span class="MC" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-edit edit-icon"></i></span> 
        <span class="CR" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-eye eye-icon"id="eye-icon"></i></span>
        <span class="CR" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-edit edit-icon"id="edit-icon"></i></span>
        <span class="TR3" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-eye eye-icon"></i></span>
        <span class="TR3" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-edit edit-icon"></i></span> 
        <span class="TR2" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-eye eye-icon"></i></span>
        <span class="TR2" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-edit edit-icon"></i></span> 
        <span class="TR1" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-eye eye-icon"></i></span>
        <span class="TR1" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-edit edit-icon"></i></span> 
        <span class="CONTROL1" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-eye eye-icon"id="eye-icon"></i></span>
        <span class="CONTROL1" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-edit edit-icon"id="edit-icon"></i></span> 
        <span class="CONTROL2" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-eye eye-icon"id="eye-icon"></i></span>
        <span class="CONTROL2" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-edit edit-icon"id="edit-icon"></i></span>
        <span class="IRS" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-eye eye-icon"></i></span>
        <span class="IRS" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-edit edit-icon"></i></span> 
        <span class="CL2" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-eye eye-icon"></i></span>
        <span class="CL2" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-edit edit-icon"></i></span> 
        <span class="CL1" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-eye eye-icon"></i></span>
        <span class="CL1" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-edit edit-icon"></i></span> 
        <span class="CMR" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-eye eye-icon"></i></span>
        <span class="CMR" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-edit edit-icon"></i></span> 
        <span class="LMR" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-eye eye-icon"></i></span>
        <span class="LMR" onclick="openModal('FACULTY COMPUTING AND RESEATCH CENTER')"><i class="fas fa-edit edit-icon"></i></span> 
        
        <h1>FOURTH FLOOR</h1>

    </div>
</div>


