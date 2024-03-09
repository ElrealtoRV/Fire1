

@if(auth()->user()->hasRole('Head'))
       <div class="setting-box">
            <h2 class="P">Profile</h2>
            <div class="profile">
                <h5 class="PP1">Profile Photo</h5>
                <div class="changeP">
                    <button class="profileButton">
                        <img src="img/fire.png" class="photo1" id="profileImage">
                        <span>Change</span>
                    </button>
                </div>
            </div>
            <div class="text5">
                <h5 class="ChangeP">Account Setting</h5>
                <p>To manage your account. Go to <a href="/profile">Account Setting</a></p>
            </div>
        </div>
@endif
@if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('Head'))
<div class="setting-box">
                <div class="setting2-box">
                    <h2 class="P">Notification Settings</h2>
                    
                    <div class="notification-category">
                        <h5 >Fire Extinguisher Alerts</h5>
                        <p class="text6">Receive notifications for fire extinguisher-related alerts.</p>
                        <div class="switch-container">
                            <input type="checkbox" id="fireExtinguisherSwitch">
                            <label for="fireExtinguisherSwitch" class="switch"></label>
                        </div>
                    </div>
                    <div class="notification-category">
                        <h5 >New User Alert</h5>
                        <p class="text6">Enable this notification to receive alerts when a new user signs up.</p>
                        <div class="switch-container">
                            <input type="checkbox" id="commentsSwitch">
                            <label for="commentsSwitch" class="switch"></label>
                        </div>
                    </div>
                    <div class="notification-category">
                    <h5 >System Updates</h5>
                    <p class="text6">Receive notifications for system updates and maintenance.</p>
                    <div class="switch-container">
                        <input type="checkbox" id="systemUpdatesSwitch">
                        <label for="systemUpdatesSwitch" class="switch"></label>
                    </div>
                    </div>
                </div>
                </div>
@endif