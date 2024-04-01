<x-app-layout> <x-slot name="header">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eee;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }



        .card {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .card h3 {
            margin-top: 0;
        }

        .warning {
            color: #ff6666;
        }
    </style>



<body>
    <div class="container">


        <div class="card">
            <div class="max-w-xl">
                <h3>Update Profile Information</h3>
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="card">
            <div class="max-w-xl">
                <h3>Update Password</h3>
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="card">
            <div class="max-w-xl">
                <h3>Delete Account</h3>
                <p class="warning">Once you delete your account, there is no going back. Please be certain.</p>
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</body>
</x-app-layout>