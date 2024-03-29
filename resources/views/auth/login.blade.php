<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="script.js" defer></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap');

        body {
            font-family: 'arial', sans-serif;
            background-color: #eee;
            color: black;
            overflow: hidden;
        }

        .container {
            max-width: 500px;
            margin: 100px auto;
            padding: 40px;
            background-color: whitesmoke;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 1;
        }

        h1 {
            text-align: center;
            color: black;
            margin-bottom: 30px;
            
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #45a29e;
            border-radius: 5px;
            background-color: #eee;
        }

        .error-message {
            color: red !important;
            margin-top: 5px;
            font-size: 11px;
        }
        
        #email-error{
            color: red;
            font-weight: 100;
            margin-top: 5px;
            font-size: 11px;
        }
        
        #password-error{
            color: red;
            font-weight: 100;
            margin-top: 5px;
            font-size: 11px;
        }
        .remember-me {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        #Forgot{
            margin-left: 97px;
            margin-bottom: 5px;
        }

        .remember-me input[type="checkbox"] {
            margin-right: 10px;
            margin-bottom: 5px;
        }

        .btn-primary {
            background-color: #3498db;
            width: 100%;
             border-color: black;
            color: white;
        }

        .btn-primary:hover {
            background-color: white;
            border-color: black;
            color: #3498db;
        }

        .background-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .background-container canvas {
            display: block;
        }

        /* Accessibility and Responsive Styles */


        @media (max-width: 767px) {
            .container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="background-container">
        <canvas id="background-canvas"></canvas>
    </div>
    <div class="container">
        
        <h1>Login</h1>
        @if(session('status'))
            <div class="alert alert-danger">
                {{ session('status') }}
            </div>
        @endif
 	<x-auth-session-status class="mb-4" :status="session('status')" />
        <form id="login-form" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email" aria-label="Email">Email</label>
                <div class="input-group">
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" aria-describedby="email-error">
                </div>
                <span id="email-error" class="error-message" aria-live="assertive"></span>
            </div>
            <div class="form-group">
                <label for="password" aria-label="Password">Password</label>
                <div class="input-group">
                    <input id="password" type="password" name="password" required autocomplete="current-password" aria-describedby="password-error">    
                </div>
                <span id="password-error" class="error-message" aria-live="assertive"></span>
            </div>
            <div class="remember-me">
                <input id="remember_me" type="checkbox" name="remember" aria-label="Remember me">
                <label for="remember_me">Remember me</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="btn btn-link" id="Forgot">Forgot your password?</a>
                @endif
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" aria-label="Log in">
                    Log in
                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                </button>
            </div>
        </form>
    </div>
    <main id="main-content" tabindex="-1"></main>
    <script>
        // script.js
        $(document).ready(function() {
            // Form Validation
            $('#login-form').validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true
                    }
                },
                messages: {
                    email: {
                        required: 'Please enter your email address',
                        email: 'Please enter a valid email address'
                    },
                    password: {
                        required: 'Please enter your password'
                    }
                },
                errorPlacement: function(error, element) {
                    var errorId = element.attr('id') + '-error';
                    error.appendTo($('#' + errorId).parent());
                },
                submitHandler: function(form) {
                    // Add loading spinner
                    $('.spinner-border').removeClass('d-none');

                    // Perform form submission or AJAX request
                    form.submit();
                }
            });

            // Password Visibility Toggle
            $('[id$="-toggle"]').on('click', function() {
                var inputId = $(this).prev().attr('id');
                var inputField = $('#' + inputId);
                var iconElement = $(this).find('i');

                if (inputField.attr('type') === 'password') {
                    inputField.attr('type', 'text');
                    iconElement.removeClass('bi-eye-slash').addClass('bi-eye');
                } else {
                    inputField.attr('type', 'password');
                    iconElement.removeClass('bi-eye').addClass('bi-eye-slash');
                }
            });

            // Background Animation
            const canvas = document.getElementById('background-canvas');
            const ctx = canvas.getContext('2d');
            const particles = [];
            const particleCount = 100;
            const particleRadius = 2;
            const maxSpeed = 2;

            class Particle {
                constructor() {
                    this.x = Math.random() * canvas.width;
                    this.y = Math.random() * canvas.height;
                    this.vx = (Math.random() - 0.5) * maxSpeed;
                    this.vy = (Math.random() - 0.5) * maxSpeed;
                    this.color = `rgb(${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)})`;
                }

                update() {
                    this.x += this.vx;
                    this.y += this.vy;

                    if (this.x < 0 || this.x > canvas.width) {
                        this.vx = -this.vx;
                    }

                    if (this.y < 0 || this.y > canvas.height) {
                        this.vy = -this.vy;
                    }
                }

                draw() {
                    ctx.beginPath();
                    ctx.arc(this.x, this.y, particleRadius, 0, 2 * Math.PI);
                    ctx.fillStyle = this.color;
                    ctx.fill();
                }
            }

            function initParticles() {
                for (let i = 0; i < particleCount; i++) {
                    particles.push(new Particle());
                }
            }

            function animateParticles() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);

                for (let i = 0; i < particles.length; i++) {
                    particles[i].update();
                    particles[i].draw();
                }

                requestAnimationFrame(animateParticles);
            }

            function resizeCanvas() {
                canvas.width = window.innerWidth;
                canvas.height = window.innerHeight;
            }

            initParticles();
            animateParticles();

            window.addEventListener('resize', resizeCanvas);
            resizeCanvas();
        });
    </script>
</body>
</html>