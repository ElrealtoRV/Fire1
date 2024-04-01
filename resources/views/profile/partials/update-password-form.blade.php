
    <style>





        h2 {
            margin-top: 0;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="password"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            width: 100%;
        }

        .error {
            color: #ff6666;
            margin-top: 5px;
        }

        button {
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        button:hover {
            background-color: #555;
        }

        .success {
            color: #4caf50;
            margin-top: 5px;
        }
    </style>

<body>
    <div class="container">
        <section>
            <header>
                <h2>Update Password</h2>
                <p>Ensure your account is using a long, random password to stay secure.</p>
            </header>

            <form method="post" action="{{ route('password.update') }}" class="mt-6">
                @csrf
                @method('put')

                <div class="form-group">
                    <label for="update_password_current_password">Current Password</label>
                    <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password">
                    @error('current_password')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="update_password_password">New Password</label>
                    <input id="update_password_password" name="password" type="password" autocomplete="new-password">
                    @error('password')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="update_password_password_confirmation">Confirm Password</label>
                    <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password">
                    @error('password_confirmation')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit">Save</button>

                    @if (session('status') === 'password-updated')
                        <p class="success">Saved.</p>
                    @endif
                </div>
            </form>
        </section>
    </div>
