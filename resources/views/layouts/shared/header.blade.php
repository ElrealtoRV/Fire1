<style>
	#back-to-top-button {
		position: fixed;
		bottom: 20px;
		/* Adjust the distance from the bottom as needed */
		right: 20px;
		/* Adjust the distance from the right as needed */
		/* display: none; */
		z-index: 999;
		/* Ensure it's above other elements */
		cursor: pointer;
	}

	.mobile-user-menu {
		position: absolute;
		top: 10px;
		right: 10px;
	}
</style>

<div class="header">
			<div class="header-left">
				<a href="/" class="logo">
					<span style="display: flex;">
						<img id="fireExtinguisherIcon" src="{{ asset('assets/img/logoIcon/fire-extinguisher.png') }}" width="50" height="50" alt="Fire Extinguisher Icon" style=" display: none;">
						<span class="text1"style="font-size:15px font-weight:bold;">
						<p style="font-size:10px; padding-top:1px; margin-bottom:-10px; margin-right:120px;">Norsu </p>Fire Extinguisher
							<p style="font-size:15px ">MMSS</p>
						</span>
					</span>
</a>
				
			</div>
			<a id="toggle_btn" href="#"><img src="{{ asset('assets/img/icons/bar-icon.svg') }}" alt></a>




		<a id="mobile_btn" class="mobile_btn float-start" href="#sidebar"><img
				src="{{ asset('assets/img/icons/bar-icon.svg') }}" alt></a>

	<div class="top-nav-search mob-view">
		<form>
			<input type="text" class="form-control" placeholder="Search here">
			<a class="btn"><img src="{{ asset('assets/img/icons/search-normal.svg') }}" alt></a>
		</form>

	</div>
	<a href="#top" id="back-to-top-button" alt>
		<i class="fa-solid fa-arrow-up"></i> <!-- Use the appropriate icon class here -->
	</a>


	<ul class="nav user-menu float-end">
	<a href="#" class="notification">
				<i class='bx bxs-bell' ></i>
				<span class="num">8</span>
			</a>
    <li class="nav-item dropdown has-arrow user-profile-list" id="prolist">
        <a  class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
            <div class="user-names">
                {{-- <h5>{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h5>
                <span class="text-capitalize">{{ auth()->user()->roles[0]->name }}</span> --}}
                <!-- Use the user's name instead of the image -->
                <span style="color: black;">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }} <i class="fa fa-chevron-down"></i></span>
            </div>
        </a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="settingView" style="color: black;">Settings</a>
            <a class="dropdown-item" href="{{ route('logout') }}" style="color: black;">Logout</a>

            <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </a>
        </div>
    </li>
</ul>



</div>
<script>
    document.getElementById('toggle_btn').addEventListener('click', function () {
        var icon = document.getElementById('fireExtinguisherIcon');
        icon.style.display = (icon.style.display === 'none' || icon.style.display === '') ? 'inline' : 'none';
    });
</script>