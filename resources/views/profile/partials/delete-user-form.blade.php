
    <style>


        h2 {
            margin-top: 0;
        }

        .danger-button {
            padding: 10px 20px;
            background-color: #ff4d4d;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .danger-button:hover {
            background-color: #ff3333;
        }

        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
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

        .button-group {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .secondary-button {
            padding: 10px 20px;
            background-color: #ccc;
            color: #333;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .secondary-button:hover {
            background-color: #aaa;
        }
    </style>

<body>
    <div class="container">
        <section>
            <header>
                <h2>Delete Account</h2>
                <p>Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.</p>
            </header>

            <button class="danger-button">Delete Account</button>

            <div class="modal" style="display: none;">
                <div class="modal-content">
                    <form method="post" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('delete')

                        <h2>Are you sure you want to delete your account?</h2>
                        <p>Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.</p>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" name="password" type="password" placeholder="Password">
                            @error('password')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="button-group">
                            <button type="button" class="secondary-button">Cancel</button>
                            <button type="submit" class="danger-button">Delete Account</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>

    <script>
        const dangerButton = document.querySelector('.danger-button');
        const modal = document.querySelector('.modal');

        dangerButton.addEventListener('click', () => {
            modal.style.display = 'flex';
        });

        const cancelButton = document.querySelector('.secondary-button');
        cancelButton.addEventListener('click', () => {
            modal.style.display = 'none';
        });
    </script>
</body>
