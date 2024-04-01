
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

        input[type="text"],
        input[type="email"] {
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
                <h2>Profile Information</h2>
                <p>Update your account's profile information and email address.</p>
            </header>

            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                @csrf
            </form>

            <form method="post" action="{{ route('profile.update') }}" class="mt-6">
                @csrf
                @method('patch')

                <div>
                    <x-input-label for="first_name" :value="__('First Name')" />
                    <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" :value="old('first_name', $user->first_name)" required autofocus autocomplete="first_name" />
                    <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
                </div>

                <div>
                    <x-input-label for="last_name" :value="__('Last Name')" />
                    <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="old('last_name', $user->last_name)" required autocomplete="last_name" />
                    @error('last_name')
                        <div class="error">{{ $message }}</div>
                    @enderror

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyLast_name && ! $user->hasVerifiedLast_name())
                        <div>
                            <p>Your last name is unverified.</p>
                            <form id="send-verification" method="post" action="{{ route('verification.last_name.send') }}">
                                @csrf
                                <button type="submit">Click here to re-send the verification last name.</button>
                            </form>

                            @if (session('status') === 'verification-link-sent')
                                <p class="success">A new verification link has been sent to your email address.</p>
                            @endif
                        </div>
                    @endif
                </div>

                


                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username">
                    @error('email')
                        <div class="error">{{ $message }}</div>
                    @enderror

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div>
                            <p>Your email address is unverified.</p>
                            <button form="send-verification">Click here to re-send the verification email.</button>

                            @if (session('status') === 'verification-link-sent')
                                <p class="success">A new verification link has been sent to your email address.</p>
                            @endif
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit">Save</button>

                    @if (session('status') === 'profile-updated')
                        <p class="success">Saved.</p>
                    @endif
                </div>
            </form>
        </section>
    </div>
</body>
